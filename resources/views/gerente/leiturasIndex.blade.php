@extends('gerente.template')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
        <div class="row">
            <div class="col-sm-12" style="background-color:darkgray;">
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $message }}</li> <br>
                        </ul>
                    </div>
                    <br>
            </div>
        </div>
        @else
            <div id="contact-us">
                <div class="container">
                    <div class="row">
                        <div class="heading text-center col-sm-16 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms"
                             data-wow-delay="600ms">
                            <div class="col-sm-14">
                                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input type="text" id="pesquisa" name="pesquisa" class="form-control"
                                                   placeholder="Introduza o nome do Cliente" onkeydown="down()"
                                                   onkeyup="up()">
                                        </div>
                                        <div class="form-group" id="search">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="background-color:lightgray;">
                    <h3> Leituras pendentes</h3>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Casa do Cliente</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td>
                                {{$dt['cliente_nome']}}
                            </td>
                            <td >
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>
                                            Bairro
                                        </td>
                                        <td>
                                            Rua/Avenida
                                        </td>
                                        <td>
                                            Casa numero
                                        </td>
                                        <td>
                                            Descricao
                                        </td>
                                        <td>
                                            Operacao
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $dt['casa_bairro']}}</td>
                                            <td>{{ $dt['casa_rua']}}</td>
                                            <td>{{ $dt['casa_numero']}}</td>
                                            <td>{{ $dt['casa_descricao']}}</td>
                                            <td>
                                                {!! Form::open(array('route'=>['leitura.show',$dt['id']], 'method'=>'GET'))!!}
                                                <button class="btn btn-success" type="submit">Efectuar Leitura </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
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
                    $.post('{{route('leitura.search')}}', {
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