@extends('user.template')
@section('hMais')

    <style>
        #success_message {
            display: none;
        }

        body {
            color: #0f0f0f;
        }
    </style>
    {{--<script src="{{asset('js/cadastro.js')}}"></script>--}}
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#celular1").inputmask("99 999-9999");
            $("#celular2").inputmask("99 999-9999");
        });
    </script>
@stop

@section('content')
    {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'user.store'])!!}
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
            <legend>
                Para quem deseja obter os nossos serviços é imperioso que se faça o cadastro preenchendo o
                formulário abaixo.
            </legend>
            <br>
            <legend>Cadastro do Cliente</legend>

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
                        <input name="apelido" id="apelido" placeholder="Apelido" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>

                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="email" id="email" placeholder="Email" class="form-control" type="email">
                    </div>
                </div>
            </div>


            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">Celular Principal</label>

                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="celular1" id="celular1" placeholder="## ### ####" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">Celular secundario</label>

                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="celular2" id="celular2" placeholder="## ### ####" class="form-control" type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning">Cadastrar-se <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
    </fieldset>
    {!! Form::close() !!}
@stop