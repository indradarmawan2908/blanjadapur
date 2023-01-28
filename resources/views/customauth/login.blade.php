@extends('base')

@section('main')

<div class="container pt-3 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span>Login dulu sebelum belanja <i class="far fa-hand-point-down"></i></span>
        </div>
    </div>
</div>

<div class="container">
		<div class="card-body">
			
			<form method="POST" action="{{ route('login') }}">
				@csrf
				<input type="hidden" name="id_toko" value="{{ $toko->id_toko }}">
				<div class="form-group">
					<label for="nohp">Nomor Whatsapp</label>
					<input class="form-control" type="text" placeholder="" name="nohp" id="nohp" value="{{ old('nohp') }}" required autofocus>
					@if ($errors->has('nohp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nohp') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" placeholder="" name="password" id="password" required>
					@if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                </div>
                <button class="btn w-100" style="color: #fff; background-color: #ff1d00; border-color: #ff1d00" type="submit">LOGIN</button>
			</form>
		</div>
</div>

<div class="container pt-5 pb-3">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span>Kalo belum punya akun silahkan daftar.. gampang kok <img src="/img/smile.png"></span>
            <p class="text-center"> <a href="{{ route('register') }}"> DAFTAR </a> </p>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="chatbox">
        <div class="bodi">
        <span class="tip tip-left"></span>
            <span><img src="/img/smile.png"> lupa password ?.. chat ke admin aja ya</span>
            <a href="https://api.whatsapp.com/send?phone={{ $toko->call_center }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:18px" class="text-center pt-3"><i class="fab fa-whatsapp" style="font-size:35px"></i> Chat WA </h6>
  	        </a>
        </div>
    </div>
</div>

@endsection