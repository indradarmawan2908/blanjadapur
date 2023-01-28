<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class order extends Model
{
    //
    protected $table = "otw_order";
    protected $primaryKey = "id_order";

    protected $fillable = [
    	'id_member',
    	'nama',
    	'nohp',
    	'alamat',
    	'metode',
    	'total',
        'id_toko',
        'ongkir',
        'paket',
        'kota',
        'kode_pos'
    ];

    protected $attributes = [
        'status' => 'pending',
        'bayar' => 0
    ];

    public function getPitih($harga){
        return "Rp ".number_format($harga,0,',','.');
    }

    public function detail($id){
        return DB::table('otw_order_detail')->select('*' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_order_detail.id_produk')->where('otw_order_detail.id_order', $id)->get();
    }

    public function totalOrder($nohp){
        return DB::table('otw_order')->where('nohp',$nohp)->count();
    }

    public function jumlahItem($id){
        return DB::table('otw_order_detail')->where('id_order',$id)->get();
    }
}
