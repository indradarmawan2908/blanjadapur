<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\produkGambar;
use App\toko;

class ProdukController extends Controller
{
    //
    public function show($id, $slug){
    	$toko = toko::whereStatus(1)->first();

        $produk = produk::where('id_toko', $toko->id_toko)->where('id_produk', $id)->first();
        $title = $produk->nm_produk;

        $gambar = produkGambar::where('id_produk', $id)->get();

        return view('produk/detail', compact('title','produk','toko','gambar'));
    }

    public function store(Request $request){
    	
    }
}
