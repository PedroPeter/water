<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Águas XYZ</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/template.css')}}">
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    @yield('hMais')
</head>
<body>
<div class="alert-info" style="font-size: 72px; text-align: center;">
    Águas XYZ
</div>
<nav class="navbar navbar-inverse  navbar-fixed-top embed-responsive" style="height: 100px; padding-top: 10px; font-size: 40px;">
    <div class="container-fluid">
        <ul class="nav justify-content-center"  >
            <li class="nav-item">
                <a class="nav-link" href="{{route('paginainicial')}}" >Pagina Inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('createuser')}}"><span class="glyphicon glyphicon-user"></span>Tornar-se Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('login.create')}}" ><span class="glyphicon glyphicon-log-in"></span>Entrar</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" id="pdf">
    @yield('content')
</div>

<div style="padding-top: 50px;">
    <footer>
        <a href="#">Fale connosco</a>
        <br/>
        <p>Av. Josina Machel numero 1352 . Maputo, Mocambique </p>
    </footer>
</div>
</body>
</html>
    