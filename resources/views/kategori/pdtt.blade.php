@extends('base')

@section('main')

<div class="mb-1 pt-3 pb-1">
	<div class="container">
		<form method="get" action="{{ route('index.cari') }}">
			<input type="search" name="cari" class="form-control form-control-lg" placeholder="Cari Produk...">
		</form>
	</div>
</div>

<div class="container pt-3 pb-5">
    <div class="col-6">
        <a href="{{ route('index') }}" class="btn" style="position: fixed;left:0;z-index:9;"><b><i class="fa fa-arrow-circle-left" style="font-size:40px;color:#bfbfbf"></i></b></a>
    </div>
    <div class="chatbox">
        <div class="bodi" style="margin-left:65px">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Ini produk {{ strtolower($title) }} kak, silahkan dipilih.. <i class="far fa-hand-point-down"></i></span>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
	@forelse($produk as $item)
		<div class="col-6 mb-3">
			<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
				<div class="kotak" style="height:100%;">
					@if($item->gambar!='')
					<img src="{{ asset('img/produk/'.$item->gambar) }}" class="img-fluid">
					@else
					<img src="https://via.placeholder.com/100x100.png?text=IMAGE NOT FOUND" class="img-fluid">
					@endif
					@if($item->diskon > 0)
					<span class="diskon">{{ round(100 - (($item->harga-$item->diskon)/$item->harga*100)) }}%</span>
					@endif
					<div>
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
				</div>
			</a>
		</div>
	@empty
		<div class="col">
			Belum ada produk di {{strtolower($title)}}.
		</div>
	@endforelse
	</div>
	<div class="row">
		<div class="col-md-12">
			{{ $produk->onEachSide(0)->links() }}
		</div>
	</div>
</div>

@endsection