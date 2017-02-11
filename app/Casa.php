<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    protected $fillable = ['bairro', 'numero_casa', 'rua_avenida', 'descricao'];


    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    public function leituras()
    {
        return $this->hasMany('App\Leitura');
    }
}