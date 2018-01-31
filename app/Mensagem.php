<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable=['assunto','mensagem','resposta'];


    public function clinete(){
        return $this->belongsTo('App\Cliente');
    }
}
