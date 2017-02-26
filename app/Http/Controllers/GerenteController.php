<?php

namespace App\Http\Controllers;

use App\Gerente;
use App\User;
use Illuminate\Http\Request;
use DB;
use View;
use Validator;

class GerenteController extends Controller
{
    private $CARGO = "Gerente";

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
        $gerentes = User::where('cargo', $this->CARGO)->get();
        return View::make('gerente.gerente')->with('gerentes', $gerentes);
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
            $input['password'] = bcrypt($input['password']);
            $user = new User($input);
            $user->cargo = $this->CARGO;
            $user->save();
            return redirect()->route('gerente.create');
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
        User::destroy($id);
        return $this->create();
    }

    public function rules()
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

    public function message()
    {
        return [
            'nome.required' => 'Nome e Obrigatorio',
            'apelido.required' => 'Apelido e Obrigatorio',
            'email.required' => 'Email e Obrigatorio',
            'celular1.required' => 'Celular principal e Obrigatorio',
            'celular2.required' => 'Celular secundario e Obrigatorio',
            'username.required' => 'Nome do usuario e Obrigatorio',
            'password.required' => 'Password e Obrigatorio',
            'passwordR.required' => 'Os campos nao tem um possword identico.Tente novamente!',
        ];
    }

    public function contracto(Request $request)
    {
        $rules= [
            'contracto.required' => 'requiered'];
        $message=[
            'contracto.required' => 'O ficheiro é obrigatório. '];
        $validate = Validator::make($request->all(), $rules, $message);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        } else {
            $pathDoc = $request->file('contracto');
            $destinationPath = 'uploads'; // upload path
            $fileNameDoc = $this->saveFile($destinationPath, $pathDoc,'contracto');
            DB::table('contracto')->insert(
                ['ctr' => $fileNameDoc]
            );
            return redirect()->route('dashboard');
        }
    }

    public function saveFile($destination, $file,$fileName)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileName . '.' . $extension; // renameing image
        $file->move($destination, $fileName); // uploading file to given path
        return $fileName;
    }

}
