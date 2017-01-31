<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aguas Zavala</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/template.css')}}">
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    @yield('hMais')
</head>
<body>
<nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Aguas Zavala</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{route('paginainicial')}}">Home</a></li>
            <li><a href="#">Auxilio na instalacao</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{route('createuser')}}"><span class="glyphicon glyphicon-user"></span> Criar uma conta</a></li>
            <li><a href="{{route('entrarnosistema')}}"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
        </ul>
    </div>
</nav>

<div class="container" id="pdf">
    @yield('content')
</div>

<footer>
<p>
   <a href="#">Fale connosco</a>
</p>
    <br/>
  <p>Av. Josina MAchel numero 1352 . Maputo, Mocambique </p>
</footer>

</body>
</html>
    