<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use Illuminate\Http\Request;
use View;
use Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $CARGO = "Cliente";

    public function index()
    {
        $clientes = Cliente::where('activo', true)->get();
        if (count((array)$clientes) > 0) {
            return View::make('gerente.clienteIndex')->with('clientes', $clientes);
        } else {
            return view('gerente.clienteIndex')->with('message', 'Nenhum Cliente registado no sistema.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return View::make('gerente.cliente')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $input = $request->all();
            $pathDoc = $request->file('doc');
            $pathContracto = $request->file('contracto');
            $destinationPath = 'uploads'; // upload path
            $fileNameDoc = $this->saveFile($destinationPath, $pathDoc);
            $fileNameContracto = $this->saveFile($destinationPath, $pathContracto); // renameing image
            $user = \App\User::findOrFail($input['id']);
            $user->cargo = $this->CARGO;
            $user->cliente()->create([
                'dataNascimento' => $input['dataNascimento'],
                'contracto' => $fileNameContracto,
                'doc' => $fileNameDoc,
            ]);
            $user->save();
            return View::make('gerente.clientecasa')->with('id', $user->cliente->id);
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
        return View::make('gerente.clienteShow', compact('user'));
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
        if ($validator->fail()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $input = $request->all();
            $user = \App\User::find($input['id']);
            $user->cliente()->create([$input
            ]);
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
        \App\Cliente::destroy($id);
        return redirect('cliente.show');
    }


    public function saveFile($destination, $file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111111, 99999999) . '.' . $extension; // renameing image
        $file->move($destination, $fileName); // uploading file to given path
        return $fileName;
    }

    public function rules()
    {
        return [
            'doc.required' => 'requiered',
            'contracto.required' => 'requiered',
             ];
    }

    public function message()
    {
        return [
            'doc.required' => 'O nome é obrigatório. ',
            'contracto.required' => 'O apelido é obrigatório. ',
             ];
    }
}
