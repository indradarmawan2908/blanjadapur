<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\toko;
use App\member;

use Hash;

class MemberController extends Controller
{
    //

    public function index(){
    	$toko = toko::whereStatus(1)->first();
    	$title = "Halaman member";

    	return view('member/index',compact('title','toko'));
    }

    public function toko(){
        $toko = toko::whereStatus(1)->first();
        $title = "Halaman profil toko";

        return view('member/toko',compact('title','toko'));
    }

    public function profil(){
    	$toko = toko::whereStatus(1)->first();
    	$title = "Halaman profil member";

    	return view('member/profil',compact('title','toko'));
    }

    public function profilUpdate(Request $request){
        $request->validate([
            'nama'=>'required|string'
        ]);

        $member = member::find(Auth::user()->id_member);
        $member->nama = $request->get('nama');
        $member->alamat = $request->get('alamat');
        $member->save();

        return redirect()->route('member.profil')->with('success','Berhasil update profil');
    }

    public function password(Request $request){
        $request->validate([
            'password'=>'required|string|confirmed',
        ]);

        $member = member::find(Auth::user()->id_member);
        $member->password = Hash::make($request->get('nama'));
        $member->save();

        return redirect()->route('member.profil')->with('success','Berhasil update password');
    }
}
