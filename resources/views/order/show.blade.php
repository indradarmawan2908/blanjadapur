@extends('base')

@section('main')

<div class="container pt-3 pb-4">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Terimakasih atas transaksinya.., jika ada yang ditanyakan bisa Chat kesini :</span>
            <a href="https://api.whatsapp.com/send?phone={{ $toko->call_center }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:18px" class="text-center pt-3"><i class="fab fa-whatsapp" style="font-size:35px"></i> Chat WA </h6>
  	        </a>
        </div>
    </div>
</div>

<?php
	switch($order->status){
		case 'pending':
			$status = 'warning';
		break;
		case 'proses':
			$status = 'primary';
		break;
		case 'sukses':
			$status = 'success';
		break;
		case 'batal':
			$status = 'danger';
		break;
	}
?>

<div class="container pt-3 pb-3">
    <div class="report">
        <div class="isi">
            <ul class="list-group">
	            <li class="list-group-item rounded-0"><b>Status</b><br><span class="btn-{{ $status }} btn">{{ ucfirst($order->status) }}</span></li>
	            <li class="list-group-item rounded-0">Nomor Pesanan<br>{{ nopesan(Auth::user()->id_toko,$order->id_order,$order->created_at) }}</li>
	            <li class="list-group-item rounded-0">Tanggal Pemesanan<br>{{ $order->created_at }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="container pt-3 pb-3">
    <div class="report">
        <div class="isi">
            <ul class="list-group">
	            <li class="list-group-item rounded-0"><b>Payment</b></li>
	            <!--
	            <li class="list-group-item rounded-0">
		            Metode Pembayaran
		            <span class="float-right"><?php echo strtoupper($order->metode); ?></span>
	            </li>
	            <li class="list-group-item rounded-0">
		            Tipe Pembayaran
		            <span class="float-right">@if($order->metode=="kirim") Transfer @else Cash @endif</span>
	            </li>
	            -->
	            <li class="list-group-item rounded-0">
		            Total Belanja
		            <span class="float-right">{{ $order->getPitih($order->total) }}</span>
	            </li>
	            <li class="list-group-item rounded-0">
		            Ongkos Kirim
		            <span class="float-right">{{ rupiah($order->ongkir) }}</span>
	            </li>
	            <li class="list-group-item rounded-0">
		            <b>Total Bayar
		            <span class="float-right">{{ rupiah($order->total+$order->ongkir) }}</span></b>
	            </li>
	            
            </ul>
        </div>
    </div>
</div>

<div class="container pt-3 pb-5">
    <div class="report">
        <div class="isi">
            <ul class="list-group">
	            <li class="list-group-item rounded-0"><b>Alamat Pengiriman</b></li>
	            <li class="list-group-item rounded-0">{{ $order->nama }}<br>{{ $order->alamat }} @if($order->metode == "kirim") <br>{{ $order->kode_pos }} @endif</li>
	            @if($order->metode == "kirim")
	            <li class="list-group-item rounded-0"><b>Provinsi</b></li>
	            <li class="list-group-item rounded-0">{{ $kota['province'] }}</li>
	            <li class="list-group-item rounded-0"><b>Kota</b></li>
	            <li class="list-group-item rounded-0">{{ $kota['city_name'] }}</li>
	            <li class="list-group-item rounded-0"><b>Paket Pengiriman</b></li>
	            <li class="list-group-item rounded-0">{{ $order->paket }}</li>
	            @endif
            </ul>
        </div>
    </div>
</div>

<ul class="list-group bg-white mb-3">
	<li class="list-group-item rounded-0">
		<b>Jumlah Item</b>
		<span class="float-right">{{ $order->jumlahItem($order->id_order)->count() }}</span>
	</li>
</ul>

<ul class="list-group bg-white mb-3">
	<li class="list-group-item rounded-0"><b>Daftar Barang</b></li>
	@foreach($order->detail($order->id_order) as $item)
	<li class="list-group-item rounded-0 clearfix">
		<div class="media">
			@if($item->gambar!='')
			<img class="media-left" width="80" src="{{ asset('img/produk/'.$item->gambar) }}">
			@else
			<img class="media-left" width="80" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND">
			@endif
			<div class="media-body pl-3">
				<h6 class="card-title">{{$item->nm_produk}}</h6>
				<p class="card-text">
					{{ rupiah($item->harga-$item->diskon) }} / <small>{{ $item->satuan }}</small> <br>
					Jumlah {{ $item->jumlah }}<br>
					{{ rupiah(($item->harga-$item->diskon)*$item->jumlah) }}
				</p>
			</div>
		</div>
	</li>
	@endforeach
</ul>

@endsection