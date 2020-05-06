<?php 
	session_start();
	include "../koneksi.php";

	$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
	$nama = strtoupper($nama);
	$ktg = @mysqli_real_escape_string($conn, $_POST['ktg']);
	$bentuk = @mysqli_real_escape_string($conn, $_POST['bentuk']);
	$satuan = @mysqli_real_escape_string($conn, $_POST['satuan']);
	$harga = @mysqli_real_escape_string($conn, $_POST['harga']);
	$harga_jual = $harga*1.20;
	$min_stok = @mysqli_real_escape_string($conn, $_POST['min_stok']);
	$exp = @mysqli_real_escape_string($conn, $_POST['exp']);
	$stok = @mysqli_real_escape_string($conn, $_POST['stok']);

	$query = "INSERT INTO tbl_dataobat (kd_obat, nm_obat, ktg_obat, bnt_obat, sat_obat, hrg_obat, hrgbeli_obat, stk_obat, minstk_obat) VALUES('$kode', '$nama', '$ktg', '$bentuk', '$satuan', '$harga_jual', '$harga', '$stok', '$min_stok')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);

	$query_stok = "INSERT INTO tbl_stokexpobat (kd_obat, tgl_exp, stok) VALUES ('$kode', '$exp', '$stok')";
	$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);

	if($sql && $sql_stok) {
		echo "tersimpan";
	} else {
		echo "gagal";
	}
 ?>