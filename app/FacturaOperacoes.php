<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaOperacoes extends Model
{
    protected $fillable = ["percentagem","ultimo_dia"];
    protected $table = 'facturaOperacoes';
}
