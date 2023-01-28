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
				<div class="card-header">Ganti Password</div>
				<div class="card-body">
					<form action="{{ route('memberku.update', $member->id_member) }}" method="post">
					@csrf
					@method('PUT')
						<div class="form-group">
							<label>Password Baru</label>
							<input class="form-control" type="password" name="password" required min="6">
						</div>
						<div class="form-group">
							<label>Konfirmasi Password Baru</label>
							<input class="form-control" type="password" name="password_confirmation" required min="6">
						</div>
						<button type="submit" class="btn btn-success">Konfirmasi</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection