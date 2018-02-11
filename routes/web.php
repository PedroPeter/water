<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//no middlewares neccessary // Guest page

Route::get('/', function () {
    return view('home.index');
})->name('paginainicial');

Route::get('/createuser', function () {
    return view('home.create');
})->name('createuser');
Route::get('/user/resposta', function () {
    return view('home.createR');
})->name('replyUser');

Route::get('/contracto', function () {
    return view('home.contracto');
})->name('contracto');
Route::get('/cliente/contracto', function () {
    return view('user.contracto');
})->name('cliente.contracto');
Route::resource('sistema/login', 'LoginController');
Route::post('sistema/login/check/', 'LoginController@check')->name('login.check');

Route::post('cliente/cadastrar', 'UserController@store')->name('user.store');


// admin routs ->middlewares necessary

Route::group(['middleware' => 'auth',], function () {

    // client routs
    Route::get('cliente/gestao', function () {
        return view('user.template');
    })->name('cliente.dashboard');
    Route::get('cliente/gestao/conversa', function () {
        return view('user.mensagem');
    })->name('cliente.chat');
    Route::get('cliente/gestao/info/all', 'ClienteController@info')->name('cliente.info');





    //admin routers

    Route::get('dashboard', function () {
        return view('gerente.template');})->name('dashboard');

    Route::get('dashboard/cliente', function () {return view('cliente.template');
    })->name('cliente.dashboard');

    Route::get('login/out/true', function () {
        Auth::logout(); return view('home.index');})->name('login.out');

    Route::get('dashboard/user', 'UserController@index')->name('user.index');

    Route::get('dashboard/casa/add/{cliente_id}', function ($id) {
        return View::make('gerente.clientecasa')->with('id', $id);})->name('addCasa');

    Route::post('dashboard/factura/imprimir/{id}', 'FacturaController@factura')->name('invoice.imprimir');

    Route::post('dashboard/recibo/imprimir/{id}', 'FacturaController@recibo')->name('recibo.imprimir');

    Route::get('cliente/{user_id}', 'ClienteController@create')->name('create.cliente');
    Route::get('cliente/gestao/editar', function(){
        $user = Auth::user();
        return View::make('user.userShow', compact('user'));
    })->name('cliente.edit');
    Route::get('/cliente/gestao/pesquisar', function () {
        return view('user.pesquisar');})->name('cliente.pesquisar');

    Route::get('dashboard/admin/contratcto/upload', function () {
        return view('gerente.contracto');})->name('contracto.crt');
    Route::get('dashboard/clientes/pesquisar', function () {
        return view('gerente.pesquisar');})->name('search');

   /* Route::get('leitura/{user_id}', 'LeiturasController@create')->name('leitura.create');*/
    Route::post('dashboard/contracto/upload', 'GerenteController@contracto')->name('contracto.up');
    Route::post('dashboard/clientes/pesquisar', 'ClienteController@search')->name('cliente.search');
    Route::post('cliente/pesquisar/resultados/factura', 'ClienteController@search3')->name('cliente.pesquisar.numerofactura');
    Route::post('cliente/pesquisar/resultados/data', 'ClienteController@search4')->name('cliente.pesquisar.data');
    Route::post('dashboard/clientes/pesquisar/clientes', 'ClienteController@search2')->name('cliente.search2');
    Route::post('dashboard/leituras/pesquisar', 'LeiturasController@search')->name('leitura.search');
    Route::post('dashboard/leituras/pesquisar/filtrando', 'LeiturasController@index_filtro')->name('leitura.filtrar');
    Route::post('dashboard/leituras/pesquisar/semFiltro', 'LeiturasController@index_todas')->name('leitura.sem_filtro');
    Route::get('dashboard/leitura/pendente', 'LeiturasController@pendentes')->name('leituras.pendentes');
    Route::get('dashboard/factura/pendente', 'FacturaController@pendentes')->name('facturas.pendentes');
    Route::get('cliente/factura/pendentes', 'FacturaController@cliente_pendentes')->name('cliente.facturas.pendentes');
    Route::get('dashboard/factura/emitidas', 'FacturaController@emetidas')->name('facturas.emetidas');
    Route::get('dashboard/admin/casa/link', 'CasaController@link')->name('casa.link');
    Route::get('dashboard/admin/fontenarias/detalhes', 'FontenariaController@links')->name('fontenaria.detalhes');
    Route::get('dashboard/admin/casa/{casa_id}/fontenaria/{fontenaria_id}', [
        'as' => 'casa.linkar', 'uses' => 'CasaController@linkar'
    ]);
    Route::resource('dashboard/leitura', 'LeiturasController');
    Route::resource('dashboard/user', 'UserController',['except' => 'store']);
    Route::resource('dashboard/fontenaria', 'FontenariaController',['except' => 'update']);
    Route::resource('dashboard/factura', 'FacturaController');
    Route::resource('dashboard/contracto', 'ContractoController');
    Route::resource('dashboard/cliente', 'ClienteController', ['only' => ['index', 'show', 'store']]);
    Route::get('dashboard/clientes/inactivos/', 'ClienteController@index2')->name('cliente.index2');
    Route::get('dashboard/clientes/situacao/', 'ClienteController@situacao')->name('clientes.situacao');
    Route::get('cliente/gestao/situacao/', 'ClienteController@situacao_individual')->name('cliente.situacao');
    Route::resource('dashboard/admin/casa', 'CasaController');
    Route::get('dashboard/clientes/chat', 'MensagemController@index')->name('chat.index');
    Route::get('dashboard/clientes/chat/{id}', 'MensagemController@show')->name('chat.show');
    Route::post('dashboard/clientes/chat/getChat/{id}', 'MensagemController@getChat');
    Route::post('dashboard/clientes/chat/sendChat', 'MensagemController@sendChat');


    Route::group(['middleware' => 'onlyAdmin', 'prefix'=>'admin'], function () {
        Route::get('dashboard/cadastro', function () {
            return view('gerente.cadastro');
        });

        Route::resource('dashboard/fontenaria', 'FontenariaController',['only' => 'update']);
        Route::resource('dashboard/gerente', 'GerenteController');
        Route::get('dashboard/admin/estatisticas', 'AdminController@estatisticas')->name('estatisticas');
        Route::resource('dashboard/admin', 'AdminController');
        Route::resource('dashboard/agua', 'AguaController');
        Route::post('dashboard/factura/definir/operacoes/', 'FacturaController@operacoes')->name('factura.operacoes');
        Route::put('dashboard/factura/definir/operacoes', 'FacturaController@operacoesUpdate')->name('factura.operacoes');
        Route::get('dashboard/factura/definir/operacoes/update', 'FacturaController@create')->name('facturaOperacoes.update');
        Route::get('dashboard/factura/definir/operacoes', 'FacturaController@operacoesCreate')->name('factura.operacoes');
        Route::get('dashboard/cliente/destroy', 'ClienteController@destroy')->name('cliente.destroy');

    });


});

Auth::routes();
Route::get('/home', 'HomeController@index');
