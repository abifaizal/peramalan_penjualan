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

 <page style="font-size: 12px;">
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
		<div style="margin-top: 0px;"> </div>
			<table class="tabel-data-penjualan-rangkuman" border="1" style="border-collapse: collapse;">
				<tr>
					<th class="kol-no">Nomor</th>
					<th class="kol-nopjl">Nomor Penjualan</th>
					<th class="kol-tglpjl">Tanggal</th>
					<th class="kol-nmpeg">Pegawai</th>
					<th class="kol-totalpjl">Total</th>
				</tr>
			<?php 
				$id_pjl = 1;
				$total = 0;
				while($data_pjl = mysqli_fetch_array($sql)) {
					$total = $total + $data_pjl['total_penjualan'];
			 ?>
				<tr>
					<td class="kol-no"><?php echo $id_pjl++; ?></td>
					<td class="kol-nopjl"><?php echo $data_pjl['no_penjualan']; ?></td>
					<td class="kol-tglpjl"><?php echo $data_pjl['tgl_penjualan']; ?></td>
					<td class="kol-nmpeg"><?php echo $data_pjl['username']; ?></td>
					<td class="kol-totalpjl">Rp<?php echo number_format($data_pjl['total_penjualan']); ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan="4"></td>
					<td class="total-pjl">Rp<?php echo number_format($total); ?></td>
				</tr>
			</table>
		<!-- </div> -->
	<?php } ?>
	<!-- </div> -->
</page>