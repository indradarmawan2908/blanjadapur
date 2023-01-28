@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Order Toko</li>
	  </ol>
	</nav>

	@if(session()->get('success'))
    <div class="alert alert-success">
    	{{ session()->get('success') }}  
	</div>
    @endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Paket</th>
									<th>Tanggal Order</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Nomor HP</th>
									<th>Username</th>
									<th>Password</th>
									<th>CallCenter</th>
									<th>Alamat</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($order as $item)
								<tr>
									<td>{{ ucfirst($item->jenis) }}</td>
									<td>{{ tgl_indo($item->created_at) }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->nohp }}</td>
									<td>{{ $item->username }}</td>
									<td>{{ $item->password }}</td>
									<td>{{ $item->kontak_toko }}</td>
									<td>{{ $item->alamat }}</td>
									<td></td>
								</tr>
							@empty
								<tr>
									<td colspan="5" align="center">Data tidak ada</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
					{{ $order->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection