<?php

if (! function_exists('tgl_indo')) {
	function tgl_indo($date , $tipe = 'full'){

		$date = explode(' ', $date);

		$tanggal = explode('-', $date[0]);
		$tanggal = $tanggal[2].' '.bulan($tanggal[1]).' '.$tanggal[0];
		if($tipe=="full"){
			$tanggal .= ' '.$date[1];
		}
		return $tanggal;
	}
}

if (! function_exists('bulan')) {
	function bulan($month){
		$namaBulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$bulan = $namaBulan[intval($month)];
		return $bulan;
	}
}

if (! function_exists('rupiah')) {
	function rupiah($pitih){
		$pitih = number_format($pitih,0,',','.');
		return "Rp ".$pitih;
	}
}

if (! function_exists('nopesan')){
	function nopesan($toko, $id, $tgl){
		$tanggal = explode(' ', $tgl);
		$tanggal = explode('-', $tanggal[0]);

		$nopesan = $toko.'-'.$tanggal[1].substr($tanggal[0],2).'-'.$id;

		return $nopesan;
	}
}