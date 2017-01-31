@extends('user.template')

@section('content')
    <div class="alert alert-success" role="alert">
        <h3> Cadastro efectuado com sucesso!</h3>
    </div>

    <div class="jumbotron">
        <h1>Proximo passo</h1>
        <p>Para terminar o processo é necessário que traga ao nosso estabelecimento uma cópia de um documento (BI, Passaporte, etc.)
            que comprove os dados anteriormente inseridos durante o cadastro. Mais detalhes serão-lhe enviados no seu celular e/ou email. </p>
        <p><a class="btn btn-primary btn-lg" href="asset('user/auxilio'" role="button">Saber mais sobre a instalacao da agua</a></p>
        <p><a class="btn btn-primary btn-lg" href="asset('index'" role="button">Voltar a pagina principal</a></p>
    </div>

@stop
