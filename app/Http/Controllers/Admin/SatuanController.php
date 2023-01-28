<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Modul Satuan :: Administrator";
        $satuan = satuan::paginate(15);

        return view('admin.satuan.index',compact('title','satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Modul Satuan Baru :: Administrator";

        return view('admin.satuan.create',compact('title'));
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
            'singkatan'=>'required',
        ]);

        $satuan = new satuan([
            'satuan' => $request->get('nama'),
            'singkatan' => $request->get('singkatan'),
            'aktif' => 1
        ]);

        $satuan->save();

        return redirect('admin/satuan')->with('success','Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Modul Satuan Baru :: Administrator";
        $satuan = satuan::find($id);

        return view('admin.satuan.edit',compact('title','satuan'));
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
            'singkatan'=>'required',
        ]);

        $satuan = satuan::find($id);
        $satuan->satuan = $request->get('nama');
        $satuan->singkatan = $request->get('singkatan');
        $satuan->save();

        return redirect('admin/satuan')->with('success','Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $satuan = satuan::find($id);
        $satuan->aktif = 0;
        $satuan->save();

        return redirect('admin/satuan')->with('success','Berhasil diubah');
    }
}
