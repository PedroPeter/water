@if(count($search)>0)
    @foreach($search as $user)
        <b>{{$user['nome']}} {{$user['apelido']}} </b> <br>
    @endforeach

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
        @foreach($user['faturas'] as $factura)
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
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Pagar
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><button class="btn btn-secondary" type="submit">Valor completo </button></li>
                                <li>
                                    <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#myModal">Valor Parcial</button>

                                </li>
                            </ul>
                        </div>
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Introduza o valor parcial</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="number" name="valor_parcial">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="submit">Submeter</button>
                                    </div>
                                </div>

                            </div>
                        </div>
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
        @endforeach
        </tbody>
    </table>

@else
    <b>Esse cliente nao se encontra cadastrado do sistema</b>
@endif