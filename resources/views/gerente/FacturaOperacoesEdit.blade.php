@extends('gerente.template')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">


            <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::model($operacoes,['route'=>['factura.operacoes'],'class'=>'control-label','method'=>'PUT'])!!}
                <legend>Actualização...</legend>
            </div>
             </div>
             <div class="row">

             <div class="col-sm-12" style="background-color:darkgray;">

                     <!-- Number input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Percentagem da multa</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="percentagem" value="{{$operacoes->percentagem}}" id="percentagem" placeholder="Percentagem da multa" class="form-control"  type="number">
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
                    <label class="col-md-4 control-label">Ultimo dia de pagamento</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="id" type="hidden" value="{{$operacoes->id}}">
                            <input name="ultimo_dia" value="{{$operacoes->ultimo_dia}}" id="ultimo_dia" placeholder="Ultimo dia de pagamento" class="form-control"  type="number">
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
                        <button type="submit" class="btn btn-success" >Alterar</button>
                    </div>
                    <br>
                </div>
                {!! Form::close() !!}
            </div>
            </div>
    </div>

@stop
