<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\produk;
use App\member;
use App\order;
use Auth;
use DB;


class IndexController extends Controller
{
    //
    public function index(){
    	$toko = Auth::guard('toko')->id();
    	$title = "Dashboard::Administrator";
    	$produk = produk::where('id_toko',$toko)->where('hapus',0)->get();
    	$member = member::where('id_toko',$toko)->get();
    	$order = order::where('id_toko',$toko)->get();
    	$profil = Auth::guard('toko')->user();

        $bulan = date('m');
        $tahun = intval(date('Y'));

        $orderGrafik = collect();

        for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);$i++){
            $day = $i;
            if($i < 10){
                $day = "0".$i;
            }
            $orderGrafik->push(DB::table('otw_order')->select('id_order')->where('id_toko',$toko)->whereDate('created_at',$tahun.'-'.$bulan.'-'.$day)->count());
        }

        $orderGrafik->all();
        //$produkGrafik = array(0=>array('nm_produk'=>'Kutang','jumlah'=>2),array('nm_produk'=>'Kutang','jumlah'=>4),array('nm_produk'=>'Kutang','jumlah'=>2),array('nm_produk'=>'Kutang','jumlah'=>6),array('nm_produk'=>'Kutang','jumlah'=>10));

        $produkGrafik = DB::table('otw_order')->selectRaw('otw_produk.nm_produk produk, sum(otw_order_detail.jumlah) jumlah, sum(otw_order.total) total')->join('otw_order_detail','otw_order.id_order','=','otw_order_detail.id_order')->join('otw_produk','otw_produk.id_produk','=','otw_order_detail.id_produk')->where('otw_order.id_toko', $toko)->whereMonth('otw_order.created_at', $bulan)->whereYear('otw_order.created_at', $tahun)->groupBy('otw_produk.id_produk')->get();

    	return view('adminToko/dashboard',compact('title','produk','member','order','profil','orderGrafik','produkGrafik'));
    }
}
