@extends('admin.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('newsAdmin.index') }}">News</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $news->judul }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">{{ $news->judul }}</div>
				<div class="card-body">
					{!! $news->isi !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection