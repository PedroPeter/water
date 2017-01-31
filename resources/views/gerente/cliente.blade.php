
@extends('gerente.template')

@section('content')
    @section('script')
    @parent

    @stop

    <div class="container">
        <h1>Cadastro de Clientes</h1>
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'cliente.store','files'=>'true'])!!}
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
                        <!-- Date input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Data de Nascimento</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  name="dataNascimento"  placeholder="Data de nascimento" class="form-control"  type="date">
                                </div>
                            </div>
                        </div>

                        <!-- File input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Selecionar Contracto</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="contracto" id='fileDoc' class="form-control"  type="file">
                                </div>
                            </div>

                        </div><!-- File input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Selecionar copia do Documento</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="doc" id='fileDoc' placeholder="Documento" class="form-control"  type="file">
                                </div>
                            </div>
                        </div>
                        <!-- hidden input-->
                       <input name="id"  type="hidden" value="{{$id}}">

                        <div class="input-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">

                                <button type="submit" class="btn btn-success" >Registar cliente <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>

                </fieldset>
                {{--</form>--}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
