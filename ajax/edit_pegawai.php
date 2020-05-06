<?php 
	session_start();
	include "../koneksi.php";

	$username = @mysqli_real_escape_string($conn, $_POST['username']);
	$id = @mysqli_real_escape_string($conn, $_POST['id']);

	$query_validasi = "SELECT id_peg FROM tbl_pegawai WHERE username = '$username' AND id_peg != '$id'";
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

		$query = "UPDATE tbl_pegawai SET nama_peg = '$nama', alamat_peg = '$alamat', hp_peg = '$no_hp', jk_peg = '$jk', lhr_peg = '$tgl_lahir', pos_peg = '$posisi', username = '$username', password = '$password' WHERE id_peg = '$id'";
		$sql = mysqli_query($conn, $query) or die ($conn->error);
		if($sql) {
			if($_SESSION['id_peg']==$id) {
				$_SESSION['nama_peg'] = $nama;
				$_SESSION['username_peg'] = $username;
			}
			echo "berhasil";
		} else {
			echo "gagal";
		}
	}
 ?>