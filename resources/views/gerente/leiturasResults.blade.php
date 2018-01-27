@if(count($search)>0)
    @foreach($search as $user)
        <b>{{$user['cliente_nome']}} </b> <br>
    @endforeach

    <table class="table table-bordered table-responsive">
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
        <td>{{ $user['casa_bairro']}}</td>
        <td>{{ $user['casa_rua']}}</td>
        <td>{{ $user['casa_numero']}}</td>
        <td>{{ $user['casa_descricao']}}</td>
        <td>
            {!! Form::open(array('route'=>['leitura.show',$user['id']], 'method'=>'GET'))!!}
            <button class="btn btn-success" type="submit">Efectuar Leitura </button>
            {!! Form::close() !!}
        </td>
        </tbody>
    </table>

@else
    <b>Esse cliente nao se encontra cadastrado do sistema</b>
@endif