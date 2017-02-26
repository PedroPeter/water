<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Casa;
use App\Factura;
use App\Recibo;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Leitura;
use View;
use Validator;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = Carbon::now()->startOfMonth();
        $last_time = $time->subMonth(1);
        $numero_leitura = Leitura::all()->max('numero_leitura');
        $casas = Casa::all();
        if (count($casas) > 0) {
            foreach ($casas as $casa) {
                $leitura_anterior = $casa->leituras()->where([
                    ['numero_leitura', '=', $numero_leitura - 1], ['updated_at', '>=', $last_time], ['updated_at', '<=', $time], ['efectuado', '=', true]])->first();
                $factura = $casa->leituras->where('updated_at', '>', $time)->first()->factura;
                if (is_null($leitura_anterior)) {
                    $factura->l_anterior = 0;
                } else {
                    $factura->l_anterior = $leitura_anterior->consumo;
                }

            }
            $agua = Agua::first();
            $preco_minimo = $agua->metros_cubicos_minimos * $agua->preco_unitario;
            $facturas = Factura::where([
                ['updated_at', '>=', $time], ['paga', '=', false]
            ])->get();
            $facturas_data = array();
            foreach ($facturas as $factura) {
                $metros_cubicos = $factura->l_actual - $factura->l_anteriro;
                if ($metros_cubicos <= $agua->metros_cubicos_minimos) {
                    $val_pagar = $preco_minimo;
                } else {
                    $val_pagar = ($factura->l_actual - $factura->l_anterior) * $agua->preco_unitario;
                }
                $facturas_data[] = [
                    'numero' => $factura->id,
                    'l_anterior' => $factura->l_anterior,
                    'l_actual' => $factura->l_actual,
                    'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                    'val_pagar' => $val_pagar,
                    'obs' => $factura->observacao,
                ];
            }
            if (count((array)$facturas_data) > 0) {
                return View::make('gerente.facturasIndex')->with('facturas_data', $facturas_data);
            } else {
                return View::make('gerente.facturasIndex')->with('message', 'Nenhuma factura por processar.');
            }
        } else {
            return View::make('gerente.facturasIndex')->with('message', 'Nenhuma factura por processar.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View::make('gerente.facturaShow')->with('factura', Factura::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $input = $request->all();
            $factura = Factura::find($id);
            $factura->l_actual = $input['l_actual'];
            $factura->val_pagarl = $factura->l_actual -$factura->l_anterior;
            $factura->observacao = $input['observacao'];
            $factura->save();
            return redirect()->route('factura.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rules()
    {
        return [
            'l_actual' => 'required|numeric',
            'observacao' => 'required'
        ];
    }

    public function message()
    {
        return [
            'l_actual.required' => 'O consumo é obrigatório.',
            'observacao.required' => 'A observacao é obrigatória.',
        ];
    }

    public function factura($id)
    {
        $factura = \App\Factura::find($id);
        $nome = $factura->leitura->casa->cliente->user->nome;
        $apelido = $factura->leitura->casa->cliente->user->apelido;
        $time = Carbon::now()->format('d/m/Y');
        $p_unit = $factura->leitura->agua->preco_unitario;
        /*$pdf =PDF::loadView('gerente.factura',['factura'=>$factura,'time'=>$time,'apelido'=>$apelido,'nome'=>$nome,'p_unit'=>$p_unit]);
        //->setPaper('a5', 'landscape')->setWarnings(false)->save('myfile.pdf')
        return $pdf->stream();*/
        return View('gerente.factura')->with(['factura' => $factura, 'time' => $time, 'apelido' => $apelido, 'nome' => $nome, 'p_unit' => $p_unit]);
    }

    public function recibo($id)
    {
        $factura = \App\Factura::find($id);
        $factura->paga = true;
        $recibo = new Recibo();
        $recibo->factura()->associate($factura);
        $factura->save();
        $recibo->save();
        $nome = $factura->leitura->casa->cliente->user->nome;
        $apelido = $factura->leitura->casa->cliente->user->apelido;
        $p_unit = $factura->leitura->agua->preco_unitario;
        $total = ($factura->l_actual - $factura->l_anterior) * $p_unit;
        $time = Carbon::now()->format('d/m/Y');
        $data = [
            'numero' => $recibo->id,
            'factura' => $factura->id,
            'nome' => $nome,
            'apelido' => $apelido,
            'total' => $total,
            'data' => $time
        ];
        return View('gerente.recibo')->with($data);
    }

    public function pendentes()
    {
        $facturas_data[] = $this->factura_geral(false);
        if (count((array)$facturas_data) > 0) {
            return View::make('gerente.facturaspendentes')->with('facturas_data', $facturas_data);
        } else {
            return View::make('gerente.facturaspendentes')->with('message', 'Nenhuma factura pendente.');
        }
    }

    public function emetidas()
    {
            $facturas_data[] = $this->factura_geral(true);
        if (count((array)$facturas_data) > 0) {
            return View::make('gerente.facturasEmitidas')->with('facturas_data', $facturas_data);
        } else {
            return View::make('gerente.facturasEmitidas')->with('message', 'Nenhuma factura emetida.');
        }
    }

    public function factura_geral($bol)
    {
        $agua = Agua::first();
        $preco_minimo = $agua->metros_cubicos_minimos * $agua->preco_unitario;
        $facturas = Factura::where('paga', $bol)->get();
        $facturas_data = array();
        foreach ($facturas as $factura) {
            $metros_cubicos = $factura->l_actual - $factura->l_anteriro;
            if ($metros_cubicos <= $agua->metros_cubicos_minimos) {
                $val_pagar = $preco_minimo;
            } else {
                $val_pagar = ($factura->l_actual - $factura->l_anterior) * $agua->preco_unitario;
            }
            $facturas_data[] = [
                'numero' => $factura->id,
                'l_anterior' => $factura->l_anterior,
                'l_actual' => $factura->l_actual,
                'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                'val_pagar' => $val_pagar,
                'obs' => $factura->observacao,
            ];
        }

    return $facturas_data;}
}