@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Bank</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('bank.create') }}" class="btn btn-primary btn-sm mb-3">Bank Baru</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Bank</th>
									<th>Atas Nama</th>
									<th>Nomor Rekening</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($bankToko as $item)
								<tr>
									<td>{{ $bank->find($item->id_bank)['nama'] }}</td>
									<td>{{ $item->atas_nama }}</td>
									<td>{{ $item->norek }}</td>
									<td>
										<a href="{{ route('bank.edit',$item->id_bank_toko) }}" class="btn btn-primary btn-sm">Edit</a>
										<a href="{{ route('bank.destroy',$item->id_bank_toko) }}" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
										<form action="{{ route('bank.destroy',$item->id_bank_toko) }}" method="post">
										@csrf
										@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					{{ $bankToko->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection