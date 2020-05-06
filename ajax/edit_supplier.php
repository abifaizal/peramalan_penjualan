<?php 
	session_start();
	include "../koneksi.php";

	$no_supp = @mysqli_real_escape_string($conn, $_POST['no_supp']);
	$nama_supp = @mysqli_real_escape_string($conn, $_POST['nama_supp']);
	$nama_pet = @mysqli_real_escape_string($conn, $_POST['nama_pet']);
	$no_petugas = @mysqli_real_escape_string($conn, $_POST['no_petugas']);
	$alm_supp = @mysqli_real_escape_string($conn, $_POST['alm_supp']);

	$query = "UPDATE tbl_supplier SET nama_supp='$nama_supp', nama_pet='$nama_pet', nohp_pet='$no_petugas', alm_supp='$alm_supp' WHERE no_supp = '$no_supp'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>