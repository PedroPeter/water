<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;
use View;
use Validator;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produto= Produtos::all();
        if(count((array)$produto)>0){
            return View::make('gerente.produtosIndex')->with('produto',$produto);
        }else{
            return View::make('gerente.produtosIndex')->with('message','Produtos não registados. Faca o seu registo preenchendo o formulário abaixo.');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return View::make('gerente.produtoCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nome' => 'required',
            'preco' => 'required',
            'descricao' => 'required',
        ];
        $message=[
            'nome.required'=>'O nome é obrigatório.',
            'preco.required'=>'O Preco é obrigatório.',
            'descricao.required'=>'A descricao é obrigatório.',
        ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            \App\Produtos::create($request->all());
            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto=Produtos::find($id);
        return View::make('gerente.produtoEdit')->with('produto',$produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'nome' => 'required',
            'preco' => 'required',
            'descricao' => 'required',
        ];
        $message=[
            'nome.required'=>'O nome é obrigatório.',
            'preco.required'=>'O Preco é obrigatório.',
            'descricao.required'=>'A descricao é obrigatório.',
        ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            $input=$request->all();
            $produto=\App\Produtos::find($id);
            $produto->nome=$input['nome'];
            $produto->preco=$input['preco'];
            $produto->descricao=$input['descricao'];
            $produto->save();
            return $this->index();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Produtos::destroy($id);
        return redirect()->back()->with('message','Produto removido com sucesso');
    }
}
