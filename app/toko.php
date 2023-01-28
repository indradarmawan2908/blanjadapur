<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class toko extends Authenticatable
{
    //
    use Notifiable;
    protected $table = "otw_toko";
    protected $primaryKey = "id_toko";

    protected $fillable = [
        'email',
    	'nm_pengelola',
    	'no_telp_pengelola',
    	'no_telp_toko',
        'alamat_toko',
        'username',
    	'password',
        'password_text',
        'seo_toko',
        'nm_toko'
    ];

    protected $attributes = [
    	'logo_toko'=>'',
    	'foto_toko'=>'',
    	'call_center'=>'',
    	'jadwal_buka'=>'',
    	'header'=>'',
    	'icon'=>'',
    	'nama_produk'=>'',
    	'harga_produk'=>'',
    	'tombol'=>'',
    	'aktif'=>null,
    	'blokir'=>0,
    	'hapus'=>0,
    	'perpanjang'=>0,
    	'tgl_pengajuan'=>null,
    	'remember_token'=>'',
        'ongkir'=>0,
        'status'=>0,
        'resetpass'=>0,
        'alamat_pengelola'=>'',
        'minOrder'=>null
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function username(){
        return 'username';
    }
}
