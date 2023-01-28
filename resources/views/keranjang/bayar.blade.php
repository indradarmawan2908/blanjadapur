@extends('base')

@section('main')

<div class="bg-white mb-3">
	<div class="container pt-3 pb-3 text-center">
		Terima Kasih Untuk Pesanan Anda!<br>
		<b>Nomor Order {{ nopesan(Request::uid(),$item->id_order,$item->created_at) }}</b>
	</div>
</div>

<div class="bg-white mb-3">
	<div class="container pt-3 pb-3">
		<span>Total Harga</span>
		<h5 class="card-title">{{ rupiah($order->total) }}</h5>
	</div>
</div>

<div class="bg-white mb-3">
	<div class="container">
		<h5 class="cardt-title">PEMBAYARAN</h5>
		<table class="table">
			<tr>
				<td>Total Pembayaran</td>
				<td>{{ rupiah($order->total) }}</td>
			</tr>
			<tr>
				<td>Metode Pembayaran</td>
				<td><?php echo strtoupper($order->metode); ?></td>
			</tr>
			<tr>
				<td>Tipe Pembayaran</td>
				<td>Cash</td>
			</tr>
		</table>
	</div>
</div>

<a href="#" class="btn btn-block btn-primary">Lihat pesanan</a>

@endsection