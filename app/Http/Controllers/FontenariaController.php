<?php

namespace App\Http\Controllers;

use App\Fontenaria;
use Illuminate\Http\Request;
use View;
use Validator;

class FontenariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fontenarias = Fontenaria::all();
        foreach ($fontenarias as $fontenaria) {
            if (count($fontenaria->casas) > 0) {
                $fontenaria->num_casas = count($fontenaria->casas);
            }
        }
        if (count($fontenarias) > 0) {
            return View::make('gerente.fontenariaIndex')->with('fontenarias', $fontenarias);
        } else {
            return View::make('gerente.fontenariaIndex')->with('message', 'Nenhuma fontenaria registada.');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gerente.fontenariaCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->menssages());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $input = $request->all();
            $fontenaria = new Fontenaria();
            $fontenaria->create($input);
            return redirect()->route('fontenaria.index');
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
        $fontenaria = Fontenaria::findOrFail($id);
        return View::make('gerente.fontenariaShow', compact('fontenaria'));
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
        $validator = Validator::make($request->all(), $this->rules(), $this->menssages());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $fontenaria = Fontenaria::findOrFail($id);
            $input = $request->all();
            $fontenaria->nome = $input['nome'];
            $fontenaria->bairro = $input['bairro'];
            $fontenaria->rua_avenida = $input['rua_avenida'];
            $fontenaria->numero = $input['numero'];
            $fontenaria->max_clientes = $input['max_clientes'];
            $fontenaria->descricao = $input['descricao'];
            $fontenaria->save();
            return redirect()->route('fontenaria.index');
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
        Fontenaria::destroy($id);
        return redirect()->route('fontenaria.index');

    }

    public function links()
    {
        $data = array();
        $fontenarias = Fontenaria::all();
        foreach ($fontenarias as $fontenaria) {
            $data[] = [
                'nome' => $fontenaria->nome,
                'numero_clientes' => count($fontenaria->casas),
                'max_clientes' => $fontenaria->max_clientes,
            ];
        }
        return View::make('gerente.fontenariaDetalhes')->with('data', $data);

    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'bairro' => 'required',
            'rua_avenida' => 'required',
            'numero' => 'required',
            'max_clientes' => 'required',
            'descricao' => 'required',
        ];
    }

    public function menssages()
    {
        return [
            'nome.required' => 'O Nome é obrigatório. ',
            'bairro.required' => 'O Bairro é obrigatório. ',
            'rua_avenida.required' => 'A Rua/Avenida é obrigatório. ',
            'numero.required' => 'O numero é obrigatório. ',
            'max_clientes.required' => 'O numero maximo de clientes é obrigatório. ',
            'descricao.required' => 'A descricao é obrigatório. ',
        ];
    }
}
