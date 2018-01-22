<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Route;
use Validator;
use View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $CARGO = "User";

    public function index()
    {
        $users = User::where('cargo', $this->CARGO)->get();
        if (count($users) > 0) {
            return View::make('gerente.userIndex')->with('users', $users);
        } else {
            return View::make('gerente.userIndex')->with('message', 'Sem pedidos de novos clientes.');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $input = $request->all();
            $input['cargo'] = $this->CARGO;
            User::create($input);
            return redirect()->route('replyUser');
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
        $user = User::findOrFail($id);
        return View::make('gerente.userShow', compact('user'));
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
        $validator = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $user = \App\User::findOrFail($id);
            $input = $request->all();
            $user->nome = $input['nome'];
            $user->apelido = $input['apelido'];
            $user->celular1 = $input['celular1'];
            $user->celular2 = $input['celular2'];
            $user->email = $input['email'];
            $user->save();
            return redirect()->route('user.index');
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
        \App\User::destroy($id);
        return redirect()->route('user.index')->with('message', 'Usuario removido com sucesso');
    }

    public function rules(){
    return [
        'nome' => 'required',
        'apelido' => 'required',
        'celular1' => 'required',
        'celular2' => 'required',
        'email' => 'required',
    ];

    }

    public function message(){
        return [
            'nome.required' => 'O nome é obrigatório. ',
            'apelido.required' => 'O apelido é obrigatório. ',
            'celular1.required' => 'O celular principal é obrigatório. ',
            'celular2.required' => 'O celular secundario é obrigatório. ',
            'email.required' => 'O email é obrigatório. ',
        ];
    }
}
