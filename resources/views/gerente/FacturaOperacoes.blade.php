@extends('gerente.template')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            @if(isset($message))
                <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                    <button class="alert-info">
                        <a href="{{route('facturaOperacoes.update')}}">Editar as definicoes feitas</a>
                    </button>
                    <br>
                </div>
            @else
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        </div>

        <div class="row">
            {!! Form::open(array('route'=>['factura.operacoes'], 'method'=>'POST'))!!}
            <legend>Multa para facturas não pagas</legend>
            <div class="col-sm-12" style="background-color:darkgray;">
                <!-- Number input-->
                <br>
                <div class="form-group">
                    <label class="col-md-4 control-label">Percentagem da multa</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="percentagem" placeholder="Percentagem da multa" class="form-control"
                                   type="number">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12" style="background-color:darkgray;">

                <!-- Number input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Último dia de pagamento</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="ultimo_dia" placeholder="Último dia de pagamento da factura"
                                   class="form-control" type="number">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                <div class="input-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success">Definir</button>
                    </div>
                    <br>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @endif
    </div>
@stop
