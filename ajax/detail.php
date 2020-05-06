<?php 
	include '../koneksi.php';

	if(@$_GET['page']=='penjualan') {
		$no_pjl = @mysqli_real_escape_string($conn, $_GET['no_pjl']);
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_penjualandetail.hrg_jual, tbl_penjualandetail.jml_jual, tbl_penjualandetail.sat_jual, tbl_penjualandetail.subtotal FROM tbl_penjualandetail INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_penjualandetail.no_penjualan = '$no_pjl'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	} 
	else if(@$_GET['page']=='pembelian') {
		$no_faktur = @mysqli_real_escape_string($conn, $_GET['no_faktur']);
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_pembeliandetail.hrg_beli, tbl_pembeliandetail.jml_beli, tbl_pembeliandetail.sat_beli, tbl_pembeliandetail.subtotal FROM tbl_pembeliandetail INNER JOIN tbl_dataobat ON tbl_pembeliandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_pembeliandetail.no_faktur = '$no_faktur'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		$data = array();

		while($detail=mysqli_fetch_array($sql_lihat)) {
			$data[] = $detail;
		}
		echo json_encode($data);
	}
	else if(@$_GET['page']=='pelunasan_pembelian') {
		$no_faktur = @mysqli_real_escape_string($conn, $_POST['no_faktur']);
		// $no_faktur = "tesss";
		$tgl_lunas = date('Y-m-d');
		$query_lunas = "UPDATE tbl_pembelian SET status_byr = 'Lunas', tgl_lunas = '$tgl_lunas' WHERE no_faktur = '$no_faktur'";
		mysqli_query($conn, $query_lunas) or die ($conn->error);
	}
	else if(@$_GET['page']=='expstok_obat') {
		$kd_obat = @mysqli_real_escape_string($conn, $_GET['kd_obat']);
		$query_expstok = "SELECT * FROM tbl_stokexpobat WHERE kd_obat = '$kd_obat'";
		$sql_expstok = mysqli_query($conn, $query_expstok) or die ($conn->error);
		$data_expstok = array();

		while($data = mysqli_fetch_array($sql_expstok)) {
			$data_expstok[] = $data;
		}

		echo json_encode($data_expstok);
	}
 ?>