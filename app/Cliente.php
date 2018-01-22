<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model

{
    protected $fillable=['dataNascimento','contracto','doc'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function casa()
    {
        return $this->hasOne('App\Casa');
    }

}
