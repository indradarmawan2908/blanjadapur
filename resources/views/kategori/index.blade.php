@extends('base')

@section('main')

<div class="mb-3 pt-3 pb-3">
	<div class="container">
		<form method="get" action="{{ route('index.cari') }}">
			<input type="search" name="cari" class="form-control form-control-lg" placeholder="Cari Produk...">
		</form>
	</div>
</div>

@if(count($ktg_produk) > 0)
<div class="container">
	<div class="category mb-3">
		<h6><mark>Kategori</mark></h6>
	<?php
		//Columns must be a factor of 12 (1,2,3,4,6,12)
		$numOfCols = 3;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
	?>
		<div class="row">
			@foreach($ktg_produk as $kategori)
			<a class="col-4" href="{{ action('KategoriController@show', [$kategori->id_ktg_produk, str_slug($kategori->nm_ktg_produk)]) }}">
				<div class="box">
					@if($kategori->gambar!='')
					<img src="{{ asset('img/kategori/'.$kategori->gambar) }}" class="img-fluid" style="border-radius: 50%;">
					@else
					<img src="https://via.placeholder.com/100x100.png?text=IMAGE NOT FOUND" class="img-fluid" style="border-radius: 50%;">
					@endif
					<div class="namaProduk" style="font-size:13px">{{ $kategori->nm_ktg_produk }}</div>
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
<hr>
@endif

@endsection