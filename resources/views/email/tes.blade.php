<div>
    
	Order dari : {{ $request->nama }}<br>
	Alamat : {{ $request->alamat }}<br>
	No Order : {{ nopesan(Auth::user()->id_toko,$request->id_order,$request->created_at) }}<br>
	Total Transaksi : <b>{{ rupiah($request->total) }}</b><br>
	Tanggal Orderan : {{ tgl_indo($request->created_at) }}
	<div><a href="https://api.whatsapp.com/send?phone=62{{$request->nohp}}&amp;text=Halo kak.." target="_blank"> <h6 style="color:#f6b20e; font-size:12px"><img src="http://pasarpedia.id/img/waicon.png"> Whatsapp </h6> </a> 
	</div><br>
	
	@foreach($request->detail($request->id_order) as $item)
	
		<div style="text-align:right; background-color:#dbf7e7; border:1px solid #d4e0f9; padding:8px;">
			@if($item->gambar!='')
			<img style="float:left; margin:0 8px 4px 0;" width="80" src="{{ asset('img/produk/'.$item->gambar) }}">
			@else
			<img style="float:left; margin:0 8px 4px 0;" width="80" src="https://via.placeholder.com/350x150.png?text=IMAGE NOT FOUND">
			@endif
			
				<h5>{{$item->nm_produk}}</h5>
				<p>
					{{ rupiah($item->harga-$item->diskon) }} / <small>{{ $item->satuan }}</small> <br>
					Jumlah {{ $item->jumlah }}<br>
					{{ rupiah(($item->harga-$item->diskon)*$item->jumlah) }}
				</p> <br>
		</div>
	
	@endforeach


</div>