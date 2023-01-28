<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RajaOngkir;

class ROController extends Controller
{
    public function index(){
    	$data = RajaOngkir::Provinsi()->all();
        return $data;
    }

    public function show($id)
    {
        $data = RajaOngkir::Kota()->byProvinsi($id)->get();

        return $data;
    }

    public function store(Request $request)
    {
        $data = RajaOngkir::Cost([
            'origin'        => $request->origin, // id kota asal
            'originType'    => 'city',
            'destination'   => $request->destination, // id kota tujuan
            'destinationType' => 'city',
            'weight'        => $request->weight * 1000, // berat satuan gram
            'courier'       => $request->courier, // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        //$data = collect($data);
        return $data;
    }
}
