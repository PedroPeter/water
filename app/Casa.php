<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    protected  $fillable=['bairo','casa_numero','rua_avenida','descricao'];







public function agua()
{
    return $this->belongsToMany('App\Agua','leituras')->withPivot('consumo');
}

public function cliente_leitura()
{
    return $this->belongsToMany('App\Cliente','cliente_leituras')->withPivot('consumo', 'imagem');
}

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}