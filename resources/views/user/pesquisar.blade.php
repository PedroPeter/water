@extends('user.template')
@section('content')
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-16 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms"
                     data-wow-delay="600ms">
                    <div class="col-sm-14">
                        <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="number" id="pesquisa" name="pesquisa" class="form-control"
                                           placeholder="Introduza o numero da fatura" onkeydown="down()"
                                           onkeyup="up()">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" id="pesquisa1" name="pesquisa" class="form-control"
                                           placeholder="Introduza o data" onkeydown="down()"
                                           onkeyup="up1()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="search"></div>
                </div>
            </div>
        </div>


    <script>
        var timer;
        function up() {
            timer = setTimeout(function () {
                var keywords = $('#pesquisa').val();
                if (keywords.length > 0) {
                    $.post('{{route('cliente.pesquisar.numerofactura')}}', {
                        keywords: keywords,
                        _token: '{{Session::token()}}'
                    }, function (markup) {
                        $('#search').html(markup);
                    });
                }

            }, 200);
        }
        function up1() {
            timer = setTimeout(function () {
                var keywords = $('#pesquisa1').val();
                if (keywords.length > 0) {
                    $.post('{{route('cliente.pesquisar.data')}}', {
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
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#pesquisa1").inputmask("9999-99-99");
        });
    </script>
@stop