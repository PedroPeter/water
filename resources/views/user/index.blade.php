
@extends('user.template')

@section('content')
    <img src="{{URL::asset('/img/water_desktop_wallpaper.jpg')}}" alt="profile Pic" height="400" width="1100">

    <br>
    <br>

    <p>
        As águas Zavala, SA, é uma empresa que se dedica na distribuição de água nas Áreas da Matola, Machava Socimol, Km-18 desde 2016.
    </p>
    <br>
    <p>
        O crescimento da empresa no período acima referido foi marcado por várias situações, alguma delas adversas e de caracter interno
        e externo como é natural, mas a empresa sempre procurou garantir o abastecimento de água aos seus clientes-sua
        principal razão de ser.
    </p>
    <br>
    <p>
        É em nome da equipa que reitera-se o compromisso de procurar trabalhar para melhorar a qualidade de vida de nossos clientes,
        contribuindo assim para o desenvolvimento da região Machava Socimol KM-18,
        em particular e do País, em geral.
    </p>

    <h4 style="text-decoration: underline">
        <a href="{{route('contracto')}}">Saiba como aderir aos nossos serviços</a>
    </h4>
    <br><br><br><br>
@stop