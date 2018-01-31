@if(count($search)>0)
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Numero da factura</th>
            <th>Valor a pagar</th>
            <th>Paga?</th>
            <th>Accao</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$factura->id}}
                </td>
                <td>
                    {{$factura->val_pagar}}
                </td>
                <td>
                    @if($factura->paga)
                    Sim
                    @else
                        {!! Form::open(array('route'=>['recibo.imprimir',$factura->id], 'method'=>'POST'))!!}
                        <button class="btn btn-success" type="submit">Nao (Clique aqui para efectuar o pagamento)</button>
                        {!! Form::close() !!}
                    @endif
                </td>
                <td>
                    {!! Form::open(array('route'=>['invoice.imprimir',$factura->id], 'method'=>'POST'))!!}
                    <button class="btn btn-success" type="submit">Imprimir</button>
                    {!! Form::close() !!}
                    <br>
                </td>

            </tr>
        </tbody>
    </table>

@else
    <b>Esse cliente nao se encontra cadastrado do sistema</b>
@endif