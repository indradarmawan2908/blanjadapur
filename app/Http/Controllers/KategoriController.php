<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\kategoriProduk;
use App\toko;

class KategoriController extends Controller
{
    //
    public function show($id , $slug){
    	$toko = toko::whereStatus(1)->first();

        $kategori = kategoriProduk::where('id_toko',$toko->id_toko)->where('id_ktg_produk', $id)->first();
        $title = $kategori->nm_ktg_produk;
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus', 0)->where('id_ktg_produk', $id)->orderBy('created_at','desc')->paginate(20);

        return view('kategori/detail', compact('title','produk','kategori','toko'));
    }

    public function promo(){
    	$toko = toko::whereStatus(1)->first();
    	$title = "Promo";
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus', 0)->where('promo', 1)->paginate(20);

        return view('kategori.pdtt', compact('title','produk','toko'));
    }

    public function diskon(){
    	$toko = toko::whereStatus(1)->first();
        $title = "Diskon";
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus', 0)->where('diskon','>', 0)->orderBy('diskon','desc')->paginate(20);

        return view('kategori.pdtt', compact('title','produk','toko'));
    }

    public function terbaru(){
        $toko = toko::whereStatus(1)->first();
        $title = "Terbaru";
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus', 0)->orderBy('created_at','desc')->paginate(20);

        return view('kategori.pdtt', compact('title','produk','toko'));
    }

    public function terlaris(){
        $toko = toko::whereStatus(1)->first();
        $title = "Terlaris";
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus', 0)->where('terjual','>',0)->orderBy('terjual','desc')->paginate(20);

        return view('kategori.pdtt', compact('title','produk','toko'));
    }
}
