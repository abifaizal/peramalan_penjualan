<?php 
	include "../koneksi.php";
	session_start();

	$no_faktur = $_POST['no_faktur'];
	$no_supplier = $_POST['no_supplier'];
	$tgl_pembelian = $_POST['tgl_pembelian'];
	$total_pembelian = $_POST['hidden_totalpembelian'];
	$cr_bayar = $_POST['cr_bayar'];
	if($cr_bayar=="Utang"){
		$status = "Belum Lunas";
		$tgl_lunas = "0000-00-00";
		$jth_tempo = $_POST['jth_tempo'];
	} else {
		$status = "Lunas";
		$tgl_lunas = $tgl_pembelian;
		$jth_tempo = "0000-00-00";
	}
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_pbl = "INSERT INTO tbl_pembelian (no_faktur, no_supplier, tgl_pembelian, cr_bayar, jth_tempo, total_pembelian, status_byr, tgl_lunas, id_peg) VALUES ('$no_faktur', '$no_supplier', '$tgl_pembelian', '$cr_bayar', '$jth_tempo', '$total_pembelian', '$status', '$tgl_lunas', '$id_pegawai')";
	mysqli_query($conn, $query_pbl) or die ($conn->error);

	for($i = 0; $i < count($_POST["hidden_kdobat"]); $i++) {
		$kd_obat = $_POST['hidden_kdobat'][$i];
		$hrg_beli = $_POST['hidden_hrgobat'][$i];
		$exp_obat = $_POST['hidden_expobat'][$i];
		$jml_obat = $_POST['hidden_jmlobat'][$i];
		$sat_jual = $_POST['hidden_satobat'][$i];
		$subtotal = $_POST['hidden_subtotal'][$i];
		$query_pbldtl = "INSERT INTO tbl_pembeliandetail (no_faktur, kd_obat, exp_obatbeli, hrg_beli, jml_beli, sat_beli, subtotal) VALUES ('$no_faktur', '$kd_obat', '$exp_obat', '$hrg_beli', '$jml_obat', '$sat_jual', '$subtotal')";
		mysqli_query($conn, $query_pbldtl) or die ($conn->error);

		$query_stok = "SELECT stk_obat, hrgbeli_obat FROM tbl_dataobat WHERE kd_obat = '$kd_obat'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama + $jml_obat;
		$harga = $data_stok['hrgbeli_obat'];
		if($stok_lama >= 0) {
			$harga = (($stok_lama*$harga)+($jml_obat*$hrg_beli))/($stok_lama+$jml_obat);
		}
		$harga_jual = $harga*1.20;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru', hrgbeli_obat = '$harga', hrg_obat = '$harga_jual' WHERE kd_obat='$kd_obat'";
		mysqli_query($conn, $query_estok) or die ($conn->error);

		$query_exp = "SELECT stok FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat' AND tgl_exp = '$exp_obat'";
		$sql_exp = mysqli_query($conn, $query_exp) or die ($conn->error);
		$rows_exp = mysqli_num_rows($sql_exp);
		if($rows_exp > 0) {
			$data_exp = mysqli_fetch_array($sql_exp);
			$stok_lamaexp = $data_exp['stok'];
			$stok_baruexp = $stok_lamaexp + $jml_obat;
			$query_updstokexp = "UPDATE tbl_stokexpobat SET stok='$stok_baruexp' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
			mysqli_query($conn, $query_updstokexp) or die ($conn->error);
		} else {
			$query_stokexp = "INSERT INTO tbl_stokexpobat (kd_obat, tgl_exp, stok) VALUES ('$kd_obat', '$exp_obat', '$jml_obat')";
			mysqli_query($conn, $query_stokexp) or die ($conn->error);
		}
	}
 ?>