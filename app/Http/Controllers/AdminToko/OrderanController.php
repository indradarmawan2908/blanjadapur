<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\order;
use App\orderDetail;
use App\keranjangDetail;
use App\produk;
use App\kembali;
use Auth;

class OrderanController extends Controller
{
    //
    private $folder = "order/";

    public function index(){
    	$title = "Modul Orderan :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$order = order::where('id_toko', $toko)->get();
        $datatable = true;
        
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order','datatable'));
    }

    public function status($status){
    	$title = "Modul Orderan ".ucfirst($status)." :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$order = order::where('id_toko', $toko)->where('status',$status)->get();
    	$stat = array('pending','proses','sukses','batal');
        $datatable = true;

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order','status','stat','datatable'));
    }

    public function show($id){
    	$title = "Orderan no $id :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$order = order::where('id_toko', $toko)->where('id_order',$id)->first();
        $kembali = [];
        foreach ($order->detail($order->id_order) as $key => $item) {
            $data = kembali::where('id_detail', $item->id_detail)->first();
            if($data)
                $kembali[$key] = $item;
        }
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order','kembali'));
    }

    public function update(Request $request, $id){
    	$request->validate([
            'status'=>'required'
        ]);

        $toko = Auth::guard('toko')->id();

        $order = order::where('id_toko', $toko)->where('id_order',$id)->first();
        $order->status = $request->get('status');
        if($request->get('status')=="sukses"){
            $order->bayar = 1;
            foreach($order->detail($id) as $item){
                $produk = produk::find($item->id_produk);
                if($produk->stok < $item->jumlah) return redirect()->back()->with('error', $item->nm_produk." stok tidak mencukupi.");
            }
            foreach($order->detail($id) as $item){
                $produk = produk::find($item->id_produk);
                $produk->stok = $produk->stok - $item->jumlah;
                $produk->terjual = $produk->terjual + $item->jumlah;
                $produk->save();
                $cekeranjang = keranjangDetail::where('id_produk', $produk->id_produk)->get();
                if($produk->stok == 0){
                    foreach ($cekeranjang as $value){
                        keranjangDetail::find($value['id_detail'])->delete();
                    }
                }else{
                    foreach ($cekeranjang as $value){
                        if($value['jumlah'] > $produk->stok){
                            keranjangDetail::find($value['id_detail'])->delete();
                        }
                    }
                }
            }
        }
        $order->save();
        
        return redirect('tokoku/orderan')->with('success','Berhasil diganti menjadi '.$request->get('status'));
    }

    public function destroy(Request $req, $id){

        $req->validate([
            'item' => 'required'
        ]);

        foreach($req->get('item') as $key => $value){
            $detail = orderDetail::find($value);
            $order = order::find($detail->id_order);
            $produk = produk::find($detail->id_produk);
            $order->total = $order->total - (($produk->harga - $produk->diskon) * $detail->jumlah);
            $order->save();
            $detail->delete();
        }

        return redirect()->back()->with('success','Berhasil menghapus item terpilih');
    }

    public function cetak($id){
        $toko = Auth::guard('toko')->id();

        $order = order::where('id_toko', $toko)->where('id_order',$id)->first();

        $title = "Cetak Orderan ".nopesan($toko, $order->id_order, $order->created_at);
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order'));
    }

    public function cetakbesar($id){
        $toko = Auth::guard('toko')->id();

        $order = order::where('id_toko', $toko)->where('id_order',$id)->first();

        $title = "Cetak Orderan ".nopesan($toko, $order->id_order, $order->created_at);
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order'));
    }

    public function kembali($id){
        $toko = Auth::guard('toko')->id();

        $order = order::where('id_toko', $toko)->where('id_order',$id)->first();

        $title = "Cetak Orderan ".nopesan($toko, $order->id_order, $order->created_at);
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','order'));
    }

    public function postKembali(Request $request, $id){
        $toko = Auth::guard('toko')->id();

        $order = order::where('id_toko', $toko)->where('id_order',$id)->first();

        foreach($order->detail($id) as $k => $v){
            $return = kembali::where('id_detail', $v->id_detail)->first();
            if($return){
                $return->delete();
            }
        }

        if($request->get('kembali')){
            foreach($request->get('kembali') as $k => $v){
                $ck = kembali::where('id_detail', $v)->first();
                if($ck){
                    
                }else{
                    $return = new kembali([
                        'id_detail' => $v
                    ]);
                    $return->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Berhasil dikembalikan');
    }
}
