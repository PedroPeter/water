
@extends('gerente.template')

@section('content')


    <div class="container">
        <h1>Actualizacao da Factura</h1>
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">

                {!! Form::model($factura,['class'=>'well form-horizontal','route'=>['factura.update',$factura->id],'method'=>'PUT'])!!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <br>
                        <!-- Number input-->

                        <div >
                            <label  >Consumo do mes</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  name="l_actual" value="{{$factura->l_actual}}" placeholder="Consumo do mes" class="form-control"  type="number">
                                </div>
                            </div>
                        </div>

                        <div >
                            <label >Observacao</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
                                    <textarea class="form-control" rows="5" name="observacao"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" >Registar consumo <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </div>

                {{--</form>--}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
