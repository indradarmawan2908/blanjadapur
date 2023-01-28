@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Orderan</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="mb-3">
				<span class="btn btn-sm btn-primary active">Semua</span> <a href="{{ route('orderan.status','pending') }}" class="btn btn-sm btn-secondary">Pending</a> <a href="{{ route('orderan.status','proses') }}" class="btn btn-sm btn-secondary">Proses</a> <a href="{{ route('orderan.status','sukses') }}" class="btn btn-sm btn-secondary">Sukses</a> <a href="{{ route('orderan.status','batal') }}" class="btn btn-sm btn-secondary">Batal</a>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatableO">
							<thead>
								<tr>
									<th>No Orderan</th>
									<th>Status</th>
									<th>Tanggal</th>
									<th>Pemesan</th>
									<th>Alamat</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($order as $item)
								<tr>
									<td>{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</td>
									<td>{{ ucfirst($item->status) }}</td>
									<td>{{ $item->created_at }}</td>
									<td>{{ $item->nohp }}<br>{{ $item->nama }}</td>
									<td>{{ $item->alamat }}</td>
									<td>
										<a href="{{ route('orderan.show',$item->id_order) }}" class="btn btn-sm btn-primary">Detail</a>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="6">Tidak ada data</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection