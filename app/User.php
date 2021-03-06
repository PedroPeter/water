<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome','apelido', 'email', 'password','celular1','celular2','username','password','cargo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cliente()
    {
        return $this->hasOne('App\Cliente');
    }

    /**
     * Get the user for the sms.
     */
    public function sms()
    {
        return $this->hasMany('App\Sms');
    }

}
