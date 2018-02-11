@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="row">
                <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li>
                            <br>
                        </ul>
                    </div>
                    <br>
                </div>
            </div>
        @else
            <div id="contact-us">
                <div class="container">
                    <div class="row">
                        <div class="heading text-center col-sm-16 col-sm-offset-2 wow fadeInUp"
                             data-wow-duration="1000ms"
                             data-wow-delay="600ms">
                            <div class="col-sm-10">
                                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input type="text" id="pesquisa" name="pesquisa" class="form-control"
                                                   placeholder="Introduza o nome do Cliente" onkeydown="down()"
                                                   onkeyup="up()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding-left: 100px; align-content: center;">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <td>Pesquisa pelo Bairro</td>
                            <td>Pesquisa pela Rua/Avenida</td>
                            <td></td>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <td><select id="bairro" onchange="filtro()">
                                    @foreach($bairros as $bairro)
                                        <option>
                                            {{$bairro}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="rua_avenida" onchange="filtro()">
                                    @foreach($rua_avenidas as $rua_avenida)
                                        <option>
                                            {{$rua_avenida}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button onclick="sem_filtro()" class="btn-success"> Ver todas Leituras</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <div class="form-group" id="search"></div>
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
                    $.post('{{route('leitura.search')}}', {
                        keywords: keywords,
                        _token: '{{Session::token()}}'
                    }, function (markup) {
                        $('#search').html(markup);
                    });
                }

            }, 200);
        }
        function filtro() {
            timer = setTimeout(function () {
                var obj = document.getElementById("bairro").value;
                var filtro = 'bairro';
                if (obj.value == '') {
                    var obj = document.getElementById("rua_avenida").value;
                    var filtro = 'rua_avenida';
                }
                var keywords = obj;
                filtro = filtro;
                if (keywords.length > 0) {
                    $.post('{{route('leitura.filtrar')}}', {
                        keywords: keywords,
                        filtro: filtro,
                        _token: '{{Session::token()}}'
                    }, function (markup) {
                        $('#search').html(markup);
                    });
                }

            }, 200);
        }
        function sem_filtro() {
            timer = setTimeout(function () {
                    $.post('{{route('leitura.sem_filtro')}}', {
                        _token: '{{Session::token()}}'
                    }, function (markup) {
                        $('#search').html(markup);
                    });

            }, 200);}

            function down() {
            clearTimeout(timer);
        }
    </script>
@stop