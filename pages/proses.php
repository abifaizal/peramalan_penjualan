<?php 
	include "../koneksi.php"; //koneksi ke database
	require '../asset/PHPExcel-1.8/Classes/PHPExcel.php'; //load PHPExcel Ver-1.8

	if(isset($_POST['import'])) { //menekan tombol import 
		$file = $_FILES['file']['name'];
		$ekstensi = explode(".", $file);
		$file_name = "file-".round(microtime(true)).".".end($ekstensi);
		$sumber = $_FILES['file']['tmp_name'];
		$target_dir = "../files/";
		$target_file = $target_dir.$file_name;
		move_uploaded_file($sumber, $target_file); 

		$obj = PHPExcel_IOFactory::load($target_file);
		$all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

		// echo $all_data[2]['C'];
		$sql = "INSERT INTO tbl_dataobat (kd_obat, nm_obat, exp_obat, ktg_obat, bnt_obat, sat_obat, hrg_obat, hrgbeli_obat, stk_obat, minstk_obat) VALUES";
		for($i=2; $i<=count($all_data); $i++) {
			$kode = $all_data[$i]['A'];
			$nama = $all_data[$i]['B'];
			$exp = $all_data[$i]['C'];
			$kategori = $all_data[$i]['D'];
			$bentuk = $all_data[$i]['E'];
			$satuan = $all_data[$i]['F'];
			$harga_jual = $all_data[$i]['G'];
			$harga_beli = $all_data[$i]['H'];
			$stok = $all_data[$i]['I'];
			$min_stok = $all_data[$i]['J'];
			$sql .= " ('$kode', '$nama', '$exp', '$kategori', '$bentuk', '$satuan', '$harga_jual', '$harga_beli', '$stok', '$min_stok'),";
		}
		$sql = substr($sql, 0, -1);
		mysqli_query($conn, $sql) or die ($conn->error); 

		unlink($target_file);

		echo "<script>window.location='../?page=dataobat';</script>";
	}
 ?>