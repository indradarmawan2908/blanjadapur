<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\kategoriProduk;
use App\produk;
use Image;
use Storage;
use Auth;

class KategoriController extends Controller
{
    //
    private $folder = "kategori/";

    public function index(){
    	$title = "Modul Kategori :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$kategori = kategoriProduk::where('id_toko',$toko)->where('hapus',0)->paginate(15);
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','kategori'));
    }

    public function show($id){
    	$title = "Modul Kategori :: Administrator";
        $toko = Auth::guard('toko')->id();
    	$kategori = kategoriProduk::find($id);
    	$produk = produk::where('id_toko',$toko)->where('id_ktg_produk',$id)->paginate(15);
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','kategori','produk'));
    }

    public function create(){
    	$title = "Modul Kategori :: Administrator";

    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title'));
    }

    public function edit($id){
    	$title = "Modul Kategori :: Administrator";
        $toko = Auth::guard('toko')->id();
    	$kategori = kategoriProduk::where('id_ktg_produk',$id)->where('id_toko',$toko)->first();
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','kategori'));
    }

    public function store(Request $request){
    	$request->validate([
            'nama'=>'required',
            'gambar'=>'required|image'
        ]);

        $uploadedFile = $request->file('gambar');

        $thumbnailImage = Image::make($uploadedFile);
        $thumbnailPath = 'img/kategori/';
        $thumbnailImage->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
        $thumbnailImage->save($thumbnailPath.$filename);
        
        // $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
        // Storage::disk('public')->putFileAs(
        //     'kategori',
        //     $uploadedFile,
        //     $filename
        // );

        $toko = Auth::guard('toko')->id();

        $kategori = new kategoriProduk([
            'gambar' => $filename,
            'nm_ktg_produk' => $request->get('nama'),
            'id_toko' => $toko
        ]);

        $kategori->save();

        return redirect('tokoku/kategori')->with('success','Berhasil ditambahkan');
    }

    public function update(Request $request, $id){
    	$request->validate([
            'nama'=>'required',
            'gambar'=>'image'
        ]);

        $kategori = kategoriProduk::find($id);
        $kategori->nm_ktg_produk = $request->get('nama');

        if($request->file('gambar')){
            
            @unlink('img/kategori/'.$kategoriProduk->gambar);

            $uploadedFile = $request->file('gambar');
            // $filename = str_replace(' ', '', time().$uploadedFile->getClientOriginalName());
            
            // Storage::disk('public')->putFileAs(
            //     'gambar',
            //     $uploadedFile,
            //     $filename
            // );
            $thumbnailImage = Image::make($uploadedFile);
	        $thumbnailPath = 'img/kategori/';
	        $thumbnailImage->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
	        $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
	        $thumbnailImage->save($thumbnailPath.$filename);

            $kategori->gambar = $filename;
        }

        $kategori->save();

        return redirect('tokoku/kategori')->with('success','Berhasil diubah');
    }

    public function destroy($id){
        $toko = Auth::guard('toko')->id();

    	$kategori = kategoriProduk::where('id_ktg_produk',$id)->where('id_toko',$toko)->first();
    	$kategori->hapus = 1;
    	$kategori->save();

    	//Storage::disk('public')->delete('gambar/'.$kategori->gambar);
    	//$kategori->delete();

    	return redirect('tokoku/kategori')->with('success','Berhasil dihapus');
    }

}
