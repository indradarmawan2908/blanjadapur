<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\produk;
use App\member;
use App\order;
use Auth;

class CariController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Request $request, $id)
    {
        //
        $toko = Auth::guard('toko')->id();
        $title = "Hasil pencarian ".$request->get('cari');

        $produk = produk::where('id_toko',$toko)->where('nm_produk','LIKE', '%' . $request->get('cari') . '%')->get();
        $member = member::where('id_toko',$toko)->where('nama','LIKE', '%' . $request->get('cari') . '%')->orWhere('nohp','LIKE','%'.$request->get('cari').'%')->get();
        $order = order::where('id_toko',$toko)->where('nama','LIKE', '%' . $request->get('cari') . '%')->orWhere('id_order','LIKE','%'.$request->get('cari').'%')->get();
        return view('adminToko/cari',compact('title','produk','member','order'));
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
    }
}
