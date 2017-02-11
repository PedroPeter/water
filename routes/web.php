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



Route::get('/', function () {
    return view('user.index');
});

Route::get('/user/resposta', function () {
    return view('user.createR');})->name('replyUser');

Route::get('/index', function () {
    return view('user.index');})->name('paginainicial');

Route::get('/contracto', function () {
    return view('user.contracto');})->name('contracto');

Route::get('/createuser', function () {
    return view('user.create');})->name('createuser');

Route::get('dashboard/cadastro', function(){
    return view('gerente.cadastro');});

Route::get('dashboard/index', function(){
    return view('gerente.template');});

Route::get('dashboard/user', 'UserController@index')->name('userindex');

Route::get('dashboard/login', function(){
    return view('gerente.login');})->name('entrarnosistema');

Route::get('dashboard/', function(){
    return view('gerente.login');});

Route::get('dashboard/casa/add/{cliente_id}', function($id){
    return View::make('gerente.clientecasa')->with('id',$id);;})->name('addCasa');
Route::get('dashboard/factura/imprimir/{id}','FacturaController@factura')->name('invoice.imprimir');
Route::get('dashboard/recibo/imprimir/{id}','FacturaController@recibo')->name('recibo.imprimir');

Route::get('porta','LoginController@Porta')->name('porta');
Route::get('cliente/{user_id}','ClienteController@create')->name('create.cliente');
Route::get('leitura/{user_id}','LeiturasController@create')->name('leitura.create');

Route::resource('dashboard/leitura','LeiturasController');
Route::resource('dashboard/gerente', 'GerenteController');
Route::resource('user','UserController');
Route::resource('dashboard/admin', 'AdminController');
Route::resource('dashboard/factura', 'FacturaController');
Route::resource('dashboard/contracto', 'ContractoController');
Route::resource('dashboard/agua', 'AguaController');
Route::resource('dashboard/produto', 'ProdutosController');
Route::resource('dashboard/cliente', 'ClienteController',['only' => ['index', 'show','destroy','store']]);
Route::resource('dashboard/admin/casa', 'CasaController');

Auth::routes();
Route::get('/home', 'HomeController@index');
