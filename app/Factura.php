<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected  $fillable=['l_anterior','l_actual','val_pagar','val_pago','val_pendente','pagamento_parcial','observacao','paga','num_multas','val_multas'];

    public function leitura(){
        return $this->belongsTo('App\Leitura');
    }
    public function recibo(){
        return $this->hasOne('\App\Recibo');
    }
}
