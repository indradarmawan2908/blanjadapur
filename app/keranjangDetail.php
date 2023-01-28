<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjangDetail extends Model
{
    protected $table = "otw_keranjang_detail";
    protected $primaryKey = "id_detail";

    protected $fillable = [
    	'id_keranjang',
    	'id_produk',
    	'jumlah'
    ];
}
