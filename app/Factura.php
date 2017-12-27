<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected  $fillable=['l_anterior','l_actual','val_pagar','observacao','paga','num_multas'];

    public function leitura(){
        return $this->belongsTo('App\Leitura');
    }
    public function recibo(){
        return $this->hasOne('\App\Recibo');
    }
}
