@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li><br>
                        </ul>
                    </div>
                    <br>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Facturas </h3>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Numero da factura</th>
                            <th>Leitura anterior</th>
                            <th>Leitura actual</th>
                            <th>Metros cubicos</th>
                            <th>Valor a pagar</th>
                            <th>Observacao</th>
                            <th>Operacao</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($facturas_data as $factura)
                        <tr>
                            <td>
                                {{$factura['numero']}}
                            </td>
                            <td>
                                {{$factura['l_anterior']}}
                            </td>
                            <td>
                                {{$factura['l_actual']}}
                            </td>
                            <td>
                                {{$factura['metros_cubicos']}}
                            </td>
                            <td>
                                {{$factura['val_pagar']}}
                            </td>
                            <td>
                                {{$factura['obs']}}
                            </td>
                            <td>
                                {!! Form::open(array('route'=>['invoice.imprimir',$factura['numero']], 'method'=>'GET'))!!}
                                <button class="btn btn-success" type="submit">Imprimir </button>
                                {!! Form::close() !!}
                                {!! Form::open(array('route'=>['recibo.imprimir',$factura['numero']], 'method'=>'GET'))!!}
                                <button class="btn btn-success" type="submit">Recibo </button>
                                {!! Form::close() !!}
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