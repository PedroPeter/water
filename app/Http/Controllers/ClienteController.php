<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Leitura;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use View;

class ClienteController extends Controller
{
    /**
     * Display a listing of active the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $CARGO = "Cliente";

    public function index()
    {
        return $this->indexGeral(true, 'Nenhum Cliente registado no sistema.');
    }

    /**
     * Display a listing of active the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index2()
    {
        return $this->indexGeral(false, 'Nenhum Cliente cancelou contracto.');
    }

    public function indexGeral($bol, $message)
    {
        $clientes = Cliente::where('activo', $bol)->get();
        if (count((array)$clientes) > 0) {
            return View::make('gerente.clienteIndex')->with('clientes', $clientes);
        }
        return view('gerente.clienteIndex')->with('message', $message);
    }

    /**
     * Display a listing of active the resource situation.
     *
     * @return \Illuminate\Http\Response
     */

    public function situacao()
    {
        $clientes = Cliente::where('activo', true)->get();
        $data = array();
        if (count((array)$clientes) > 0) {
            foreach ($clientes as $cliente) {
                $casa = $cliente->casa()->first();
                if (!is_null($casa)) {
                    $leituras = $casa->leituras;
                    $pagas = 0;
                    $n_pagas = 0;
                    $multa_acomulada = 0;
                    if (count($leituras) > 0) {

                        foreach ($leituras as $leitura) {
                            $factura = $leitura->factura;
                            if (!is_null($factura)) {

                                if ($factura->paga) {
                                    $pagas++;
                                } else {
                                    $n_pagas++;
                                    $multa_acomulada += $leitura->factura->val_multas;
                                }
                            }
                        }
                    }
                    $data[] = [
                        'id' => $cliente->id,
                        'nome' => $cliente->user->nome,
                        'apelido' => $cliente->user->apelido,
                        'celular1' => $cliente->user->celular1,
                        'celular2' => $cliente->user->celular2,
                        'email' => $cliente->user->email,
                        'facturas_pagas' => $pagas,
                        'facturas_nao_pagas' => $n_pagas,
                        'multa_acumulada' => $multa_acomulada,
                    ];
                }
                return View::make('gerente.clienteSituacao')->with('data', $data);

            }
        } else {
            return view('gerente.clienteSituacao')->with('message', "Nao ha clientes activos.");
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create($id)
    {
        return View::make('gerente.cliente')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
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
            /*$user->username=$user->nome.$user->apelido;
            $user->password=bcrypt($user->apelido.$user->nome);*/
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
    public
    function show($id)
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
    public
    function destroy($id)
    {
        $c = Cliente::find($id);
        $c->activo = false;
        $c->save();
        return redirect('cliente.index');
    }


    public
    function saveFile($destination, $file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111111, 99999999) . '.' . $extension; // renameing image
        $file->move($destination, $fileName); // uploading file to given path
        return $fileName;
    }

    public
    function rules()
    {
        return [
            'doc.required' => 'requiered',
            'contracto.required' => 'requiered',
        ];
    }

    public
    function message()
    {
        return [
            'doc.required' => 'O documeno é obrigatório. ',
            'contracto.required' => 'O contracto é obrigatório. ',
        ];
    }

    /**
     * Search for a specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $keywords = Input::get('keywords');
        $clientes = Cliente::where('activo', 1)->get();
        $search = array();
        $faturas = array();
        if (!is_null($clientes)) {
            foreach ($clientes as $cliente) {
                if (Str::contains(Str::lower($cliente->user->nome.$cliente->user->apelido), Str::lower($keywords))) {
                    $casa_id= DB::table('casas')->where('cliente_id', $cliente->id)->value('id');
                    $leituras_id=Leitura::where('casa_id', $casa_id)->pluck('id');
                    foreach($leituras_id as $id){
                        $l=Leitura::find($id);
                        $f=$l->factura;
                        if(!is_null($f)){
                            $faturas[]=$l->factura;
                        }
                    }
                    if(!is_null($faturas)){
                        $search [] = [
                            'nome' => $cliente->user->nome,
                            'apelido' => $cliente->user->apelido,
                            'faturas' =>$faturas
                        ];
                    }

                }
            }
            if (!is_null($search)) {
                return view('gerente.searchResults')->with('search',$search);
            }
        }
        return view('gerente.searchResults');
    }
}
