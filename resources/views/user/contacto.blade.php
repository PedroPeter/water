@extends('user.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li><br>
                        </ul>
                    </div>
                    <br>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-12" style="background-color:darkgray;">

                    {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'leitura.store'])!!}
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
                            <!-- Number input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Assunto</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="assunto"  placeholder="Consumo do mes" class="form-control"  type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mensagem</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <textarea  name="mensagem"  class="form-control" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- hidden input-->
                            <input name="id"  type="hidden" value="{{$id}}">
                            <div class="input-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success" >Comunicar<span class="glyphicon glyphicon-send"></span></button>
                                </div>
                            </div>

                    </fieldset>
                    {{--</form>--}}
                    {!! Form::close() !!}

                </div>

            </div>
        @endif
</div>
@stop