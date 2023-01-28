<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
	use Notifiable;
    //
    protected $table = "otw_admin";
    protected $primaryKey = "username";

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'password_text', 'remember_token'
    ];

    protected $attributes = [
        'nama' =>'',
        'email' =>'',
        'blokir' => 0,
        'remember_token' => '',
    ];

    public function username()
    {
        return 'username';
    }
}
