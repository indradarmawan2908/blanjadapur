@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Bank</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Baru</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('banks.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nama">Nama Bank</label>
								<input class="form-control" type="text" name="nama" id="nama" required>
							</div>
							<div class="form-group col-md-6">
								<label for="gambar">Gambar</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar" name="gambar" required>
									<label class="custom-file-label" for="gambar">Choose file</label>
								</div>
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