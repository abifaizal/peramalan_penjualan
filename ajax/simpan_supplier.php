<?php 
	session_start();
	include "../koneksi.php";

	$nama_supp = @mysqli_real_escape_string($conn, $_POST['nama_supp']);
	$nama_pet = @mysqli_real_escape_string($conn, $_POST['nama_pet']);
	$no_petugas = @mysqli_real_escape_string($conn, $_POST['no_petugas']);
	$alm_supp = @mysqli_real_escape_string($conn, $_POST['alm_supp']);

	$query = "INSERT INTO tbl_supplier VALUES('', '$nama_supp', '$nama_pet', '$no_petugas', '$alm_supp')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>