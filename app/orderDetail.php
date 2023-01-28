<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    //
    protected $table = "otw_order_detail";
    protected $primaryKey = "id_detail";

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
    	'id_order',
    	'id_produk',
    	'jumlah',
    	'harga',
        'diskon'
    ];
}
