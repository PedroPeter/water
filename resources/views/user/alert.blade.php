@extends('user.template')

@section('content')
    <h3>Envie sua Preocupacao</h3>
    <div class="row">
        <div class="col-sm-12" style="background-color:darkgray;">
            {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'casa.store'])!!}

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
                <!-- Bairro-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Bairro:</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="bairro" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Rua ou avenida-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Rua/Avenida:</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="rua_avenida" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Numero da casa-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Numero da Casa:</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="numero_casa" class="form-control"  type="number">
                        </div>
                    </div>
                </div>
                <!-- Descricao-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Descricao da localizacao</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <textarea name="descricao" class="form-control" ></textarea>
                        </div>
                    </div>
                </div>
                <!-- hidden input-->
                <input name="id"  type="hidden" value="{{$id}}">
                <div class="input-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">

                        <button type="submit" class="btn btn-success" >Registar Casa <span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>

                {!! Form::close() !!}

        </div>
    </div>


@stop