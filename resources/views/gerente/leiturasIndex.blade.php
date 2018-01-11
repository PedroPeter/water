@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li> <br>
                        </ul>
                    </div>
                    <br>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Leituras pendentes</h3>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Casa do Cliente</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td>
                                {{$dt['cliente_nome']}}
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
                                            Operacao
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $dt['casa_bairro']}}</td>
                                            <td>{{ $dt['casa_rua']}}</td>
                                            <td>{{ $dt['casa_numero']}}</td>
                                            <td>{{ $dt['casa_descricao']}}</td>
                                            <td>
                                                {!! Form::open(array('route'=>['leitura.show',$dt['id']], 'method'=>'GET'))!!}
                                                <button class="btn btn-success" type="submit">Efectuar Leitura </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
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