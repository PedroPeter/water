<?php

namespace App\Http\Controllers;


use App\Agua;
use App\Factura;
use App\Leitura;
use Validator;
use Illuminate\Http\Request;
use View;
use Carbon\Carbon;

class LeiturasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leituras_clientes = Leitura::where('efectuado', false)->get();
        if (count($leituras_clientes) < 1) {
            return View::make('gerente.leiturasIndex')->with('message', 'Leituras de todos clientes efectuadas.');
        }
        $data = array();
        foreach ($leituras_clientes as $leitura_cliente) {
            $casa=$leitura_cliente->casa;
            if(!is_null($casa)){
                $data[] = [
                    'casa_bairro' => $casa['bairro'],
                    'casa_rua' => $casa['rua_avenida'],
                    'casa_numero' => $casa['numero_casa'],
                    'casa_descricao' => $casa['descricao'],
                    'cliente_nome' => $casa->cliente->user['nome'],
                    'id' => $leitura_cliente->id,
                ];
            }

        }
        return View::make('gerente.leiturasIndex')->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $input = $request->all();
            $leitura = Leitura::find($input['id']);
            $leitura->efectuado = true;
            $leitura->consumo = $input['consumo'];
            $factura = new Factura();
            $factura->l_actual = $input['consumo'];
            $factura->l_anterior = $this->leitura_anterior($leitura->casa->id);
            if (is_null($factura->l_anterior)) {
                return redirect()->back()->with('message', 'Ocorreu um erro durante a gravacao da leitua, o cliente ainda tem leituras pendentes!');
            }
            $agua = Agua::first();
            $p_unit = $agua->preco_unitario;
            $metros_cubicos = $factura->l_actual - $factura->l_anterior;
            $preco_minimo = $agua->metros_cubicos_minimos * $agua->preco_unitario;
            if ($metros_cubicos <= $agua->metros_cubicos_minimos) {
                $val_pagar = $preco_minimo;
            } else {
                $val_pagar = ($factura->l_actual - $factura->l_anterior) * $p_unit;
            }
            $factura->val_pagar = $val_pagar;
            $leitura->save();
            $factura->leitura()->associate($leitura);
            $factura->save();
            $factura->metros_cubicos = $metros_cubicos;
            $factura->preco_unitario = $p_unit;
            return view('gerente.facturaEspecifica')->with('factura', $factura);
        }
        return redirect()->back()->with('message', 'Ocorreu um erro durante a gravacao da leitua!');


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
        return View::make('gerente.leituraShow')->with('id', $id);
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
        //
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function pendentes()
    {
        $leitura_cliente = Leitura::where('efectuado', '=', false)->get();
        if (count($leitura_cliente) < 1) {
            return View::make('gerente.leiturasPendentes')->with('message', 'Nenhuma leitura pendente.');
        }
        foreach ($leitura_cliente as $lc) {
            //casa
            $data [] = [
                'casa_bairro' => $lc->casa->bairro,
                'casa_rua' => $lc->casa->rua_avenida,
                'casa_numero' => $lc->casa->numero_casa,
                'casa_descricao' => $lc->casa->descricao,
                'cliente_nome' => $lc->casa->cliente->user->nome,
                'id' => $lc->id,
            ];
        }
        return View::make('gerente.leiturasPendentes')->with('data', $data);
    }

    public
    function rules()
    {
        return [
            'consumo' => 'required|numeric'
        ];
    }

    public
    function message()
    {
        return [
            'consumo.required' => 'O consumo é obrigatório.'
        ];
    }

    public
    function leitura_anterior($casa_id)
    {
        $casa = \App\Casa::find($casa_id);
        $leituras = $casa->leituras;
        if (count($leituras) > 1) {
            $leituras->pop();
            $ultima_leitura = $leituras->last();
            return $ultima_leitura->consumo;
        } else {
            return 0;
        }
    }
}
