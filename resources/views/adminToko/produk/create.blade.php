@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Baru</li>
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
					<form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nama">Nama Produk</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="kategori">Kategori</label>
								<select class="form-control" id="kategori" name="kategori" required>
									<option value="">-Pilih-</option>
									@foreach($kategori as $item)
										@if(old('kategori')==$item->id_ktg_produk)
										<option value="{{ $item->id_ktg_produk }}" selected>{{ $item->nm_ktg_produk }}</option>
										@else
										<option value="{{ $item->id_ktg_produk }}">{{ $item->nm_ktg_produk }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="gambar">Gambar Produk</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar" name="gambar" accept="image/jpeg" required>
									<label class="custom-file-label" for="gambar">Choose file</label>
								</div>
								<small class="text-help">Ukuran gambar tiap produk harus sama dan persegi. Contoh : 50x50 dalam pixel</small>
							</div>
							<div class="form-group col-md-6">
								<label for="deskripsi">Deskripsi</label>
								<textarea class="form-control summernote" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
								<small class="text-help">Dapat dikosongkan</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="satuan">Satuan</label>
								<select class="form-control" id="satuan" name="satuan" required>
									<option value="">-Pilih-</option>
								@foreach($satuan as $item)
									<option value="{{ $item->singkatan }}">{{ $item->satuan }} - {{ $item->singkatan }}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="stok">Stok</label>
								<input class="form-control" type="number" name="stok" id="stok" value="{{ old('stok') }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="modal">Modal</label>
								<input class="form-control" type="number" name="modal" id="modal" value="{{ old('modal') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="harga">Harga</label>
								<input class="form-control" type="number" name="harga" id="harga" value="{{ old('harga') }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="diskon">Diskon</label>
								<input class="form-control" type="number" name="diskon" id="diskon" value="{{ old('diskon') }}">
								<small class="text-help">Dapat dikosongkan</small>
							</div>
							<div class="form-group col-md-6">
								<label for="berat">Berat</label>
								<input class="form-control" type="number" name="berat" id="berat" value="{{ old('berat') }}" required>
								<small class="text-help">Dalam gram</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="gambarP">Gambar tambahan (isi jika memiliki gambar produk lebih banyak)</label>
								<input class="form-control" type="file" name="gambarP[]" id="gambarP" accept="image/jpeg" multiple="multiple">
								<small class="text-help">Ukuran gambar tiap produk harus sama dan persegi. Contoh : 50x50 dalam pixel</small>
							</div>
							<div class="col-md-6">
								<label>
									<input type="checkbox" name="promo" value="1"> Promo
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-sm btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection