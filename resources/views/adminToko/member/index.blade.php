@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">MemberKu</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered datatable">
							<thead>
								<tr>
									<th>Terdaftar</th>
									<th>Nomor Handphone</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Total Pesanan</th>
									<th>Terakhir Pesan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@forelse($member as $item)
								<tr>
									<td>{{ $item->created_at }}</td>
									<td>{{ $item->nohp }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->alamat }}</td>
									<td class="text-right">{{ $item->jumlahOrder  }}</td>
									<td><?php echo $item->lastOrder?$item->lastOrder:'Belum order'; ?></td>
									<td>
										<a href="{{ route('memberku.show',$item->nohp) }}" class="btn btn-sm btn-primary">Detail</a>
										<a href="{{ route('memberku.edit',$item->nohp) }}" class="btn btn-sm btn-info">Ganti Password</a>
									</td>
								</tr>
							@empty
								<tr>
									<td class="text-center" colspan="6">Belum Ada Member</td>
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
@endsection