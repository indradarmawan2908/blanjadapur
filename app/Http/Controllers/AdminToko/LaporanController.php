<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\order;
use Auth;

class LaporanController extends Controller
{
    //
    private $folder = "laporan/";

    public function index(Request $request){
    	$title = "Laporan::Administrator";
        $toko = Auth::guard('toko')->id();

        $date1 = "";
        $date2 = "";

        $order = \DB::table('otw_order')->selectRaw('otw_order.*,sum(otw_produk.modal*otw_order_detail.jumlah) totalmodal')->join('otw_order_detail','otw_order_detail.id_order','=','otw_order.id_order')->join('otw_produk','otw_order_detail.id_produk','=','otw_produk.id_produk')->where('otw_order.id_toko',$toko)->where('otw_order.bayar',1)->groupBy('otw_order.id_order')->paginate(15);

        if($request->from && $request->until){
            $date1 = $request->from;
            $date2 = $request->until;
            $order = \DB::table('otw_order')->selectRaw('otw_order.*,sum(otw_produk.modal*otw_order_detail.jumlah) totalmodal')->join('otw_order_detail','otw_order_detail.id_order','=','otw_order.id_order')->join('otw_produk','otw_order_detail.id_produk','=','otw_produk.id_produk')->where('otw_order.id_toko',$toko)->where('otw_order.bayar',1)->whereBetween('otw_order.created_at', [$date1.' 00:00:00', $date2.' 23:59:59'])->groupBy('otw_order.id_order')->paginate(15);
        }

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order','date1','date2'));
    }

    public function perhari(Request $request){
    	$title = "Laporan perHari::Administrator";
    	$tanggal = date('Y-m-d');
        $toko = Auth::guard('toko')->id();

    	if($request->get('tanggal')){
    		$tanggal = $request->get('tanggal');
    		$title = "Laporan tanggal ".$tanggal."::Administrator";
    	}
    	// $order = order::where('id_toko', $toko)->where('bayar',1)->whereBetween('created_at', [$tanggal.' 00:00:00', $tanggal.' 23:59:59'])->get();

        $order = \DB::table('otw_order')->selectRaw('otw_order.*,date(otw_order.created_at) date,sum(otw_produk.modal*otw_order_detail.jumlah) totalmodal')->join('otw_order_detail','otw_order_detail.id_order','=','otw_order.id_order')->join('otw_produk','otw_order_detail.id_produk','=','otw_produk.id_produk')->where('otw_order.id_toko',$toko)->where('otw_order.bayar',1)->whereBetween('otw_order.created_at', [$tanggal.' 00:00:00', $tanggal.' 23:59:59'])->groupBy('otw_order.id_order')->get();


        $datatable = true;

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','tanggal','order','datatable'));
    }

    public function perbulan(Request $request){
    	$title = "Laporan perBulan::Administrator";
        $toko = Auth::guard('toko')->id();
    	$bulan = date('m');
    	$tahun = date('Y');
    	if($request->get('bulan') && $request->get('tahun')){
    		$bulan = $request->get('bulan');
    		$tahun = $request->get('tahun');
    		$title = "Laporan bulan ".$request->get('bulan')."::Administrator";
    	}

        //$order = order::select(\DB::raw('date(created_at) date,count(id_order) as jumlah, sum(total) as total'))->where('id_toko', $toko)->where('bayar',1)->whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->groupBy('date')->get();
    	//$orderDetail = order::where('id_toko', $toko)->where('bayar',1)->whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->get();
        $orderDetail = \DB::table('otw_order')->selectRaw('otw_order.*,date(otw_order.created_at) date,sum(otw_produk.modal*otw_order_detail.jumlah) totalmodal')->join('otw_order_detail','otw_order_detail.id_order','=','otw_order.id_order')->join('otw_produk','otw_order_detail.id_produk','=','otw_produk.id_produk')->where('otw_order.id_toko',$toko)->where('otw_order.bayar',1)->whereMonth('otw_order.created_at', $bulan)->whereYear('otw_order.created_at', $tahun)->groupBy('otw_order.id_order')->get();

        $datatable = true;

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','bulan','tahun','orderDetail','datatable'));
    }

    public function pertahun(Request $request){
    	$title = "Laporan perTahun::Administrator";
        $toko = Auth::guard('toko')->id();
    	$tahun = date('Y');
    	if($request->get('tahun')){
    		$tahun = $request->get('tahun');
    		$title = "Laporan tahun ".$request->get('tahun')."::Administrator";
    	}
        // $order = order::select(\DB::raw('month(created_at) month,count(id_order) as jumlah, sum(total) as total'))->where('id_toko', $toko)->where('bayar',1)->whereYear('created_at',$tahun)->groupBy('month')->get();
    	// $orderDetail = order::where('id_toko', $toko)->where('bayar',1)->whereYear('created_at',$tahun)->paginate(15);
        $orderDetail = \DB::table('otw_order')->selectRaw('otw_order.*,month(otw_order.created_at) month,sum(otw_produk.modal*otw_order_detail.jumlah) totalmodal')->join('otw_order_detail','otw_order_detail.id_order','=','otw_order.id_order')->join('otw_produk','otw_order_detail.id_produk','=','otw_produk.id_produk')->where('otw_order.id_toko',$toko)->where('otw_order.bayar',1)->whereYear('otw_order.created_at',$tahun)->groupBy('otw_order.id_order')->get();

        $datatable = true;

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','tahun','orderDetail','datatable'));
    }

    public function member(Request $request){
        $title = "Laporan Member::Administrator";
        $toko = Auth::guard('toko')->id();

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if($request->from && $request->until){
            $date1 = $request->from;
            $date2 = $request->until;
        }

        $member = \DB::table('otw_member')->select('*',\DB::raw('count(otw_order.id_order) jumlahOrder, otw_order.created_at lastOrder, sum(otw_order.total) totalOrder'))->leftJoin('otw_order','otw_order.id_member','=','otw_member.id_member')->where('otw_member.id_toko',$toko)->where('otw_order.bayar', 1)->whereBetween('otw_order.created_at', [$date1.' 00:00:00', $date2.' 23:59:59'])->orderBy('jumlahOrder','desc')->orderBy('lastOrder', 'desc')->groupBy('otw_member.id_member')->get();

        $datatable = true;

        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','date1','date2','member','datatable'));
    }

}
