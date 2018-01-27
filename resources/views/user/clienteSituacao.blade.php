@extends('user.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
                <a href="{{route('createuser')}}" target="_blank">
                </a>
            </div>
        @else
        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                <div class="alert-info">
                    <h3> Dados dos clientes <br>
                    </h3>
                </div>

                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr >
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Celular Principal</th>
                                <th>Celular Secundário </th>
                                <th>Email</th>
                                <th>Facturas pagas</th>
                                <th><a href="{{route('cliente.facturas.pendentes')}}">Facturas nao pagas</a></th>
                                <th >Valor acumulado das multas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $data['nome']}}</td>
                                <td>{{ $data['apelido']}}</td>
                                <td>{{ $data['celular1']}}</td>
                                <td>{{ $data['celular2']}}</td>
                                <td>{{ $data['email']}}</td>
                                <td>{{ $data['facturas_pagas']}}</td>
                                <td>{{ $data['facturas_nao_pagas']}}</td>
                                <td>{{ $data['multa_acumulada']}}</td>

                            </tr>
                            </tbody>
                            </table>
                        </div>
                </div>
        @endif
    </div>
@stop
