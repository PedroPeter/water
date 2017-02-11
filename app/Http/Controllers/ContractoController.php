<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use View;
class ContractoController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules(), $this->message());
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $input = $request->all();
            $pathContracto = $request->file('contracto');
            $destinationPath = 'uploads'; // upload path
            $fileNameContracto = $this->saveFile($destinationPath, $pathContracto); // renameing image
            $user = \App\User::findOrFail($input['id']);
            $user->cargo = $this->CARGO;
            $user->cliente()->create([
                'contracto' => $fileNameContracto,
            ]);
            $user->save();
            return View::make('gerente.clientecasa')->with('id', $user->cliente->id);
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
