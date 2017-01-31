<?php

namespace App\Http\Controllers;

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
    private $CARGO="Cliente";

    public function index()
    {
        $clientes= User::where('cargo',$this->CARGO)->get();
        if(count((array)$clientes)>0){
            return View::make('gerente.cliente')->with('clientes',$clientes);
        }else{
            return view('gerente.cliente')->with('message','Nenhum Cliente registado no sistema.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return View::make('gerente.cliente')->with('id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'dataNascimento' => 'required|date',
            'contracto' => 'required|file',
            'doc' => 'required|file',
            'id'=>'required'
        ];
        $message=[
            'dataNascimento.required'=>'Data de Nascimento é obrigatório.',
            'contracto.required'=>'O contracto é obrigatório.',
            'doc.required'=>'A copia do documento é obrigatório.',
        ];
        $validate=Validator::make($request->all(),$rules,$message);
        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }else{
            $input=$request->all();
            $pathDoc=$request->file('doc');
            $pathContracto=$request->file('contracto');
            $destinationPath = 'uploads'; // upload path
            $fileNameDoc = $this->saveFile($destinationPath,$pathDoc);
            $fileNameContracto = $this->saveFile($destinationPath,$pathContracto); // renameing image
            $user=\App\User::findOrFail($input['id']);
            $user->cargo=$this->CARGO;
            $user->cliente()->create([
                'dataNascimento'=>$input['dataNascimento'],
                'contracto'=>$fileNameContracto,
                'doc'=>$fileNameDoc,
            ]);
            $user->save();
            return View::make('gerente.clientecasa')->with('id',$user->cliente->id);
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
        $user= User::findOrFail($id);
        return View::make('gerente.clienteShow',compact('user'));
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
        $rules=[
            'nome'=>'required',
            'apelido'=>'required',
            'celular1'=>'required',
            'celula2'=>'required',
            'email'=>'required',
        ];
        $messages=[
          'nome.required'=>'O nome é obrigatório. ',
          'apelido.required'=>'O apelido é obrigatório. ',
          'celular1.required'=>'O celular principal é obrigatório. ',
          'celular2.required'=>'O celular secundario é obrigatório. ',
          'email.required'=>'O email é obrigatório. ',
        ];
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fail()){
            return redirect()->back()->withInput()->withErrors($validator);
        }else{
            $input=$request->all();
            $user=\App\User::find($input['id']);
            $user->cliente()->create(['nome'=>'required',
                'apelido'=>'required',
                'celular1'=>'required',
                'celula2'=>'required',
                'email'=>'required',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Cliente::destroy($id);
        return redirect('cliente.show');
    }


    public function saveFile($destination, $file){
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111111,99999999).'.'.$extension; // renameing image
        $file->move($destination, $fileName); // uploading file to given path
        return $fileName;}
}
