<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\bank;
use App\bankToko;
use Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Bank :: Administrator Toko";
        $bank = bank::where('tampil',1)->where('hapus',0)->get();
        $bankToko = bankToko::where('id_toko',Auth::guard('toko')->id())->where('hapus',0)->paginate(15);
        return view('adminToko.bank.index', compact('title','bank','bankToko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Bank :: Administrator Toko";
        $bank = bank::where('tampil',1)->where('hapus',0)->get();
        return view('adminToko.bank.create', compact('title','bank'));
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
            'bank'=>'required|unique:otw_bank_toko,id_bank',
            'nama'=>'required',
            'norek'=>'required'
        ]);

        $bankToko = new bankToko([
            'id_bank'=>$request->get('bank'),
            'id_toko'=>Auth::guard('toko')->id(),
            'atas_nama'=>$request->get('nama'),
            'norek'=>$request->get('norek')
        ]);
        $bankToko->save();

        return redirect()->route('bank.index')->with('success','Berhasil menambahkan bank baru');
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
        $title = "Edit Bank :: Administrator Toko";
        $bank = bank::where('tampil',1)->where('hapus',0)->get();
        $bankToko = bankToko::find($id);

        return view('adminToko.bank.edit',compact('title','bank','bankToko'));
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
            'bank'=>'required',
            'nama'=>'required',
            'norek'=>'required'
        ]);

        $bankToko = bankToko::find($id);
        $bankToko->id_bank = $request->get('bank');
        $bankToko->atas_nama = $request->get('nama');
        $bankToko->norek = $request->get('norek');
        $bankToko->save();

        return redirect()->route('bank.index')->with('success','Berhasil mengubah data bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankToko = bankToko::find($id);
        $bankToko->delete();

        return redirect()->route('bank.index')->with('success','Berhasil menghapus data bank');
    }
}
