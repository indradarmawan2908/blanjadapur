@extends('base')

@section('main')

<div>
	@if($produk->gambar!='')
	<img class="w-100" src="{{ asset('img/produk/'.$produk->gambar) }}">
	@else
	<img class="w-100" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND">
	@endif
</div>
<div class="text-center">
	@if($produk->stok < 1)
	Tidak ada stok tersisa
	@else
	Tersisa {{$produk->stok}} item
	@endif
</div>
<div class="mt-1 p-3 bg-white">
	<form class="beli mb-3" method="post" action="{{ route('keranjang.ubah', $produk->id_detail) }}">
		@method('POST')
		@csrf
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button type="button" class="btn btn-outline-primary tmbPM" data-pm="minus">-</button>
			</div>
			<input id="jumlah" name="jumlah" data-harga="{{$produk->harga}}" type="number" class="form-control" min="1" max="{{$produk->stok}}" value="{{$produk->jumlah}}" readonly required>
			<div class="input-group-prepend">
				<button type="button" class="btn btn-outline-primary tmbPM" data-pm="plus">+</button>
				<span class="input-group-text">{{ $produk->satuan }}</span>
			</div>
		</div>
		<div class="form-group">
			<label>Total</label>
			<input class="form-control" type="text" name="total" id="total" value="{{ $produk->harga*1 }}" readonly>
		</div>
		<button type="submit" class="btn btn-block tombol">Ubah <i class="fa fa-shopping-cart"></i></button>
	</form>
</div>

@endsection