@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Edit</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{ route('toko.update',$toko->id_toko) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
				<div class="card mb-3">
					<div class="card-header">Profil Pengelola</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="namap">Email Pengelola</label>
								<input class="form-control" type="email" name="email" id="email" value="{{ $toko->email }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="namap">Nama Pengelola</label>
								<input class="form-control" type="text" name="namap" id="namap" value="{{ $toko->nm_pengelola }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="kontakp">Kontak Pengelola</label>
								<input class="form-control" type="text" name="kontakp" id="kontakp" value="{{ $toko->no_telp_pengelola }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="alamatp">Alamat Pengelola</label>
								<input class="form-control" type="text" name="alamatp" id="alamatp" value="{{ $toko->alamat_pengelola }}" required>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">Profil Toko</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="nama">Nama Toko</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ $toko->nm_toko }}" required>
							</div>
							<div class="form-group col-md-4">
								<label for="kontak">Kontak Toko</label>
								<input class="form-control" type="text" name="kontak" id="kontak" value="{{ $toko->no_telp_toko }}" required>
							</div>
							<div class="form-group col-md-4">
								<label for="alamat">Alamat Toko</label>
								<input class="form-control" type="text" name="alamat" id="alamat" value="{{ $toko->alamat_toko }}" required>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Simpan</button>
			</form>
		</div>
	</div>
</div>
@endsection