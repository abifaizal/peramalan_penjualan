<?php 
	session_start();
	include "../koneksi.php";

	$username = @mysqli_real_escape_string($conn, $_POST['username']);

	$query_validasi = "SELECT id_peg FROM tbl_pegawai WHERE username = '$username'";
	$sql_validasi = mysqli_query($conn, $query_validasi) or die ($conn->error);
	$hasil_validasi = mysqli_fetch_array($sql_validasi);
	if($hasil_validasi) {
		echo "gagal-username";
	}else {
		$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
		$posisi = @mysqli_real_escape_string($conn, $_POST['posisi']);
		$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
		$alamat = @mysqli_real_escape_string($conn, $_POST['alamat']);
		$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
		$password = @mysqli_real_escape_string($conn, $_POST['password']);
		$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
		$tgl_masuk = date('Y-m-d');

		$tahun = substr($tgl_lahir, 2, 2);
		$bulan = substr($tgl_lahir, 5, 2);
		$hari = substr($tgl_lahir, 8, 2);
		$tgl = $tahun.$bulan.$hari;

		if($posisi=="Admin") {
			$pos = "ADM";
		} else if($posisi=="Manager") {
			$pos = "MNG";
		} else if($posisi=="Apoteker") {
			$pos = "APT";
		} else if($posisi=="Kasir") {
			$pos = "KSR";
		}

		$query_id = "SELECT id_peg FROM tbl_pegawai WHERE pos_peg='$posisi' ORDER BY id_peg DESC";
		$sql_id = mysqli_query($conn, $query_id) or die ($conn->error);
		$data_id = mysqli_fetch_array($sql_id);
		if($data_id) {
			$indeks = substr($data_id[0], 3, 2);
			$no_indeks = (int) $indeks;
			$no_indeks = $no_indeks + 1;
			$id = $pos.str_pad($no_indeks, 2, "0", STR_PAD_LEFT).$tgl;
		} else {
			$id = $pos."01".$tgl;
		}

		$query = "INSERT INTO tbl_pegawai VALUES('$username', '$password', '$id', '$nama', '$alamat', '$no_hp', '$jk', '$tgl_lahir', '$tgl_masuk', '$posisi')";
		$sql = mysqli_query($conn, $query) or die ($conn->error);
		if($sql) {
			echo "berhasil";
		} else {
			echo "gagal";
		}
	}
 ?>