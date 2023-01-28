<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\toko;
use App\produk;
use App\order;
use Hash;
use Str;

class TokoController extends Controller
{
    private $folder = "toko/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Modul Toko :: Administrator";

        $toko = toko::where('hapus',0)->get();
        return view('admin/'.$this->folder.__FUNCTION__,compact('title','toko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Modul Toko Baru :: Administrator";

        return view('admin/'.$this->folder.__FUNCTION__,compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [ 
            'same'    => ':attribute dan :other harus sama.',
            'size'    => ':attribute memiliki panjang :size karakter.',
            'username.unique' => 'Username sudah digunakan oleh toko lain.',
            'password.confirmed' => 'Password dan konfirmasi password berbeda.'
        ];
        $request->validate([
            'email'=>'required',
            'namap'=>'required',
            'kontakp'=>'required',
            'kontak'=>'required',
            'alamat'=>'required',
            'username'=>'required|min:4|unique:otw_toko',
            'password'=>'required|min:8|confirmed',
        ],$messages);

        $toko = new toko([
            'email'=>$request->get('email'),
            'nm_pengelola'=>$request->get('namap'),
            'no_telp_pengelola'=>$request->get('kontakp'),
            'no_telp_toko'=>$request->get('kontak'),
            'alamat'=>$request->get('alamat'),
            'nama'=>$request->get('username'),
            'username'=>$request->get('username'),
            'password'=>Hash::make($request->get('password')),
            'password_text'=>$request->get('password'),
            'seo_toko'=>Str::slug($request->get('username')),
            'nm_toko'=>array_get($request, 'nama')
        ]);
        $toko->save();

        if($request->get('aktifkan')){
            $toko->status = 1;
            $toko->aktif = date('Y-m-d G:i:s');
            $toko->save();
        }

        return redirect('admin/toko')->with('success','Berhasil menamahkan toko baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = "Modul Detail Toko :: Administrator";

        $toko = toko::find($id);
        $produk = produk::where('id_toko',$id)->paginate(8);
        $order = order::where('id_toko',$id)->get();
        return view('admin/'.$this->folder.__FUNCTION__,compact('title','toko','produk','order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = "Modul Edit Toko :: Administrator";

        $toko = toko::find($id);
        return view('admin/'.$this->folder.__FUNCTION__,compact('title','toko'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'email'=>'required',
            'namap'=>'required',
            'kontakp'=>'required',
            'kontak'=>'required',
        ]);

        $toko = toko::find($id);
        $toko->email = $request->get('email');
        $toko->nm_pengelola = $request->get('namap');
        $toko->no_telp_pengelola = $request->get('kontakp');
        $toko->nm_toko = $request->get('nama');
        $toko->no_telp_toko = $request->get('kontak');
        $toko->save();

        return redirect('admin/toko')->with('success','Berhasil mengubah data toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $toko = toko::find($id);
        $toko->hapus = 1;
        $toko->save();

        return redirect('admin/toko')->with('success','Berhasil menghapus toko.');
    }

    public function perpanjang(){
        $title = "Modul Perpanjang Toko :: Administrator";

        $toko = toko::where('perpanjang',1)->paginate(15);
        return view('admin/'.$this->folder.__FUNCTION__,compact('title','toko'));
    }

    public function aktifkan($id)
    {
        //
        $toko = toko::find($id);
        $toko->perpanjang = 0;
        $toko->tgl_pengajuan = "0000-00-00 00:00:00";
        if($toko->status > 0){
            $toko->aktif = date('Y-m-d G:i:s', strtotime('+1 years',strtotime($toko->aktif)));
        }else{
            $toko->status = 1;
            $toko->aktif = date('Y-m-d G:i:s');
        }
        $toko->save();

        return redirect('admin/toko/'.$id)->with('success','Berhasil mengaktifkan toko.');
    }

    public function batalkan($id)
    {
        //
        $toko = toko::find($id);
        $toko->perpanjang = 0;
        $toko->tgl_pengajuan = "0000-00-00 00:00:00";
        $toko->save();

        return redirect('admin/perpanjang')->with('success','Berhasil membatalkan pengajuan.');
    }
}
