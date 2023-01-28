<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Auth;
use App\toko;
use App\Mail\LupaPassword;

class AuthController extends Controller
{

    public function index(){
    	$title = "Login Dashboard Admin Toko";
    	return view('adminToko/auth/login',compact('title'));
    }

    public function auth(Request $request){

    	$username = $request->get('username');
    	$password = $request->get('password');

    	if (Auth::guard('toko')->attempt(['username' => $username, 'password' => $password ],true)) {
            return redirect('tokoku/dashboard');
		}else{
            return redirect('tokoku/login');
        }
    }

    public function lupas(Request $request){
        $title = "Lupa Password";

        $toko = toko::where('email',$request->get('email'))->first();

        if($toko){
            $respon['status'] = "success";
            $respon['pesan'] = "Permintaan sudah dikiriman ke email ".$request->get('email');

            Mail::to($request->get('email'))->send(new LupaPassword($request));
            $toko->resetpass = 1;
            $toko->save();

        }else{
            $respon['status'] = "danger";
            $respon['pesan'] = "Email tidak ditemukan";
        }
        return view('adminToko/auth/lupas',compact('title','respon'));
    }

    public function reset(Request $request){
        $title = "Reset Password";

        $email = base64_decode($request->get('s'));

        $now = date('Ymd');
        $reqDate = base64_decode($request->get('h'));

        $toko = toko::where('email', $email)->first();

        if($now == $reqDate && $toko && $toko->resetpass==1){
            $respon['status'] = 200;
        }else{
            $respon['status'] = 500;
        }

        return view('adminToko.auth.reset',compact('title','respon'));
    }

    public function resetact(Request $request){
        $request->validate([
            'password'=>'required|confirmed',
        ]);

        $email = base64_decode($request->get('s'));

        $toko = toko::where('email',$email)->first();
        $toko->password = \Hash::make($request->get('password'));
        $toko->password_text = $request->get('password');
        $toko->save();

        return redirect()->route('tokoku.reset2')->with('success','Password berhasil diganti');
    }

    public function reset2(){
        $title = "Reset Password";
        return view('adminToko.auth.reset2', compact('title'));
    }

    public function logout(){
        Auth::guard('toko')->logout();
        return redirect('tokoku/login');
    }
}
