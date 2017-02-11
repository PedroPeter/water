@extends('gerente.template')

@section('content')

    <div class="container">

        {{ Form::open(array('method' => 'PUT','class'=>'well form-horizontal','route' => array('user.update', $user->id)))}}
        <legend>Actualizacao dos dados do Cliente <br>
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
        <!-- Text input-->
        <div class="form-group">
            <label class="control-label" for="nome">Nome</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="nome" id="nome" value="{{$user->nome}}" placeholder="Nome" class="form-control"
                           type="text" maxlength="30">
                </div>
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="control-label">Apelido</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="apelido" id="apelido" value="{{$user->apelido}}" placeholder="Apelido"
                           class="form-control" type="text" maxlength="30">
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="control-label">E-Mail</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="email" id="email" value="{{$user->email}}" class="form-control"
                           type="email">
                </div>
            </div>
        </div>


        <!-- Text input-->

        <div class="form-group">
            <label class="control-label" for="celular1">Celular Principal#</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="celular1" id="celular1" value="{{$user->celular1}}" class="form-control" type="text">
                </div>
            </div>
        </div>
        <!-- Text input-->

        <div class="form-group">
            <label class=" control-label" for="celular2">Celular secundario#</label>

            <div class=" inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="celular2" id="celular2" value="{{$user->celular2}}" class="form-control" type="text">
                </div>
            </div>
        </div>

        <div class="input-group">
            <label class="control-label"></label>

            <div>
                <button type="submit" class="btn btn-success">Actualizar <span class="glyphicon glyphicon-send"></span>
                </button>
            </div>
        </div>


        {!! Form::close() !!}
        <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $("#celular1").inputmask("99 999-9999");
                $("#celular2").inputmask("99 999-9999");
            });
        </script>


    </div>
@stop
