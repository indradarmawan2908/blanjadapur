@extends('admin.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('newsAdmin.index') }}">News</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Baru</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			@if($errors->count() > 0)
                <div class="alert alert-warning" role="alert">
                @foreach($errors->all() as $item)
                	<p>{{ $item }}</p>
                @endforeach
                </div>
            @endif
			<form method="POST" action="{{ route('newsAdmin.store') }}" enctype="multipart/form-data">
			@csrf
				<div class="card mb-3">
					<div class="card-header">Form News Baru</div>
					<div class="card-body">
						<div class="form-group">
							<label for="judul">Judul</label>
							<input class="form-control" type="text" name="judul" id="judul" value="{{ old('judul') }}" required>
						</div>
						<div class="form-group">
							<label for="alamatp">Isi</label>
							<textarea class="form-control" type="text" name="isi" id="isi" required>{{ old('isi') }}</textarea>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" name="tampil" id="tampil">
								<label class="form-check-label" for="tampil">Tampil</label>
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