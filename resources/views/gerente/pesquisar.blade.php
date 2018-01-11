@extends('gerente.template')
@section('content')
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


    <script>
        var timer;
        function up() {
            timer = setTimeout(function () {
                var keywords = $('#pesquisa').val();
                if (keywords.length > 0) {
                    $.post('{{route('cliente.search')}}', {
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