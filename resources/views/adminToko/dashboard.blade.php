@extends('adminToko.base')

@section('main')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

<div class="container mt-3">
	<div class="row mb-3">
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Produk<br>
					{{ $produk->count() }} Item aktif<br>
					{{ $produk->count() }} / 1000 Item
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Order<br>
					{{ $order->count() }} order masuk<br>
					{{ $order->where('status','sukses')->count() }} order sukses
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Transaksi<br>
					{{ rupiah($order->where('status','sukses')->sum('total')) }}
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card">
				<div class="card-body">
					Info Membership Toko<br>
					<form action="{{ route('profil.update',1) }}" method="post">
						@csrf
						@method('PUT')
						Status - {{ $profil->status ? 'Aktif' : 'NonAktif' }}<br>
						<?php
							$mulai = $profil->aktif;
							$oneYearOn = strtotime(date('Y-m-d H:i:s',strtotime($mulai . " + 1 year")));
							$now = time();
							$datediff = round(($oneYearOn - $now) / (60 * 60 * 24));
							if($datediff < 0){
								$datediff = 0;
							}
						?>
						@if($profil->status > 0)
						Tersisa {{ $datediff }} hari
						@else
						Tersisa 0 hari
						@endif
						<br>
						@if($profil->perpanjang > 0)
						Sudah diajukan
						@else
						<button type="submit" class="btn btn-success">Perpanjang</button>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Grafik Penjualan Bulan Ini <?php echo bulan(intval(date('m')))." ".date('Y'); ?>
				</div>
				<div class="card-body">
					<canvas id="grafik"></canvas>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Grafik Penjualan Bulan Ini <?php echo bulan(intval(date('m')))." ".date('Y'); ?>
				</div>
				<div class="card-body">
					<canvas id="grafik2"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Order Terbaru
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>No Order</th>
								<th>Tanggal</th>
								<th>Status</th>
							</thead>
							<tbody>
								@foreach($order->sortByDesc('created_at')->take(12) as $item)
								<tr>
									<td><a href="{{ route('orderan.show',$item->id_order) }}">{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</a></td>
									<td>{{ tgl_indo($item->created_at) }}</td>
									<td>{{ $item->status }}</td>
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
				<div class="card-header">
					Member Terbaru
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Nomor HP</th>
								<th>Nama</th>
								<th>Alamat</th>
							</thead>
							<tbody>
								@foreach($member->sortByDesc('created_at')->take(12) as $row)
								<tr>
									<td>{{ $row->nohp }}</td>
									<td>{{ $row->nama }}</td>
									<td>{{ $row->alamat }}</td>
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

<script type="text/javascript">
var ctx = document.getElementById('grafik');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,21,22,23,24,25,26,27,28,29,30,31],
        datasets: [{
            label: '# Order per Hari',
            data: {!! json_encode($orderGrafik) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
var ctx2 = document.getElementById('grafik2');
var myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($produkGrafik->pluck('produk')->toArray()) !!},
        datasets: [{
            label: 'Produk',
            data: {!! json_encode($produkGrafik->pluck('jumlah')->toArray()) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection