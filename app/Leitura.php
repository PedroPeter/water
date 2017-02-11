<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    protected  $fillable=['consumo','numero_leitura','efectuado'];

    public function casa()
    {
        return $this->belongsTo('App\Casa');
    }
    public function agua()
    {
        return $this->belongsTo('App\Agua');
    }

    public function factura(){
        return $this->hasOne('App\Factura');

    }



}
