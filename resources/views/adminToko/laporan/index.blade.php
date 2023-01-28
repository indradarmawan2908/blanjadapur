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
			<div class="">
				<h4>Daftar Transaksi</h4>
				<form method="get" action="" class="form-inline float-right">
					<input class="form-control date" type="text" name="from" id="from" value="{{ $date1 }}" placeholder="Mulai" required autocomplete="off">
					<input class="form-control date" type="text" name="until" id="until" value="{{ $date2 }}" placeholder="Sampai" required autocomplete="off">
					<button class="btn btn-success btn-lg" type="submit">Telusuri</button>
				</form>
				<span class="btn btn-sm btn-primary active">Semua</span> <a href="{{ route('laporan.perhari') }}" class="btn btn-sm btn-secondary">Per Hari</a> <a href="{{ route('laporan.perbulan') }}" class="btn btn-sm btn-secondary">Per Bulan</a> <a href="{{ route('laporan.pertahun') }}" class="btn btn-sm btn-secondary">Per Tahun</a> <a href="{{ route('laporan.member') }}" class="btn btn-sm btn-secondary">By Member</a>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
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
					{{ $order->appends(Request::except('page'))->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection