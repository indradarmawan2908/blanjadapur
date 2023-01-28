@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $kategori->nm_ktg_produk }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>Gambar</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($produk as $item)
								<tr>
									<td>{{ $item->nm_produk }}</td>
									<td>{{ $item->gambar }}</td>
									<td></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $produk->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection