<?php 
	include '../koneksi.php';
	$ket_periode = "";
	$periode_lap = @$_POST['periode_lap'];
	$no_supp = @$_POST['nm_supplier'];
	$status_byr = @$_POST['status_pbl'];
	if($no_supp == "semua") {
		$no_supp = "%";
		$ket_supp = "Semua";
	} else {
		$ket_supp = $no_supp;
	}

	if($status_byr == "semua") {
		$status_byr = "%";
		$ket_status = "Semua";
	} else {
		$ket_status = $status_byr;
	}

	if($periode_lap == "hari_ini") {
		$ket_periode = date('d M Y');
		
	} else if($periode_lap == "bulan_ini") {
		$ket_periode = date('F Y');
		
	} else if($periode_lap == "tahun_ini") {
		$ket_periode = "tahun ".date('Y');
		
	} else if($periode_lap == "pertanggal") {
		$cek_tgl = @$_POST['tgl_akhir'];
		$tgl_awal = @$_POST['per_tanggal1'];
		if($cek_tgl == "yes") {
			$tgl_akhir = @$_POST['per_tanggal2'];
			$ket_periode = tgl_indo($tgl_awal)." sd ".tgl_indo($tgl_akhir);
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (tbl_pembelian.tgl_pembelian BETWEEN '$tgl_awal' AND '$tgl_akhir') AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.no_faktur ASC";
		} else {
			$ket_periode = tgl_indo($tgl_awal);
			
		}
	} else if($periode_lap == "perbulan") {
		$cek_bln = @$_POST['bulan_akhir'];
		$bulan1 = @$_POST['per_bulan1'];
		$tahunbulan1 = @$_POST['tahun_perbulan1'];
		if($cek_bln == "yes") {
			$bulan2 = @$_POST['per_bulan2'];
			$tahunbulan2 = @$_POST['tahun_perbulan2'];
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1." sd ".bulan_indo($bulan2)." ".$tahunbulan2;
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE ((MONTH(tbl_pembelian.tgl_pembelian) BETWEEN '$bulan1' AND '$bulan2') AND (YEAR(tbl_pembelian.tgl_pembelian) BETWEEN '$tahunbulan1' AND '$tahunbulan2')) AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.no_faktur ASC";
		} else {
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1;
			
		}
	} else if($periode_lap == "pertahun") {
		$cek_thn = @$_POST['tahun_akhir'];
		$per_tahun1 = @$_POST['per_tahun1'];
		if($cek_thn == "yes") {
			$per_tahun2 = @$_POST['per_tahun2'];
			$ket_periode = "tahun ".$per_tahun1." sd ".$per_tahun2;
			
		} else {
			$ket_periode = "tahun ".$per_tahun1;
			
		}
	}
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	$rows = mysqli_num_rows($sql);
	if($rows>0) {
		$status = "ada";
	} else {
		$status = "kosong";
	}
 ?>

<link type="text/css" href="./isi/style_css/laporan_pembelian2.css" rel="stylesheet">

<page backtop="2mm" backbottom="2mm" backleft="0mm" backright="3mm" style="font-size: 12px;">
	<page_header class="page_header">

	</page_header>
	<page_footer>

	</page_footer>
	<div class="page-content page-laporan-penjualan-detail">
		<div class="kotak-judul">
			<table class="tabel-judul">
				<tr>
					<td>
						<table class="tabel-keterangan-laporan">
							<tr>
								<td colspan="2" class="nama-laporan">LAPORAN PEMBELIAN</td>
							</tr>
							<tr>
								<td class="keterangan">Periode</td>
								<td class="isi-keterangan">: <?php echo $ket_periode; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Supplier</td>
								<td class="isi-keterangan">: <?php echo $ket_supp; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Status</td>
								<td class="isi-keterangan">: <?php echo $ket_status; ?></td>
							</tr>
						</table>
					</td>
					<td class="kolom-nama-apotek">
						<span class="nama-apotek">APOTEK MARGO SARAS</span><br>
						Jl. Kebon Agung, Mriyan Kulon, Margomulyo, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561 <br>
						(Telp) 0822-2775-5005
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php 
		if($status == "kosong") {
	 ?>
	 	<div class="data-kosong">
	 		Tidak terdapat data pembelian dengan kriteria tersebut
	 	</div>
	<?php } else {?>
		<div class="data-detail">
		</div>
		<?php 
			$id_pjl = 1;
			while($data_pbl = mysqli_fetch_array($sql)) {
				$no_faktur = $data_pbl['no_faktur'];
		 ?>
			<div>
				<table class="data-transaksi">
					<tr>
						<td rowspan="2" class="nomor_tran"><b><?php echo $id_pjl++; ?></b></td>
						<td>No Faktur</td>
						<td class="nofaktur">: <b>PBL0001</b></td>
						<td>Tanggal</td>
						<td class="tanggal">: <b>20/12/2019</b></td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td class="supplier">: <b>PT Medika Asih</b></td>
					</tr>
				</table>
			</div>
		<?php } ?>
	<?php } ?>
</page>