@extends('gerente.template')

@section('content')

    <div class="container">
        <table class="table-bordered" style="width: 1000px; height: 400%">
            <thead>
            <tr>
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
                    Fontenaria
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $casas)
                @foreach($casas as $casa)
                <tr style="height: 50px;">
                <td>
                    {{$casa->numero_casa}}
                </td>
                <td>
                    {{$casa->rua_avenida}}
                </td>
                <td>
                    {{$casa->bairro}}
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Conectar a Fontenaria...
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            @foreach($data['fontenarias'] as $fontenaria)
                                <li><a href="{!! route('casa.linkar', ['casa_id' => $casa->id, 'fontenaria_id' => $fontenaria->id] )!!}" >{{$fontenaria->nome}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>

        </table>
    </div>
@stop