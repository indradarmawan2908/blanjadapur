@extends('admin.base')

@section('main')
<div class="container mt-3">
	<div class="row mb-3">
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Toko<br>
					{{ $toko->where('status',1)->count() }} Toko Aktif <br>
					{{ $toko->count() }} Total Toko 
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Order<br>
					<a href="{{ route('orderToko.index') }}">{{ $orderToko->where('dilihat',0)->count() }}</a> Orderan Baru <br>
					{{ $orderToko->count() }} Total Orderan
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Transaksi<br>
					{{ $order->count() }} Jumlah Transaksi<br>
					{{ rupiah($order->sum('total')) }} Total Transaksi
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Ajuan Perpanjangan<br>
					<a href="{{ route('toko.perpanjang') }}">{{ $toko->where('perpanjang',1)->count() }} toko</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">10 Toko Terbaru</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Nama Toko</th>
									<th>Alamat Toko</th>
									<th>Kontak Toko</th>
								</tr>
							</thead>
							<tbody>
							@foreach($toko->sortByDesc('created_at') as $item)
								<tr>
									<td><a href="{{ route('toko.show',$item->id_toko) }}">{{ $item->nm_toko }}</a></td>
									<td>{{ $item->alamat_toko }}</td>
									<td>{{ $item->no_telp_toko }}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">10 Toko Expired dan Akan Expired</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Nama Toko</th>
									<th>Kontak Toko</th>
									<th>Expired</th>
								</tr>
							</thead>
							<tbody>
							@foreach($toko->where('status',0) as $item)
								<tr>
									<td><a href="{{ route('toko.show',$item->id_toko) }}">{{ $item->nm_toko }}</a></td>
									<td>{{ $item->no_telp_toko }}</td>
									<td><span class="btn btn-danger btn-sm">Expired</span></td>
								</tr>
							@endforeach
							@foreach($toko->where('status',1)->sortBy('aktif') as $item)
							<?php
								$mulai = $item->aktif;
								$oneYearOn = strtotime(date('Y-m-d H:i:s',strtotime($mulai . " + 1 year")));
								$now = time();
								$datediff = round(($oneYearOn - $now) / (60 * 60 * 24));
								if($datediff < 0){
									$datediff = 0;
								}
							?>
								<tr>
									<td><a href="{{ route('toko.show',$item->id_toko) }}">{{ $item->nm_toko }}</a></td>
									<td>{{ $item->no_telp_toko }}</td>
									@if($datediff > 0)
									<td><span class="btn btn-success btn-sm">{{ $datediff }} hari tersisa</span></td>
									@else
									<td><span class="btn btn-danger btn-sm">Expired</span></td>
									@endif
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection