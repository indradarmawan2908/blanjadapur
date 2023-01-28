<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slide extends Model
{
    //
    protected $table = "otw_slide";
    protected $primaryKey = "id_slide";
    protected $attributes = [
        'hapus' => 0,
    ];

    protected $fillable = [
        'id_toko',
        'gambar'
    ];
}
