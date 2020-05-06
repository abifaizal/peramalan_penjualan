<?php 
	include '../koneksi.php';
	$ket_periode = "";
	$periode_lap = @$_POST['periode_lap'];
	$pegawai = @$_POST['nm_peg'];
	if($pegawai == "semua") {
		$pegawai = "%";
		$ket_pegawai = "Semua";
	} else {
		$ket_pegawai = $pegawai;
	}
	if($periode_lap == "hari_ini") {
		$ket_periode = date('d M Y');
		$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE tbl_penjualan.tgl_penjualan = CURDATE() AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
	} else if($periode_lap == "bulan_ini") {
		$ket_periode = date('F Y');
		$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE (MONTH(tbl_penjualan.tgl_penjualan) = MONTH(CURDATE()) AND YEAR(tbl_penjualan.tgl_penjualan) = YEAR(CURDATE())) AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
	} else if($periode_lap == "tahun_ini") {
		$ket_periode = "tahun ".date('Y');
		$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE YEAR(tbl_penjualan.tgl_penjualan) = YEAR(CURDATE()) AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
	} else if($periode_lap == "pertanggal") {
		$cek_tgl = @$_POST['tgl_akhir'];
		$tgl_awal = @$_POST['per_tanggal1'];
		if($cek_tgl == "yes") {
			$tgl_akhir = @$_POST['per_tanggal2'];
			$ket_periode = tgl_indo($tgl_awal)." sd ".tgl_indo($tgl_akhir);
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE (tbl_penjualan.tgl_penjualan BETWEEN '$tgl_awal' AND '$tgl_akhir') AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
		} else {
			$ket_periode = tgl_indo($tgl_awal);
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE tbl_penjualan.tgl_penjualan = '$tgl_awal' AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
		}
	} else if($periode_lap == "perbulan") {
		$cek_bln = @$_POST['bulan_akhir'];
		$bulan1 = @$_POST['per_bulan1'];
		$tahunbulan1 = @$_POST['tahun_perbulan1'];
		if($cek_bln == "yes") {
			$bulan2 = @$_POST['per_bulan2'];
			$tahunbulan2 = @$_POST['tahun_perbulan2'];
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1." sd ".bulan_indo($bulan2)." ".$tahunbulan2;
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE ((MONTH(tbl_penjualan.tgl_penjualan) BETWEEN '$bulan1' AND '$bulan2') AND (YEAR(tbl_penjualan.tgl_penjualan) BETWEEN '$tahunbulan1' AND '$tahunbulan2')) AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";	
		} else {
			$ket_periode = bulan_indo($bulan1)." ".$tahunbulan1;
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE (MONTH(tbl_penjualan.tgl_penjualan) = '$bulan1' AND YEAR(tbl_penjualan.tgl_penjualan) = '$tahunbulan1') AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
		}
	} else if($periode_lap == "pertahun") {
		$cek_thn = @$_POST['tahun_akhir'];
		$per_tahun1 = @$_POST['per_tahun1'];
		if($cek_thn == "yes") {
			$per_tahun2 = @$_POST['per_tahun2'];
			$ket_periode = "tahun ".$per_tahun1." sd ".$per_tahun2;
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE (YEAR(tbl_penjualan.tgl_penjualan) BETWEEN '$per_tahun1' AND '$per_tahun2') AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
		} else {
			$ket_periode = "tahun ".$per_tahun1;
			$query = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE YEAR(tbl_penjualan.tgl_penjualan) = '$per_tahun1' AND tbl_pegawai.username LIKE '$pegawai' ORDER BY tbl_penjualan.tgl_penjualan ASC";
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

 <link type="text/css" href="./isi/style_css/laporan_penjualan.css" rel="stylesheet">

 <page backtop="8mm" backbottom="8mm" backleft="0mm" backright="3mm" style="font-size: 12px;">
	<page_header class="page_header" style="text-align: right; font-size: 10px; color: #575757; font-style: italic;">
		arsip apotek margo saras - laporan pembelian
	</page_header>
	<page_footer>
		<div class="page_footer" style="width: 100%; text-align: right; vertical-align: middle; padding: 5px; background-color: #c7c7c7; font-size: 10px;">
			Laporan Penjualan - Hal. [[page_cu]]
		</div>
	</page_footer>
	<div class="page-content page-laporan-penjualan-detail">
		<div class="kotak-judul">
			<table class="tabel-judul">
				<tr>
					<td>
						<table class="tabel-keterangan-laporan">
							<tr>
								<td colspan="2" class="nama-laporan">LAPORAN PENJUALAN</td>
							</tr>
							<tr>
								<td class="keterangan">Periode</td>
								<td class="isi-keterangan">: <?php echo $ket_periode; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Pegawai</td>
								<td class="isi-keterangan">: <?php echo $ket_pegawai; ?></td>
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
	<div style="margin-top: 15px; width: 100%; border-bottom: 1px solid; "></div>
	<!-- <div class="kotak-data-penjualan"> -->
	<?php 
		if($status == "kosong") {
	 ?>
	 	<div class="data-kosong">
	 		Tidak terdapat data penjualan dengan kriteria tersebut
	 	</div>
	<?php } else {?>
		<!-- <div class="data-penjualan-detail">
		</div>
 -->		<?php 
 			$total_semua = 0;
			$id_pjl = 1;
			while($data_pjl = mysqli_fetch_array($sql)) {
				$no_penjualan = $data_pjl['no_penjualan'];
		 ?>
			<div style="margin: 12px 0 8px 0;">
				<table class="tabel-nopenjualan">
					<tr>
						<th rowspan="2" style="vertical-align: middle; text-align: center; padding: 0 15px;"><?php echo $id_pjl++; ?></th>
						<th>Nomor Penjualan</th>
						<td>: <?php echo $no_penjualan; ?></td>
						<th style="padding-left: 30px;">Tanggal</th>
						<td>: <?php echo tgl_indo($data_pjl['tgl_penjualan']); ?></td>
					</tr>
					<tr>
						<th>Pegawai</th>
						<td>: <?php echo $data_pjl['username']; ?></td>
					</tr>
				</table>
			</div>
			<table class="tabel-daftar-obat" border="1" style="border-collapse: collapse;">
				<tr>
					<th class="kol-nmobat">Nama Obat</th>
					<th class="kol-hrgjual">Harga</th>
					<th class="kol-jmljual">Jumlah</th>
					<th class="kol-satjual">Satuan</th>
					<th class="kol-subt">Subtotal</th>
				</tr>
			<?php 
				$query_obat = "SELECT * FROM tbl_penjualandetail INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_penjualandetail.no_penjualan = '$no_penjualan'";
				$sql_obat = mysqli_query($conn, $query_obat) or die ($conn->error);
				while($data_obat = mysqli_fetch_array($sql_obat)) {
			 ?>
				<tr>
					<td class="kol-nmobat"><?php echo $data_obat['nm_obat']; ?></td>
					<td class="kol-hrgjual"><?php echo $data_obat['hrg_jual']; ?></td>
					<td class="kol-jmljual"><?php echo $data_obat['jml_jual']; ?></td>
					<td class="kol-satjual"><?php echo $data_obat['sat_jual']; ?></td>
					<td class="kol-subt">Rp<?php echo number_format($data_obat['subtotal']); ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan="4"></td>
					<td class="total-pjl">Rp<?php echo number_format($data_pjl['total_penjualan']); ?></td>
				</tr>
			</table>
		<?php
				$total_semua = $data_pjl['total_penjualan'] + $total_semua; 
			} 
		?>
		<div style="margin-top: 30px; background-color: #dbdbdb; padding: 5px 2px; font-weight: bold; font-size: 16px; text-align: right; font-style: italic;">
			Total : Rp<?php echo number_format($total_semua); ?>
		</div>
	<?php } ?>
	<!-- </div> -->
</page>