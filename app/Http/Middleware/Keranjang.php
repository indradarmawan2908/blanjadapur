<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\toko;

class Keranjang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::user()){
            $isiKeranjang = 0;
            $news = collect();
        }else{
            $id_member = Auth::user()->id_member;
            $isiKeranjang = DB::table('otw_keranjang_detail')->selectRaw('(otw_produk.harga-otw_produk.diskon)*otw_keranjang_detail.jumlah as total' )->join('otw_produk', 'otw_produk.id_produk', '=', 'otw_keranjang_detail.id_produk')->join('otw_keranjang','otw_keranjang.id_keranjang','=','otw_keranjang_detail.id_keranjang')->where('otw_keranjang.id_member',$id_member)->get();

            $total = 0;
            foreach($isiKeranjang as $item){
                $total = $total + $item->total;
            }
            $isiKeranjang = $total;

            if($request->uid){
                $toko = toko::where('seo_toko', $request->uid)->first();
                // $news = notifikasi::where('id_toko', $toko->id_toko)->where('id_member', $id_member)->get();
                $news = collect();
            }else{
              $news = collect();
            }
        }

        View::share('duitKeranjang', "Rp ".number_format($isiKeranjang,0,',','.'));
        View::share('jmlNews', $news);

        return $next($request);
    }
}
