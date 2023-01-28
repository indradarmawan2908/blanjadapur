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
					<form method="POST" action="{{ route('bank.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="bank">Bank</label>
								<select class="form-control" name="bank" id="bank" required>
									<option value="">Pilih</option>
									@foreach($bank as $item)
									<option value="{{ $item->id_bank }}">{{ $item->nama }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="nama">Atas Nama</label>
								<input type="text" name="nama" id="nama" class="form-control" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="norek">Nomor Rekening</label>
								<input type="text" name="norek" id="norek" class="form-control" required>
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