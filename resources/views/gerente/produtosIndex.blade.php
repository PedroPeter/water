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
                    <br>
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
        @else
        <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Produtos</h3>
                    @if(isset($message))
                        <div class="col-sm-12" style="background-color:darkgray;">
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            </div>
                            <br>
                    @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preco</th>
                                <th>Descrição</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produto as $p)
                            <tr>
                                <td>{{ $p->nome}}</td>
                                <td>{{ $p->preco}}</td>
                                <td>{{ $p->descricao}}</td>
                                <td>
                                    {!! Form::open(array('route'=>['produto.edit',$p->id], 'method'=>'GET'))!!}
                                    <button class="btn btn-success" type="submit">Alterar preco </button>
                                    {!! Form::close() !!}

                                </td>
                                <td>
                                    {!! Form::open(array('route'=>['produto.destroy',$p->id], 'method'=>'DELETE'))!!}
                                    <button class="btn btn-warning" type="submit">Remover </button>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    {!! Form::open(array('route'=>['produto.create'], 'method'=>'GET'))!!}
                                    <button class="btn btn-info" type="submit">Adicionar Produto</button>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                </div>
        @endif
    </div>

@stop
