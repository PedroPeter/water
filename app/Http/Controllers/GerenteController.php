<?php

namespace App\Http\Controllers;

use App\Gerente;
use App\User;
use Illuminate\Http\Request;
use DB;
use View;

class GerenteController extends Controller
{
    private $CARGO="Gerente";
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
        $gerentes= User::where('cargo',$this->CARGO)->get();
        return View::make('gerente.gerente')->with('gerentes',$gerentes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required|email',
            'celular1' => 'required|digits:9',
            'celular2' => 'required|digits:9',
            'username' => 'required',
            'password' => 'required|between:7,20',
        ]);
        $input= $request->all();
        $input['cargo']=$this->CARGO;
        $input['password']=bcrypt($input['password']);
        $user=new User($input);
        $user->save();
        return $this->create();
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
        User::destroy($id);
        return $this->create();
    }

}
