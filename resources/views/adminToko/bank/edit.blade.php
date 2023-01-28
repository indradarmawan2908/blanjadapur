@extends('adminToko.base')

@section('main')

<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('bank.index') }}">Bank</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Baru</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('bank.update', $bankToko->id_bank_toko) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="bank">Bank</label>
								<select class="form-control" name="bank" id="bank" readonly>
									<option value="">Pilih</option>
									@foreach($bank as $item)
									@if($item->id_bank==$bankToko->id_bank)
									<option value="{{ $item->id_bank }}" selected>{{ $item->nama }}</option>
									@else
									<option value="{{ $item->id_bank }}">{{ $item->nama }}</option>
									@endif
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="nama">Atas Nama</label>
								<input type="text" name="nama" id="nama" class="form-control" value="{{ $bankToko->atas_nama }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="norek">Nomor Rekening</label>
								<input type="text" name="norek" id="norek" class="form-control" value="{{ $bankToko->norek }}" required>
							</div>
						</div>
						<button type="submit" class="btn btn-sm btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection