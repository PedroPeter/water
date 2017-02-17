@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
                <a href="{{route('createuser')}}">
                    <button>Registar</button>
                </a>
            </div>
        @else
        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Dados das fontenarias <br>
                        @if(isset($message))
                            <div class="alert alert-success">
                                <h3>{{$message}}</h3>
                            </div>
                        @endif
                    </h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Bairro</th>
                                <th>Rua/Avenida</th>
                                <th>Numero </th>
                                <th>Numero maximo de clientes</th>
                                <th>Descricao</th>
                                <th colspan="2">Acções </th>
                            </tr>
                            </thead>
                    @foreach ($fontenarias as $fontenaria)
                            <tbody>
                            <tr>
                                <td>{{ $fontenaria->nome}}</td>
                                <td>{{ $fontenaria->bairro}}</td>
                                <td>{{ $fontenaria->rua_avenida}}</td>
                                <td>{{ $fontenaria->numero}}</td>
                                <td>{{ $fontenaria->max_clientes}}</td>
                                <td>{{ $fontenaria->descricao}}</td>

                                <td>
                                    {!! Form::open(array('route'=>['fontenaria.show',$fontenaria->id], 'method'=>'GET'))!!}
                                    <button class="btn btn-warning" type="submit">Alterar dados </button>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['fontenaria.destroy',$fontenaria->id], 'method'=>'DELETE'))!!}
                                    <button class="btn btn-warning" type="submit">Remover </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tbody>
                    @endforeach
                            </table>
                <a><button type="button" class="btn btn-info">Mais informacoes</button></a>
                        </div>
                </div>
        @endif
    </div>
@stop
