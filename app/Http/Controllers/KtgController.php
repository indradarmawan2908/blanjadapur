<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategoriProduk;
use App\produk;
use App\toko;
use App\slide;

class KtgController extends Controller
{
    public function index(){
    	$toko = toko::whereStatus(1)->first();
        $title = $toko->nm_toko;

        $ktg_produk = kategoriProduk::where('id_toko',$toko->id_toko)->where('hapus',0)->get();
        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus',0)->get();

        $slide = slide::where('id_toko',$toko->id_toko)->where('hapus',0)->get();

        return view('ktg/index', compact('title','toko','ktg_produk','produk','slide'));
    }

    public function cari(Request $request){
    	$toko = toko::whereStatus(1)->first();
        $title = 'Hasil pencarian kata kunci "'.$request->cari.'"';

        $produk = produk::where('id_toko',$toko->id_toko)->where('hapus',0)->where('nm_produk','LIKE','%'.$request->cari.'%')->get();
        if($request->cari==""){
        	$produk = produk::where('id_toko',$toko->id_toko)->where('hapus',0)->where('nm_produk','=',$request->cari)->get();
        }

        return view('cari', compact('title','toko','produk'));
    }
}
