<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    protected $table = "otw_satuan";
    protected $primaryKey = "id_satuan";

    protected $fillable = [
        'satuan',
        'singkatan',
        'aktif'
    ];
}
