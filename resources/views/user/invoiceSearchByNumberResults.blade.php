@if(isset($factura)>0)
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Numero da factura</th>
            <th>Data</th>
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
                    {{$factura->created_at}}
                </td>
                <td>
                    {{$factura->val_pagar}}
                </td>
                <td>
                    @if($factura->paga)
                    Sim
                    @else
                        Nao
                       {{-- {!! Form::open(array('route'=>['recibo.imprimir',$factura->id], 'method'=>'POST'))!!}
                        <button class="btn btn-success" type="submit">Nao (Clique aqui para efectuar o pagamento)</button>
                        {!! Form::close() !!}--}}
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
    <b>Nao possui uma factura com esse numero no sistema</b>
@endif