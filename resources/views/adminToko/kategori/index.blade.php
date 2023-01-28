@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm mb-3">Kategori Baru</a>
						<h6><font size="2">* Untuk membuat Kategori/Group guna mengelompokkan produk</font></h6>
						<h6><font size="2">* Ukuran gambar tiap kategori harus sama dan persegi. Contoh : 50x50 dalam pixel</font></h6>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Kategori</th>
									<th>Gambar</th>
									<th>Produk</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($kategori as $item)
								<tr>
									<td>{{ $item->nm_ktg_produk }}</td>
									<td><img src="{{ asset('img/kategori/'.$item->gambar) }}" width="100"></td>
									<td class="text-right">{{ $item->produk($item->id_ktg_produk)->count() }}</td>
									<td>
										<a href="{{ route('kategori.show',$item->id_ktg_produk) }}" data-toggle="tooltip" class="btn btn-info btn-sm" title="Produk"><i class="fa fa-warehouse"></i></a>
										<a href="{{ route('kategori.edit',$item->id_ktg_produk) }}" data-toggle="tooltip" class="btn btn-info btn-sm" title="Edit Kategori"><i class="fa fa-edit"></i></a>
										<a href="{{ route('kategori.destroy',$item->id_ktg_produk) }}" data-toggle="tooltip" class="btn btn-info btn-sm btn-hapus" title="Hapus Kategori"><i class="fa fa-trash"></i></a>
										<form action="{{ route('kategori.destroy',$item->id_ktg_produk) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $kategori->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection