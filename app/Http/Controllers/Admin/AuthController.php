<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\toko;

class AuthController extends Controller
{

    public function index(){
    	$title = "Login Administrator::Administrator OTW";
    	return view('admin/auth/login',compact('title'));
    }

    public function auth(Request $request){

    	$username = $request->get('username');
    	$password = $request->get('password');

    	if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $password, 'blokir' => 0 ],true)) {
            return redirect('admin/beranda');
		}else{
            return redirect('admin/login');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function toko($id){
        $toko = toko::find($id);

        if (Auth::guard('toko')->attempt(['username' => $toko->username, 'password' => $toko->password_text ], true)) {
            return redirect('tokoku/dashboard');
        }else{
            return redirect('tokoku/login');
        }
    }
}
