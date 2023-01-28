<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\kategoriProduk;
use App\produk;
use App\produkGambar;
use App\satuan;
use Image;
use Storage;
use Str;
use Auth;

class ProdukController extends Controller
{
    //
    private $folder = "produk/";

    public function index(){
    	$title = "Modul Produk :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$produk = produk::where('id_toko',$toko)->where('hapus',0)->orderBy('created_at','desc')->get();
        $datatable = true;
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','produk','datatable'));
    }

    public function stok(Request $request, $id){
    	$title = "Modul Produk :: Administrator";

        $toko = Auth::guard('toko')->id();

        $produk = produk::where('id_toko',$toko)->where('id_produk',$id)->first();
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','produk'));
    }

    public function stokTambah(Request $request, $id){
        $request->validate([
            'jumlah'=>'required|numeric'
        ]);

        $produk = produk::find($id);
        $produk->stok = $produk->stok + $request->get('jumlah');
        $produk->save();

        return redirect('tokoku/produk')->with('success','Stok berhasil ditambahkan');
    }

    public function gambar(Request $request, $id){
        $title = "Modul Produk :: Administrator";

        $toko = Auth::guard('toko')->id();

        $produk = produk::where('id_toko',$toko)->where('id_produk',$id)->first();
        $gambar = produkGambar::where('id_produk',$id)->where('hapus',0)->get();
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','produk','gambar'));
    }

    public function gambarTambah(Request $request, $id){
        $request->validate([
            'gambar'=>'required'
        ]);

        $n = 1;

        if($request->hasfile('gambar')){
            foreach ($request->file('gambar') as $item) {
                $thumbnailImage = Image::make($item);
                $thumbnailPath = 'img/produk/';
                $thumbnailImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = str_replace(' ','',$n.time().$item->getClientOriginalName());
                $thumbnailImage->save($thumbnailPath.$filename);
                $n++;

                $gambar = new produkGambar([
                    'id_produk'=> $id,
                    'gambar'=>$filename
                ]);

                $gambar->save();
            }

            return redirect('tokoku/produk/gambar/'.$id)->with('success','Gambar berhasil ditambahkan');
        }else{
            return redirect('tokoku/produk/gambar/'.$id)->with('error','Tidak ada file gambar yang diupload');
        }
    }

    public function gambarHapus($id){
        $toko = Auth::guard('toko')->id();

        $gambar = produkGambar::where('id_gambar',$id)->first();
        $gambar->hapus = 1;
        $gambar->save();

        //Storage::disk('public')->delete('gambar/'.$kategori->gambar);
        //$kategori->delete();

        return redirect('tokoku/produk/gambar/'.$gambar->id_produk)->with('success','Berhasil dihapus');
    }

    public function create(){
    	$title = "Modul Produk :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$kategori = kategoriProduk::where('id_toko',$toko)->where('hapus',0)->get();
        $satuan = satuan::where('aktif',1)->get();
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','kategori','satuan'));
    }

    public function edit($id){
    	$title = "Modul Produk :: Administrator";
        $toko = Auth::guard('toko')->id();

    	$produk = produk::where('id_produk',$id)->where('id_toko',$toko)->first();
    	$kategori = kategoriProduk::where('id_toko',$toko)->where('hapus',0)->get();
        $satuan = satuan::where('aktif',1)->get();
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','kategori','produk','satuan'));
    }

    public function store(Request $request){
    	$request->validate([
            'nama'=>'required',
            'kategori'=>'required|numeric',
            'gambar'=>'required|image',
            'satuan'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|numeric',
            'deskripsi'=>'nullable|string',
            'modal'=>'required|numeric'
        ]);

        $uploadedFile = $request->file('gambar');

        $thumbnailImage = Image::make($uploadedFile);
        $thumbnailPath = 'img/produk/';
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
        $diskon = $promo = 0;

        if($request->get('diskon')){
            $diskon = $request->get('diskon');
        }

        if($request->get('promo')){
            $promo = $request->get('promo');
        }

        $toko = Auth::guard('toko')->id();


        $produk = new produk([
        	'produk_seo' => Str::slug($request->get('nama')),
        	'id_ktg_produk' => $request->get('kategori'),
        	'nm_produk' => $request->get('nama'),
        	'deskripsi' => $request->get('deskripsi'),
        	'satuan' => $request->get('satuan'),
            'gambar' => $filename,
            'harga' => $request->get('harga'),
            'stok' => $request->get('stok'),
            'modal' => $request->get('modal'),
            'berat' => $request->get('berat'),
            'diskon' => $diskon,
            'id_toko' => $toko,
            'promo' => $promo,
        ]);

        $produk->save();

        $n = 1;

        if($request->hasfile('gambarP')){
            foreach ($request->file('gambarP') as $item) {
                $thumbnailImage = Image::make($item);
                $thumbnailPath = 'img/produk/';
                $thumbnailImage->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $filename = str_replace(' ','',$n.time().$item->getClientOriginalName());
                $thumbnailImage->save($thumbnailPath.$filename);
                $n++;

                $gambar = new produkGambar([
                    'id_produk'=> $produk->id_produk,
                    'gambar'=>$filename
                ]);

                $gambar->save();
            }
        }

        return redirect('tokoku/produk')->with('success','Berhasil ditambahkan');
    }

    public function update(Request $request, $id){
    	$request->validate([
            'nama'=>'required',
            'kategori'=>'required|numeric',
            'satuan'=>'required',
            'harga'=>'required|numeric',
            'deskripsi'=>'nullable|string',
            'diskon'=>'nullable|numeric',
            'modal'=>'nullable|numeric',
        ]);

        $toko = Auth::guard('toko')->id();

        $produk = produk::where('id_produk',$id)->where('id_toko',$toko)->first();
        $produk->produk_seo = Str::slug($request->get('nama'));
        $produk->nm_produk = $request->get('nama');
        $produk->id_ktg_produk = $request->get('kategori');
        $produk->deskripsi = $request->get('deskripsi');
        $produk->satuan = $request->get('satuan');
        $produk->harga = $request->get('harga');
        $produk->diskon = $request->get('diskon');
        $produk->modal = $request->get('modal');
        $produk->berat = $request->get('berat');
        if($request->get('promo')) $produk->promo = 1; else $produk->promo = 0;

        if($request->hasfile('gambar')){
            
            if(file_exists('img/produk/'.$produk->gambar)){
                @unlink('img/produk/'.$produk->gambar);
            }

            $uploadedFile = $request->file('gambar');
            // $filename = str_replace(' ', '', time().$uploadedFile->getClientOriginalName());
            
            // Storage::disk('public')->putFileAs(
            //     'gambar',
            //     $uploadedFile,
            //     $filename
            // );
            $thumbnailImage = Image::make($uploadedFile);
	        $thumbnailPath = 'img/produk/';
	        $thumbnailImage->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
	        $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
	        $thumbnailImage->save($thumbnailPath.$filename);

            $produk->gambar = $filename;
        }

        $produk->save();

        return redirect('tokoku/produk')->with('success','Berhasil diubah');
    }

    public function destroy($id){
        $toko = Auth::guard('toko')->id();

    	$produk = produk::where('id_produk',$id)->where('id_toko',$toko)->first();
    	$produk->hapus = 1;
    	$produk->save();

    	//Storage::disk('public')->delete('gambar/'.$kategori->gambar);
    	//$kategori->delete();

    	return redirect('tokoku/produk')->with('success','Berhasil dihapus');
    }
}
