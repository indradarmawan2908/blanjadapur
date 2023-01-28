@extends('admin.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('beranda.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Bank</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('banks.create') }}" class="btn btn-primary btn-sm mb-3">Bank Baru</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Bank</th>
									<th>Gambar</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($bank as $item)
								<tr>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->gambar }}</td>
									<td>
										<a href="{{ route('banks.edit',$item->id_bank) }}" class="btn btn-primary btn-sm">Edit</a>
										<a href="{{ route('banks.destroy',$item->id_bank) }}" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
										<form action="{{ route('banks.destroy',$item->id_bank) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $bank->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection