<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\KirimEmail;

use App\keranjang;
use App\keranjangDetail;
use App\order;
use App\toko;
use App\produk;
use App\orderDetail;

use RajaOngkir;

use Str;

class KeranjangController extends Controller
{
    //
    public function index(){
        $toko = toko::whereStatus(1)->first();

    	$id_member = Auth::user()->id_member;
    	$keranjang = keranjang::where('id_member',$id_member)->first();
    	if($keranjang==null){
    		$isiKeranjang = null;
    	}else{
    		$isiKeranjang = DB::table('otw_keranjang_detail')->select('*' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_keranjang',$keranjang->id_keranjang)->orderBy('otw_keranjang_detail.updated_at','desc')->get();
    	}

    	$title = "Keranjang belanjaKu";

    	return view('keranjang/index',compact('title','keranjang','isiKeranjang','toko'));
    }

    public function edit($id){
        $toko = toko::whereStatus(1)->first();

    	$title = "Keranjang belanjaKu";

    	$id_member = Auth::user()->id_member;
    	$keranjang = keranjang::where('id_member',$id_member)->first();

    	if($keranjang==null){
    		$produk = null;
    	}else{
	    	$produk = DB::table('otw_keranjang_detail')->select('*' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_detail',$id)->first();
	    }

    	return view('keranjang/ubah',compact('title','produk','keranjang','toko'));
    }

    public function store(Request $request){

    	$request->validate([
            'produk'=>'required',
            'jumlah'=>'required'
        ]);

        $produk = produk::find($request->get('produk'));

        if($produk->stok <= 0){
            return redirect()->route('produk.show',[$produk->id_produk,Str::slug($produk->nm_produk)])->with('error', 'Stok barang sudah habis!');
        }

    	$id_member = Auth::user()->id_member;

        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang == null){ // belum ada keranjang
        	$keranjang = new keranjang([
        		'id_member' => $id_member,
                'id_toko' => Auth::user()->id_toko
	        ]);
	        $keranjang->save();
        }

        $isiKeranjang = keranjangDetail::where('id_keranjang',$keranjang->id_keranjang)->where('id_produk',$request->get('produk'))->first();
        if($isiKeranjang == null){ //belum ada dalam keranjang 
        	$isiKeranjang = new keranjangDetail([
        		'id_keranjang' => $keranjang->id_keranjang,
	            'id_produk' => $request->get('produk'),
	            'jumlah' => $request->get('jumlah')
	        ]);
	        $isiKeranjang->save();
        }else{ //sudah ada dalam keranjang
        	return redirect()->route('keranjang.index')->with('error', 'Sudah ada di dalam keranjang!');    	
        }

        return redirect()->route('keranjang.index')->with('success', 'Berhasil ditambahkan!');

    }

    public function ubah(Request $request, $id){

    	$request->validate([
            'jumlah'=>'required'
        ]);

        $id_member = Auth::user()->id_member;

        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang==null){
        	return redirect()->route('keranjang.index')->with('error', 'Server tidak merespon!'); 
        }

    	$isiKeranjang = keranjangDetail::find($id);
    	$isiKeranjang->jumlah = $request->get('jumlah');
    	$isiKeranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Berhasil diubah!');

    }

    public function destroy($id){

    	$id_member = Auth::user()->id_member;

        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang==null){
        	return redirect('keranjang')->with('error', 'Server tidak merespon!'); 
        }
        $isiKeranjang = keranjangDetail::find($id);
        $isiKeranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus!');
    }

    public function antar(){
        $toko = toko::whereStatus(1)->first();

        $title = "Antar belanjaku";

        $id_member = Auth::user()->id_member;
        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang==null){
            return redirect()->route('keranjang.index')->with('error', 'Server tidak merespon!'); 
        }
        $isiKeranjang = DB::table('otw_keranjang_detail')->select('*')->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_keranjang',$keranjang->id_keranjang)->orderBy('otw_keranjang_detail.updated_at','desc')->get();

        $total = 0;
        foreach ($isiKeranjang as $value) {
            $jumlah = $value->jumlah * ($value->harga-$value->diskon);
            $total = $total + $jumlah;
        }

        $bank = DB::table('otw_bank')->select('*')->join('otw_bank_toko', 'otw_bank.id_bank', '=', 'otw_bank_toko.id_bank')->where('otw_bank_toko.id_toko', $toko->id_toko)->get();

        return view('keranjang/antar',compact('title','keranjang','isiKeranjang','toko', 'total', 'bank'));
    }

    public function bayar(Request $request){
        $metode = $request->get('metode');
        switch($metode){
            case 'cod':
            case 'jemput':
                return $this->postBayar($request);
            break;
            case 'kirim':
                return $this->postKirim($request);
            break;
            default:
                return 'Nothing';
            break;
        }
    }

    public function kirim(Request $request){
        $toko = toko::whereStatus(1)->first();

        $title = "Antar belanjaku";
        $id_member = Auth::user()->id_member;
        $keranjang = keranjang::where('id_member',$id_member)->first();

        $bank = DB::table('otw_bank')->select('*')->join('otw_bank_toko', 'otw_bank.id_bank', '=', 'otw_bank_toko.id_bank')->where('otw_bank_toko.id_toko', $toko->id_toko)->get();
        $isiKeranjang = DB::table('otw_keranjang_detail')->select('*')->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_keranjang',$keranjang->id_keranjang)->orderBy('otw_keranjang_detail.updated_at','desc')->get();

        $total = $berat = 0;
        foreach ($isiKeranjang as $value) {
            $jumlah = $value->jumlah * ($value->harga-$value->diskon);
            $total = $total + $jumlah;
            $berat = $berat + ($value->berat * $value->jumlah);
        }

        foreach(['jne','tiki','pos'] as $k => $v){
            $ongkir[$v] = RajaOngkir::Cost([
                'origin'        => $toko->id_kota, // id kota asal
                'originType'    => 'city',
                'destination'   => $request->get('kota'), // id kota tujuan
                'destinationType' => 'city',
                'weight'        => $berat, // berat satuan gram
                'courier'       => $v, // kode kurir pengantar ( jne / tiki / pos )
            ])->get();
        }

        $kota = RajaOngkir::Kota()->byId($request->get('kota'))->get();

        return view('keranjang/kirim',compact('title','toko','bank','keranjang','isiKeranjang','ongkir','total','berat','request','kota'));
    }

    public function postBayar(Request $request){

        $toko = toko::whereStatus(1)->first();

        if($request->metode == "cod"){
            $request->validate([
                'nohp'=>'required',
                'nama'=>'required',
                'alamat'=>'required',
                'metode'=>'required'
            ]);
        }else{
            $request->validate([
                'nohp'=>'required',
                'nama'=>'required',
            ]);
            $alamat = ' ';
        }

        $title = "Invoice Belanjaku";
        $id_member = Auth::user()->id_member;
        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang==null){
            return redirect()->route('keranjang.index')->with('error', 'Server tidak merespon!'); 
        }

        $order = new order([
            'id_member' => $id_member,
            'id_toko' => $toko->id_toko,
            'nohp' => $request->get('nohp'),
            'nama' => $request->get('nama'),
            'alamat' => $request->get('alamat') ? $request->get('alamat') : $alamat,
            'metode' => $request->get('metode'),
            'total' => 0
        ]);
        $order->save();

        $isiKeranjang = DB::table('otw_keranjang_detail')->select('*' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_keranjang',$keranjang->id_keranjang)->orderBy('otw_keranjang_detail.updated_at','desc')->get();

        $total = 0;

        foreach($isiKeranjang as $item){
            $orderDetail = new orderDetail([
                'id_order' => $order->id_order,
                'id_produk' => $item->id_produk,
                'harga' => $item->harga-$item->diskon,
                'jumlah' => $item->jumlah
            ]);
            $orderDetail->save();

            $total = $total + (($item->harga-$item->diskon) * $item->jumlah);
        }

        $order = order::find($order->id_order);
        $order->total = $total;
        if($request->get('metode') == "cod") $order->ongkir = $toko->ongkir; else $order->ongkir = 0;
        $order->save();

        DB::table('otw_keranjang')->where('id_keranjang', '=', $keranjang->id_keranjang)->delete();
        DB::table('otw_keranjang_detail')->where('id_keranjang', '=', $keranjang->id_keranjang)->delete();

        if($toko->email!=""){
            Mail::to($toko->email)->send(new KirimEmail($order));
        }

        return redirect()->route('order.show', ['id' => $order->id_order]);
    }

    public function postKirim(Request $request){

        $toko = toko::whereStatus(1)->first();

        $title = "Invoice Belanjaku";
        $id_member = Auth::user()->id_member;
        $keranjang = keranjang::where('id_member',$id_member)->first();

        if($keranjang==null){
            return redirect()->route('keranjang.index')->with('error', 'Server tidak merespon!'); 
        }

        $order = new order([
            'id_member' => $id_member,
            'id_toko' => $toko->id_toko,
            'nohp' => $request->get('nohp'),
            'nama' => $request->get('nama'),
            'alamat' => $request->get('alamat'),
            'metode' => $request->get('metode'),
            'kota' => $request->get('kota'),
            'ongkir' => $request->get('ongkir'),
            'paket' => $request->get('paket'),
            'kode_pos' => $request->get('kodepos'),
            'total' => 0
        ]);
        $order->save();

        $isiKeranjang = DB::table('otw_keranjang_detail')->select('*' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->where('otw_keranjang_detail.id_keranjang',$keranjang->id_keranjang)->orderBy('otw_keranjang_detail.updated_at','desc')->get();

        $total = 0;

        foreach($isiKeranjang as $item){
            $orderDetail = new orderDetail([
                'id_order' => $order->id_order,
                'id_produk' => $item->id_produk,
                'harga' => $item->harga-$item->diskon,
                'jumlah' => $item->jumlah
            ]);
            $orderDetail->save();

            $total = $total + (($item->harga-$item->diskon) * $item->jumlah);
        }

        $order = order::find($order->id_order);
        $order->total = $total;
        $order->save();

        DB::table('otw_keranjang')->where('id_keranjang', '=', $keranjang->id_keranjang)->delete();
        DB::table('otw_keranjang_detail')->where('id_keranjang', '=', $keranjang->id_keranjang)->delete();

        if($toko->email!=""){
            Mail::to($toko->email)->send(new KirimEmail($order));
        }

        return redirect()->route('order.show', ['id' => $order->id_order]);
    }
}
