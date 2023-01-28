@extends('base')

@section('main')

<div class="container pt-3 pb-4">
    <div class="col-6">
        <a href="{{ route('index') }}" class="btn" style="position: fixed;left:0;z-index:9;"><b><i class="fa fa-arrow-circle-left" style="font-size:40px;color:#bfbfbf"></i></b></a>
    </div>
    <div class="chatbox">
        <div class="bodi" style="margin-left:65px">
        <span class="tip tip-left"></span>
            <span>Hasil pencarian kata kunci "{{ Request::get('cari') }}"..</span>
        </div>
    </div>
</div>

    <div class="container">
        <form class="mb-3">
			<input type="search" name="cari" placeholder="Cari produk..." class="form-control" value="{{ Request::get('cari') }}">
		</form>
		<div class="row mb-3">
		<?php
			//Columns must be a factor of 12 (1,2,3,4,6,12)
			$numOfCols = 2;
			$rowCount = 0;
			$bootstrapColWidth = 12 / $numOfCols;
		?>
			@forelse($produk as $item)
			<div class="col-6 mb-3">
				<a href="{{ action('ProdukController@show', [$item->id_produk, str_slug($item->nm_produk)]) }}">
					<div class="kotak" style="height:100%;">
						@if($item->gambar!='')
						<img src="{{ asset('img/produk/'.$item->gambar) }}" class="img-fluid">
						@else
						<img src="https://via.placeholder.com/100x100.png?text=IMAGE NOT FOUND" class="img-fluid">
						@endif
						<div>
							<h5 class="namaProduk">{{ $item->nm_produk }}</h5>
							<div>
								<!--<span>{{ $item->stok }} item</span><br>-->
								<span class="harga">{{ rupiah(($item->harga)) }} /<small>{{ $item->satuan }}</small></span>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php
		    $rowCount++;
		    if($rowCount % $numOfCols == 0) echo '</div><div class="row mb-3">';
		?>
			@empty
			<div class="container pt-3 pb-4">
            <div class="chatbox">
            <div class="bodi">
            <span class="tip tip-left"></span>
            <span><img src="https://kliker.id/img/sad.png"> maaf kak.. produknya belum ada</span>
            </div>
            </div>
            </div>
			@endforelse
		</div>
	</div>

@endsection