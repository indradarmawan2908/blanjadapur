<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table = "otw_bank";
    protected $primaryKey = "id_bank";

    protected $fillable = [
    	'nama',
    	'gambar'
    ];
}
