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
				<h5>Daftar Transaksi Per Bulan</h5>
				<form method="get" action="" class="form-inline float-right">
					<div class="input-group">
						<select class="form-control" name="bulan" required>
							<option value="">-Pilih Bulan-</option>
							@for($bln=1;$bln<=12;$bln++)
								@if($bln==$bulan)
								<option value="{{ $bln }}" selected>{{ bulan($bln) }}</option>
								@else
								<option value="{{ $bln }}">{{ bulan($bln) }}</option>
								@endif
							@endfor
						</select>
						<select class="form-control" name="tahun" required>
							<option value="">-Pilih Tahun-</option>
							@for($thn=2019;$thn<=date('Y');$thn++)
								@if($thn==$tahun)
								<option value="{{ $thn }}" selected>{{ $thn }}</option>
								@else
								<option value="{{ $thn }}">{{ $thn }}</option>
								@endif
							@endfor
						</select>
						<div class="input-group-prepend">
							<button type="submit" class="btn btn-outline-primary">Telusuri</button>
						</div>
					</div>
				</form>
				<a href="{{ route('laporan.index') }}" class="btn btn-sm btn-primary">Semua</a> <a href="{{ route('laporan.perhari') }}" class="btn btn-sm btn-secondary">Per Hari</a> <a href="{{ route('laporan.perbulan') }}" class="btn btn-sm btn-secondary active">Per Bulan</a> <a href="{{ route('laporan.pertahun') }}" class="btn btn-sm btn-secondary">Per Tahun</a> <a href="{{ route('laporan.member') }}" class="btn btn-sm btn-secondary">By Member</a>
			</div>
			<div class="card mb-3">
				<div class="card-header">Rekap Bulan {{ bulan($bulan) }}-{{ $tahun }}</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Jumlah Orderan</th>
									<th>Modal</th>
									<th>Total</th>
									<th>Profil</th>
								</tr>
							</thead>
							<tbody>
							@foreach($orderDetail->groupBy('date') as $item)
								<tr>
									<td>{{ tgl_indo($item[0]->date,'short') }}</td>
									<td class="text-right">{{ $item->count('jumlah') }}</td>
									<td class="text-right">{{ rupiah($item->sum('totalmodal')) }}</td>
									<td class="text-right">{{ rupiah($item->sum('total')) }}</td>
									<td class="text-right">{{ rupiah($item->sum('total')-$item->sum('totalmodal')) }}</td>
								</tr>
							@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th colspan="2">Total Keseluruhan</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('totalmodal')) }}</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('total')) }}</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('total')-$orderDetail->sum('totalmodal')) }}</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">Detail Bulan {{ bulan($bulan) }}-{{ $tahun }}</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatableBiasa">
							<thead>
								<tr>
									<th>No Orderan</th>
									<th>Tanggal</th>
									<th>Pemesan</th>
									<th>Alamat</th>
									<th>Modal</th>
									<th>Total</th>
									<th>Profit</th>
								</tr>
							</thead>
							<tbody>
							@foreach($orderDetail as $item)
								<tr>
									<td>{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</td>
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
									<th colspan="4">Total Keseluruhan</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('totalmodal')) }}</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('total')) }}</th>
									<th class="text-right">{{ rupiah($orderDetail->sum('total')-$orderDetail->sum('totalmodal')) }}</th>
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