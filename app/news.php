<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    //
    protected $table = "otw_news";
    protected $primaryKey = "id_news";

    protected $fillable = [
    	'judul',
    	'isi'
    ];

    protected $attributes = [
    	'tampil' => 0,
    	'hapus' => 0
    ];
}
