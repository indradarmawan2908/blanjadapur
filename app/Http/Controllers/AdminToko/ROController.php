<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
