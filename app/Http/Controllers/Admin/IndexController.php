<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\toko;
use App\produk;
use App\member;
use App\order;
use App\orderToko;
use Auth;

class IndexController extends Controller
{

    public function index(){
    	$title = "Beranda ".Auth::guard('admin')->user()->nama."::Administrator OTW";
    	$toko = toko::all();
    	$produk = produk::where('hapus',0)->get();
    	$order = order::where('status','sukses')->get();
        $orderToko = orderToko::all();

    	return view('admin/beranda',compact('title','toko','produk','order','orderToko'));
    }

    public function show($id){
    	return redirect('tokoku/dashboard');
    }
}
