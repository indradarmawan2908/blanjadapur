<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\slide;
use Image;
use Storage;
use Str;
use Auth;

class SlideController extends Controller
{

    private $folder = "slide/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Modul Slide :: Administrator";
        $toko = Auth::guard('toko')->id();

        $slide = slide::where('id_toko',$toko)->where('hapus',0)->paginate(15);
        return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Modul Slide Baru :: Administrator";
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
            'gambar'=>'required|image',
        ]);

        $uploadedFile = $request->file('gambar');

        $thumbnailImage = Image::make($uploadedFile);
        $thumbnailPath = 'img/slide/';
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


        $slide = new slide([
            'gambar' => $filename,
            'id_toko' => $toko
        ]);

        $slide->save();

        return redirect('tokoku/slide')->with('success','Berhasil ditambahkan');
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
        //
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
        $toko = Auth::guard('toko')->id();

        $slide = slide::where('id_slide',$id)->where('id_toko',$toko)->first();
        $slide->hapus = 1;
        $slide->save();

        //Storage::disk('public')->delete('gambar/'.$kategori->gambar);
        //$kategori->delete();

        return redirect('tokoku/slide')->with('success','Berhasil dihapus');
    }
}
