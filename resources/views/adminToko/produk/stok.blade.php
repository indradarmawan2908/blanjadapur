@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $produk->nm_produk }} - Stok</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			@if ($errors->any())
			    <div class="alert alert-danger mb-3">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="card">
				<div class="card-body">
					<form method="post" action="{{ route('produk.storeStok',$produk->id_produk) }}">	
					@csrf
					<div class="form-group">
						<label>Stok Saat ini</label>
						<input type="text" class="form-control" value="{{ $produk->stok }}" readonly>
					</div>
					<div class="form-group">
						<label>Jumlah Penambahan</label>
						<input type="number" class="form-control" min="1" value="" name="jumlah" required>
					</div>
					<button type="submit" class="btn btn-success">Tambah Stok</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection