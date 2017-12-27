@extends('user.template')

@section('content')
    <h3>
        Abaixo se encontra o contracto necessário para obter os nossos serviços. Ao aceitar os termos nele descritos
        estará apto a prosseguir para os próximos passos.
    </h3>
    <div class="card-blockquote" style="padding-bottom: 500px;">
        <iframe src="https://docs.google.com/document/d/1WRiawxqkN-w4hYp4LSl_DUqah62cpzpexITCWzjPBCs/edit?usp=sharing"
                style="position:absolute; top:100px; left:3px; bottom:30px; right:30px; width:100%; height:70%; border:none; margin:0; padding:10px; overflow:inherit; "
                frameborder="0" scrolling="yes">
        </iframe>
    </div>

    <div class="alert-info">
        <h3>
            <a href="{{route('createuser')}}">Aceitar os termos</a>
        </h3>


    </div>

@stop