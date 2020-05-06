<?php 
	include "../koneksi.php";
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	if(@$_GET['page']=='pegawai')
	{
		$query = "DELETE FROM tbl_pegawai WHERE id_peg = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='dataobat')
	{
		$query = "DELETE FROM tbl_dataobat WHERE kd_obat = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='supplier')
	{
		$query = "DELETE FROM tbl_supplier WHERE no_supp = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='kosongkan_stok')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$query_ksgstok = "UPDATE tbl_stokexpobat SET stok = '0' WHERE kd_obat = '$id' AND tgl_exp = '$exp'";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);

		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$id'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama - $stok;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$id'";
		mysqli_query($conn, $query_estok) or die ($conn->error);
	}

	if(@$_GET['page']=='datapenjualan')
	{
		// $query_pjldtl = "DELETE FROM tbl_penjualandetail WHERE no_penjualan = '$id'";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);
		$query_pjl = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$id'";
		mysqli_query($conn, $query_pjl) or die ($conn->error);
	}
	if(@$_GET['page']=='datapembelian')
	{
		// $query_pbldtl = "DELETE FROM tbl_pembeliandetail WHERE no_faktur = '$id'";
		// mysqli_query($conn, $query_pbldtl) or die ($conn->error);
		$query_pbl = "DELETE FROM tbl_pembelian WHERE no_faktur = '$id'";
		mysqli_query($conn, $query_pbl) or die ($conn->error);
	}
	if(@$_GET['page']=='riwayat_peramalan')
	{
		$query_peramalan = "DELETE FROM tbl_peramalan WHERE no_rml = '$id'";
		mysqli_query($conn, $query_peramalan) or die ($conn->error);
	}
 ?>