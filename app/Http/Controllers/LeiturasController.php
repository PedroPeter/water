<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Cliente;
use Validator;
use Illuminate\Http\Request;
use View;
class LeiturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=\App\User::with('cliente')->get();
        if(count((array)$clientes)>0){
            return View::make('gerente.leiturasIndex')->with('clientes',$clientes);
        }else{
            return View::make('gerente.leiturasIndex')->with('message','Leituras de todos clientes efectuados no presente mes.');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return View::make('gerente.leituraShow')->with('id',$id);
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
            'consumo' => 'required|numeric',
            'id'=>'required'
        ];
        $message=[
            'consumo.required'=>'O consumo é obrigatório.',
             ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            $input=$request->all();
            $cliente=Cliente::findOrFail($input['id']);
            $agua=Agua::all()->first();
            $cliente->casa()->attach($agua->id, ['consumo' => $input['consumo']]);
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

    public function proximaLeitura($dateTime){
        return $dateTime->addMonth(1);
    }
}
