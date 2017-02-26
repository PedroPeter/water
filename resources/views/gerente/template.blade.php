<!DOCTYPE html>
{{--@if(!\Illuminate\Support\Facades\Auth::check())
    {{ redirect()->route('paginainicial')}}
@endif--}}
<html>
<head>
    <meta charset="utf-8">
        <title>Area Administrativa - Aguas Zavala | Admin Dashboad</title>
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
                <a class="navbar-brand" href="index.blade.php">
                    <img src="{{asset('img/logo.png')}}" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger">3</span><i class="fa fa-envelope fa-3x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <!-- adicionar nome do user que enviou mensagem-->
                                    <strong><span class=" label label-danger">Pedro</span></strong>
                                    <span class="pull-right text-muted">
                                        <!-- adicionar variavel do dia que enviou mensagem -->
                                        <em>Ontem</em>
                                    </span>
                                </div>
                                <div>Aqui vem o assunto da mensagem</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-info">Peter</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Hoje</em>
                                    </span>
                                </div>
                                <div>Venha a minha casa</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-success">Pedro Peter</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Ontem</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <!-- adicionar link que direciona a novas mensagens-->
                            <a class="text-center" href="#">
                                <strong>Ler todas mensagens</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-messages -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-success">4</span>  <i class="fa fa-tasks fa-3x"></i>
                    </a>
                    <!-- dropdown para tarefas -->
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Leituras 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Emitir recibos</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Responder pedidos</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Emitir recibos</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-tasks -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-warning">5</span>  <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <!-- dropdown alerts-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>Novo usuario
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i>Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i>New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-alerts -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Profile</a>

                        <li class="divider"></li>
                        <li><a href="{{route('login.out')}}"><i class="fa fa-sign-out fa-fw"></i>Sair</a>
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
                            <div class="user-info">
                                @if(isset($username))
                                <div><strong>{{$username}}</strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="">
                        <a href="{{route('dashboard')}}"><i class="fa fa-dashboard fa-fw"></i>Administração</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Recursos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!--Preco da agua-->
                            <li>
                                <a href="{{route('agua.index')}}">Definir preco da agua</a>
                            </li>
                            <li>
                                <a href="{{route('produto.index')}}">Gerir Produtos</a>
                            </li>
                            <li>
                                <a href="{{route('contracto.crt')}}">Submeter contracto</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Fontenaria<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('fontenaria.create')}}">Registar</a>
                            </li>
                            <li>
                                <a href="{{route('fontenaria.index')}}">Mais operacoes</a>
                            </li>

                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Pedidos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.blade.php">Diversos</a>
                            </li>
                            <li>
                                <a href="{{route('user.index')}}">Novos clientes</a>
                            </li>
                            <li>
                                <a href="{{route('cliente.index')}}">Contractos</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="{{route('leitura.index')}}"><i class="fa fa-edit fa-fw"></i>Leituras</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Facturas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('factura.index')}}">Emitir</a>
                            </li>
                            <li>
                                <a href="{{route('facturas.pendentes')}}">Facturas pendentes</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>

                    <li>
                        <a href=""><i class="fa fa-flask fa-fw"></i>Reclamações </a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>SMS<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.blade.php">Enviar SMS</a>
                            </li>
                            <li>
                                <a href="buttons.blade.php">SMS recebidas</a>
                            </li>
                            <li>
                                <a href="buttons.blade.php">Pagamentos por SMS</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li >
                        <a href="{{route('estatisticas')}}"><i class="fa fa-files-o fa-fw"></i>Estatísticas <span ></span></a>
                        <!-- second-level-items -->
                    </li>
                    <li >
                        <a href="{{route('gerente.create')}}"><i class="fa fa-files-o fa-fw"></i>Gerir gerentes <span ></span></a>
                        <!-- second-level-items -->
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o fa-fw"></i>Mais<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('login.index')}}">Entrar como outro usuario</a>
                            </li>
                        </ul>
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
                @yield('content')

                <!--End Page Header -->
            </div>

            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->



</body>

</html>
