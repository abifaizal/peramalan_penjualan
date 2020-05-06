<?php 
	$conn = new mysqli("localhost", "root", "", "db_apt_margosaras");

	function tgl_indo($tgl) {
		$tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		if($bulan==1) {
			$bulan = "Jan";
		} else if($bulan==2) {
			$bulan = "Feb";
		} else if($bulan==3) {
			$bulan = "Mar";
		} else if($bulan==4) {
			$bulan = "Apr";
		} else if($bulan==5) {
			$bulan = "Mei";
		} else if($bulan==6) {
			$bulan = "Jun";
		} else if($bulan==7) {
			$bulan = "Jul";
		} else if($bulan==8) {
			$bulan = "Agu";
		} else if($bulan==9) {
			$bulan = "Sep";
		} else if($bulan==10) {
			$bulan = "Okt";
		} else if($bulan==11) {
			$bulan = "Nov";
		} else if($bulan==12) {
			$bulan = "Des";
		} 
		$tahun = substr($tgl,2,2);
		return $tanggal.'/'.$bulan.'/'.$tahun;		 
	}

	function bulan_indo($bulan) {
		if($bulan==1) {
			return "Januari";
		} else if($bulan==2) {
			return "Februari";
		} else if($bulan==3) {
			return "Maret";
		} else if($bulan==4) {
			return "April";
		} else if($bulan==5) {
			return "Mei";
		} else if($bulan==6) {
			return "Juni";
		} else if($bulan==7) {
			return "Juli";
		} else if($bulan==8) {
			return "Agustus";
		} else if($bulan==9) {
			return "September";
		} else if($bulan==10) {
			return "Oktober";
		} else if($bulan==11) {
			return "November";
		} else if($bulan==12) {
			return "Desember";
		} 
	}

	function periode($tgl) {
		$tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		if($bulan==1) {
			$bulan = "Januari";
		} else if($bulan==2) {
			$bulan = "Februari";
		} else if($bulan==3) {
			$bulan = "Maret";
		} else if($bulan==4) {
			$bulan = "April";
		} else if($bulan==5) {
			$bulan = "Mei";
		} else if($bulan==6) {
			$bulan = "Juni";
		} else if($bulan==7) {
			$bulan = "Juli";
		} else if($bulan==8) {
			$bulan = "Agustus";
		} else if($bulan==9) {
			$bulan = "September";
		} else if($bulan==10) {
			$bulan = "Oktober";
		} else if($bulan==11) {
			$bulan = "November";
		} else if($bulan==12) {
			$bulan = "Desember";
		} 
		$tahun = substr($tgl,0,4);
		return $bulan.' '.$tahun;		 
	}
 ?>