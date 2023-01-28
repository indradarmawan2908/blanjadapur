@extends('base')

@section('main')

<div style="position: relative;">
	<a href="{{ url()->previous() }}" class="btn" style="position: fixed;left:0;z-index:9;"><b><i class="fa fa-arrow-circle-left" style="font-size:40px;color:#bfbfbf"></i></b></a>
	<!-- Slider main container -->
	<div class="slide swiper-container">
	    <!-- Additional required wrapper -->
	    <div class="swiper-wrapper">
	        <!-- Slides -->
	        @if($produk->gambar!='')
			<div class="swiper-slide"><img class="img-fluid" src="{{ asset('img/produk/'.$produk->gambar) }}"></div>
			@else
			<div class="swiper-slide"><img class="img-fluid" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND"></div>
			@endif
	        @foreach($gambar as $item)
	        <div class="swiper-slide"><img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}"></div>
			@endforeach
	    </div>
	</div>
</div>
<div class="text-center">
	@if($produk->stok < 1)
	Tidak ada stok tersisa
	@else
	Tersisa {{$produk->stok}} item
	@endif
</div>

<div class="container pt-2 pb-1">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <h5>Nama Produk : {{ $produk->nm_produk }} </h5>
            @if($produk->diskon > 0)
            <p class="lt">Harga : {{ rupiah($produk->harga) }} /<small>{{ $produk->satuan }}</small></p>
            <p>Harga : {{ rupiah($produk->harga-$produk->diskon) }} /<small>{{ $produk->satuan }}</small></p>
			@else
			<p>Harga : {{ rupiah($produk->harga) }} /<small>{{ $produk->satuan }}</small></p>
			@endif
        </div>
    </div>
</div>

    <div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Berapa banyak yang kakak butuhkan ?</span>
        </div>
    </div>
    </div>

<div class="mt-1 p-3">
	<form class="beli mb-3" method="post" action="{{ route('keranjang.store') }}">
		@csrf
		<input type="hidden" name="produk" value="{{ $produk->id_produk }}">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button type="button" class="btn btn-outline-primary tmbPM" data-pm="minus">-</button>
			</div>
			<input id="jumlah" name="jumlah" data-harga="{{$produk->harga-$produk->diskon}}" type="number" class="form-control" min="1" max="{{$produk->stok}}" value="1" readonly required>
			<div class="input-group-prepend">
				<button type="button" class="btn btn-outline-primary tmbPM" data-pm="plus">+</button>
				<span class="input-group-text">{{ $produk->satuan }}</span>
			</div>
		</div>
		<div class="form-group">
			<label>Total</label>
			<input class="form-control" type="text" name="total" id="total" value="{{ ($produk->harga-$produk->diskon)*1 }}" readonly>
		</div>
		<div class="text-right">
			<button type="submit" class="btn w-50 tombol">Beli <i class="fa fa-shopping-cart"></i></button>
		</div>
	</form>
</div>
<div class="mt-1 p-3 mb-3 bg-white">
	<h6>Deskripsi Produk</h6>
	<p>{!! $produk->deskripsi !!}</p>
	<a href="https://api.whatsapp.com/send?phone={{ $toko->call_center }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:18px" class="text-center pt-3"><i class="fab fa-whatsapp" style="font-size:35px"></i> Chat WA </h6>
  	</a>
</div>

@endsection