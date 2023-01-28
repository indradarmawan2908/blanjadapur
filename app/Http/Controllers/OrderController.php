<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\toko;
use App\order;
use App\orderDetail;
use RajaOngkir;

class OrderController extends Controller
{
    //

    public function index(){
        $toko = toko::whereStatus(1)->first();

    	$title = "Tampil Semua Order";
    	$id_member = Auth::user()->id_member;

    	$order = order::where('id_member',$id_member)->get();
    	
    	return view('order/index',compact('title','order','toko'));
    }

    public function show($id){
        $toko = toko::whereStatus(1)->first();

    	$title = "Tampil Order $id";
    	$order = order::find($id);

        $total = 0;
        $kota = RajaOngkir::Kota()->byId($order->kota)->get();

        foreach ($order->detail($id) as $value) {
            $jumlah = $value->jumlah * $value->harga;
            $total = $total + $jumlah;
        }

    	return view('order/show',compact('title','order','toko','total','kota'));
    }
}
