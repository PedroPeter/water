
@extends('gerente.template')

@section('content')

    <div class="container">
        <h1>Cadastro de Gerentes</h1>
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','url'=>'gerente'])!!}
                <fieldset>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                                <!-- Form Name -->
                        <br>
                        <legend>Cadastro de Gerente</legend>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nome</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  name="nome" id="nome" placeholder="Nome" class="form-control"  type="text">
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label" >Apelido</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="apelido" id="apelido" placeholder="Apelido" class="form-control"  type="text">
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="email" id="email" placeholder="Email" class="form-control"  type="email">
                                </div>
                            </div>
                        </div>


                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Celular Principal#</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="celular1" id="celular1" placeholder="(82/84/86)#######" class="form-control" type="number">
                                </div>
                            </div>
                        </div>
                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Celular secundario#</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="celular2" id="celular2" placeholder="(82/84/86)#######" class="form-control" type="number">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">User name#</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="username" id="celular2" placeholder="User name" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password#</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="password" id="passw" placeholder="Password" class="form-control" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Repita o password#</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="passwrordR" id="passwr" placeholder="Repita o password" class="form-control" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" >Cadastrar</button>
                            </div>
                        </div>
                </fieldset>
                {{--</form>--}}
                {!! Form::close() !!}

            </div>

            <div class="col-sm-12" style="background-color:lightgray;">
                <h1>Remover Gerentes</h1>

                @if (isset($gerentes))
                    <div class="alert alert-success">
                        <ul class="list-group">
                            @foreach ($gerentes as $gerente)
                                <li class="list-group-item container-fluid">
                                    <div class="col-sm-2">{{ $gerente['nome']}}</div>
                                    <div class="col-sm-3">
                                        {!! Form::open(array('route'=>['gerente.destroy',$gerente['id']], 'method'=>'DELETE'))!!}
                                            <button class="btn btn-warning" type="submit">Remover </button>
                                        {!! Form::close() !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                 @else
                    <h1>Nenhum gerente registado</h1>

                @endif

            </div>

        </div>
    </div>
@stop
