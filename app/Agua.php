<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agua extends Model
{

    protected $fillable=['preco_unitario','metros_cubicos_minimos'];

    public function casa()
    {
        return $this->belongsToMany('App\Casa','leituras')->withPivot('consumo');
    }


}
