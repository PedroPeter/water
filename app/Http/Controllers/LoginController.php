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
        }

        return View::make('admin.admin');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("auth.login");
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

        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        $username = $request->username;
        $password = $request->password;
        if ($validate->fails()) {
            return redirect()->back()->withInput()->exceptInput('password')->withErrors($validate);
        } elseif (Auth::attempt(['username' => $username, 'password' => $password])) {
            $user = Auth::user();
            $permissao = $user->cargo;
            return redirect()->route('dashboard')->with(['username'=> $username, 'permissao'=>$permissao]);
        } else {
            return redirect()->back()->with('message', "Usuario nao registado no sistema!")->withInput()->exceptInput('password');
        }
    }

    public
    function rules()
    {
        return $rules = [
            'username' => 'required',
            'password' => 'required'];

    }

    public
    function message()
    {
        return $message = [
            'username.required' => 'Nome de usuario incorrecto.',
            'password.required' => 'Password incorrecto.'
        ];
    }


}
