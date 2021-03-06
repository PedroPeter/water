<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Casa;
use App\Factura;
use App\FacturaOperacoes;
use App\Leitura;
use App\Recibo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Validator;
use View;
use Illuminate\Support\Facades\Log;


class FacturaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas_data = [];
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
            if (!is_null($facturas)) {
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
            }
        }
        return View::make('gerente.facturasIndex')->with('message', 'Nenhuma factura por processar.');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        $operacoes = FacturaOperacoes::all()->first();
        return view('gerente.FacturaOperacoesEdit')->with("operacoes", $operacoes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function operacoesCreate()
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
    public
    function store(Request $request)
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function operacoes(Request $request)
    {
        $rules = [
            'percentagem' => 'required|digits_between:1,100.',
            'ultimo_dia' => 'required|digits_between:1,31.',
        ];
        $message = [
            'percentagem.required' => 'A percentagem é obrigatória.',
            'ultimo_dia.required' => 'A observação é obrigatória.',
        ];
        $validate = Validator::make($request->all(), $rules, $message);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $facturaOp = new FacturaOperacoes();
            $facturaOp->percentagem = $request->percentagem;
            $facturaOp->ultimo_dia = $request->ultimo_dia;
            $facturaOp->save();
            Log::info('Definicao das operacoes sobre as facturas efectuado com sucesso por ' . Auth::user()->nome);
            return view('gerente.FacturaOperacoes')->with("message", "Operação efectuada com sucesso.");
        }

    }

    /*
     *
     * @param  \Illuminate\Http\Request $request
     */
    public
    function operacoesUpdate(Request $request)
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
            $facturaOp = FacturaOperacoes::find($request->id);
            $facturaOp->percentagem = $request->percentagem;
            $facturaOp->ultimo_dia = $request->ultimo_dia;
            $facturaOp->save();
            Log::info('Alteracao das operacoes sobre as facturas efectuado com sucesso por ' . Auth::user()->nome);
            return redirect()->route('factura.operacoes')->with("message", "Definicoes alteradas com sucesso.");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        return View::make('gerente.facturaShow')->with('factura', Factura::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
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
            Log::info('Alteracao das infoemacoes das facturas efectuado com sucesso por ' . Auth::user()->nome);
            return redirect()->route('factura.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }

    public
    function rules()
    {
        return [
            'l_actual' => 'required|numeric',
            'observacao' => 'required'
        ];
    }

    public
    function message()
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
    public
    function factura($id)
    {
        $factura = Factura::find($id);
        $facturaOp = FacturaOperacoes::all()->first();
        $multa = $facturaOp->percentagem;
        $ultimo_dia = $facturaOp->ultimo_dia;
        $nome = $factura->leitura->casa->cliente->user->nome;
        $apelido = $factura->leitura->casa->cliente->user->apelido;
        $time = Carbon::now()->format('d/m/Y');
        $p_unit = $factura->leitura->agua->preco_unitario;
        return View('gerente.factura')->with(['factura' => $factura, 'time' => $time, 'apelido' => $apelido, 'nome' => $nome, 'p_unit' => $p_unit, 'multa' => $multa, 'ultimo_dia' => $ultimo_dia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function recibo(Request $request, $id)
    {
        $factura = Factura::find($id);
        $factura->paga = true;
        $total = $factura->val_pagar + $factura->val_multa;
        if (isset($request->valor_parcial)) {
            if ($request->valor_parcial > 0 && $request->valor_parcial < $total) {
                $factura->pagamento_parcial = true;
                $factura->val_pago = $request->valor_parcial;
                $factura->val_pendente = $total - $request->valor_parcial;
                $factura->observacao = "A factura foi paga parcialmete. Valor pendente: " . $factura->val_pendente;
            }
        } else {
            $factura->val_pago = $total;
        }
        $nome = $factura->leitura->casa->cliente->user->nome;
        $apelido = $factura->leitura->casa->cliente->user->apelido;
        $time = Carbon::now()->format('d/m/Y');
        $recibo = new Recibo();
        $recibo->factura()->associate($factura);
        $factura->save();
        $recibo->save();
        $data = [
            'numero' => $recibo->id,
            'factura' => $factura->id,
            'nome' => $nome,
            'apelido' => $apelido,
            'total' => $factura->val_pago,
            'obs' => $factura->observacao,
            'data' => $time
        ];
        Log::info('Pagamento da fatura efectuado com sucesso. Operacao efectuada por ' . Auth::user()->username);
        return View('gerente.recibo')->with($data);
    }

    public
    function pendentes()
    {
        $facturas_data = $this->factura_geral(false);
        if (!is_null($facturas_data)) {
            return View::make('gerente.facturasPendentes')->with('facturas_data', $facturas_data);
        } else {
            return View::make('gerente.facturasPendentes')->with('message', 'Nenhuma factura pendente.');
        }
    }

    public
    function cliente_pendentes()
    {
        $user = Auth::user();
        $cliente = $user->cliente;
        $casa = $cliente->casa;
        if (count($casa) > 0) {
            $leituras = $casa->leituras;
            if (count($leituras) > 0) {
                foreach ($leituras as $leitura) {
                    $factura = $leitura->factura;
                    if (count($factura) > 0) {
                        if (!$factura->paga) {
                            $val_pagar = $factura->val_pagar;
                            $facturas_data [] = [
                                'numero' => $factura->id,
                                'l_anterior' => $factura->l_anterior,
                                'l_actual' => $factura->l_actual,
                                'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                                'meses_atrasados' => $factura->num_multas,
                                'val_multa' => $factura->val_multas,
                                'val_pagar' => $val_pagar,
                                'val_total' => $val_pagar + $factura->val_multas,
                                'obs' => $factura->observacao,
                            ];
                        }
                    }

                }
                if (!is_null($facturas_data)) {
                    return View::make('user.facturasPendentes')->with('facturas_data', $facturas_data);
                }
            } else {
                return View::make('user.facturasPendentes')->with('message', 'Ainda nao possui facturas processadas.');
            }
        } else {
            return View::make('user.facturasPendentes')->with('message', 'Ainda nao possui facturas processadas.');
        }
    }

    public
    function emetidas()
    {
        $facturas_data = $this->factura_geral(true);
        if (!is_null($facturas_data)) {
            return View::make('gerente.facturasEmitidas')->with('facturas_data', $facturas_data);
        } else {
            return View::make('gerente.facturasEmitidas')->with('message', 'Nenhuma factura emetida.');
        }
    }

    public
    function factura_geral($bol)
    {
        $facturas = Factura::where('paga', $bol)->get();
        if (count($facturas) > 0) {
            foreach ($facturas as $factura) {
                $val_pagar = $factura->val_pagar;
                if ($factura->num_multas > 0) {
                    $facturas_data [] = [
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


                } else {
                    $facturas_data [] = [
                        'numero' => $factura->id,
                        'l_anterior' => $factura->l_anterior,
                        'l_actual' => $factura->l_actual,
                        'metros_cubicos' => $factura->l_actual - $factura->l_anterior,
                        'meses_atrasados' => $factura->num_multas,
                        'val_multa' => $factura->val_multas,
                        'val_pagar' => $val_pagar,
                        'val_total' => $val_pagar + $factura->val_multas,
                        'obs' => $factura->observacao,
                    ];
                }
            }
            return $facturas_data;
        } else {
            return null;
        }
    }

    public
    function agua_preco_minimo()
    {
        $agua = Agua::first();
        $preco_minimo = $agua->metros_cubicos_minimos * $agua->preco_unitario;
        return $preco_minimo;
    }

    public
    function agua_preco_unitario()
    {
        $agua = Agua::first();
        $preco_unitario = $agua->preco_unitario;
        return $preco_unitario;
    }


}