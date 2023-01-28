<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderToko extends Model
{
    //
    protected $table = "otw_order_toko";
    protected $primaryKey = "id_order";

    protected $fillable = [
    	'nama',
    	'email',
    	'nohp',
    	'jenis',
        'alamat',
        'kontak_toko',
        'username',
        'password'
    ];

    protected $attributes = [
        'dilihat' => 0
    ];
}
