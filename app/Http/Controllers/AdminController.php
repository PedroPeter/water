<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Cliente;
use App\Factura;
use App\Produtos;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $CARGO = 'admin';

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules(), $this->message());
        if ($validator->fails()) {
            Log::error("Administrador tentando criar mais um administrador");
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = new User($input);
        $user->cargo = $this->CARGO;
        $user->save();
        Log::info('Administrador criou mais um novo administrador');
        return redirect()->route('gerente.create');
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
        //
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

    public
    function estatisticas()
    {
        $agua = Agua::first();
        $data = [
            'agua' => $agua,
            'clt_activos' => Cliente::where('activo', true)->count(),
            'clt_inactivos' => Cliente::where('activo', false)->count(),
            'fac_pagas' => Factura::where('paga', true)->count(),
            'fac_Npagas' => Factura::where('paga', false)->count(),
            'val_total' => Factura::where('paga', true)->sum('val_pagar'),
            'val_pendente' => Factura::where('paga', false)->sum('val_pagar'),
        ];
        Log::info('Administrador visualizando as estatisticas.');
        return view('gerente.estatisticas')->with('data', $data);
    }

    public
    function rules()
    {
        return [
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required|email',
            'celular1' => 'required',
            'celular2' => 'required',
            'username' => 'required',
            'password' => 'required|between:7,20',
            'passwordR' => 'required|same:password',
        ];
    }

    public
    function message()
    {
        return [
            'nome.required' => 'Nome e Obrigatorio',
            'apelido.required' => 'Apelido e Obrigatorio',
            'email.required' => 'Email e Obrigatorio',
            'celular1.required' => 'Celular principal e Obrigatorio',
            'celular2.required' => 'Celular secundario e Obrigatorio',
            'username.required' => 'Nome do usuario e Obrigatorio',
            'password.required' => 'Password e Obrigatorio',
        ];
    }
}
