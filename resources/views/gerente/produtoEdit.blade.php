@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">


            <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::model($produto,['route'=>['produto.update',$produto->id],'class'=>'control-label','method'=>'PUT'])!!}
                <legend>Actualização  dos Precos de agua</legend>

                <!-- text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Nome</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="nome" id="preco_minimo" value="{{$produto->nome}}" placeholder="Nome" class="form-control"  type="number">
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
                    <label class="col-md-4 control-label" >Preco</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="preco" value="{{$produto->preco}}" id="metros_cubicos_minimos" placeholder="Preco do produto" class="form-control"  type="number">
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
                    <label class="col-md-4 control-label">Descrição</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="descricao" value="{{$produto->descricao}}" placeholder="Descrição do produto" class="form-control"  type="textarea">
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
