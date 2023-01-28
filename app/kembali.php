<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kembali extends Model
{
    protected $table = "otw_kembali";
    protected $primaryKey = "id_kembali";

    protected $fillable = ['id_detail'];

}
