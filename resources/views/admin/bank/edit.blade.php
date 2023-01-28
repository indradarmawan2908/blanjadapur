@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Kategori</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Edit</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('banks.update',$bank->id_bank) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nama">Nama Bank</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ $bank->nama }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="gambar">Gambar</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar" name="gambar">
									<label class="custom-file-label" for="gambar">Choose file</label>
								</div>
								<img src="" class="w-50" align="center">
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