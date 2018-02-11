@extends('gerente.template')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(isset($message))
            <div class="alert alert-danger">
                <h3>{{$message}}</h3>
                </a>
            </div>
        @else
            <div class="container">
                <div class="column is-8 is-offset-2">
                    <div class="panel">
                        <div class="panel-heading">
                            Lista dos Clientes
                        </div>
                        @foreach($users as $friend)
                            <a href="{{ route('chat.show', $friend->id) }}" class="panel-block" style="justify-content: space-between;">
                                <div>{{ $friend->nome }}</div>
                                <onlineuser v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></onlineuser>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
