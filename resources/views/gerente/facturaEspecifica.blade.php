@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">

        <div class="row">
            <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Factura </h3>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Numero da factura</th>
                            <th>Leitura anterior</th>
                            <th>Leitura actual</th>
                            <th>Metros cubicos consumidos</th>
                            <th>Valor unitario</th>
                            <th>Valor a pagar</th>
                            <th>Observacao</th>
                            <th>Operacao</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$factura->id}}
                                </td>
                                <td>
                                    {{$factura->l_anterior}}
                                </td>
                                <td>
                                    {{$factura->l_actual}}
                                </td>
                                <td>
                                    {{$factura->metros_cubicos}}
                                </td>
                                <td>
                                    {{$factura->preco_unitario}}
                                </td>
                                <td>
                                    {{$factura->val_pagar}}
                                </td>
                                <td>
                                    {{$factura->observacao}}
                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['factura.show',$factura->id], 'method'=>'GET'))!!}
                                    <button class="btn btn-success" type="submit">Alterar dados</button>
                                    {!! Form::close() !!}
                                    <br>
                                    {!! Form::open(array('route'=>['invoice.imprimir',$factura->id], 'method'=>'POST'))!!}
                                    <button class="btn btn-success" type="submit">Imprimir</button>
                                    {!! Form::close() !!}
                                    <br>
                                    {!! Form::open(array('route'=>['recibo.imprimir',$factura->id], 'method'=>'POST'))!!}

                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pagar
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                        <li><button class="btn btn-secondary" type="submit">Valor completo </button></li>
                                            <li>
                                                <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#myModal">Valor Parcial</button>

                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Introduza o valor parcial</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="number" name="valor_parcial">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="submit">Submeter</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
@stop