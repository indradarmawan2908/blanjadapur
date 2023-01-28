<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\bank;
use Image;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Bank :: Administrator";
        $bank = bank::where('tampil',1)->where('hapus',0)->paginate(15);
        return view('admin.bank.index', compact('title','bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Bank Baru :: Administrator";
        return view('admin.bank.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'gambar'=>'required|image'
        ]);

        $uploadedFile = $request->file('gambar');

        $thumbnailImage = Image::make($uploadedFile);
        $thumbnailPath = 'img/bank/';
        $thumbnailImage->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
        $thumbnailImage->save($thumbnailPath.$filename);

        $bank = new bank([
            'gambar' => $filename,
            'nama' => $request->get('nama')
        ]);

        $bank->save();

        return redirect('admin/banks')->with('success','Berhasil ditambahkan');
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
        $title = "Bank Baru :: Administrator";
        $bank = bank::find($id);
        return view('admin.bank.edit', compact('title','bank'));
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
        $request->validate([
            'nama'=>'required',
            'gambar'=>'required|image'
        ]);

        $bank = bank::find($id);
        $bank->nama = $request->get('nama');

        if($request->file('gambar')){
            
            @unlink('img/bank/'.$bank->gambar);

            $uploadedFile = $request->file('gambar');

            $thumbnailImage = Image::make($uploadedFile);
            $thumbnailPath = 'img/bank/';
            $thumbnailImage->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filename = str_replace(' ','',time().$uploadedFile->getClientOriginalName());
            $thumbnailImage->save($thumbnailPath.$filename);

            $bank->gambar = $filename;
        }

        $bank->save();

        return redirect('admin/banks')->with('success','Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = bank::find($id);
        $bank->hapus = 1;
        $bank->save();

        return redirect('admin/banks')->with('success','Berhasil dihapus');
    }
}
