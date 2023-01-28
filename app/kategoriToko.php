<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kategoriToko extends Model
{
    //
    protected $table = "otw_ktg_toko";
    protected $primaryKey = "id_ktg_toko";

    protected $fillable = [
    	'nm_ktg_produk'
    ];

    protected $attributes = [
        'hapus' => 0
    ];

    public function toko($id){
    	return DB::table('otw_ktg_toko')->where('id_ktg_toko',$id)->get();
    }
}
