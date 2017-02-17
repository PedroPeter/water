<?php

namespace App\Http\Controllers;

use App\Casa;
use App\Cliente;
use App\Fontenaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
class CasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator=Validator::make($request->all(),$this->rules(),$this->menssages());
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }else{
            $input=$request->all();
            $cliente=\App\Cliente::findOrFail($input['id']);
            $cliente->casa()->create($input);
            $cliente->save();
           return redirect()->route('casa.link');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function rules(){
        return [
            'bairro'=>'required',
            'rua_avenida'=>'required',
            'numero_casa'=>'required',
            'descricao'=>'required',
            'id'=>'required',
        ];
    }
    public function menssages(){
        return [
            'bairro.required'=>'O Bairro é obrigatório. ',
            'rua_avenida.required'=>'A Rua/Avenida é obrigatório. ',
            'numero_casa.required'=>'O numero da casa é obrigatório. ',
            'descricao.required'=>'A descricao é obrigatório. ',
        ];
    }

    public function link(){
        $clintes=Cliente::all();
        $data=array();
        foreach($clintes as $cliente){
            $data[]= $cliente->casa;
        }
        $data['fontenarias']=Fontenaria::all();
        return View::make('gerente.link')->with('data',$data);
    }
    public function linkar($id1,$id2){
        $casa=Casa::find($id1);
        $casa->fontenarias()->attach($id2);
    }
}