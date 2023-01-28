@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('orderan.index') }}">Orderan</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $order->id_order }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div>
						<div class="btn-group float-right" role="group" aria-label="Basic example">
							<a href="{{ route('orderan.cetak',$order->id_order) }}" target="_blank" class="btn btn-secondary">Print 58mm</a>
							<a href="{{ route('orderan.cetakbesar',$order->id_order) }}" target="_blank" class="btn btn-primary">Print</a>
						</div>
					Nama : {{ $order->nama }} <br>	
					Nomor Orderan : {{ nopesan(Auth::guard('toko')->id(),$order->id_order,$order->created_at) }}<br>
					Tanggal Orderan : {{ tgl_indo($order->created_at) }}<br>
					Status : {{ ucfirst($order->status) }}<br>
					Nohp : {{ $order->nohp }}<br><br>
					
					@if($order->metode != "cod")
					Alamat : {{ $order->alamat }}<br>
					@endif
					@if($order->metode == "kirim")
					Paket Pengiriman : {{ $order->paket }}<br>
					Kode Pos : {{ $order->kode_pos }}<br>
					@endif
					<br>
					<div class="email"><a href="https://api.whatsapp.com/send?phone=62{{ $order->nohp }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:18px" class="text-center pt-3"><img src="http://pasarpedia.id/img/waicon.png"> Whatsapp </h6> </a> </div> <br>
					</div>

					<span>Produk yang diorder</span>
					<form method="POST" action="{{ route('orderan.update',$order->id_order) }}">
						@csrf
						@method('DELETE')
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Quantity / <small>stok</small></th>
								<th>Jumlah</th>
								@if($order->status=="pending")
								<th class="text-center"><input type="checkbox" id="checkAll"></th>
								@endif
							</tr>
						</thead>
						<tbody>
					<?php $total = $diskon = 0; ?>
					@foreach($order->detail($order->id_order) as $item)
						<tr>
							<td>{{ $item->nm_produk}}</td>
							<td class="text-right">{{ rupiah($item->harga) }}</td>
							<td class="text-right">{{ $item->jumlah }} / <small>{{ $item->stok }}</small></td>
							<td class="text-right">{{ rupiah($item->jumlah*$item->harga) }}</td>
							@if($order->status=="pending")
							<td class="text-center"><input type="checkbox" class="checkItem" name="item[]" value="{{ $item->id_detail}}"></td>
							@endif
							<?php $total = $total+($item->jumlah*$item->harga); $diskon = $diskon+($item->jumlah*$item->diskon); ?>
						</tr>
					@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3">Total Belanja</th>
								<th class="text-right">{{ rupiah($total) }}</th>
							</tr>
							<tr>
								<th colspan="3">Diskon</th>
								<th class="text-right">-{{ rupiah($diskon) }}</th>
							</tr>
							<tr>
								<th colspan="3">Ongkos Kirim</th>
								<th class="text-right">{{ rupiah($order->ongkir) }}</th>
							</tr>
							<tr>
								<th colspan="3">Total Seluruhnya</th>
								<th class="text-right">{{ rupiah($order->total+$order->ongkir) }}</th>
							</tr>
						</tfoot>
					</table>
						@if($order->status=="pending")
						<button class="btn btn-warning float-right" type="submit" onclick="return confirm('Yakin hapus item terpilih?')">Hapus</button>
						@endif
					</form>

					@if($order->bayar == 0)
					<form method="post" action="{{ route('orderan.update',$order->id_order) }}">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="status"></label>
								<select class="form-control" id="status" name="status" required>
									<option>-Pilih-</option>
									@if($order->status=="pending")
									<option value="pending" selected>Pending</option>
									@else
									<option value="pending">Pending</option>
									@endif
									@if($order->status=="proses")
									<option value="proses" selected>Proses</option>
									@else
									<option value="proses">Proses</option>
									@endif
									@if($order->status=="sukses")
									<option value="sukses" selected>Sukses</option>
									@else
									<option value="sukses">Sukses</option>
									@endif
									@if($order->status=="batal")
									<option value="batal" selected>Batal</option>
									@else
									<option value="batal">Batal</option>
									@endif
								</select>
							</div>
						</div>
						<button type="submit" class="btn btn-sm btn-success">Konfirmasi</button>
					</form>
					@else
					<a href="{{ route('orderan.kembali', $order->id_order) }}" class="btn btn-success mb-3">Return</a>
					@if(count($kembali) > 0)
					<span>Produk yang dikembalikan</span>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Quantity</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
						@foreach($kembali as $item)
							<tr>
								<td>{{ $item->nm_produk}}</td>
								<td class="text-right">{{ rupiah($item->harga) }} /{{ $item->satuan }}</td>
								<td class="text-right">{{ $item->jumlah }}</td>
								<td class="text-right">{{ rupiah($item->jumlah*$item->harga) }}</td>
								<?php $total = $total+($item->jumlah*$item->harga); ?>
							</tr>
						@endforeach
						</tbody>
					</table>
					@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection