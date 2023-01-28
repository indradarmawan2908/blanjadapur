@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Satuan</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('satuan.create') }}" class="btn btn-primary btn-sm mb-3">Satuan Baru</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Satuan</th>
									<th>Singkatan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($satuan as $item)
								<tr>
									<td>{{ $item->satuan }}</td>
									<td>{{ $item->singkatan }}</td>
									<td>
										<a href="{{ route('satuan.edit',$item->id_satuan) }}" class="btn btn-primary btn-sm">Edit</a>
										<a href="{{ route('satuan.destroy',$item->id_satuan) }}" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
										<form action="{{ route('satuan.destroy',$item->id_satuan) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $satuan->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection