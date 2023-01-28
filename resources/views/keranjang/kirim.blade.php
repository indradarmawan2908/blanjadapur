@extends('base')

@section('main')
<div class="container pt-3 pb-3 top">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Ini detail tagihan nya kak.. </span>
            <ul class="list-group bg-white mb-2 mt-2">
            	<li class="list-group-item rounded-0">
			        <b>Total Berat</b>
			        <span class="float-right">{{ number_format($berat/1000,2) }} kg</span>
		        </li>
		        <li class="list-group-item rounded-0">
			        <b>Total Belanja</b>
			        <span class="float-right">{{ $duitKeranjang }}</span>
		        </li>
		        <li class="list-group-item rounded-0">
			        <b>Ongkos Kirim</b>
			        <span class="float-right" id="ongkir">{{ rupiah(0) }}</span>
		        </li>
		        <li class="list-group-item rounded-0">
			        <b>Total Bayar
			        <span class="float-right" id="total" data-value="{{ $total }}">{{ rupiah($total) }}</span></b>
		        </li>
	        </ul>
        </div>
    </div>
</div>

<form method="post" action="{{ route('keranjang.bayar') }}">
	@csrf
	<input type="hidden" name="metode" value="kirim">
	<input type="hidden" name="paket" id="paket" value="">
<div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        	<span class="tip tip-left"></span>
        	<span><img src="/img/smile.png"> Barang sedang kami siapkan, lengkapi form ini ya kak.. <i class="far fa-hand-point-down"></i></span>
		    <ul class="list-group mb-2 mt-2">
		    	<?php $i = 1; ?>
		    	@foreach($ongkir as $k => $v)
		    	<li class="list-group-item rounded-0 bg-info">
					<h5>{{ $v[0]['name'] }}</h5>
				</li>
					@foreach($v[0]['costs'] as $k2 => $v2)
					<li class="list-group-item rounded-0">
						<label for="ongkir{{$i}}">
							{{ $v2['service'] }} - {{ $v2['description']}}<br>
							{{ rupiah($v2['cost'][0]['value']) }} - Perkiraan {{$v2['cost'][0]['etd']}} hari
						</label>
						<input class="float-right ongkir" data-paket="{{ $v2['service'] }} - {{ $v2['description']}}" type="radio" name="ongkir" value="{{$v2['cost'][0]['value']}}" id="ongkir{{$i}}" required>
					</li>
					<?php $i++; ?>
					@endforeach
				@endforeach
		    </ul>
		</div>
	</div>
</div>

<div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        	<span class="tip tip-left"></span>
        	<span><img src="/img/smile.png"> Pastikan alamatnya lengkap.. <i class="far fa-hand-point-down"></i></span>
		    <ul class="list-group mb-2 mt-2">
		        <li class="list-group-item rounded-0">
					<p>{{ $request->nama }}</p>
				</li>
				<li class="list-group-item rounded-0">
					<p>{{ $request->nohp }}</p>
				</li>
				<li class="list-group-item rounded-0">
					<p>{{ $request->alamat }}</p>
				</li>
		    	<li class="list-group-item rounded-0">
					<p>{{ $kota['type']." ".$kota['city_name'] }}</p>
					<input type="hidden" name="kota" value="{{ $request->kota }}">
					<input type="hidden" name="alamat" value="{{ $request->alamat }}">
					<input type="hidden" name="nama" value="{{ $request->nama }}">
					<input type="hidden" name="nohp" value="{{ $request->nohp }}">
					<input type="hidden" name="kodepos" value="{{ $request->kodepos }}">
				</li>
				<li class="list-group-item rounded-0">
					<p>Provinsi {{ $kota['province'] }}</p>
				</li>
				<li class="list-group-item rounded-0">
					<p>Kode Pos : {{ $request->kodepos }}</p>
				</li>
			</ul>
        </div>
    </div>
</div>
	
	<div class="container pt-3 pb-4">
		<div class="pb-4">
			<p>Setelah pemesanan silahkan lakukan transfer pada salah satu bank dibawah ini :</p>
			@foreach($bank as $row)
				<div class="mb-1">
					<span>{{ $row->nama }}</span><br>
					<span>rekening : {{ $row->norek }}</span><br>
					<span>atas nama : <b>{{ $row->atas_nama }}</b></span>
				</div>
			@endforeach
		</div>

	    <div class="chatbox">
	        <div class="bodi">
	        <span class="tip tip-left"></span>
	            <span><img src="/img/smile.png"> Jika sudah benar semua, Klik tombol dibawah kak.. <i class="far fa-hand-point-down"></i> , secepatnya barang akan kami antar </span>
	        </div>
	    </div>
    </div>

	<div class="text-center pb-5">
		<button class="btn w-50 tombol rounded-0" type="submit">Antar Sekarang</button>
	</div>
</form>

<ul class="list-group bg-white mb-3 mt-1">
	@foreach($isiKeranjang as $item)
	<li class="list-group-item rounded-0 clearfix">
		<div class="media">
			@if($item->gambar!='')
			<img class="media-left" width="80" src="{{ asset('img/produk/'.$item->gambar) }}">
			@else
			<img class="media-left" width="80" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND">
			@endif
			<div class="media-body pl-3">
				<h6 class="card-title">{{$item->nm_produk}}</h6>
				<p class="card-text">
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
			</div>
		</div>
	</li>
	@endforeach
</ul>

@endsection