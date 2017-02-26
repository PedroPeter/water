@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                        <table class="table table-bordered">
                            <thead>
                            <div class="alert alert-info">
                            <h3>Agua</h3></div>
                            <tr>
                                <th>Metros cubicos minimos</th>
                                <th>Preco unitario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $data['agua']->metros_cubicos_minimos}}</td>
                                <td>{{ $data['agua']->preco_unitario}}</td>
                            </tr>
                            </tbody>
                            </table>

                    <table class="table table-bordered">
                            <thead>
                            <div class="alert alert-info"><h3>Clintes</h3></div>
                            <tr>
                                <th>Clientes activos</th>
                                <th>Clientes inactivos</th>
                                <th>Facturas pagas</th>
                                <th>Facturas nao pagas</th>
                                <th>Reclamacoes feitas</th>
                                <th>Pedidos feitos</th>
                                <th>Valor total das facturas pagas </th>
                                <th>Valor pendente das facturas nao pagas </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $data['clt_activos']}}</td>
                                <td>{{ $data['clt_inactivos']}}</td>
                                <td>{{ $data['fac_pagas']}}</td>
                                <td>{{ $data['fac_Npagas']}}</td>
                                <td>{{ $data['rcl']}}</td>
                                <td>{{ $data['pdd']}}</td>
                                <td>{{ $data['val_total']}}</td>
                                <td>{{ $data['val_pendente']}}</td>
                            </tr>
                            </tbody>
                            </table>
                    <table class="table table-bordered">
                            <thead>
                            <div class="alert alert-info"><h3>Productos</h3></div>
                            <tr>
                                <th>Nome</th>
                                <th>Preco</th>
                                <th>Descricao</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($data['productos'] as $producto)
                                <td>{{ $producto->nome}}</td>
                                <td>{{ $producto->preco}}</td>
                                <td>{{ $producto->descricao}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                </div>
    </div>
@stop
