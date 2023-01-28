@extends('base')

@section('main')

<div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Ini detail tagihan nya kak.. </span>
            <ul class="list-group bg-white mb-2 mt-2">
		        <li class="list-group-item rounded-0">
			        Total Belanja
			        <span class="float-right">{{ $duitKeranjang }}</span>
		        </li>
		    </ul>
	     </div>
    </div>
</div>
<form method="post" action="{{ route('keranjang.bayar') }}" id="formAntar">
	@csrf
	
<div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> Pilih Metode Pengirimannya Kak</span>
	<ul class="list-group mb-2 mt-2">
		<li class="list-group-item rounded-0">
			<label for="cod">
				<h6>ANTAR</h6> <span class="text-muted">Diantar oleh kami</span>
			</label>
			<input class="float-right metode" type="radio" name="metode" value="cod" id="cod" required>
		</li>
		
		<!--
		<li class="list-group-item rounded-0">
			<label for="cod">
				<h6>COD</h6>
				<span class="text-muted">Alamat<br>{{ $toko->alamat_toko }}</span>
			</label>
			<input class="float-right metode" type="radio" name="metode" value="jemput" id="jemput">
		</li>
		
		
		<li class="list-group-item rounded-0">
			<label for="transfer">
				<h6>EXPEDISI</h6>
				<span class="text-muted">JNE,TIKI,POS</span>
			</label>
			<input class="float-right metode" type="radio" name="metode" value="kirim" id="kirim">
		</li>
		-->
	</ul>
	    </div>
    </div>
</div>

<div class="container pt-3 pb-3" id="detailKonsumen">
    <div class="chatbox">
        <div class="bodi">
        	<span class="tip tip-left"></span>
        	<span><img src="/img/smile.png"> Barang sedang kami siapkan, tulis Alamat Pengirimannya ya kak.. <i class="far fa-hand-point-down"></i></span>
		    <ul class="list-group mb-2 mt-2">
		    	<li class="list-group-item rounded-0 metode-kirim">
					<label>Pilih Provinsi</label>
					<select class="form-control provinsi" name="provinsi"><option value="">-Pilih-</option></select>
					<small><i class="text-info">Pilih provinsi dan kota jika ingin dikirimkan</i></small>
				</li>
				<li class="list-group-item rounded-0 metode-kirim">
					<label>Pilih Kabupaten/Kota</label>
					<select class="form-control kota" name="kota"><option value="">-Pilih-</option></select>
				</li>
				<li class="list-group-item rounded-0 metode-kirim">
					<label>Kode Pos</label>
					<input class="form-control" id="kodepos" type="text" name="kodepos">
				</li>
				<li class="list-group-item rounded-0">
					<label>Alamat Pengiriman *</label>
					<textarea class="form-control" id="alamat" name="alamat" required>{{ Auth::user()->alamat }}</textarea>
				</li>
				<li class="list-group-item rounded-0">
					<label>Nama Penerima *</label>
					<input class="form-control" type="text" name="nama" id="nama" value="{{ Auth::user()->nama }}" required>
				</li>
				<li class="list-group-item rounded-0">
					<label>Nomor Handphone *</label>
					<input class="form-control" type="text" name="nohp" id="nohp" value="{{ Auth::user()->nohp }}" required>
				</li>
			</ul>
        </div>
    </div>
</div>
	
	<div class="container pt-3 pb-4">
		<div class="pb-4">
			<p>Transfer pada salah satu bank dibawah ini :</p>
			@foreach($bank as $row)
				<div class="mb-1">
					<span>{{ $row->nama }}</span><br>
					<span>rekening : <b>{{ $row->norek }}</b></span><br>
					<span>atas nama : <b>{{ $row->atas_nama }}</b></span>
				</div>
			@endforeach
		</div>

	    <div class="chatbox">
	        <div class="bodi">
	        <span class="tip tip-left"></span>
	            <span><img src="/img/smile.png"> Jika sudah benar semua, Klik tombol dibawah kak.. <i class="far fa-hand-point-down"></i> , barang akan kami siapkan </span>
	        </div>
	    </div>
    </div>

	<div class="text-center pb-5">
		<button class="btn w-50 tombol rounded-0" type="submit">Order</button>
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