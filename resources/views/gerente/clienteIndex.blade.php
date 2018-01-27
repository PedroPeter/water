@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
                <a href="{{route('createuser')}}" target="_blank">
                    <button>Registar</button>
                </a>
            </div>
        @else
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Pesquise pelos clientes</h3> <br>

                        <div id="contact-us">
                            <div class="container">
                                <div class="row">
                                    <div class="heading text-center col-sm-16 col-sm-offset-2 wow fadeInUp"
                                         data-wow-duration="1000ms"
                                         data-wow-delay="600ms">
                                        <div class="col-sm-14">
                                            <div class="row  wow fadeInUp" data-wow-duration="1000ms"
                                                 data-wow-delay="300ms">
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <input type="text" id="pesquisa" name="pesquisa"
                                                               class="form-control"
                                                               placeholder="Introduza o nome do Cliente"
                                                               onkeydown="down()"
                                                               onkeyup="up()">
                                                    </div>
                                                    <div class="form-group" id="search"></div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3> Todos clientes <br>
                        </h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Celular Principal</th>
                                <th>Celular Secundário</th>
                                <th>Email</th>
                                <th colspan="3">Acções</th>
                            </tr>
                            </thead>
                            @foreach ($clientes as $cliente)
                                <tbody>
                                <tr>
                                    <td>{{ $cliente->user->nome}}</td>
                                    <td>{{ $cliente->user->apelido}}</td>
                                    <td>{{ $cliente->user->celular1}}</td>
                                    <td>{{ $cliente->user->celular2}}</td>
                                    <td>{{ $cliente->user->email}}</td>

                                    <td>
                                        {!! Form::open(array('route'=>['user.show',$cliente->id], 'method'=>'GET'))!!}
                                        <button class="btn btn-warning" type="submit">Alterar dados do cliente</button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(array('route'=>['user.destroy',$cliente->id], 'method'=>'DELETE'))!!}
                                        <button class="btn btn-danger" type="submit">Cancelar cotracto</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                </div>
            </div>
        @endif
    </div>
    <script>
        var timer;
        function up() {
            timer = setTimeout(function () {
                var keywords = $('#pesquisa').val();
                if (keywords.length > 0) {
                    $.post('{{route('cliente.search2')}}', {
                        keywords: keywords,
                        _token: '{{Session::token()}}'
                    }, function (markup) {
                        $('#search').html(markup);
                    });
                }

            }, 200);
        }
        function down() {
            clearTimeout(timer);
        }
    </script>

@stop
