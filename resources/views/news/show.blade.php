@extends('base')

@section('main')
<div class="container mt-3">
	<a href="{{ route('newsToko.index') }}" class="mb-3"><i class="fa fa-angle-left"></i> Kembali</a>
	<div class="report p-1 mt-2">
	    <div class="isi">
		{{ tgl_indo($newsToko->created_at) }}<br>
		{{ $newsToko->judul }}
		<p>{!! $newsToko->isi !!}</p>
		</div>
	</div>
</div>
@endsection