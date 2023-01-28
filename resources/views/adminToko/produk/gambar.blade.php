@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $produk->nm_produk }} - Gambar</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			@if ($errors->any())
			    <div class="alert alert-danger mb-3">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="#" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#gambar">Gambar Baru</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Gambar</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($gambar as $item)
								<tr>
									<td><img src="{{ asset('img/produk/'.$item->gambar) }}" width="100"></td>
									<td>
										<a href="{{ route('produk.destroyGambar',$item->id_gambar) }}" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
										<form action="{{ route('produk.destroyGambar',$item->id_gambar) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="2" align="center">Tidak ada gambar</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="gambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form method="post" action="{{ route('produk.storeGambar',$produk->id_produk) }}" enctype="multipart/form-data">
      	@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Gambar Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-group">
         	<label for="gambarFile">Gambar</label>
			<input type="file" class="form-control" id="gambarFile" name="gambar[]" accept="image/jpeg" multiple="multiple" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection