@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>Nome da fontenaria</th>
                                <th>Numero maximo de clientes</th>
                                <th>Clientes conectados a fontenaria</th>
                            </tr>
                            </thead>
                    @foreach ($data as $fontenaria)
                            <tbody>
                            <tr>
                                <td>{{ $fontenaria['nome']}}</td>
                                <td>{{ $fontenaria['max_clientes']}}</td>
                                <td>{{ $fontenaria['numero_clientes']}}</td>
                            </tr>
                            </tbody>
                    @endforeach
                            </table>
                        </div>
                </div>
    </div>
@stop
