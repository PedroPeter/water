<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fontenaria extends Model
{
    protected $fillable=['nome','bairro','rua_avenida','numero','max_clientes','descricao'];

    public function casas()
    {
        return $this->belongsToMany('App\Casa');
    }
}
