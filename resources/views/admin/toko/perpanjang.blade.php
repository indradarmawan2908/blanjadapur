@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Toko</li>
	  </ol>
	</nav>

	@if(session()->get('success'))
    <div class="alert alert-success">
    	{{ session()->get('success') }}  
	</div>
    @endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Daftar Pengajuan Perpanjangan Toko</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Toko</th>
									<th>Pengelola</th>
									<th>Pengajuan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($toko as $item)
								<tr>
									<td><a href="{{ route('toko.show',$item->id_toko) }}" data-toggle="tooltip" title="Detail toko">{{ $item->nm_toko }}</a></td>
									<td>{{ $item->nm_pengelola }}<br>{{ $item->no_telp_pengelola }}</td>
									<td>{{ tgl_indo($item->tgl_pengajuan) }}</td>
									<td>
										<a href="{{ route('toko.aktifkan',$item->id_toko) }}" class="btn btn-success btn-submit" data-msg="Aktikan toko ini?" data-toggle="tooltip" title="Aktifkan"><i class="fa fa-check"></i></a>
										<form action="{{ route('toko.aktifkan',$item->id_toko) }}" method="post" style="display: none;">
										@csrf
										@method('PUT')
										</form>
										<a href="{{ route('toko.batalkan',$item->id_toko) }}" class="btn btn-danger btn-submit" data-msg="Batalkan pengajuan toko ini?" data-toggle="tooltip" title="Batalkan"><i class="fa fa-times"></i></a>
										<form action="{{ route('toko.batalkan',$item->id_toko) }}" method="post" style="display: none;">
										@csrf
										@method('PUT')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $toko->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection