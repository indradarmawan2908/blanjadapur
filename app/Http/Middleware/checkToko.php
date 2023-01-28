<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;
use View;

use App\toko;
use App\newsToko;

class checkToko
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
        $toko = toko::whereStatus(1)->first();

        if($toko==null){
            return abort(404,'Toko tidak ditemukan.');
        }

        if($toko->status == 0){
            return abort(404,'Toko tidak aktif.');
        }

        $news = newsToko::where('id_toko',$toko->id_toko)->where('tampil',1)->where('hapus',0)->get();
        View::share('news', $news);

        return $next($request);
    }
}
