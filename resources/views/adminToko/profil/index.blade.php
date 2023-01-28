@extends('adminToko.base')

@section('main')
<div class="container mt-3 mb-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Profil</li>
	  </ol>
	</nav>

	<div class="row mb-3">
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header">TEMA WARNA TOKO</div>
				<div class="card-body">
					<form action="{{ route('profil.update',0) }}" method="post">
						@csrf
						@method('PUT')
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Header</label>
								<div class="input-group colorpicker-component cPicker">
									<input type="text" value="{{ $profil->header ? $profil->header : '#343a40' }}" name="header" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label>Icon Bottom Navbar</label>
								<div class="input-group colorpicker-component cPicker">
									<input type="text" value="{{ $profil->icon ? $profil->icon : '#3490dc' }}" name="icon" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label>Text Nama Produk</label>
								<div class="input-group colorpicker-component cPicker">
									<input type="text" value="{{ $profil->nama_produk ? $profil->nama_produk : '#3490dc' }}" name="nama" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Text Harga Produk</label>
								<div class="input-group colorpicker-component cPicker">
									<input type="text" value="{{ $profil->harga_produk ? $profil->harga_produk : '#3490dc' }}" name="harga" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label>Semua Tombol</label>
								<div class="input-group colorpicker-component cPicker">
									<input type="text" value="{{ $profil->tombol ? $profil->tombol : '#2fa360' }}" name="tombol" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header">Status Layanan</div>
				<div class="card-body">
					<form action="{{ route('profil.update',1) }}" method="post">
						@csrf
						@method('PUT')
						<p>Status - {{ $profil->status ? 'Aktif' : 'NonAktif' }}</p>
						@if($profil->status > 0)
						<p>Aktif sejak {{ $profil->aktif }} - 
						<?php
							$mulai = $profil->aktif;
							$oneYearOn = strtotime(date('Y-m-d H:i:s',strtotime($mulai . " + 1 year")));
							$now = time();
							$datediff = round(($oneYearOn - $now) / (60 * 60 * 24));
							if($datediff < 0){
								$datediff = 0;
							}

							echo "tersisa ".$datediff." hari";
						?>
						</p>
						@endif
						@if($profil->perpanjang > 0)
						<p>Sudah mengajukan perpanjangan</p>
						@else
						<button type="submit" class="btn btn-success">Perpanjang</button>
						@endif
					</form>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header">Minimal Order</div>
				<div class="card-body">
					<form action="{{ route('profil.update',5) }}" method="post">
					@csrf
					@method('PUT')
						<div class="form-group">
							<label>Minimal Order</label>
							<input class="form-control" type="number" name="minOrder" id="minOrder" value="{{ $profil->minOrder }}">
						</div>
						<button type="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Profil Toko</div>
				<div class="card-body">
					<form action="{{ route('profil.update',2) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label>Upload Logo</label>
							<input class="form-control" type="file" name="logo" accept="image/jpeg">
							<small class="text-help">Disarankan tinggi dan lebarnya sama. Contoh : 300X300 dalam pixel.</small>
						</div>
						<div class="form-group">
							<label>Nama Toko</label>
							<input class="form-control" type="text"value="{{ $profil->nm_toko }}" readonly>
						</div>
						<div class="form-group">
							<label>No Telfon Toko</label>
							<input class="form-control" type="text" name="kontak" id="kontak" value="{{ $profil->no_telp_toko }}">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamat" id="alamat">{{ $profil->alamat_toko }}</textarea>
						</div>
						<div class="form-group">
							<label>Whatsapp</label> <small class="text-help">(Masukan Nomor Whatsapp dengan kode <b>62</b>, contoh : 628137212345)</small>
							<input class="form-control" type="text" name="callcenter" id="callcenter" value="{{ $profil->call_center }}">
						</div>
						<div class="form-group">
							<label>Ongkos Kirim</label>
							<input class="form-control" type="number" name="ongkir" id="ongkir" value="{{ $profil->ongkir }}">
						</div>
						<button type="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php $jadwal = unserialize($profil->jadwal_buka); ?>
			<div class="card">
				<div class="card-header">Hari dan Jam Buka</div>
				<div class="card-body">
					<small class="text-help">Berikan centang untuk hari buka.</small>
					<form action="{{ route('profil.update',3) }}" method="post">
						@csrf
						@method('PUT')
						<table class="table">
							<thead>
								<tr>
									<th>Hari</th>
									<th>Buka</th>
									<th>Tutup</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							@if($jadwal)
								@foreach($hari as $item => $row)
								<tr>
									<td>{{ $row }}</td>
									<td>
										<select class="form-control" name="jam{{ $item }}Buka">
										@for ($i = 1; $i <= 24; $i++)
											@if($i<10)
												@if($jadwal->get($item)['buka']==$i)
												<option value="{{ $i }}" selected>0{{ $i }}:00</option>
												@else
												<option value="{{ $i }}">0{{ $i }}:00</option>
												@endif
											@else
												@if($jadwal->get($item)['buka']==$i)
												<option value="{{ $i }}" selected>{{ $i }}:00</option>
												@else
												<option value="{{ $i }}">{{ $i }}:00</option>
												@endif
											@endif
										@endfor
										</select>
									</td>
									<td>
										<select class="form-control" name="jam{{ $item }}Tutup">
										@for ($i = 1; $i <= 24; $i++)
											@if($i<10)
												@if($jadwal->get($item)['tutup']==$i)
												<option value="{{ $i }}" selected>0{{ $i }}:00</option>
												@else
												<option value="{{ $i }}">0{{ $i }}:00</option>
												@endif
											@else
												@if($jadwal->get($item)['tutup']==$i)
												<option value="{{ $i }}" selected>{{ $i }}:00</option>
												@else
												<option value="{{ $i }}">{{ $i }}:00</option>
												@endif
											@endif
										@endfor
										</select>
									</td>
									@if($jadwal->has($item))
									<td><input type="checkbox" name="buka{{ $item }}" checked></td>
									@else
									<td><input type="checkbox" name="buka{{ $item }}"></td>
									@endif
								</tr>
								@endforeach
							@else
								@foreach($hari as $item => $row)
								<tr>
									<td>{{ $row }}</td>
									<td>
										<select class="form-control" name="jam{{ $item }}Buka">
										@for ($i = 1; $i <= 24; $i++)
											@if($i<10)
												<option value="{{ $i }}">0{{ $i }}:00</option>
											@else
												<option value="{{ $i }}">{{ $i }}:00</option>
											@endif
										@endfor
										</select>
									</td>
									<td>
										<select class="form-control" name="jam{{ $item }}Tutup">
										@for ($i = 1; $i <= 24; $i++)
											@if($i<10)
												<option value="{{ $i }}">0{{ $i }}:00</option>
											@else
												<option value="{{ $i }}">{{ $i }}:00</option>
											@endif
										@endfor
										</select>
									</td>
									<td><input type="checkbox" name="buka{{ $item }}"></td>
								</tr>
								@endforeach
							@endif
							</tbody>
						</table>
						<button type="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header">Profil Pengelola</div>
				<div class="card-body">
					<form action="{{ route('profil.update',4) }}" method="post">
					@csrf
					@method('PUT')
						<div class="form-group">
							<label>Email Pengelola (untuk menerima laporan)</label>
							<input class="form-control" type="email" value="{{ $profil->email }}" readonly>
						</div>
						<div class="form-group">
							<label>Nama Pengelola</label>
							<input class="form-control" type="text" value="{{ $profil->nm_pengelola }}" readonly>
						</div>
						<div class="form-group">
							<label>Kontak Pengelola</label>
							<input class="form-control" type="text" name="kontak" value="{{ $profil->no_telp_pengelola }}">
						</div>
						<div class="form-group">
							<label>Alamat Pengelola</label>
							<textarea class="form-control" name="alamat">{{ $profil->alamat_pengelola }}</textarea>
						</div>
						<div class="form-group">
							<label>Pilih Provinsi</label>
							<select class="form-control provinsi" name="provinsi"><option value="">-Pilih-</option></select>
						</div>
						<div class="form-group">
							<label>Pilih Kabupaten/Kota</label>
							<select class="form-control kota" name="kota"><option value="">-Pilih-</option></select>
						</div>
						<button type="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection