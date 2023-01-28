@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('memberku.index') }}">MemberKu</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $member->nohp }}</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="get" action="" class="form-inline float-right">
						<input class="form-control date" type="text" name="from" id="from" value="{{ $date1 }}" placeholder="Mulai" required autocomplete="off">
						<input class="form-control date" type="text" name="until" id="until" value="{{ $date2 }}" placeholder="Sampai" required autocomplete="off">
						<button class="btn btn-success btn-lg" type="submit">Telusuri</button>
					</form>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No Orderan</th>
									<th>Tanggal Pemesanan</th>
									<th>Status</th>
									<th>Jumlah Item</th>
									<th>Total Harga</th>
								</tr>
							</thead>
							<tbody>
							@forelse($order as $item)
								<tr>
									<td>{{ nopesan(Auth::guard('toko')->id(),$item->id_order,$item->created_at) }}</td>
									<td>{{ $item->created_at }}</td>
									<td>{{ ucfirst($item->status) }}</td>
									<td class="text-right">{{ $item->jumlahItem($item->id_order)->count() }}</td>
									<td class="text-right">{{ rupiah($item->total) }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center">Belum Ada Transaksi</td>
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