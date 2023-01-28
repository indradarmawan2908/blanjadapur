@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $toko->nm_toko }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">Data Toko <a href="{{ route('toko.edit',$toko->id_toko) }}" data-toggle="tooltip" title="Edit data toko" class="float-right btn btn-sm btn-primary"><i class="fa fa-edit"></i></a></div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<table class="w-100">
								<tr>
									<td>{{ $toko->nm_toko }}</td>
								</tr>
								<tr>
									<td>{{ $toko->alamat_toko }}</td>
								</tr>
								<tr>
									<td>{{ $toko->no_telp_toko }}</td>
								</tr>
								<tr>
									<td>{{ $toko->created_at }}</td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<table class="w-100">
								<tr>
									<td>{{ $toko->nm_pengelola }}</td>
								</tr>
								<tr>
									<td>{{ $toko->alamat_pengelola }}</td>
								</tr>
								<tr>
									<td>{{ $toko->no_telp_pengelola }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">Produk Toko {{ $toko->nm_toko }}</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Nama Produk</th>
											<th>Gambar</th>
										</tr>
									</thead>
									<tbody>
									@foreach($produk as $item)
										<tr>
											<td>{{ $item->nm_produk }}</td>
											<td>{{ $item->gambar }}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
							{{ $produk->links() }}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">Order dan Transaksi</div>
						<div class="card-body">
							<h5>Orderan Toko</h5>
							<div>Order Masuk : <b>{{ $order->count() }}</b></div>
							<div>Order Sukses : <b>{{ $order->where('status','sukses')->count() }}</b></div>
							<div>Order Batal : <b>{{ $order->where('status','batal')->count() }}</b></div>
							<div>Total Nilai Transaksi : <b>{{ $order->where('status','sukses')->sum('total') }}</b></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection