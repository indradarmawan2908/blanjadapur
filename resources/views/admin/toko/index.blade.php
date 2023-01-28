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
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('toko.create') }}" class="btn btn-primary btn-sm mb-3" data-toggle="tooltip" title="Tambah toko baru">Toko Baru <i class="fa fa-plus"></i></a>
						<table class="table table-bordered datatable">
							<thead>
								<tr>
									<th>Nama Toko</th>
									<th>Status</th>
									<th>Pengelola</th>
									<th>Username</th>
									<th>Terdaftar</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($toko as $item)
								<tr>
									<td>{{ $item->nm_toko }}</td>
									<?php
										$mulai = $item->aktif;
										$oneYearOn = strtotime(date('Y-m-d H:i:s',strtotime($mulai . " + 1 year")));
										$now = time();
										$datediff = round(($oneYearOn - $now) / (60 * 60 * 24));
										if($datediff < 0){
											$datediff = 0;
										}
									?>
									@if($item->status>0 && $datediff > 0)
									<td>Aktif<br>{{ $item->aktif }}<br>{{$datediff}} hari tersisa</td>
									@else
									<td>Tidak Aktif</td>
									@endif
									<td>{{ $item->nm_pengelola }}<br>{{ $item->no_telp_pengelola }}</td>
									<td>{{ $item->email }}<br>{{ $item->username }}</td>
									<td>{{ $item->created_at }}</td>
									<td>
										<a href="{{ route('toko.show',$item->id_toko) }}" data-toggle="tooltip" class="btn btn-info btn-sm" title="Detail toko"><i class="fa fa-search"></i></a>
										<a href="{{ route('toko.edit',$item->id_toko) }}" data-toggle="tooltip" class="btn btn-primary btn-sm" title="Edit toko"><i class="fa fa-edit"></i></a>
										<a href="{{ route('toko.destroy',$item->id_toko) }}" data-toggle="tooltip" class="btn btn-danger btn-sm btn-hapus" title="Hapus toko"><i class="fa fa-trash"></i></a>
										<form action="{{ route('toko.destroy',$item->id_toko) }}" method="post" style="display: none;">
										@csrf
										@method('DELETE')
										</form>
										<a href="{{ route('toko.login',$item->id_toko) }}" data-toggle="tooltip" class="btn btn-sm btn-warning" target="_blank" title="Masuk ke admin toko"><i class="fa fa-folder"></i></a>
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