<!DOCTYPE html>
<html>

<head>
    <title>Águas XYZ</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- modernizr enables HTML5 elements and feature detects -->
    <script type="text/javascript" src="{{asset('js/modernizr-1.5.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/template.css')}}">


</head>

<body class="container">
<div id="main" >
    <header class="navbar-static-top">
        <div id="strapline">
            <div id="welcome_slogan">
                <h3>Bem-vindo a Águas <span>XYZ</span></h3>
            </div><!--close welcome_slogan-->
        </div><!--close strapline-->
        <nav>
            <div id="menubar">
                <ul id="nav">
                    <li class="current"><a href="{{route('paginainicial')}}">Pagina Inicial</a></li>
                    <li><a href="{{route('contracto')}}">Como Aderir nosso Servicos</a></li>
                    <li><a href="{{route('createuser')}}">Tornar-se Cliente</a></li>
                    <li><a href="{{route('login.index')}}">Log-in</a></li>
                </ul>
            </div><!--close menubar-->
        </nav>
    </header>

    <div id="site_content">
        <div class="sidebar_container">
            <div class="sidebar">
                <div class="sidebar_item">
                    <h2>Esse Website foi feito pensando em ti.</h2>
                    <br>

                    <p>Bem-vindo ao nosso website. Por favor aprecie, qualquer feedback é apreciado.</p>
                </div><!--close sidebar_item-->
            </div><!--close sidebar-->
            <div class="sidebar">
                <div class="sidebar_item">
                    <h2>Anúncio 1 </h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque cursus tempor enim.</p>
                </div><!--close sidebar_item-->
            </div><!--close sidebar-->
            <div class="sidebar">
                <div class="sidebar_item">
                    <h2>Anúncio 2</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque cursus tempor enim.</p>
                </div><!--close sidebar_item-->
            </div><!--close sidebar-->
            <div class="sidebar">
                <div class="sidebar_item">
                    <h2>Contacto</h2>

                    <p>Celular: 84 463 8520</p>

                    <p>Email: <a href="mailto:pedropeterdev@gmail.com">PedroPeterDev@gmail.com</a></p>
                </div><!--close sidebar_item-->
            </div><!--close sidebar-->
        </div><!--close sidebar_container-->

        <div class="slideshow">
            <ul class="slideshow">
                <li class="show i"><img width="680" height="250" src="{{asset('images/home_1.jpg')}}"
                                        alt="O melhor da agua para si."/></li>
                <li><img width="680" height="250" src="{{asset('images/home_2.jpg')}}"
                         alt="Preocupamo-nos em lhe trazer a melhor água e melhores serviços."/></li>
            </ul>
        </div>
        @yield('content')

    </div><!--close site_content-->

    <footer>
        <a href="{{route('paginainicial')}}">Pagina Inicial</a> | <a href="{{route('createuser')}}">Tor-se nosso
            Cliente</a> | <a href="{{route('contracto')}}">Nosso Contracto</a> |<br/>
        <a href="mailto:pedropeterdev@gmail.com">CopyRight PedroPeter </a><br/>
    </footer>

</div><!--close main-->

<!-- javascript at the bottom for fast page loading -->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/image_slide.js')}}"></script>

@yield('hMais')
</body>
</html>
