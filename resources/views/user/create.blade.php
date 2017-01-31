@extends('user.template');

@section('hMais')

<style>
    #success_message{
        display: none;
    }
</style>
{{--<script src="{{asset('js/cadastro.js')}}"></script>--}}
<script src="{{asset('js/inputmask.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#nome").inputmask("Regex");
        $("#apelido").inputmask("Regex");
        $("#email").inputmask("{1,20}@{1,20}.{3}[.{2}]");
        $("#celular1").inputmask("999999999");
        $("#celular2").inputmask("999999999");
    });
</script>

@stop

@section('content')
{!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','url'=>'user'])!!}
{{--<form class="well form-horizontal" action="{{asset('user/store')}} " method="post"  id="contact_form" >--}}
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
        <legend>Para quem deseja obter os nossos serviços é imperioso que se faça o cadastro preenchendo o formulário abaixo. </legend>
       <br>
        <legend>Cadastro de user</legend>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label">Nome</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input  name="nome" id="nome" placeholder="Nome" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label" >Apelido</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="apelido" id="apelido" placeholder="Apelido" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label">E-Mail</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="email" id="email" placeholder="Email" class="form-control"  type="email">
                </div>
            </div>
        </div>


        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label">Celular Principal#</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="celular1" id="celular1" placeholder="(82/84/86)#######" class="form-control" type="number">
                </div>
            </div>
        </div>
        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label">Celular secundario#</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="celular2" id="celular2" placeholder="(82/84/86)#######" class="form-control" type="number">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-warning" >Cadastrar-se <span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>



    </fieldset>
{{--</form>--}}
{!! Form::close() !!}}
@stop