<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\newsToko;

class NewsController extends Controller
{
    private $folder = "news/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Modul Pengumuman :: Administrator";
        $toko = Auth::guard('toko')->id();

        $newsToko = newsToko::where('id_toko', $toko)->where('hapus',0)->paginate(15);
        
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','newsToko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Modul News baru :: Administrator";

        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title'));
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
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
        ]);

        $news = new newsToko([
            'judul'=>$request->get('judul'),
            'isi'=>$request->get('isi'),
            'id_toko'=>Auth::guard('toko')->id()
        ]);
        $news->save();

        if($request->get('tampil')){
            $news->tampil = 1;
            $news->save();
        }

        return redirect('tokoku/news')->with('success','Berhasil menambahkan news baru');
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
        $title = "Baca news :: Administrator";
        $newsToko = newsToko::find($id);

        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','newsToko'));
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
        $title = "Modul News edit :: Administrator";
        $newsToko = newsToko::find($id);

        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','newsToko'));
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
            'judul'=>'required',
            'isi'=>'required'
        ]);

        $news = newsToko::find($id);
        $news->judul = $request->get('judul');
        $news->isi = $request->get('isi');
        $news->save();

        return redirect('tokoku/news')->with('success','Berhasil mengubah news');
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
        $news = newsToko::find($id);
        $news->tampil = 0;
        $news->hapus = 1;
        $news->save();

        return redirect('tokoku/news')->with('success','Berhasil menghapus news');
    }

    public function tampil($id,$tampil){
        $news = newsToko::find($id);
        $news->tampil = $tampil;
        $news->save();

        if($tampil > 0){
            return redirect('tokoku/news')->with('success','Berhasil menampilkan news');
        }else{
            return redirect('tokoku/news')->with('success','Berhasil menyembunyikan news');
        }
    }
}
