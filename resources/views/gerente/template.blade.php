<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Area Administrativa - Aguas XYZ | Admin Dashboad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Core CSS - Include with every page -->
    {{ Html::style('plugins/bootstrap/bootstrap.css')}}
    {{ Html::style('font-awesome/css/font-awesome.css')}}
    {{ Html::style('plugins/pace/pace-theme-big-counter.css')}}
    {{ Html::style('css/style.css')}}
    {{ Html::style('css/main-style.css')}}
            <!-- Core Scripts - Include with every page -->
    {{ Html::script('js/jquery-3.1.1.min.js')}}
    {{ Html::script('plugins/bootstrap/bootstrap.min.js')}}
    {{ Html::script('plugins/metisMenu/jquery.metisMenu.js')}}
    {{ Html::script('plugins/pace/pace.js')}}
    {{ Html::script('scripts/siminta.js')}}
    @yield('hMais')
</head>

<body>
<!--  wrapper -->
<div id="wrapper">
    <!-- navbar top -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
        <!-- navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('paginainicial')}}">
                <img src="{{asset('img/logo.png')}}" alt=""/>
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- navbar-top-links -->
        <ul class="nav navbar-top-links navbar-right">
            <!-- main dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-3x"></i>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{route('login.out')}}"><i class="fa fa-sign-out fa-fw"></i>Sair</a>
                    </li>
                </ul>
                <!-- end dropdown-user -->
            </li>
            <!-- end main dropdown -->
        </ul>
        <!-- end navbar-top-links -->

    </nav>
    <!-- end navbar top -->

    <!-- navbar side -->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <!-- sidebar-collapse -->
        <div class="sidebar-collapse">
            <!-- side-menu -->
            <ul class="nav" id="side-menu">
                <li>
                    <!-- user image section-->
                    <div class="user-section">
                        <div class="user-section-inner">
                            <img src="{{asset('img/user.jpg')}}" alt="">
                        </div>
                        <div class="user-section-inner">
                        </div>
                        <div class="user-info">

                            <div class="user-text-online">
                                <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                            </div>
                        </div>
                    </div>
                    <!--end user image section-->
                </li>
                <li class="">
                    <a href="{{route('dashboard')}}"><i class="fa fa-dashboard fa-fw"></i>Administração</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bitcoin fa-fw"></i>Recursos<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <!--Preco da agua-->
                        <li>
                            <a href="{{route('agua.index')}}">Definir preço da Água</a>
                        </li>
                        <li>
                            <a href="{{route('factura.operacoes')}}">Operações sobre as Facturas</a>
                        </li>
                        <li>
                            <a href="{{route('contracto.crt')}}">Submeter contracto</a>
                        </li>
                    </ul>
                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sun-o fa-fw"></i>Fontenária<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('fontenaria.create')}}">Registar</a>
                        </li>
                        <li>
                            <a href="{{route('fontenaria.index')}}">Mais operações</a>
                        </li>
                    </ul>
                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>Pedidos/Operações<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="{{route('user.index')}}">Novos clientes</a>
                        </li>
                        <li>
                            <a href="{{route('casa.link')}}">Casas e pontos de distribuição</a>
                        </li>
                        <li>
                            <a href="{{route('cliente.index')}}">Clientes</a>
                        </li>
                    </ul>
                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="{{route('leitura.index')}}"><i class="fa fa-edit fa-fw"></i>Leituras</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i>Facturas<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('factura.index')}}">Emitir</a>
                        </li>
                        <li>
                            <a href="{{route('facturas.pendentes')}}">Facturas pendentes</a>
                        </li>
                        <li>
                            <a href="{{route('search')}}">Pesquisar</a>
                        </li>
                    </ul>
                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="{{route('clientes.situacao')}}"><i class="fa fa-warning fa-fw"></i>Situação dos
                        clientes<span></span></a>
                </li>
                <li>
                    <a href="{{route('estatisticas')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Estatísticas
                        <span></span></a>
                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="{{route('chat.index')}}"><i class="fa fa-edit fa-fw"></i>Chat com Clientes
                        <span></span></a>
                    <!-- second-level-items -->
                </li><li>
                    <a href="{{route('gerente.create')}}"><i class="fa fa-edit fa-fw"></i>Gerir gerentes
                        <span></span></a>
                    <!-- second-level-items -->
                </li>
            </ul>
            <!-- end side-menu -->
        </div>
        <!-- end sidebar-collapse -->
    </nav>
    <!-- end navbar side -->
    <!--  page-wrapper -->
    <div id="page-wrapper">

        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12">
                <h1 class="page-header">Página Administrativa </h1>
            </div>
            <br><br>
            <br><br>
            <br><br>
                @yield('content')

                        <!--End Page Header -->
        </div>


    </div>
    <!-- end page-wrapper -->

</div>
<!-- end wrapper -->


</body>

</html>
