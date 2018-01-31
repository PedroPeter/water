<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Factura</title>
    {{ Html::style('plugins/bootstrap/bootstrap.css')}}

</head>
<body>
<div class="container">
    <div class="head" style="border: 1px solid #dddddd;">
        <table class="table table-responsive">
            <tbody>
            <tr>
                <td colspan="2" rowspan="3"><img src="{{asset('img/logo.png')}}" style="width: 100px; height: 100px;" /></td>
                <td>Bairro Machava-Km 18 <br>
                Cel: 84 463 8344<br>
                MATOLA-MOÇAMBIQUE<br>
                </td>
                <td></td>
                <td>
                    Recibo <span style="color: red;">{{$numero}}</span> <br>
                </td>
                <td>
                    <br>
                    Valor :{{number_format($total,2)}} MT
                </td>

            </tr>

            </tbody>
            <tr>
                <td colspan="2">Recebemos do (s) Exmo.(s) Sr.(s)</td>
                <td> {{$nome}}</td>
                <td> {{$apelido}}</td>
                <td></td>
            </tr>
                <tr>
                    <td>Referente ao pagamento da factura número:</td>
                    <td> {{$factura}} </td>
                    <td colspan="3">de que passamos o presente recibo.</td>
                </tr>
            <tr>
                    <td>Observacoes feitas:</td>
                    <td colspan="4"> {{$obs}} </td>
                </tr>
                <tr >
                    <td colspan="4">(Assinatura e Carimbo) <br> <br> <hr width="400" align="left"></td>
                    <td>Data: {{$data}}</td>
                </tr>
        </table>
    </div>
</div>
</body>
</html>