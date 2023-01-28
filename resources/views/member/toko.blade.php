@extends('base')

@section('main')
<ul class="list-group mt-3 mb-3">
  	<li class="list-group-item bg-white mb-3 rounded-0">
  		<h6 style="font-weight: bold;">Profil Toko</h6>
  	</li>
  	<li class="list-group-item bg-white rounded-0">
  		<h6 style="font-weight: bold;">Alamat Toko :</h6>
  		<p>{{ $toko->alamat_toko }}</p>
  	</li>
  	<li class="list-group-item bg-white rounded-0">
  		<h6 style="font-weight: bold;">Contact :</h6>
  		<p>{{ $toko->call_center }}</p>
  		<a href="https://api.whatsapp.com/send?phone={{ $toko->call_center }}&amp;text=Halo.." target="_blank"> <h6 style="color:#f6b20e; font-size:18px" class="pt-1"><i class="fab fa-whatsapp" style="font-size:35px"></i> Chat WA </h6>
  	    </a>
  	</li>
  	<li class="list-group-item bg-white rounded-0">
  		<h6 style="font-weight: bold;">Jadwal Buka : <?php $nmHari = array(0=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'); if($toko->jadwal_buka){ $jadwal = unserialize($toko->jadwal_buka); $jadwal = $jadwal->sortKeys(); $jadwal->all(); }else{ $jadwal = collect(); } ?></h6>
  	</li>
  	@forelse($jadwal as $key => $hari)
  	<li class="list-group-item bg-white rounded-0">
  		<span>{{ $nmHari[$key] }}</span><br>
  		<span>Jam : 
  		@if($hari['buka']<10)
  			{{ $hari['buka'] }}:00
  		@else
  			0{{ $hari['buka'] }}:00
  		@endif
  			- 
  		@if($hari['tutup']<10)
  			{{ $hari['tutup'] }}:00
  		@else
  			0{{ $hari['tutup'] }}:00
  		@endif
  	</li>
  	@empty
  	<li class="list-group-item bg-white rounded-0">Belum ada jadwal</li>
  	@endforelse
</ul>
@endsection