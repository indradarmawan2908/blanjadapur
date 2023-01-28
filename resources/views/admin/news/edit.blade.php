@extends('admin.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('newsAdmin.index') }}">News</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
			<form method="POST" action="{{ route('newsAdmin.update',$news->id_news) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
				<div class="card mb-3">
					<div class="card-header">Form News Edit</div>
					<div class="card-body">
						<div class="form-group">
							<label for="judul">Judul</label>
							<input class="form-control" type="text" name="judul" id="judul" value="{{ $news->judul }}" required>
						</div>
						<div class="form-group">
							<label for="alamatp">Isi</label>
							<textarea class="form-control" type="text" name="isi" id="isi" required>{{ $news->isi }}</textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Simpan</button>
			</form>
		</div>
	</div>
</div>
@endsection