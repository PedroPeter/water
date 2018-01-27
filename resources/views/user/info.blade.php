@extends('user.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            @if(isset($message))
                <div class="row">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                </div>
            @elseif(count($faturas)>0)
                <div class="alert-info">
                    <h3> Dados pessoais</h3>
                </div>
                <br>
                <div class="col-sm-12" style="background-color:lightgray;">
                    <table class="table-bordered" style="width: 1000px; height: 400%">
                        <thead>
                        <tr>
                            <th>
                                Nome
                            </th>
                            <th>
                                Apelido
                            </th>

                            <th>
                                Numero do Celular 1
                            </th>
                            <th>
                                Numero do Celular 2
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="height: 50px;">
                            <td>
                                {{$casa['nome']}}
                            </td>
                            <td>
                                {{$casa['apelido']}}
                            </td>
                            <td>
                                {{$casa['celular1']}}
                            </td>
                            <td>
                                {{$casa['celular2']}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="alert-info">
                    <h3> Informacao Sobre sua Casa</h3>
                </div>
                <br>
                <div class="col-sm-12" style="background-color:lightgray;">
                    <table class="table-bordered" style="width: 100%; height: 400%">
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
                                Ponto de distribuicao conectada
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{$casa['num_casa']}}
                            </td>
                            <td>
                                {{$casa['rua_avenida']}}
                            </td>
                            <td>
                                {{$casa['bairro']}}
                            </td>

                            <td>
                                <div class="row">
                                    <div class="14">
                                        <table class="table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 80px;">
                                                    Nome
                                                </th>
                                                <th style="width: 80px;">
                                                    Bairro
                                                </th>
                                                <th style="width: 100px;">
                                                    Rua/Avenida
                                                </th>
                                                <th style="width: inherit; height: 50px; border-left: 20px;">
                                                    Descricao
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> {{$casa['fontenaria_nome']}} </td>
                                                <td>{{$casa['fontenaria_bairro']}}</td>
                                                <td>{{$casa['fontenaria_avenida']}}</td>
                                                <td>{{$casa['fontenaria_descricao']}}</td>
                                            </tr>
                                            </tbody>
                                            <tr>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        </tbody>
                    </table>
                </div>


                <div class="col-sm-12" style="background-color:lightgray;">
                    <div class="alert-info">
                        <h3> Agua</h3>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Metros cúbicos minimos</th>
                            <th>Preço por metro cúbico</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $agua['metros_cubicos_minimos']}}</td>
                            <td>{{ $agua['preco_unitario']}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="alert-info">
                        <h3>NB: Se o consumo mensal for inferior aos metros cúbicos minimos se
                            pagará {{ $agua['metros_cubicos_minimos']*$agua['preco_unitario']}} meticais.
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="background-color:lightgray;">
                        <div class="alert-info">
                            <h3> Factura/Leitura</h3>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Número da última leitua</th>
                                <th>Data</th>
                                <th>Consumo registado</th>

                                <th>Valor</th>
                                <th>Paga</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faturas as $fatura)
                                <tr>
                                    <td>{{ $fatura->leitura_id}}</td>
                                    <td>{{ $fatura->updated_at}}</td>
                                    <td>{{ $fatura->l_actual - $fatura->anterior}}</td>
                                    <td>{{ $fatura->val_pagar}}</td>
                                    <td>
                                        @if($fatura->paga)
                                            Sim
                                        @else
                                            Nao
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{ $faturas->links() }}
                        </table>
                        @else
                            <div class="row">
                                <div class="alert alert-info">
                                    Ainda nao possui faturas processadas.
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
@stop
