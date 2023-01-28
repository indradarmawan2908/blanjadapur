<?php

namespace App\Http\Controllers\adminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\member;
use App\order;
use Auth;

class MemberkuController extends Controller
{
    //
    private $folder = "member/";

    public function index(){
    	$title = "Modul Member :: Administrator";
        $toko = Auth::guard('toko')->id();

    	// $member = member::where('id_toko', $toko)->orderBy('created_at','desc')->get();
        $member = \DB::table('otw_member')->select('otw_member.*',\DB::raw('count(otw_order.id_order) jumlahOrder, otw_order.created_at lastOrder'))->leftJoin('otw_order','otw_order.id_member','=','otw_member.id_member')->where('otw_member.id_toko',$toko)->orderBy('jumlahOrder','desc')->orderBy('lastOrder', 'desc')->groupBy('otw_member.id_member')->get();
        // $order = order::where('id_toko', $toko)->get();
        $datatable = true;
    	return view('adminToko/'.$this->folder.__FUNCTION__,compact('title','member','datatable'));
    }

    public function show($id, Request $request){
    	$title = "Modul Member :: Administrator";
        $toko = Auth::guard('toko')->id();

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if($request->from && $request->until){
            $date1 = $request->from;
            $date2 = $request->until;
        }

        $member = member::where('id_toko', $toko)->where('nohp',$id)->first();
    	$order = order::where('id_toko', $toko)->where('id_member',$member->id_member)->whereBetween('created_at', [$date1.' 00:00:00', $date2.' 23:59:59'])->get();
    	return view('adminToko.member.show',compact('title', 'member','order','date1','date2'));
    }

    public function edit($id){
        $title = "Modul Member :: Administrator";
        $toko = Auth::guard('toko')->id();

        $member = member::where('id_toko', $toko)->where('nohp',$id)->first();
        return view('adminToko.member.edit',compact('title','member'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'password'=>'required|confirmed',
        ]);

        $member = member::find($id);
        $member->password = \Hash::make($request->get('password'));
        $member->save();

        return redirect()->route('memberku.index')->with('success','Berhasil mengubah password');
    }
}
