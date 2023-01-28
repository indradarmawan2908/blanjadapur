<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produkGambar extends Model
{
    //
    protected $table = "otw_produk_gambar";
    protected $primaryKey = "id_gambar";
    protected $attributes = [
        'hapus' => 0,
    ];

    protected $fillable = [
        'id_produk',
        'gambar'
    ];
}
