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
		<div style="margin-top: 15px; width: 100%; border-bottom: 1px solid; "></div>
		<?php 
			$total_semua = 0;
			$id_pjl = 1;
			while($data_pbl = mysqli_fetch_array($sql)) {
				$no_faktur = $data_pbl['no_faktur'];
		 ?>
			<div style="margin-bottom: 10px;">
				<table class="tabel-nopenjualan">
			 		<tr>
			 			<th rowspan="2" style="vertical-align: middle; text-align: center; padding: 0 15px;"><?php echo $id_pjl++; ?></th>
			 			<th>Nomor Faktur</th>
			 			<td>: <?php echo $no_faktur; ?></td>
			 			<th style="padding-left: 30px;">Tanggal</th>
			 			<td>: <?php echo tgl_indo($data_pbl['tgl_pembelian']); ?></td>
			 		</tr>
			 		<tr>
			 			<th>Supplier</th>
			 			<td>: <?php echo $data_pbl['nama_supp']; ?></td>
			 			<th style="padding-left: 30px;">Status</th>
			 			<td>: <?php echo $data_pbl['status_byr']; ?></td>
			 		</tr>
			 	</table>
			</div>
			<div style="width: 100%; max-width: 100%; margin-bottom: 20px;">
				<table class="tabel-daftar-obat" border="1" style="border-collapse: collapse;">
					<tr>
						<th class="kol-nmobat">Nama Obat</th>
						<th class="kol-hrgjual">Harga</th>
						<th class="kol-jmljual">Jumlah</th>
						<th class="kol-satjual">Satuan</th>
						<th class="kol-subt">Subtotal</th>
					</tr>
				<?php 
					$query_obat = "SELECT * FROM tbl_pembeliandetail INNER JOIN tbl_dataobat ON tbl_pembeliandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_pembeliandetail.no_faktur = '$no_faktur'";
					$sql_obat = mysqli_query($conn, $query_obat) or die ($conn->error);
					while($data_obat = mysqli_fetch_array($sql_obat)) {
				 ?>
					<tr>
						<td class="kol-nmobat"><?php echo $data_obat['nm_obat']; ?></td>
						<td class="kol-hrgjual">Rp<?php echo number_format($data_obat['hrg_beli'], 0,",", "."); ?></td>
						<td class="kol-jmljual"><?php echo $data_obat['jml_beli']; ?></td>
						<td class="kol-satjual"><?php echo $data_obat['sat_beli']; ?></td>
						<td class="kol-subt">Rp<?php echo number_format($data_obat['subtotal'], 0,",", "."); ?></td>
					</tr>
				<?php } ?>
					<tr>
						<td colspan="4"></td>
						<td class="total-pjl">Rp<?php echo number_format($data_pbl['total_pembelian'], 0,",", "."); ?></td>
					</tr>
				</table>
			</div>
		<?php
				$total_semua = $data_pbl['total_pembelian'] + $total_semua; 
			} 
		?>		
		<div style="margin-top: 10px; background-color: #dbdbdb; padding: 5px 2px; font-weight: bold; font-size: 16px; text-align: right; font-style: italic;">
			Total : Rp<?php echo number_format($total_semua); ?>
		</div>
	<?php } ?>
</page>