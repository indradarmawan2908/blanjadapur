<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimEmail;

use App\orderToko;

class UtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('utama');
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
        $request->validate([
            'nama'=>'required|string',
            'email'=>'required|email',
            'nohp'=>'required',
            'paket'=>'required',
            'callcenter'=>'required',
            'alamat'=>'required',
            'username'=>'required',
            'password'=>'required'
        ]);
        $order = new orderToko([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'nohp' => $request->get('nohp'),
            'jenis' => $request->get('paket'),
            'kontak_toko' => $request->get('callcenter'),
            'alamat' => $request->get('alamat'),
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ]);
        $order->save();

        // $name = 'Krunal';
        // Mail::to($request->get('email'))->send(new KirimEmail($request));
        // Mail::to('cs@kliker.id')->send(new KirimEmail($request));

        return redirect()->route('utama.index')->with('success', 'Terima kasih telah order toko kami!');  
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
    }
}
