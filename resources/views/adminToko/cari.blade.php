@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Cari {{ Request()->cari }}</li>
	  </ol>
	</nav>

	<div class="card mb-3">
		<div class="card-header">Hasil Pencarian Produk</div>
		<div class="card-body">
			<p>Ditemukan data sebanyak : {{ $produk->count() }} data</p>
			@if($produk->count() >0)
			<ol>
				@foreach($produk as $item)
				<li>{{ $item->nm_produk }}</li>
				@endforeach
			</ol>
			@endif
		</div>
	</div>

	<div class="card mb-3">
		<div class="card-header">Hasil Pencarian Member</div>
		<div class="card-body">
			<p>Ditemukan data sebanyak : {{ $member->count() }} data</p>
			@if($member->count() >0)
			<ol>
				@foreach($member as $item)
				<li><a href="{{ route('memberku.show',$item->nohp) }}">{{ $item->nohp }} - {{ $item->nama }}</a></li>
				@endforeach
			</ol>
			@endif
		</div>
	</div>

	<div class="card mb-3">
		<div class="card-header">Hasil Pencarian Order</div>
		<div class="card-body">
			<p>Ditemukan data sebanyak : {{ $order->count() }} data</p>
			@if($order->count() >0)
			<ol>
				@foreach($order as $item)
				<li><a href="{{ route('orderan.show',$item->id_order) }}">#{{ $item->id_order }} - {{ $item->nama }} - {{ $item->total }}</a></li>
				@endforeach
			</ol>
			@endif
		</div>
	</div>
</div>
@endsection