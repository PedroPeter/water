<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    //

    public function factura(){
        return $this->belongsTo('\App\Factura');
    }
}
