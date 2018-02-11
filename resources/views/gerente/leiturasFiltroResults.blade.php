@if(count($data)>0)
    <h3> Leituras pendentes</h3>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <td>
                Nome
            </td>
            <td>
                Casa do Cliente
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <tr>
                <td>{{ $user['cliente_nome']}}</td>
                <td>
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
                            <td>{{ $user['casa_bairro']}}</td>
                            <td>{{ $user['casa_rua']}}</td>
                            <td>{{ $user['casa_numero']}}</td>
                            <td>{{ $user['casa_descricao']}}</td>
                            <td>
                                {!! Form::open(array('route'=>['leitura.show',$user['id']], 'method'=>'GET'))!!}
                                <button class="btn btn-success" type="submit">Efectuar Leitura</button>
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

@else
    <h3>{{$message}} </h3>
@endif