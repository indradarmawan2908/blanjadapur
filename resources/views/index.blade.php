@extends('base')

@section('main')
<div class="">
	<!-- Slider main container -->
	<div class="slide swiper-container">
	    <!-- Additional required wrapper -->
	    <div class="swiper-wrapper">
	        <!-- Slides -->
	        @foreach($slide as $item)
	        <div class="swiper-slide mt-1"><img class="img-fluid" style="border-radius:10px" src="{{ asset('img/slide/'.$item->gambar) }}"></div>
			@endforeach
	    </div>
	</div>
</div>
<!--
<div class="container pt-2">
    <div class="chatbox">
        <div class="bodi">
            <span>Selamat Datang di ALLOZ </span>
            <a href="https://api.whatsapp.com/send?phone={{ $toko->call_center }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:15px" class="text-center pt-3"><i class="fab fa-whatsapp" style="font-size:25px"></i> Chat WA </h6>
  	        </a>
        </div>
    </div>
</div>
-->
<div class="mb-4 pt-3">
	<div class="container">
		<form method="get" action="{{ route('index.cari') }}">
			<input type="search" name="cari" class="form-control form-control-lg" placeholder="Cari Produk...">
		</form>
	</div>
</div>

@if(count($ktg_produk) > 0)
<div class="container">
	<div class="category mb-3">
		<h6><mark style="background-color: #DCF8C6; padding-right: 10px;">Kategori</mark></h6>
	<?php
		//Columns must be a factor of 12 (1,2,3,4,6,12)
		$numOfCols = 3;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
	?>
		<div class="row">
			@foreach($ktg_produk as $kategori)
			<a class="col-4" href="{{ action('KategoriController@show', [$kategori->id_ktg_produk, str_slug($kategori->nm_ktg_produk)]) }}">
				<center>
				<div class="boxx">
					@if($kategori->gambar!='')
					<img src="{{ asset('img/kategori/'.$kategori->gambar) }}" class="img-fluid" style="width:50%; border-radius: 80%;">
					@else
					<img src="https://via.placeholder.com/100x100.png?text=IMAGE NOT FOUND" class="img-fluid" style="border-radius: 80%;">
					@endif
					<div class="namaProduk mb-2" style="font-size:13px">{{ $kategori->nm_ktg_produk }}</div>
				</div>
				</center>
			</a>
	<?php
	    $rowCount++;
	    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
	?>
			@endforeach
		</div>
	</div>
</div>
@endif

@if(count($produk->where('promo',1)) > 0)
<div class="container">
	<div class="product-selection mb-3">
		<a href="{{ route('kategori.promo') }}" class="float-right">Selengkapnya <i class="fa fa-angle-right"></i></a>
		<h6 ><mark style="background-color: #fee800; padding-right: 15px; padding-left: 15px; border-radius: 0px 10px 0 10px;">Promo</mark></h6>
		<!-- Slider main container -->
		<div class="slide2 swiper-container">
		    <!-- Additional required wrapper -->
		    <div class="swiper-wrapper">
		        <!-- Slides -->
		        @foreach($produk->where('promo',1)->take(20) as $item)
		        <div class="swiper-slide">
		        	<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				        @if($item->gambar!='')
				        <img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}">
				        @else
				        <img class="img-fluid" src="https://via.placeholder.com/350x250.png?text=Image+not+found">
				        @endif
				        @if($item->diskon > 0)
						<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
						@endif
				        <div class="p-2">
					        <h5 class="namaProduk">{{ $item->nm_produk }}</h5>
					        <div>
					        	<!--<span>{{ $item->stok }} item</span><br>-->
					        	@if($item->diskon > 0)
					        	<span class="harga lt">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	<span class="harga">{{ rupiah($item->harga-$item->diskon) }}</span>
					        	@else
					        	<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	@endif
					        </div>
				        </div>
				    </a>
			    </div>
				@endforeach
		    </div>
		</div>
	</div>
</div>
<hr>
@endif

@if(count($produk->where('diskon','>',0)) > 0)
<div class="container">
	<div class="product-selection mb-3">
		<a href="{{ route('kategori.diskon') }}" class="float-right">Selengkapnya <i class="fa fa-angle-right"></i></a>
		<h6 ><mark style="background-color: #fee800; padding-right: 15px; padding-left: 15px; border-radius: 0px 10px 0 10px;">Produk Diskon</mark></h6>
		<div class="slide2 swiper-container">
		    <!-- Additional required wrapper -->
		    <div class="swiper-wrapper">
		        @foreach($produk->where('diskon','>','0')->sortByDesc('diskon')->take(20) as $item)
		        <div class="swiper-slide">
		        	<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				        @if($item->gambar!='')
				        <img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}">
				        @else
				        <img class="img-fluid" src="https://via.placeholder.com/350x250.png?text=Image+not+found">
				        @endif
				        @if($item->diskon > 0)
						<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
						@endif
				        <div class="p-2">
					        <h5 class="namaProduk">{{ $item->nm_produk }}</h5>
					        <div>
					        	<!--<span>{{ $item->stok }} item</span><br>-->
					        	@if($item->diskon > 0)
					        	<span class="harga lt">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	<span class="harga">{{ rupiah($item->harga-$item->diskon) }}</span>
					        	@else
					        	<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	@endif
					        </div>
				        </div>
				    </a>
			    </div>
				@endforeach
		    </div>
		</div>
	</div>
</div>
<hr>
@endif

@if(count($produk) > 0)
<div class="container">
	<div class="product-selection mb-3">
		<a href="{{ route('kategori.terbaru') }}" class="float-right">Selengkapnya <i class="fa fa-angle-right"></i></a>
		<h6 ><mark style="background-color: #fee800; padding-right: 15px; padding-left: 15px; border-radius: 0px 10px 0 10px;">Produk Terbaru</mark></h6>
		<div class="slide2 swiper-container">
		    <!-- Additional required wrapper -->
		    <div class="swiper-wrapper">
		        @foreach($produk->sortByDesc('created_at')->take(12) as $item)
		        <div class="swiper-slide">
		        	<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				        @if($item->gambar!='')
				        <img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}">
				        @else
				        <img class="img-fluid" src="https://via.placeholder.com/350x250.png?text=Image+not+found">
				        @endif
				        @if($item->diskon > 0)
						<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
						@endif
				        <div class="p-2">
					        <h5 class="namaProduk">{{ $item->nm_produk }}</h5>
					        <div>
					        	<!--<span>{{ $item->stok }} item</span><br>-->
					        	@if($item->diskon > 0)
					        	<span class="harga lt">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	<span class="harga">{{ rupiah($item->harga-$item->diskon) }}</span>
					        	@else
					        	<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	@endif
					        </div>
				        </div>
				    </a>
			    </div>
				@endforeach
		    </div>
		</div>
	</div>
</div>
<hr>
@endif

@foreach($ktg_produk as $kategori)
<div class="container">
	<div class="product-categories mb-3">
		<a href="{{ action('KategoriController@show', [$kategori->id_ktg_produk, str_slug($kategori->nm_ktg_produk)]) }}" class="float-right">Selengkapnya <i class="fa fa-angle-right"></i></a>
		<h6 class="mb-3" ><mark style="background-color: #fbf3ae; padding-right: 15px; padding-left: 15px; border-radius: 0px 10px 0 10px;">{{ $kategori->nm_ktg_produk }}</mark></h6>
		<div class="slide2 swiper-container">
		    <!-- Additional required wrapper -->
		    <div class="swiper-wrapper">
		        <!-- Slides -->
		        @forelse($produk->where('id_ktg_produk', $kategori->id_ktg_produk)->sortByDesc('created_at')->take(12) as $item)
		        <div class="swiper-slide">
		        	<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				        @if($item->gambar!='')
				        <img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}">
				        @else
				        <img class="img-fluid" src="https://via.placeholder.com/350x250.png?text=Image+not+found">
				        @endif
				        @if($item->diskon > 0)
						<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
						@endif
				        <div class="p-2">
					        <h5 class="namaProduk">{{ $item->nm_produk }}</h5>
					        <div>
					        	<!--<span>{{ $item->stok }} item</span><br>-->
					        	@if($item->diskon > 0)
					        	<span class="harga lt">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	<span class="harga">{{ rupiah($item->harga-$item->diskon) }}</span>
					        	@else
					        	<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	@endif
					        </div>
				        </div>
			        </a>
			    </div>
			    @empty
			    <div>Belum ada produk</div>
				@endforelse
		    </div>
		</div>
	</div>
</div>
@if ($loop->last)
<hr style="display: none;">
@else
<hr>
@endif
@endforeach

<hr>
@if(count($produk->where('terjual','>',0)) >0)
<div class="container">
	<div class="product-selection mb-3">
		<a href="{{ route('kategori.terlaris') }}" class="float-right">Selengkapnya <i class="fa fa-angle-right"></i></a>
		<h6 ><mark style="background-color: #fbf3ae; padding-right: 15px; border-radius: 10px 60px 0 10px;">Produk Terlaris</mark></h6>
		<div class="slide2 swiper-container">
		    <!-- Additional required wrapper -->
		    <div class="swiper-wrapper">
		        <!-- Slides -->
		        @foreach($produk->where('terjual','>',0)->sortByDesc('terjual')->take(12) as $item)
		        <div class="swiper-slide">
		        	<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				        @if($item->gambar!='')
				        <img class="img-fluid" src="{{ asset('img/produk/'.$item->gambar) }}">
				        @else
				        <img class="img-fluid" src="https://via.placeholder.com/350x250.png?text=Image+not+found">
				        @endif
				        @if($item->diskon > 0)
						<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
						@endif
				        <div class="p-2">
					        <h5 class="namaProduk">{{ $item->nm_produk }}</h5>
					        <div>
					        	<!--<span>{{ $item->stok }} item</span><br>-->
					        	@if($item->diskon > 0)
					        	<span class="harga lt">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	<span class="harga">{{ rupiah($item->harga-$item->diskon) }}</span>
					        	@else
					        	<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span><br>
					        	@endif
					        </div>
				        </div>
				    </a>
			    </div>
				@endforeach
		    </div>
		</div>
	</div>
</div>
<hr>
@endif

@endsection