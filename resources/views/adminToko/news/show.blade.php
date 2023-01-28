@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $newsToko->judul }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">{{ $newsToko->judul }}<a href="{{ route('news.edit', $newsToko) }}" class="float-right text-primary">Ubah</a></div>
				<div class="card-body">
					{!! $newsToko->isi !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection