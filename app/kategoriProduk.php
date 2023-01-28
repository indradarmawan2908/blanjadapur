<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class kategoriProduk extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $table = "otw_ktg_produk";
    protected $primaryKey = "id_ktg_produk";
    protected $attributes = [
        'hapus' => 0
    ];
    protected $fillable = [
        'gambar',
        'nm_ktg_produk',
        'id_toko'
    ];

    public function produk($id){
        return DB::table('otw_produk')->where('id_ktg_produk',$id);
    }
}
