<?php

namespace App\Http\Controllers;


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
        $time = Carbon::now()->startOfMonth();
        $numero_leitura = Leitura::all()->max('numero_leitura');
        $data = array();
        $leitura_cliente = Leitura::where([
            ['numero_leitura', '=', $numero_leitura], ['updated_at', '>=', $time], ['efectuado', '=', false]
        ])->get();
        if (count($leitura_cliente) < 1) {
            return View::make('gerente.leiturasIndex')->with('message', 'Leituras de todos clientes efectuados para o presente mes.');
        }
        foreach ($leitura_cliente as $lc) {
            //data
            $data[] = [
                'casa_bairro' => $lc->casa->bairro,
                'casa_rua' => $lc->casa->rua_avenida,
                'casa_numero' => $lc->casa->numero_casa,
                'casa_descricao' => $lc->casa->descricao,
                'cliente_nome' => $lc->casa->cliente->user->nome,
                'id' => $lc->id,
            ];
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
            $leitura->save();
            $factura = new Factura();
            $factura->l_actual = $input['consumo'];
            $factura->leitura()->associate($leitura);
            $factura->save();
            return redirect()->route('leitura.index');
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
        return View::make('gerente.leituraShow')->with('id', $id);
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
        //
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendentes()
    {
        $data = array();
        $leitura_cliente = Leitura::where('efectuado', '=', false)->get();
        if (count($leitura_cliente) < 1) {
            return View::make('gerente.leiturasPendentes')->with('message', 'Nenhuma leitura pendente.');
        }
        foreach ($leitura_cliente as $lc) {
            //casa
            $data[] = [
                'casa_bairro' => $lc->casa->bairro,
                'casa_rua' => $lc->casa->rua_avenida,
                'casa_numero' => $lc->casa->numero_casa,
                'casa_descricao' => $lc->casa->descricao,
                'cliente_nome' => $lc->casa->cliente->user->nome,
                'id' => $lc->id
            ];
        }
        return View::make('gerente.leiturasPendentes')->with('data', $data);
    }

    public function rules()
    {
        return [
            'consumo' => 'required|numeric'
        ];
    }

    public function message()
    {
        return [
            'consumo.required' => 'O consumo é obrigatório.'
        ];
    }

    /**
     * Prepars resource from storage to the Moth_reader.
     *
     * @return the number of the reader
     */

}
