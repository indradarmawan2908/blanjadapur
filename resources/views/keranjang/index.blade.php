@extends('base')

@section('main')

@if($keranjang==null)
Keranjang kosong
@else
	<?php $total=0; ?>
	<ul class="list-group bg-white">
        @if(session()->get('error'))
		<li class="list-group-item list-group-item-danger">
		{{ session()->get('error') }}  
		</li>
        @endif
        @if(session()->get('success'))
		<li class="list-group-item list-group-item-success">
		{{ session()->get('success') }}  
		</li>
        @endif
		<li class="list-group-item rounded-0">Total Pesanan ({{ count($isiKeranjang) }} item)</li>
		@foreach($isiKeranjang as $item)
		<li class="list-group-item rounded-0 clearfix">
			<?php $total = $total + ($item->harga-$item->diskon)*$item->jumlah; ?>
			<div class="media">
				@if($item->gambar!='')
				<img class="media-left" width="80" src="{{ asset('img/produk/'.$item->gambar) }}">
				@else
				<img class="media-left" width="80" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND">
				@endif
				<div class="media-body pl-3">
					<h6 class="card-title">{{$item->nm_produk}}</h6>
					<p class="card-text">
						@if($item->diskon > 0)
						<p class="lt">{{ rupiah($item->harga) }} /<small>{{ $item->satuan }}</small></p>
						@endif
						{{ rupiah($item->harga-$item->diskon) }} / <small>{{ $item->satuan }}</small> <br>
						Jumlah {{ $item->jumlah }}<br>
						{{ rupiah(($item->harga-$item->diskon)*$item->jumlah) }}
					</p>
				</div>
				<div class="media-right" style="width:30px;">
					<form action="{{ route('keranjang.destroy', $item->id_detail)}}" method="post">
	                  @csrf
	                  @method('DELETE')
	                  <button class="btn" type="submit"><i class="fa fa-trash"></i></button>
	                </form>
					<p style="padding-top: 25px; padding-bottom: 25px;"></p>
					<a href="{{ route('keranjang.edit', $item->id_detail) }}">Ubah</a>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
    
    @if(count($isiKeranjang) > 0)
	<div class="container pt-5 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png">Produk kakak sudah masuk keranjang, mau tambah lagi atau langsung di order kak ?</span>
        </div>
    </div>
    </div>
    @endif

	<div class="mb-3">
	<a href="{{ route('index') }}" class="mb-5 btn btn-secondary rounded-0 w-50" style="border:0;">+ Tambah barang</a>
	@if(count($isiKeranjang) > 0 && $total>=$toko->minOrder)
	<a href="{{ route('keranjang.antar') }}" class="mb-5 btn tombol rounded-0 w-50 float-right">Order</a>
	@endif
	</div>

	<div>
		<div class="alert alert-info">
			<p>Minimal order belanja {{ rupiah($toko->minOrder) }}</p>
		</div>
	</div>
@endif

@endsection