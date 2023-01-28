<?php
namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\toko;
use Auth;

use App\firebase;
use App\pushfire;

class BroadcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $title = "Broadcast :: Administrator Toko";
        $toko = Auth::guard('toko')->id();
        $jab = toko::find($toko);
        $seo_toko = $jab->seo_toko;
        return view('adminToko.broadcast.index', compact('title','toko','seo_toko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        // notification title
        $title = $request->get('judul');
        
        // notification message
        $message = $request->get('pesan');

        // notification link
        $link = $request->get('link');
        
        // whether to include to image or not
        if( $request->get('foto') !== null ){
            $include_image = TRUE;
            $image = $request->get('foto');
        }else{
            $include_image = FALSE;
            $image = '';
        }

        $json = array();
        $json['data']['title'] = $title;
        $json['data']['is_background'] = $include_image;
        $json['data']['message'] = $message;
        $json['data']['link'] = $link;
        $json['data']['image'] = $image;
        $json['data']['timestamp'] = date('Y-m-d G:i:s');

        $toko = Auth::guard('toko')->id();
        $jab = toko::find($toko);
        $seo_toko = $jab->seo_toko;
        
        $topics = $seo_toko;

        $fields = array(
            'to' => '/topics/' . $topics,
            'data' => $json,
        );

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        define('FIREBASE_API_KEY', 'AAAAolMdDgE:APA91bFd-AcNoPBDX3GBhiHM9_Mkcx8MvnGknuT_E4e7y5Ui2MLKjTpMitAnl1XE6Wj8Kus-VU7_NzuQxM__fIRM3Hxoeb22VHj_C1lnm9q7bLS_zLEhTJqF4l65vAJjRoAg-MJLJP50');
        
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return redirect()->route('broadcast.index')->with('success','Notif berhasil di siarkan');
    }

}
