@extends('user.template')

@section('content')

    <div class="container">
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
            @if (isset($message))
                <div class="alert alert-info">
                    <h4>{{$message}}</h4>
                </div>
            @endif
        </legend>
        {{ Form::open(array('method' => 'PUT','class'=>'well form-horizontal','route' => array('user.update', $user->id)))}}
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
        <!-- Text input-->
        <div class="form-group">
            <label class="control-label" for="nome">Username</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="username" id="username" value="{{$user->username}}" placeholder="Nome" class="form-control"
                           type="text" maxlength="30">
                </div>
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="control-label">Password actual</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="password" id="passw"  placeholder="password"
                           class="form-control" type="password" maxlength="30">
                </div>
            </div>
        </div>
        <!-- Text input-->

        <div class="form-group">
            <label class="control-label">Novo Password</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="passwordN" id="passw"  placeholder="password"
                           class="form-control" type="password" maxlength="30">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Repita o novo Password</label>

            <div class="inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="passwordNR" id="passwR"  placeholder="password"
                           class="form-control" type="password" maxlength="30">
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
