@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
                <a href="{{route('createuser')}}" target="_blank">
                    <button>Registar</button>
                </a>
            </div>
        @else
        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Dados dos clientes <br>
                    </h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Celular Principal</th>
                                <th>Celular Secundário </th>
                                <th>Email</th>
                                <th colspan="3">Acções </th>
                            </tr>
                            </thead>
                    @foreach ($clientes as $cliente)
                            <tbody>
                            <tr>
                                <td>{{ $cliente->user->nome}}</td>
                                <td>{{ $cliente->user->apelido}}</td>
                                <td>{{ $cliente->user->celular1}}</td>
                                <td>{{ $cliente->user->celular2}}</td>
                                <td>{{ $cliente->user->email}}</td>


                                  {{--<td>
                                    {!! Form::open(array('route'=>['addCasa',$cliente->id], 'method'=>'GET'))!!}
                                    <button class="btn btn-success" type="submit">Addicionar Casa </button>
                                    {!! Form::close() !!}
                                </td>--}}
                                <td>
                                    {!! Form::open(array('route'=>['user.show',$cliente->id], 'method'=>'GET'))!!}
                                    <button class="btn btn-warning" type="submit">Alterar dados do cliente </button>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['user.destroy',$cliente->id], 'method'=>'DELETE'))!!}
                                    <button class="btn btn-danger" type="submit">Cancelar cotracto</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tbody>
                    @endforeach
                            </table>
                        </div>
                </div>
        @endif
    </div>
@stop
