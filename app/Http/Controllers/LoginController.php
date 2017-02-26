<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (User::all()->count() > 0) {
            return View::make('login');
        } else {
            return View::make('admin.admin');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function check(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $message = [
            'username.required' => 'Nome de usuario incorrecto.',
            'password' => 'Password incorrecto.',
        ];

        $validate = Validator::make($request->all(), $rules, $message);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->exceptInput('password')->withErrors($validate);
        } else {
            $username = $request->username;
            $password = $request->password;
            if (Auth::attempt(['username' => $username, 'password' => $password, 'cargo' => 'Gerente']) || Auth::attempt(['username' => $username, 'password' => $password, 'cargo' => 'Admin'])) {
                return redirect()->route('dashboard')->with('username',$username);
            } elseif (Auth::attempt(['username' => $username, 'password' => $password, 'cargo' => 'Cliente'])) {
                return redirect()->route('cliente.dashboard')->with('username',$username);
            } else {
                return redirect()->back()->withInput()->exceptInput('password')->with('message', "Usuario nao registado no sistema!");
            }
        }
    }

}
