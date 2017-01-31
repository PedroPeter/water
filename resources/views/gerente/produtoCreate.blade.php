@extends('gerente.template')

@section('content')
        <div class="row">
                <div class="col-sm-12" style="background-color:darkgray;">
                    {!! Form::open(array('route'=>['produto.store'], 'method'=>'POST'))!!}
                    <legend>Cadastro de Produtos</legend>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                                <!-- text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nome</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  name="nome"  placeholder="Nome" class="form-control"  type="text">
                                </div>
                                <br>
                            </div>
                        </div>
                </div>
        </div>
        <div class="row">

            <div class="col-sm-12" style="background-color:darkgray;">

                <!-- number input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Preco</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="preco"  placeholder="Preco" class="form-control"  type="number">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12" style="background-color:darkgray;">

                <!-- text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Descrição</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="descricao" placeholder="Descrição" class="form-control"  type="textarea">
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
                        <button type="submit" class="btn btn-success" >Registar produto</button>
                    </div>
                    <br>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@stop