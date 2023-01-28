@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Edit</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('produk.update',$produk->id_produk) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nama">Nama Produk</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ $produk->nm_produk }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="kategori">Kategori</label>
								<select class="form-control" id="kategori" name="kategori" required>
									<option value="">-Pilih-</option>
									@foreach($kategori as $item)
										@if($produk->id_ktg_produk==$item->id_ktg_produk)
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
									<input type="file" class="custom-file-input" id="gambar" name="gambar" accept="image/jpeg">
									<label class="custom-file-label" for="gambar">Choose file</label>
								</div>
								<small class="text-help">Ukuran gambar tiap produk harus sama dan persegi. Contoh : 50x50 dalam pixel</small>
							</div>
							<div class="form-group col-md-6">
								<label for="deskripsi">Deskripsi</label>
								<textarea class="form-control summernote" id="deskripsi" name="deskripsi">{!! $produk->deskripsi !!}</textarea>
								<small class="text-help">Dapat dikosongkan</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="satuan">Satuan</label>
								<select class="form-control" id="satuan" name="satuan" required>
									<option value="">-Pilih-</option>
								@foreach($satuan as $item)
									@if($produk->satuan==$item->singkatan)
									<option value="{{ $item->singkatan }}" selected>{{ $item->satuan }} - {{ $item->singkatan }}</option>
									@else
									<option value="{{ $item->singkatan }}">{{ $item->satuan }} - {{ $item->singkatan }}</option>
									@endif
								@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="diskon">Diskon</label>
								<input class="form-control" type="number" name="diskon" id="diskon" value="{{ $produk->diskon }}">
								<small class="text-help">Dapat dikosongkan</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="modal">Modal</label>
								<input class="form-control" type="number" name="modal" id="modal" value="{{ $produk->modal }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="harga">Harga</label>
								<input class="form-control" type="number" name="harga" id="harga" value="{{ $produk->harga }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="berat">Berat</label>
								<input class="form-control" type="number" name="berat" id="berat" value="{{ old('berat') }}" required>
								<small class="text-help">Dalam gram</small>
							</div>
							<div class="col-md-6">
								<label>
									<input type="checkbox" name="promo" value="1" @if($produk->promo>0) checked @endif> Promo
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-success btn-sm">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection