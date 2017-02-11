<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agua extends Model
{

    protected $fillable = ['preco_unitario', 'metros_cubicos_minimos'];

    public function leituras()
    {
        return $this->hasMany('App\Leitura');
    }

}
