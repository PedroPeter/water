@if(count($search)>0)
    @foreach($search as $user)
        <b>{{$user['nome']}} {{$user['apelido']}} </b> <br>
    @endforeach

    <table class="table table-bordered table-responsive">
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
        <tbody>
        <td>{{ $user['nome']}}</td>
        <td>{{ $user['apelido']}}</td>
        <td>{{ $user['celular1']}}</td>
        <td>{{ $user['celular2']}}</td>
        <td>{{ $user['email']}}</td>

        <td>
            {!! Form::open(array('route'=>['user.show',$user['id']], 'method'=>'GET'))!!}
            <button class="btn btn-warning" type="submit">Alterar dados do user</button>
            {!! Form::close() !!}
        </td>
        <td>
            {!! Form::open(array('route'=>['user.destroy',$user['id']], 'method'=>'DELETE'))!!}
            <button class="btn btn-danger" type="submit">Cancelar cotracto</button>
            {!! Form::close() !!}
        </td>
        </tbody>
    </table>

@else
    <b>Esse cliente nao se encontra cadastrado do sistema</b>
@endif