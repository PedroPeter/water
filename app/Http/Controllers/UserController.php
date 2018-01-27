<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = User::find($id);
        if (Hash::check($request->password, $user->password)) {
            $validator = Validator::make($request->all(), $this->rules(), $this->message());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $user->username = $request->username;
                $user->celular1 = $request->celular1;
                $user->celular2 = $request->celular2;
                $user->email = $request->email;
                $user->password = bcrypt($request->passwordN);
                $user->save();
                return redirect()->back()->with('message','Alteracao efectuada com sucesso');
            }
        } else {
            $errors=array();
            $errors[]='O passaword actual introduzido e incorrecto.';
            return redirect()->back()->withInput()->with(json_encode($errors));
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

    public function rules()
    {

        return [
            'username' => 'required',
            'celular1' => 'required',
            'celular2' => 'required',
            'email' => 'required',
            'passwordN' => 'required|between:6,20',
            'passwordNR' => 'required|same:passwordN'
        ];

    }

    public function message()
    {
        return [
            'username.required' => 'O nome é obrigatório. ',
            'celular1.required' => 'O celular principal é obrigatório. ',
            'celular2.required' => 'O celular secundario é obrigatório. ',
            'email.required' => 'O email é obrigatório. ',
            'passwordN.required' => 'O novo password deve conter pelo menos 7 caracteres.',
            'passwordNR.required' => 'O password repetido nao coincidem',
        ];
    }
}
