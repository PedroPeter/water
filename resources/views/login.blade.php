<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aguas Guessane</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{asset('plugins/bootstrap/bootstrap.css')}}" rel="stylesheet"/>
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/pace/pace-theme-big-counter.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/main-style.css')}}" rel="stylesheet"/>
</head>

<body class="body-Login-back">

<div class="container">

    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($message))
            <div class="alert-info" style="font-size: 72px; text-align: center;">
                {{$message}}
            </div>
        @endif

        <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
            <img src="{{asset('img/user.jpg')}}" alt=""/>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">

                    {!! Form::open(['id'=>'contact_form','class'=>'well form-horizontal','route'=>'login.check','role'=>'form'])!!}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nome do usuario" name="username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" >
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <div class="form-group">
                            <button class="btn btn-info" type="submit">Login</button>
                        </div>

                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Core Scripts - Include with every page -->
<script src="{{assets('plugins/jquery-1.10.2.js')}}"></script>
<script src="{{assets('plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/metisMenu/jquery.metisMenu.js')}}"></script>

</body>

</html>
