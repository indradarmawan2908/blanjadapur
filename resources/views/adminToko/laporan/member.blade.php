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
		<div class="col-md-12 mb-3">
			<div>
				<h5>Daftar Transaksi Per Hari</h5>
				<form method="get" action="" class="form-inline float-right">
					<input class="form-control date" type="text" name="from" id="from" value="{{ $date1 }}" placeholder="Mulai" required autocomplete="off">
					<input class="form-control date" type="text" name="until" id="until" value="{{ $date2 }}" placeholder="Sampai" required autocomplete="off">
					<button class="btn btn-success btn-lg" type="submit">Telusuri</button>
				</form>
				<a href="{{ route('laporan.index') }}" class="btn btn-sm btn-primary">Semua</a> <a href="{{ route('laporan.perhari') }}" class="btn btn-sm btn-secondary">Per Hari</a> <a href="{{ route('laporan.perbulan') }}" class="btn btn-sm btn-secondary">Per Bulan</a> <a href="{{ route('laporan.pertahun') }}" class="btn btn-sm btn-secondary">Per Tahun</a>
				<a href="{{ route('laporan.member') }}" class="btn btn-sm btn-secondary active">By Member</a>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatableBiasa">
							<thead>
								<tr>
									<th>Nomor Handphone</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Terakhir Pesan</th>
									<th>Jumlah Pesanan</th>
									<th>Total Pesanan</th>
								</tr>
							</thead>
							<tbody>
							@foreach($member as $item)
								<tr>
									<td>{{ $item->nohp }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->alamat }}</td>
									<td>{{ $item->lastOrder }}</td>
									<td class="text-right">{{ $item->jumlahOrder  }}</td>
									<td class="text-right">{{ rupiah($item->totalOrder)  }}</td>
								</tr>
							@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th colspan="4">Total</th>
									<th class="text-right">{{ $member->sum('jumlahOrder') }}</th>
									<th class="text-right">{{ rupiah($member->sum('totalOrder')) }}</th>
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