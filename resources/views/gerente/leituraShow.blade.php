
@extends('gerente.template')

@section('content')
    {{--@section('script')
    @parent

    @stop--}}

    <div class="container">
        <h1>Leitura</h1>
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'leitura.store'])!!}
                <fieldset>
                    @if(isset($message))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

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
                        <!-- Number input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Consumo do mes</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  name="consumo"  placeholder="Consumo do mes" class="form-control"  type="number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Observação</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <textarea value="Nenhuma observação feita." name="observacao"  class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- hidden input-->
                       <input name="id"  type="hidden" value="{{$id}}">
                        <div class="input-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" >Registar consumo <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>

                </fieldset>
                {{--</form>--}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
