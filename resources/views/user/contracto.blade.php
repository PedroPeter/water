@extends('user.template')

@section('content')
    <h3>
        Abaixo encontra-se o contracto necessário para obter os nossos serviços. Ao aceitar os termos nele descritos estará apto a prosseguir com os próximos passos.

    </h3>

    <iframe src="{{asset('doc/SGA.pdf')}}" style="position:fixed; top:200px; left:3px; bottom:30px; right:30px; width:100%; height:70%; border:none; margin:0; padding:10px; overflow:hidden; " frameborder="0" scrolling="yes">

    </iframe>

    <h4 style="text-decoration: underline">
        <a href="{{route('createuser')}}">
            Aceitar os termos
        </a>
    </h4>

@stop