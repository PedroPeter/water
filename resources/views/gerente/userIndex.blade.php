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
                    <h3> Dados previamente disponibilizados</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Celular Principal</th>
                                <th>Celular Secundario</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                    @foreach ($users as $user)
                            <tbody>
                            <tr>
                                <td>{{ $user->nome}}</td>
                                <td>{{ $user->apelido}}</td>
                                <td>{{ $user->celular1}}</td>
                                <td>{{ $user->celular2}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                    {!! Form::open(array('route'=>['create.cliente',$user['id']], 'method'=>'GET'))!!}
                                    <button class="btn btn-warning" type="submit">Tornar cliente </button>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['user.show',$user['id']], 'method'=>'PUT'))!!}
                                    <button class="btn btn-warning" type="submit">Actualizar dados </button>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['user.destroy',$user['id']], 'method'=>'POST'))!!}
                                    <button class="btn btn-warning" type="submit">Remover </button>
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
