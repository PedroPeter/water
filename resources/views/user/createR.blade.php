@extends('user.template')

@section('content')


    <div class="jumbotron" style="color: black;">
        <div class="alert alert-success" role="alert">
            <h3> Cadastro efectuado com sucesso!</h3>
        </div>

        <h1>Próximo passo</h1>
        <p>Para terminar o processo é necessário que traga ao nosso estabelecimento uma cópia de um documento (BI, Passaporte, etc.)
            que comprove os dados anteriormente inseridos durante o cadastro. Mais detalhes lhe serão enviados no seu celular e/ou email. </p>
        <p><a class="btn btn-primary btn-lg" href="{{route('paginainicial')}}" role="button">Voltar a pagina principal</a></p>
    </div>

@stop
