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
                {!! Form::open(array('route'=>['agua.store'], 'method'=>'POST'))!!}
                <legend>Cadastro de Precos de agua</legend>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
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
                            <input name="metros_cubicos_minimos"  placeholder="Metros Cubicos minimos" class="form-control"  type="number">
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
                    <label class="col-md-4 control-label">Preco por metro cubico</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="preco_unitario" placeholder="Preco unitario" class="form-control"  type="number">
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
                        <button type="submit" class="btn btn-success" >Definir precos</button>
                    </div>
                    <br>
                </div>
                {!! Form::close() !!}
            </div>
            </div>
        @else
        <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Preco da agua</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Metros cubicos minimos</th>
                                <th>Preco por metro cubico</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $agua['metros_cubicos_minimos']}}</td>
                                <td>{{ $agua['preco_unitario']}}</td>
                                <td>
                                    {!! Form::open(array('route'=>['agua.edit',$agua['id']], 'method'=>'GET'))!!}
                                    <button class="btn btn-warning" type="submit">Alterar </button>
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
