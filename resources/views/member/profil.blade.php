@extends('base')

@section('main')
<div class="card rounded-0 mb-3">
	<div class="card-body">
		<h5 class="card-title">Profil</h5>
		<form method="post" action="{{ route('member.profilUpdate') }}">
			@csrf
			<div class="form-group">
				<label>Nohp</label>
				<input class="form-control" type="text" value="{{ Auth::user()->nohp }}" readonly>
			</div>
			<div class="form-group">
				<label>Nama</label>
				<input class="form-control" name="nama" type="text" value="{{ Auth::user()->nama }}" required>
				@if ($errors->has('nama'))
                    <span class="text-help" role="alert">
                        {{ $errors->first('nama') }}
                    </span>
                @endif
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat">{{ Auth::user()->alamat }}</textarea>
				@if ($errors->has('alamat'))
                    <span class="text-help" role="alert">
                        {{ $errors->first('alamat') }}
                    </span>
                @endif
			</div>

			<button type="submit" class="btn btn-block btn-success">Simpan</button>
		</form>
	</div>
</div>

<div class="card rounded-0 mb-3">
	<div class="card-body">
		<h5 class="card-title">Ubah Password</h5>
		<form method="post" action="{{ route('member.password') }}">
			@csrf
			<div class="form-group">
				<label>Password Baru</label>
				<input class="form-control" type="password" name="password" minlength="8">
				@if ($errors->has('password'))
                    <span class="text-help" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
			</div>
			<div class="form-group">
				<label>Konfirmasi Password baru</label>
				<input class="form-control" type="password" name="password_confirmation" minlength="8">
			</div>

			<button type="submit" class="btn btn-block btn-success">Ubah</button>
		</form>
	</div>
</div>
@endsection