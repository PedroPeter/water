<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use View;

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
            return $this->create();
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
        return view("login");
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
        $username = $request->username;
        $password = $request->password;
        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validate->fails()) {
            Session::flash('errors',$validate->errors);
            return redirect()->back()->withErrors($validate);
        } elseif (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->withInput()->exceptInput('password');
        }
    }

    public
    function rules()
    {
        return $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

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
