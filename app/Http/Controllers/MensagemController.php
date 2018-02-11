<?php

namespace App\Http\Controllers;

use App\Mensagem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MensagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $CARGO = "Cliente";

    public function index()
    {
        $users = User::where('cargo', $this->CARGO)->get();
        if (count($users) > 0) {
            return View::make('gerente.mensagemIndex')->with('users', $users);
        } else {
            return View::make('gerente.mensagemIndex')->with('message', 'Ainda nao possui clientes activos.');

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $friend = User::find($id);
        return View::make('gerente.mensagemShow')->with('friend',$friend);
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

    public function getChat($id) {
        $chats = Mensagem::where(function ($query) use ($id) {
            $query->where('cliente_id', '=', Auth::user()->id)->where('gerente_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('cliente_id', '=', $id)->where('gerente_id', '=', Auth::user()->id);
        })->get();
        return $chats;
    }

    public function sendChat(Request $request) {
        Mensagem::create([
            'cliente_id' => $request->user_id,
            'gerente_id' => $request->friend_id,
            'chat' => $request->chat
        ]);

        return [];
    }

}
