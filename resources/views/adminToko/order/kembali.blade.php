@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('orderan.index') }}">Orderan</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('orderan.show', $order->id_order) }}">{{ $order->id_order }}</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Kembali</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div>
					Nomor Orderan : {{ nopesan(Auth::guard('toko')->id(),$order->id_order,$order->created_at) }}<br>
					Nama : {{ $order->nama }} <br>
					Tanggal Orderan : {{ tgl_indo($order->created_at) }}<br>
					Status : {{ ucfirst($order->status) }}<br>
					Metode Pembayaran : {{ $order->metode }}<br><br><br>
					<span>Pilih produk yang dikembalikan</span>
					<form action="{{ route('orderan.kembali', $order->id_order) }}" method="POST">
						@csrf
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>Harga</th>
									<th>Quantity</th>
									<th>Jumlah</th>
									<th>Return</th>
								</tr>
							</thead>
							<tbody>
						<?php $total = 0; ?>
						@foreach($order->detail($order->id_order) as $item)
							<tr>
								<td>{{ $item->nm_produk}}</td>
								<td class="text-right">{{ rupiah($item->harga) }} /{{ $item->satuan }}</td>
								<td class="text-right">{{ $item->jumlah }}</td>
								<td class="text-right">{{ rupiah($item->jumlah*$item->harga) }}</td>
								<td><input type="checkbox" name="kembali[]" value="{{$item->id_detail}}" @if(\App\kembali::where('id_detail',$item->id_detail)->first()) checked @endif></td>
								<?php $total = $total+($item->jumlah*$item->harga); ?>
							</tr>
						@endforeach
							</tbody>
						</table>
						<button type="submit" class="btn btn-success">Return</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
