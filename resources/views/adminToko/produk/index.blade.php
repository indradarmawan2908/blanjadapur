@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Produk</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm mb-3">Produk Baru</a>
						<table class="table table-bordered datatable_produk">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>Promo</th>
									<th>Satuan</th>
									<th>Gambar</th>
									<th>Kategori</th>
									<th>Modal</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Harga Akhir</th>
									<th>Stok</th>
									<th>Created</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($produk as $item)
								<tr>
									<td>{{ $item->nm_produk }}</td>
									<td>@if($item->promo>0) Promo @else Tidak @endif</td>
									<td>{{ $item->satuan }}</td>
									<td><img src="{{ asset('img/produk/'.$item->gambar) }}" width="100"></td>
									<td>{{ $item->getKategori($item->id_ktg_produk)->nm_ktg_produk }}</td>
									<td class="text-right">{{ rupiah($item->modal) }}</td>
									<td class="text-right">{{ rupiah($item->harga) }}</td>
									<td class="text-right">{{ rupiah($item->diskon) }}</td>
									<td class="text-right">{{ rupiah($item->harga-$item->diskon) }}</td>
									<td class="text-right">{{ $item->stok }}</td>
									<td class="text-right">{{ $item->created_at }}</td>
									<td>
										<a href="{{ route('produk.gambar',$item->id_produk) }}" data-toggle="tooltip" title="Gambar produk" class="btn btn-primary btn-sm"><i class="fa fa-images"></i></a>
										<a href="{{ route('produk.stok',$item->id_produk) }}" data-toggle="tooltip" title="Stok produk" class="btn btn-info btn-sm"><i class="fa fa-warehouse"></i></a>
										<a href="{{ route('produk.edit',$item->id_produk) }}" data-toggle="tooltip" title="Edit produk" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a href="{{ route('produk.destroy',$item->id_produk) }}" data-toggle="tooltip" title="Hapus produk" class="btn btn-danger btn-sm btn-hapus"><i class="fa fa-trash"></i></a>
										<form action="{{ route('produk.destroy',$item->id_produk) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('.datatable_produk').dataTable({
	"order": [[ 10, "desc" ]]
});
</script>
@endsection