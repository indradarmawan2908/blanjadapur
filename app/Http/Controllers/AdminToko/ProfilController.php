<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Storage;
use Str;
use App\toko;
use Image;

class ProfilController extends Controller
{

    private $folder = "profil/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Profil :: Administrator";
        $profil = Auth::guard('toko')->user();
        $hari = [0=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','profil','hari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $toko = Auth::guard('toko')->id();

        switch ($id) {
            case 0: // Tema toko
                $request->validate([
                    'header'=>'required',
                    'icon'=>'required',
                    'nama'=>'required',
                    'harga'=>'required',
                    'tombol'=>'required'
                ]);

                $toko = toko::find($toko);
                $toko->header = $request->get('header');
                $toko->icon = $request->get('icon');
                $toko->nama_produk = $request->get('nama');
                $toko->harga_produk = $request->get('harga');
                $toko->tombol = $request->get('tombol');
                $toko->save();

            break;
            case 1: //Perpanjangan
                $toko = toko::find($toko);

                $toko->perpanjang = 1;
                $toko->tgl_pengajuan = date('Y-m-d H:i:s');
                $toko->save();

                return redirect('tokoku/profil')->with('success','Perpanjangan berhasil diajukan');
            break;
            case 2: //Profil Toko
                $request->validate([
                    'logo'=>'nullable|image',
                    'kontak'=>'nullable|string',
                    'alamat'=>'nullable|string',
                    'callcenter'=>'nullable|string',
                    'ongkir'=>'nullable|numeric'
                ]);

                $toko = toko::find($toko);

                if($request->file('logo')){
                    if(file_exists('img/toko/'.$toko->logo_toko)){
                        @unlink('img/toko/'.$toko->logo_toko);
                    }
                    $uploadedFile = $request->file('logo');

                    $thumbnailImage = Image::make($uploadedFile);
                    $thumbnailPath = 'img/toko/';
                    $thumbnailImage->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $filename = str_replace(' ','',$toko->id_toko.'-'.Str::slug($toko->nm_toko).'.'.$uploadedFile->getClientOriginalExtension());
                    $thumbnailImage->save($thumbnailPath.$filename);
                    $toko->logo_toko = $filename;
                }

                $toko->no_telp_toko = $request->get('kontak');
                $toko->alamat_toko = $request->get('alamat');
                $toko->call_center = $request->get('callcenter');
                $toko->ongkir = $request->get('ongkir');
                $toko->save();
            break;
            case 3: //Hari dan Jam Buka

                $jadwal = collect();

                for($i=0;$i<=6;$i++){
                    if($request->get('buka'.$i)){
                        $hari = collect(['buka'=>$request->get('jam'.$i.'Buka'),'tutup'=>$request->get('jam'.$i.'Tutup')]);
                        $jadwal->prepend($hari, $i);
                    }
                }

                $jadwal->all();

                $jadwal = serialize($jadwal);
                $toko = toko::find($toko);
                $toko->jadwal_buka = $jadwal;
                $toko->save();

                return redirect('tokoku/profil')->with('success','Jadwal buka berhasil diupdate');
            break;
            case 4: //Profil pengelola
                $request->validate([
                    'kontak'=>'nullable|string',
                    'alamat'=>'nullable|string',
                    'kota'=>'nullable|numeric'
                ]);

                $toko = toko::find($toko);
                $toko->no_telp_pengelola = $request->get('kontak');
                $toko->alamat_pengelola = $request->get('alamat');
                if($request->get('kota')){
                    $toko->id_kota = $request->get('kota');
                }
                $toko->save();
            break;
            case 5: //Profil pengelola
                $request->validate([
                    'minOrder'=>'nullable|numeric',
                ]);

                $toko = toko::find($toko);
                $toko->minOrder = $request->get('minOrder');
                $toko->save();
            break;
        }

        return redirect('tokoku/profil')->with('success','Profil berhasil diupdate');
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
    }
}
