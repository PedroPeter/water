@extends('gerente.template')

@section('content')
    <div class="container">
        <h1>Submeter contracto</h1>

        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'contracto.up','files'=>'true','methos'=>'POST'])!!}
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Selecionar Contracto</label>

                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                <input name="contracto" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Submeter <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
