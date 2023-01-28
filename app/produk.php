<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\kategoriProduk;

class produk extends Model
{
    protected $table = "otw_produk";
    protected $primaryKey = "id_produk";
    protected $attributes = [
        'hapus' => 0
    ];

    protected $fillable = [
        'id_ktg_produk',
    	'produk_seo',
        'nm_produk',
        'gambar',
        'satuan',
        'stok',
        'harga',
        'id_toko',
        'deskripsi',
        'terjual',
        'diskon',
        'modal',
        'promo',
        'berat'
    ];

    public function getPitih($harga){
        return "Rp ".number_format($harga,0,',','.');
    }

    public function getKategori($id){
        $kategori = kategoriProduk::where('id_ktg_produk',$id)->first();
        return $kategori;
    }
}
