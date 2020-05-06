<?php 
	include '../koneksi.php';
	$ket_periode = "";
	$periode_lap = @$_POST['periode_lap'];
	$no_supp = @$_POST['nm_supplier'];
	$query_nmsupp = "SELECT nama_supp FROM tbl_supplier WHERE no_supp = '$no_supp'";
	$sql_nmsupp = mysqli_query($conn, $query_nmsupp) or die ($conn->error);
	$data_nmsupp = mysqli_fetch_array($sql_nmsupp);
	$ket_supp = $data_nmsupp['nama_supp'];
	$status_byr = @$_POST['status_pbl'];
	if($no_supp == "semua") {
		$no_supp = "%";
		$ket_supp = "Semua";
	}

	if($status_byr == "semua") {
		$status_byr = "%";
		$ket_status = "Semua";
	} else {
		$ket_status = $status_byr;
	}

	if($periode_lap == "hari_ini") {
		$ket_periode = date('d M Y');
		$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE tbl_pembelian.tgl_pembelian = CURDATE() AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr  LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
	} else if($periode_lap == "bulan_ini") {
		$ket_periode = date('F Y');
		$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (MONTH(tbl_pembelian.tgl_pembelian) = MONTH(CURDATE()) AND YEAR(tbl_pembelian.tgl_pembelian) = YEAR(CURDATE())) AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr  LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
	} else if($periode_lap == "tahun_ini") {
		$ket_periode = "tahun ".date('Y');
		$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE YEAR(tbl_pembelian.tgl_pembelian) = YEAR(CURDATE()) AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr  LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
	} else if($periode_lap == "pertanggal") {
		$cek_tgl = @$_POST['tgl_akhir'];
		$tgl_awal = @$_POST['per_tanggal1'];
		if($cek_tgl == "yes") {
			$tgl_akhir = @$_POST['per_tanggal2'];
			$ket_periode = tgl_indo($tgl_awal)." sd ".tgl_indo($tgl_akhir);
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (tbl_pembelian.tgl_pembelian BETWEEN '$tgl_awal' AND '$tgl_akhir') AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
		} else {
			$ket_periode = tgl_indo($tgl_awal);
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE tbl_pembelian.tgl_pembelian = '$tgl_awal' AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
		}
	} else if($periode_lap == "perbulan") {
		$cek_bln = @$_POST['bulan_akhir'];
		$bulan1 = @$_POST['per_bulan1'];
		$tahunbulan1 = @$_POST['tahun_perbulan1'];
		if($cek_bln == "yes") {
			$bulan2 = @$_POST['per_bulan2'];
			$tahunbulan2 = @$_POST['tahun_perbulan2'];
			$tgl_awal = $tahunbulan1."-".$bulan1."-01";
			$tgl_akhir = $tahunbulan2."-".$bulan2."-31";
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1." sd ".bulan_indo($bulan2)." ".$tahunbulan2;
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (tbl_pembelian.tgl_pembelian BETWEEN '$tgl_awal' AND '$tgl_akhir') AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
		} else {
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1;
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (MONTH(tbl_pembelian.tgl_pembelian) = '$bulan1' AND YEAR(tbl_pembelian.tgl_pembelian) = '$tahunbulan1') AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr  LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
		}
	} else if($periode_lap == "pertahun") {
		$cek_thn = @$_POST['tahun_akhir'];
		$per_tahun1 = @$_POST['per_tahun1'];
		if($cek_thn == "yes") {
			$per_tahun2 = @$_POST['per_tahun2'];
			$ket_periode = "tahun ".$per_tahun1." sd ".$per_tahun2;
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE (YEAR(tbl_pembelian.tgl_pembelian) BETWEEN '$per_tahun1' AND '$per_tahun2') AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
		} else {
			$ket_periode = "tahun ".$per_tahun1;
			$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE YEAR(tbl_pembelian.tgl_pembelian) = '$per_tahun1' AND tbl_supplier.no_supp LIKE '$no_supp' AND tbl_pembelian.status_byr LIKE '$status_byr' ORDER BY tbl_pembelian.tgl_pembelian ASC";
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

<link type="text/css" href="./isi/style_css/laporan_pembelian.css" rel="stylesheet">

<page backtop="8mm" backbottom="8mm" backleft="0mm" backright="3mm" style="font-size: 12px;">
	<page_header class="page_header" style="text-align: right; font-size: 10px; color: #575757; font-style: italic;">
		arsip apotek margo saras - laporan pembelian
	</page_header>
	<page_footer>
		<div class="page_footer" style="width: 100%; text-align: right; vertical-align: middle; padding: 5px; background-color: #c7c7c7; font-size: 10px;">
			Hal. [[page_cu]]
		</div>
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
		<div style="margin-top: 15px; margin-bottom: 10px; width: 100%; border-bottom: 1px solid; "></div>
		<table class="tabel-pembelian-rangkuman" border="1" style="border-collapse: collapse;">
			<tr>
				<th class="kol-no">No</th>
				<th class="kol-fak">No Faktur</th>
				<th class="kol-tgl">Tanggal</th>
				<th class="kol-sup">Supplier</th>
				<th class="kol-sta">Status</th>
				<th class="kol-tot">Total</th>
			</tr>
		<?php 
			$nomor = 1;
			$total = 0;
			while($data = mysqli_fetch_array($sql)) {
				$total = $total + $data['total_pembelian'];
		 ?>
			<tr>
				<td align="center" class="kol-no"><?php echo $nomor++; ?></td>
				<td align="left" class="kol-fak"><?php echo $data['no_faktur']; ?></td>
				<td align="center" class="kol-tgl"><?php echo tgl_indo($data['tgl_pembelian']); ?></td>
				<td align="center" class="kol-sup"><?php echo $data['nama_supp']; ?>a</td>
				<td align="center" class="kol-sta"><?php echo $data['status_byr']; ?></td>
				<td align="right" class="kol-tot">Rp<?php echo number_format($data['total_pembelian'], 0, ",", "."); ?></td>
			</tr>
		<?php } ?>
			<tr>
				<td colspan="6" align="right" class="kol-tot-pembelian">Rp<?php echo number_format($total, 0, ",", "."); ?></td>
			</tr>
		</table>
	<?php } ?>
</page>