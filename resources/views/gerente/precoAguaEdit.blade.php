@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">


            <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::model($agua,['route'=>['agua.update',$agua->id],'class'=>'control-label','method'=>'PUT'])!!}
                <legend>Actualização  dos Precos de agua</legend>

            </div>
             </div>
             <div class="row">

             <div class="col-sm-12" style="background-color:darkgray;">

                     <!-- Number input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Metros cubicos minimos</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="metros_cubicos_minimos" value="{{$agua->metros_cubicos_minimos}}" id="metros_cubicos_minimos" placeholder="Metros Cubicos minimos" class="form-control"  type="number">
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
                    <label class="col-md-4 control-label">Preco por metro-cubico</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="preco_unitario" value="{{$agua->preco_unitario}}" id="preco_unitario" placeholder="Preco unitario" class="form-control"  type="number">
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
