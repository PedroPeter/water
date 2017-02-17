@extends('gerente.template')

@section('content')

    <div class="container">

        {{ Form::open(array('method' => 'PUT','class'=>'well form-horizontal','route' => array('fontenaria.update', $fontenaria->id)))}}
        <legend>Actualizacao dos dados <br>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </legend>
        <!-- Form Name -->
        <br>
        <!-- Nome-->
        <div class="form-group">
            <label class="col-md-4 control-label">Nome:</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="nome" class="form-control"  type="text" value="{{$fontenaria->nome}}">
                </div>
            </div>
        </div><!-- Bairro-->
        <div class="form-group">
            <label class="col-md-4 control-label">Bairro:</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input value="{{$fontenaria->bairro}}" name="bairro" class="form-control"  type="text">
                </div>
            </div>
        </div>
        <!-- Rua ou avenida-->
        <div class="form-group">
            <label class="col-md-4 control-label">Rua/Avenida:</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input value="{{$fontenaria->rua_avenida}}" name="rua_avenida" class="form-control"  type="text">
                </div>
            </div>
        </div>
        <!-- Numero da casa-->
        <div class="form-group">
            <label class="col-md-4 control-label">Numero:</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input value="{{$fontenaria->numero}}" name="numero" class="form-control"  type="number">
                </div>
            </div>
        </div>
        <!-- Numero da casa-->
        <div class="form-group">
            <label class="col-md-4 control-label">Numero maximo de clientes:</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input value="{{$fontenaria->max_clientes}}" name="max_clientes" class="form-control"  type="number">
                </div>
            </div>
        </div>
        <!-- Descricao-->
        <div class="form-group">
            <label class="col-md-4 control-label">Descricao da localizacao</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <textarea value="{{$fontenaria->descricao}}" name="descricao" class="form-control" ></textarea>
                </div>
            </div>
        </div>
        <div class="input-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success" >Alterar Fontenaria <span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>
        {!! Form::close() !!}



    </div>
@stop
