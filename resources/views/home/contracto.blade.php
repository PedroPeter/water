@extends('home.template')
@section('content')
    <div id="content">
                <p> Abaixo se encontra o contracto necessário para obter os nossos serviços. Ao aceitar os termos nele
                    descritos estará apto a prosseguir para os próximos passos.</p>
                <iframe src="https://docs.google.com/document/d/1WRiawxqkN-w4hYp4LSl_DUqah62cpzpexITCWzjPBCs/edit?usp=sharing"
                        style="position:absolute; width:inherit; height:80px; overflow:inherit; "
                        frameborder="0" scrolling="yes">
                </iframe>
            <div class="alert-info" style="padding-top: 500px;">
                <h4>
                    <a href="{{route('createuser')}}">Aceitar os termos</a>
                </h4>

            </div>
    </div>

@stop