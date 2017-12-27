@extends('gerente.template')

@section('content')
    <div class="container">
        @if(count($data["dataNotLinked"])>0)
            <div class="alert-info"><h3>Casa de clientes nao conectadas a pontos de distribuicao</h3></div>
            <table class="table-bordered" style="width: 1000px; height: 400%">
                <thead>
                <tr>
                    <th>
                        Nome do Cliente
                    </th>
                    <th>
                        Apelido do Cliente
                    </th>
                    <th>
                        Numero da casa
                    </th>
                    <th>
                        Rua/Avenida
                    </th>
                    <th>
                        Bairro
                    </th>
                    <th>
                        Ponto de distribuicao por conectar
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data["dataNotLinked"] as $dados)
                    <tr style="height: 50px;">
                        <td>
                            {{$dados['nome']}}
                        </td>
                        <td>
                            {{$dados['apelido']}}
                        </td>
                        <td>
                            {{$dados['num_casa']}}
                        </td>
                        <td>
                            {{$dados['rua_avenida']}}
                        </td>
                        <td>
                            {{$dados['bairro']}}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    Conectar a Fontenaria...
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    @foreach($data['fontenarias'] as $fontenaria)
                                        <li>
                                            <a href="{!! route('casa.linkar', ['casa_id' => $dados['id'], 'fontenaria_id' => $fontenaria->id] )!!}">{{$fontenaria->nome}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        @else
            <div class="alert-success"><h3>Todas casas dos clientes estao conectados a pontos de distribuicao.</h3>
            </div>
        @endif
        <br><br>
        <div class="alert-info"><h3>Casa de clientes conectadas a pontos de distribuicao</h3></div>
        <table class="table-bordered" style="width: 1000px; height: 400%">
            <thead>
            <tr>
                <th>
                    Nome do Cliente
                </th>
                <th>
                    Apelido do Cliente
                </th>
                <th>
                    Numero da casa
                </th>
                <th>
                    Rua/Avenida
                </th>
                <th>
                    Bairro
                </th>
                <th>
                    Ponto de distribuicao conectada
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data["dataLinked"] as $dados)
                <tr style="height: 50px;">
                    <td>
                        {{$dados['nome']}}
                    </td>
                    <td>
                        {{$dados['apelido']}}
                    </td>
                    <td>
                        {{$dados['num_casa']}}
                    </td>
                    <td>
                        {{$dados['rua_avenida']}}
                    </td>
                    <td>
                        {{$dados['bairro']}}
                    </td>
                    <td>
                        <a href="{!! route('fontenaria.index')!!}">{{$dados['fontenaria']}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@stop