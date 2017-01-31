
@extends('gerente.template')

@section('content')

<div class="container">
    <h1>Cadastro da Casa do Cliente</h1>
    {{ Html::style('css/maps.css') }}
    <div id="map"></div>
    {{Html::script('js/loadmap.js')}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7tEiLExzWUkGGPssl0ST5A6DU4uqatjo&callback&callback=initMap"
            async defer></script>

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
                    <!-- Descricao-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Descricao da localizacao</label>
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input name="descricao" class="form-control"  type="textarea">
                            </div>
                        </div>

                   <!-- hidden input-->
                    <input name="id"  type="hidden" value="{{$id}}">
                    <!-- hidden input-->
                    <input name="lat"  type="hidden" >
                    <!-- hidden input-->
                    <input name="long"  type="hidden">

                    <div class="input-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">

                            <button type="submit" class="btn btn-success" >Registar Casa <span class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </div>

            {{--</form>--}}
            {!! Form::close() !!}

        </div>
    </div>
</div>
</div>


@stop