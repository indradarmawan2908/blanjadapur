@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('orderan.index') }}">Orderan</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($status) }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="mb-3">
				<a href="{{ route('orderan.index') }}" class="btn btn-sm btn-primary">Semua</a>
				@foreach($stat as $row)
					@if($status==$row)
						<span class="btn btn-sm btn-secondary active">{{ ucfirst($row) }}</span>
					@else
						<a href="{{ route('orderan.status',$row) }}" class="btn btn-sm btn-secondary">{{ ucfirst($row) }}</a>
					@endif
				@endforeach
			</div>
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatableO">
							<thead>
								<tr>
									<th>No Orderan</th>
									<th>Tanggal</th>
									<th>Pemesan</th>
									<th>Alamat</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($order->sortByDesc('created_at') as $item)
								<tr>
									<td>{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</td>
									<td>{{ tgl_indo($item->created_at) }}</td>
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