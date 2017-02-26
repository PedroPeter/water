@extends('gerente.template')

@section('content')
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#celular1").inputmask("99 999-9999");
            $("#celular2").inputmask("99 999-9999");
        });
    </script>
    <div class="container">
        <h1>Gestao dos Adminstradores</h1>

        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'admin.store'])!!}
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
                        <legend>Cadastro do Administrardor</legend>
                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nome</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="nome" id="nome" placeholder="Nome" class="form-control" type="text">
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Apelido</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="apelido" id="apelido" placeholder="Apelido" class="form-control"
                                           type="text">
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="email" id="email" placeholder="Email" class="form-control"
                                           type="email">
                                </div>
                            </div>
                        </div>


                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Celular Principal</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="celular1" id="celular1" placeholder="## ### ####" class="form-control"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Celular secundario</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="celular2" id="celular2" placeholder="## ### ####" class="form-control"
                                           type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">User name</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="username" id="celular2" placeholder="User name" class="form-control"
                                           type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="password" placeholder="Password" class="form-control"
                                           type="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Repita o password</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input name="passwordR"  placeholder="Repita o password" class="form-control" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                </fieldset>
                {{--</form>--}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@stop
