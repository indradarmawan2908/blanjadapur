@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('satuan.index') }}">Satuan</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Edit</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('satuan.update',$satuan->id_satuan) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nama">Nama Satuan</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ $satuan->satuan }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="nama">Nama Singkatan</label>
								<input class="form-control" type="text" name="singkatan" id="singkatan" value="{{ $satuan->singkatan }}" required>
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