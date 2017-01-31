<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{asset('plugins/bootstrap/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/pace/pace-theme-big-counter.css')}}" rel="stylesheet" />
   <link href="{{asset('css/style.css')}}" rel="stylesheet" />
      <link href="{{asset('css/main-style.css')}}" rel="stylesheet" />

    <!-- Core Scripts - Include with every page -->
    <script src="{{asset('plugins/jquery-1.10.2.js')}}"></script>
    <script src="{{asset('plugins/jquery-3.1.1.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/inputmask.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#nome").inputmask("Regex");
            $("#username").inputmask("Regex");
            $("#password").inputmask("Regex");
            $("#apelido").inputmask("Regex");
            $("#email").inputmask("{1,20}@{1,20}.{3}[.{2}]");
            $("#celular1").inputmask("999999999");
            $("#celular2").inputmask("999999999");

            $('form').submit(function(){
                if ($('#pass').getValue().length<5){
                    document.getElementById("pls").innerHTML = "<div class='alert alert-danger' role='alert'> <strong>Oh snap!</strong> <a href='#' class='alert-link'>Quantidade de caracteres para o password tem de ser maior que 5 </div>";
                }else if( $('#pass').getValue() != $('#cpass').getValue()){
                    document.getElementById("pls").innerHTML = "<div class='alert alert-danger' role='alert'> <strong>Oh snap!</strong> <a href='#' class='alert-link'>Os passwords introduzidos nao sao identicos </div>";
                }
            });
        });
    </script>

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="{{asset('img/logo.jpg')}}" alt=""/>
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title" id="pls">Por favor cadastre-se</h3>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body">
                        {!! Form::open(['role'=>'form','url'=>'admin'])!!}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="nome" name="nome" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="apelido" name="apelido" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Numero de celular principal" name="celular1" type="number" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Numero de celular secundario" name="celular2" type="number" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="User name" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" id="pass">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Repita o Password" name="password" type="password" value="" id="cpass">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block" id="in">Entrar <span class="glyphicon glyphicon-send"></span></button>
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
