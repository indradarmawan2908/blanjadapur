@extends('admin.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Baru</li>
	  </ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			@if($errors->count() > 0)
                <div class="alert alert-warning" role="alert">
                @foreach($errors->all() as $item)
                	<p>{{ $item }}</p>
                @endforeach
                </div>
            @endif
			<form method="POST" action="{{ route('toko.store') }}" enctype="multipart/form-data">
			@csrf
				<div class="card mb-3">
					<div class="card-header">Profil Pengelola</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="namap">Email Pengelola</label>
								<input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="namap">Nama Pengelola</label>
								<input class="form-control" type="text" name="namap" id="namap" value="{{ old('namap') }}" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="kontakp">Kontak Pengelola</label>
								<input class="form-control" type="text" name="kontakp" id="kontakp" value="{{ old('kontakp') }}" onkeyup="nospaces(this)" required>
							</div>
							<!-- <div class="form-group col-md-6">
								<label for="alamatp">Alamat Pengelola</label>
								<input class="form-control" type="text" name="alamatp" id="alamatp" value="{{ old('alamatp') }}" required>
							</div> -->
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">Profil Toko</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="nama">Nama Toko</label>
								<input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
							</div>
							<div class="form-group col-md-4">
								<label for="kontak">Kontak Toko</label>
								<input class="form-control" type="text" name="kontak" id="kontak" value="{{ old('kontak') }}" onkeyup="nospaces(this)" required>
							</div>
							<div class="form-group col-md-4">
								<label for="alamat">Alamat Toko</label>
								<input class="form-control" type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">Akun Pengelola</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="username">Username</label>
								<input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text" name="username" id="username" value="{{ $errors->has('username') ? '' : old('username') }}" minlength="4" onkeyup="nospaces(this)" required>
							</div>
							<div class="form-group col-md-4">
								<label for="password">Password</label>
								<input class="form-control" type="password" name="password" id="password" minlength="8" onkeyup="nospaces(this)" required>
							</div>
							<div class="form-group col-md-4">
								<label for="passwordRe">Konfirmasi Password</label>
								<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" onkeyup="nospaces(this)" minlength="8" required>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">Aktifkan</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" name="aktifkan" id="aktifkan">
									<label class="form-check-label" for="aktifkan">Aktifkan</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Simpan</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
function nospaces(t){
  if(t.value.match(/\s/g)){
    t.value=t.value.replace(/\s/g,'');
  }
}
</script>
@endsection