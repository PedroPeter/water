<?php

namespace App\Http\Controllers;

use App\Agua;
use App\Cliente;
use App\Leitura;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use View;use Illuminate\Support\Facades\Log;


class ClienteController extends Controller
{
    private $CARGO = "Cliente";


    /**
     * Display a listing of active the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->indexGeral(true, 'Nenhum Cliente registado no sistema.');
    }

    /**
     * Display a listing of active the resources.
     *
     * @return \Illuminate\Http\Response
     */

    public function info()
    {
        $agua = Agua::all()->first();
        $user = Auth::user();
        $faturas = array();
        $leituras = $user->cliente->casa->leituras;
        $casa = $user->cliente->casa;
        $casa = [
            "nome" => $casa->cliente->user->nome,
            "apelido" => $casa->cliente->user->apelido,
            "celular1" => $casa->cliente->user->celular1,
            "celular2" => $casa->cliente->user->celular2,
            "num_casa" => $casa->numero_casa,
            "bairro" => $casa->bairro,
            "rua_avenida" => $casa->rua_avenida,
            "fontenaria_nome" => $casa->fontenarias()->get()->first()->nome,
            "fontenaria_bairro" => $casa->fontenarias()->get()->first()->bairro,
            "fontenaria_avenida" => $casa->fontenarias()->get()->first()->rua_avenida,
            "fontenaria_descricao" => $casa->fontenarias()->get()->first()->descricao
        ];
        if (count($leituras) > 0) {
            foreach ($leituras as $leitura) {
                if (count($leitura->factura) > 0) {
                    $faturas[] = $leitura->factura;
                }
            }
            $faturas = new LengthAwarePaginator($faturas, count($faturas), 5);
            return View::make('user.info')->with('agua', $agua)->with('faturas', $faturas)->with('casa', $casa);
        }
        return View::make('user.info')->with('message', 'Ainda nao possui facturas processadas.');
    }

    /**
     * Display a listing of active the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function index2()
    {
        return $this->indexGeral(false, 'Nenhum Cliente cancelou contracto.');
    }

    public
    function indexGeral($bol, $message)
    {
        $clientes = Cliente::where('activo', $bol)->get();
        if (count((array)$clientes) > 0) {
            return View::make('gerente.clienteIndex')->with('clientes', $clientes);
        }
        return view('gerente.clienteIndex')->with('message', $message);
    }

    /**
     * Display a listing of active associated resource situation.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function situacao()
    {
        Log::info('Visualizacao da situacao dos clientes efectuado por'.Auth::user()->nome);
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
     * Display a listing of active associated resource situation.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function situacao_individual()
    {
        $user = Auth::user();
        $cliente = $user->cliente;
        $casa = $cliente->casa;
        if (count($casa)>0) {
            $leituras = $casa->leituras;
            $pagas = 0;
            $n_pagas = 0;
            $multa_acomulada = 0;
            if (count($leituras) > 0) {
                foreach ($leituras as $leitura) {
                    $factura = $leitura->factura;
                    if (count($factura)>0) {
                        if ($factura->paga) {
                            $pagas++;
                        } else {
                            $n_pagas++;
                            $multa_acomulada += $leitura->factura->val_multas;
                        }
                    }
                }
                $data['id'] = $cliente->id;
                $data['nome'] = $cliente->user->nome;
                $data['apelido'] = $cliente->user->apelido;
                $data['celular1'] = $cliente->user->celular1;
                $data['celular2'] = $cliente->user->celular2;
                $data['email'] = $cliente->user->email;
                $data['facturas_pagas'] = $pagas;
                $data['facturas_nao_pagas'] = $n_pagas;
                $data['multa_acumulada'] = $multa_acomulada;
                return View::make('user.clienteSituacao')->with('data', $data);
            } else {
                return View::make('user.clienteSituacao')->with('message', 'Ainda nao possui Faturas Processadas.');
            }
        }else{
            return View::make('user.clienteSituacao')->with('message', 'Ainda nao possui Faturas Processadas.');

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
            $user->username = Str::lower($user->nome);
            $user->password = bcrypt(Str::lower($user->nome . $user->nome));
            $user->cliente()->create([
                'dataNascimento' => $input['dataNascimento'],
                'contracto' => $fileNameContracto,
                'doc' => $fileNameDoc,
            ]);
            $user->save();
            Log::info('Cadastro de um novo Cliente efectuado com sucesso por '.Auth::user()->nome);
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
        return View::make('user.userShow', compact('user'));
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
            $user = Auth::user();
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
        Log::info('Remocao de cliente efectuado com sucesso por'.Auth::user()->nome);
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
     * Search for a user and invoice data.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function search()
    {
        $keywords = Input::get('keywords');
        $clientes = Cliente::where('activo', 1)->get();
        $search = array();
        $faturas = array();
        if (!is_null($clientes)) {
            foreach ($clientes as $cliente) {
                if (Str::contains(Str::lower($cliente->user->nome . $cliente->user->apelido), Str::lower($keywords))) {
                    $casa_id = DB::table('casas')->where('cliente_id', $cliente->id)->value('id');
                    $leituras_id = Leitura::where('casa_id', $casa_id)->pluck('id');
                    foreach ($leituras_id as $id) {
                        $l = Leitura::find($id);
                        $f = $l->factura;
                        if (!is_null($f)) {
                            $faturas[] = $l->factura;
                        }
                    }
                    if (!is_null($faturas)) {
                        $search [] = [
                            'nome' => $cliente->user->nome,
                            'apelido' => $cliente->user->apelido,
                            'faturas' => $faturas
                        ];
                    }

                }
            }
            if (!is_null($search)) {
                return view('gerente.searchResults')->with('search', $search);
            }
        }
        return view('gerente.searchResults');
    }

    /**
     * Search for a user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function search2()
    {
        $keywords = Input::get('keywords');
        $clientes = Cliente::where('activo', 1)->get();
        $search = array();
        if (!is_null($clientes)) {
            foreach ($clientes as $cliente) {
                if (Str::contains(Str::lower($cliente->user->nome . $cliente->user->apelido), Str::lower($keywords))) {
                    $search [] = [
                        'id' => $cliente->id,
                        'nome' => $cliente->user->nome,
                        'apelido' => $cliente->user->apelido,
                        'celular1' => $cliente->user->celular1,
                        'celular2' => $cliente->user->celular2,
                        'email' => $cliente->user->email,
                    ];
                }
            }
            if (!is_null($search)) {
                return view('gerente.clienteResults')->with('search', $search);
            }
        }
        return view('gerente.clienteResults');
    }

    /**
     * Search for a invoice based on his number.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function search3()
    {
        $keywords = Input::get('keywords');
        $cliente = Auth::user()->cliente;
        $leituras = $cliente->casa->leituras;
            foreach ($leituras as $leitura) {
                if ($leitura->factura->id==$keywords) {
                    return view('user.invoiceSearchByNumberResults')->with('factura', $leitura->factura);
                }
            }
        return view('user.invoiceSearchByNumberResults');
    }/**
     * Search for a invoice based on the date.
     *
     * @return \Illuminate\Http\Response
     */

    public
    function search4()
    {
        $keywords = Input::get('keywords');
        $cliente = Auth::user()->cliente;
        $leituras = $cliente->casa->leituras;
        foreach ($leituras as $leitura) {
                if (Str::contains($leitura->factura->created_at,$keywords)) {
                    return view('user.invoiceSearchByNumberResults')->with('factura', $leitura->factura);
                }
            }
        return view('user.invoiceSearchByNumberResults');
    }
}
