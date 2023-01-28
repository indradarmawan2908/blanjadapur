<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsToko extends Model
{
    //
    protected $table = "otw_news_toko";
    protected $primaryKey = "id_news";

    protected $fillable = [
    	'judul',
    	'isi',
    	'id_toko'
    ];

    protected $attributes = [
    	'tampil' => 0,
    	'hapus' => 0
    ];
}
