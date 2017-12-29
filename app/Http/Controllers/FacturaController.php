<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Casa;
use App\Factura;
use App\FacturaOperacoes;
use App\Recibo;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Leitura;
use View;
use Validator;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    private $facturasOperacoestable = 'facturaOperacoes';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = Carbon::now()->startOfMonth();
        $last_leitura_day = Leitura::all()->max('created_at');
        $numero_leitura = Leitura::all()->max('numero_leitura');
        $casas = Casa::all();
        if (count($casas) > 0) {
            foreach ($casas as $casa) {
                $leitura_anterior = $casa->leituras()->where([
                    ['numero_leitura', '=', $numero_leitura - 1], ['efectuado', '=', true]])->first();
                if (!is_null($leitura_anterior)) {
                    $factura = $leitura_anterior->factura;
                    $factura->l_anterior = $leitura_anterior->consumo;
                }
            }
            $agua = Agua::first();
            $preco_minimo = $this->agua_preco_minimo();
            $facturas = Factura::where([
                ['updated_at', '>=', $last_leitura_day], ['paga', '=', false]
            ])->get();
            $facturas_data = array();
            foreach ($facturas as $factura) {
                $metros_cubicos = $factura->l_actual - $factura->l_anterior;
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
                    'preco_unitario' => $agua->preco_unitario,
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
        $operacoes = FacturaOperacoes::all()->first();
        return view('gerente.FacturaOperacoesEdit')->with("operacoes", $operacoes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operacoesCreate()
    {
        $operacoes = FacturaOperacoes::all();
        if (count($operacoes) < 1) {
            return view('gerente.FacturaOperacoes');
        } else {
            return view('gerente.FacturaOperacoes')->with("message", "Definicoes das operacoes sobre as facturas feitas.");
        }

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
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function operacoes(Request $request)
    {
        $rules = [
            'percentagem' => 'required|digits_between:1,100.',
            'ultimo_dia' => 'required|digits_between:1,31.',
        ];
        $message = [
            'percentagem.required' => 'A percentagem é obrigatória.',
            'ultimo_dia.required' => 'A observacao é obrigatória.',
        ];
        $validate = Validator::make($request->all(), $rules, $message);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $facturaOp = new FacturaOperacoes();
            $facturaOp->percentagem = $request->percentagem;
            $facturaOp->ultimo_dia = $request->ultimo_dia;
            $facturaOp->save();
            return redirect()->view('gerenre.FacturaOperacoes')->with("message", "Definicoes efectuadas com sucesso.");
        }

    }

    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function operacoesUpdate(Request $request, $id)
    {
        $rules = [
            'percentagem' => 'required|digits_between:1,100.',
            'ultimo_dia' => 'required|digits_between:1,31.',
        ];
        $message = [
            'percentagem.required' => 'O consumo é obrigatório.',
            'ultimo_dia.required' => 'O ultimo dia de leitura é obrigatório.',
        ];
        $validate = Validator::make($request->all(), $rules, $message);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $facturaOp = FacturaOperacoes::find($id);
            $facturaOp->percentagem = $request->percentagem;
            $facturaOp->ultimo_dia = $request->ultimo_dia;
            $facturaOp->save();
            return redirect()->route('factura.operacoes')->with("message", "Definicoes alteradas com sucesso.");
        }

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
            $p_unit = $factura->leitura->agua->preco_unitario;
            $factura->l_actual = $input['l_actual'];
            $metros_cubicos = $factura->l_actual - $factura->l_anterior;
            $agua = Agua::first();
            $preco_minimo = $this->agua_preco_minimo();
            if ($metros_cubicos <= $agua->metros_cubicos_minimos) {
                $val_pagar = $preco_minimo;
            } else {
                $val_pagar = ($factura->l_actual - $factura->l_anterior) * $p_unit;
            }
            $factura->val_pagar = $val_pagar;
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

    /**
     * Show specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
        $nome = $factura->leitura->casa->cliente->user->nome;
        $apelido = $factura->leitura->casa->cliente->user->apelido;
        $total = $factura->val_pagar + $factura->val_multa;
        $time = Carbon::now()->format('d/m/Y');
        $factura->save();
        $recibo->save();
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
        $facturas_data []= $this->factura_geral(false);
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
        $facturas = Factura::where('paga', $bol)->get();
        $facturas_data = array();
        foreach ($facturas as $factura) {
            $val_pagar = $factura->val_pagar;
            if ($factura->num_multas > 0) {
                $facturas_data = [
                    'numero' => $factura->id,
                    'l_anterior' => $factura->l_anterior,
                    'l_actual' => $factura->l_actual,
                    'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                    'val_pagar' => $val_pagar,
                    'obs' => $factura->observacao,
                    'meses_atrasados' => $factura->num_multas,
                    'val_multa' => $factura->val_multas,
                    'val_total' => $val_pagar + $factura->val_multas,
                ];


            }else{
            $facturas_data = [
                'numero' => $factura->id,
                'l_anterior' => $factura->l_anterior,
                'l_actual' => $factura->l_actual,
                'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                'val_pagar' => $val_pagar,
                'obs' => $factura->observacao,
                ];
            }
        }
        return $facturas_data;
    }

    public function agua_preco_minimo()
    {
        $agua = Agua::first();
        $preco_minimo = $agua->metros_cubicos_minimos * $agua->preco_unitario;
        return $preco_minimo;
    }

    public function agua_preco_unitario()
    {
        $agua = Agua::first();
        $preco_unitario = $agua->preco_unitario;
        return $preco_unitario;
    }


}