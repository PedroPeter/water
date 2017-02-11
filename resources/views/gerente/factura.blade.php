<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Factura</title>
    {{ Html::style('plugins/bootstrap/bootstrap.css')}}

</head>
<body>
<div class="container">
    <div class="head" style="border: 1px solid #dddddd;">
        <table class="table">
            <tbody>
            <tr>
                <td colspan="2" rowspan="3"><img src="{{asset('img/logo.png')}}" style="width: 100px; height: 100px;" /></td>
                <td>Bairro Machava-Km 18 <br>
                Cel: 84 463 8344<br>
                MATOLA-MOÇAMBIQUE<br>
                </td>
                <td></td>
                <td></td>
                <td>
                    FACTURA <span style="color: red;">{{$factura->id}}</span> <br>
                    {{$time}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Nome do consumidor:</td>
                <td>{{$nome}}</td>
                <td>{{$apelido}}</td>
            </tr>
            </tbody>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>L-actual</th>
                    <th>L-anterior</th>
                    <th>Consumo do Mês</th>
                    <th>Valor por mestros Cúbicos </th>
                    <th>Valor a pagar </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$factura->l_actual}}</td>
                    <td>{{$factura->l_anterior}}</td>
                    <td>{{$factura->l_actual - $factura->l_anterior}}</td>
                    <td>{{$p_unit}}</td>
                    <td>{{($factura->l_actual - $factura->l_anterior)*$p_unit}}</td>
                </tr>
                <tr>
                    <td>Observação:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Outros encargos:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total a pagar:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr >
                    <td colspan="2" >Pagável até dia 10 de cada mês.<br>
                        A falta de pagamento de tarifas de água dentro do prazo por parte do cliente implicará corte imediato e pagamento de uma multa de 25% do valor em divida.<br>
                        Atendimento ao público de segunda a sábado das 7:00h às 17h:00h.
                    </td>
                    <td></td>
                    <td colspan="2"><hr width="400" align="left"> <br>(Assinatura e Carimbo)</td>
                    <td></td>
                </tr>
                </tbody>
            </table>

        </table>
    </div>
</div>
</body>
</html>