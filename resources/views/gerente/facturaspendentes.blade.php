@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                    <br>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Clientes</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Casa do Cliente</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>
                                {{$cliente['cliente_nome']}}
                            </td>
                            <td >
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>
                                            Bairro
                                        </td>
                                        <td>
                                            Rua/Avenida
                                        </td>
                                        <td>
                                            Casa numero
                                        </td>
                                        <td>
                                            Descricao
                                        </td>
                                        <td>
                                            Data
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cliente['casa'] as $casa)
                                            <td>{{ $casa['casa_bairro']}}</td>
                                            <td>{{ $casa['casa_rua']}}</td>
                                            <td>{{ $casa['casa_numero']}}</td>
                                            <td>{{ $casa['casa_descricao']}}</td>
                                            <td>{{ $casa['data']}}</td>
                                            <td>
                                                <a href="{{route('leitura.create',$casa['id'])}}">
                                                    <button class="btn btn-warning">Efectuar Leitura</button>
                                                </a>
                                            </td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
</div>
@stop