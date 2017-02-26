<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable=['from','to','assunto','message','type'];
    protected  $table='smss';

    /**
     * Get the users for the sms.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
