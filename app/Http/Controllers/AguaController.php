<?php

namespace App\Http\Controllers;

use App\Agua;
use View;
use Illuminate\Http\Request;
use Validator;

class AguaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agua= Agua::all()->first();
        if(count((array)$agua)>0){
            return View::make('gerente.precoAguaIndex')->with('agua',$agua);
        }else{
            return View::make('gerente.precoAguaIndex')->with('message','Preço de água não registado. Faca o seu registo preenchendo o formulário abaixo.');

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'metros_cubicos_minimos' => 'required',
            'preco_unitario' => 'required',
        ];
        $message=[
            'metros_cubicos_minimos.required'=>'Os minimos metros cubicos é obrigatório.',
            'preco_unitario.required'=>'O preco unitario é obrigatório.',
        ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            \App\Agua::create($request->all());
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
        $agua=Agua::find($id);
        return View::make('gerente.precoAguaEdit')->with('agua',$agua);
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
            'metros_cubicos_minimos' => 'required',
            'preco_unitario' => 'required',
        ];
        $message=[
            'metros_cubicos_minimos.required'=>'Os minimos metros cubicos é obrigatório.',
            'preco_unitario.required'=>'O preco unitario é obrigatório.',
        ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            $input=$request->all();
            $agua=\App\Agua::find($id);
            $agua->metros_cubicos_minimos=$input['metros_cubicos_minimos'];
            $agua->preco_unitario=$input['preco_unitario'];
            $agua->save();
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
        //
    }
}
