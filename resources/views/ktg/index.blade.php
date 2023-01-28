@extends('base')

@section('main')

<div class="container pt-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="img/smile.png"> Halo kakak.. silahkan pilih Kategori dibawah <i class="far fa-hand-point-down"></i></span>
        </div>
    </div>
</div>

<div class="mb-3 pt-3 pb-3">
	<div class="container">
		<form method="get" action="{{ route('index.cari') }}">
			<input type="search" name="cari" class="form-control form-control-lg" placeholder="Cari Produk...">
		</form>
	</div>
</div>

@if(count($ktg_produk) > 0)
<div class="container">
	<div class="category mb-4">
		<h6><mark style="background-color: #fbf3ae; padding-right: 15px; padding-left: 15px; border-radius: 0px 10px 0 10px;">Kategori</mark></h6>
	<?php
		//Columns must be a factor of 12 (1,2,3,4,6,12)
		$numOfCols = 3;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
	?>
		<div class="row">
			@foreach($ktg_produk as $kategori)
			<a class="col-4" href="{{ action('KategoriController@show', [$kategori->id_ktg_produk, str_slug($kategori->nm_ktg_produk)]) }}">
				<div class=" mb-1" style="border: 1px solid #ccc; border-radius: 15px; text-align:center">
					@if($kategori->gambar!='')
					<img src="{{ asset('img/kategori/'.$kategori->gambar) }}" style="width: 40%; margin-top:2px">
					@else
					<img src="https://via.placeholder.com/100x100.png?text=IMAGE NOT FOUND" style="width: 40%; margin-top:2px">
					@endif
					<div class="namaProduk" style="font-size:13px; margin-bottom:2px">{{ $kategori->nm_ktg_produk }}</div>
				</div>
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

@endsection