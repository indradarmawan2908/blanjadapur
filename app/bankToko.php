<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bankToko extends Model
{
    protected $table = "otw_bank_toko";
    protected $primaryKey = "id_bank_toko";

    protected $fillable = [
    	'id_bank',
    	'id_toko',
    	'atas_nama',
    	'norek'
    ];
}
