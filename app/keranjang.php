<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    protected $table = "otw_keranjang";
    protected $primaryKey = "id_keranjang";

    protected $fillable = [
    	'id_member',
        'id_toko'
    ];

    protected $attributes = [
        'status' => 0
    ];

    public function getPitih($harga){
        return "Rp ".number_format($harga,0,',','.');
    }

}
