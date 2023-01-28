<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class member extends Authenticatable
{
    use Notifiable;

    protected $table = "otw_member";
    protected $primaryKey = "id_member";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nohp','nama', 'password','id_toko'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $attributes = [
        'alamat' => '',
        'remember_token' => ''
    ];
}
