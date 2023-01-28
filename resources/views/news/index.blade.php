@extends('base')

@section('main')
<div class="container mt-3">
	<h5>News</h5>
	@forelse($news->sortByDesc('created_at') as $item)
	<div class="kotak mb-3 p-3">
		<a href="{{ route('newsToko.show',$item->id_news) }}">
			<div>
				{{ tgl_indo($item->created_at) }}<br>
				{{ $item->judul }}
			</div>
		</a>
	</div>
	@empty
	<div class="kotak mb-3 p-3">
		<p>Belum ada news terbaru.</p>
	</div>
	@endforelse
</div>
@endsection