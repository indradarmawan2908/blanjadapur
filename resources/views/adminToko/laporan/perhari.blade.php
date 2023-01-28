@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="mb-3">
				<h5>Daftar Transaksi Per Hari</h5>
				<form method="get" action="" class="form-inline float-right">
					<div class="input-group">
						<input class="form-control date" type="text" name="tanggal" id="tanggal" value="{{ $tanggal }}">
						<div class="input-group-prepend">
							<button type="submit" class="btn btn-outline-primary">Telusuri</button>
						</div>
					</div>
				</form>
				<a href="{{ route('laporan.index') }}" class="btn btn-sm btn-primary">Semua</a> <a href="{{ route('laporan.perhari') }}" class="btn btn-sm btn-secondary active">Per Hari</a> <a href="{{ route('laporan.perbulan') }}" class="btn btn-sm btn-secondary">Per Bulan</a> <a href="{{ route('laporan.pertahun') }}" class="btn btn-sm btn-secondary">Per Tahun</a> <a href="{{ route('laporan.member') }}" class="btn btn-sm btn-secondary">By Member</a>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatableBiasa">
							<thead>
								<tr>
									<th>No Orderan</th>
									<th>Status</th>
									<th>Tanggal</th>
									<th>Pemesan</th>
									<th>Alamat</th>
									<th>Modal</th>
									<th>Total</th>
									<th>Profit</th>
								</tr>
							</thead>
							<tbody>
							@foreach($order as $item)
								<tr>
									<td>{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</td>
									<td>{{ $item->status }}</td>
									<td>{{ tgl_indo($item->created_at) }}</td>
									<td>{{ $item->nama }}<br>{{ $item->nohp }}</td>
									<td>{{ $item->alamat }}</td>
									<td class="text-right">{{ rupiah($item->totalmodal) }}</td>
									<td class="text-right">{{ rupiah($item->total) }}</td>
									<td class="text-right">{{ rupiah($item->total-$item->totalmodal) }}</td>
								</tr>
							@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th colspan="5">Total</th>
									<th class="text-right">{{ rupiah($order->sum('totalmodal')) }}</th>
									<th class="text-right">{{ rupiah($order->sum('total')) }}</th>
									<th class="text-right">{{ rupiah($order->sum('total')-$order->sum('totalmodal')) }}</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection