<?php 
	include '../koneksi.php';
	$no_rml = @$_GET['no_rml'];
	
	$d_prd_sma = array();
	$mae_sma = array();
	$mape_sma = array();
	$msd_sma = array();
	$error_sma = array();
	$skor_sma = 0;

	$d_prd_ses = array();
	$mae_ses = array();
	$mape_ses = array();
	$msd_ses = array();
	$error_ses = array();
	$skor_ses = 0;

	$query_prm = "SELECT * FROM tbl_peramalan WHERE no_rml='$no_rml'";
	$sql_prm = mysqli_query($conn, $query_prm) or die ($conn->error);
	$data_prm = mysqli_fetch_array($sql_prm);

	$query_prd_sma1 = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_sma ON tbl_peramalan.no_rml = tbl_metode_sma.no_rml INNER JOIN tbl_prd_sma ON tbl_metode_sma.no_mtd_sma = tbl_prd_sma.no_mtd_sma WHERE tbl_metode_sma.nilai_ma = '2'";
	$sql_prd_sma1 = mysqli_query($conn, $query_prd_sma1) or die ($conn->error);
	$baris = 0;
	while($data_prd_sma1 = mysqli_fetch_array($sql_prd_sma1)) {
		$d_prd_sma[$baris][0] = $data_prd_sma1['periode'];
		$d_prd_sma[$baris][1] = $data_prd_sma1['jml_penjualan'];
		$d_prd_sma[$baris][2] = $data_prd_sma1['rml_sma'];
		$d_prd_sma[$baris][3] = $data_prd_sma1['ea_sma'];
		$baris++;
	}

	$query_prd_sma2 = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_sma ON tbl_peramalan.no_rml = tbl_metode_sma.no_rml INNER JOIN tbl_prd_sma ON tbl_metode_sma.no_mtd_sma = tbl_prd_sma.no_mtd_sma WHERE tbl_metode_sma.nilai_ma = '5'";
	$sql_prd_sma2 = mysqli_query($conn, $query_prd_sma2) or die ($conn->error);
	$baris = 0;
	while($data_prd_sma2 = mysqli_fetch_array($sql_prd_sma2)) {
		$d_prd_sma[$baris][4] = $data_prd_sma2['rml_sma'];
		$d_prd_sma[$baris][5] = $data_prd_sma2['ea_sma'];
		$baris++;
	}

	$query_prd_ses1 = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_ses ON tbl_peramalan.no_rml = tbl_metode_ses.no_rml INNER JOIN tbl_prd_ses ON tbl_metode_ses.no_mtd_ses = tbl_prd_ses.no_mtd_ses WHERE tbl_peramalan.no_rml = '$no_rml' AND tbl_metode_ses.nilai_alpha = '0.2'";
	$sql_prd_sma1 = mysqli_query($conn, $query_prd_ses1) or die ($conn->error);
	$baris = 0;
	while($data_prd_ses1 = mysqli_fetch_array($sql_prd_sma1)) {
		$d_prd_ses[$baris][0] = $data_prd_ses1['periode'];
		$d_prd_ses[$baris][1] = $data_prd_ses1['jml_penjualan'];
		$d_prd_ses[$baris][2] = $data_prd_ses1['rml_ses'];
		$d_prd_ses[$baris][3] = $data_prd_ses1['ea_ses'];
		$baris++;
	}

	$query_prd_ses2 = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_ses ON tbl_peramalan.no_rml = tbl_metode_ses.no_rml INNER JOIN tbl_prd_ses ON tbl_metode_ses.no_mtd_ses = tbl_prd_ses.no_mtd_ses WHERE tbl_peramalan.no_rml = '$no_rml' AND tbl_metode_ses.nilai_alpha = '0.8'";
	$sql_prd_sma2 = mysqli_query($conn, $query_prd_ses2) or die ($conn->error);
	$baris = 0;
	while($data_prd_ses2 = mysqli_fetch_array($sql_prd_sma2)) {
		$d_prd_ses[$baris][4] = $data_prd_ses2['rml_ses'];
		$d_prd_ses[$baris][5] = $data_prd_ses2['ea_ses'];
		$baris++;
	}

	$query_mtd_sma = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_sma ON tbl_peramalan.no_rml = tbl_metode_sma.no_rml WHERE tbl_metode_sma.no_rml='$no_rml'";
	$sql_mtd_sma = mysqli_query($conn, $query_mtd_sma) or die ($conn->error);
	$i = 0;
	while($data_mtd_sma = mysqli_fetch_array($sql_mtd_sma)) {
		$mae_sma[$i] = $data_mtd_sma['mae_sma'];
		$mape_sma[$i] = $data_mtd_sma['mape_sma'];
		$msd_sma[$i] = $data_mtd_sma['msd_sma'];
		if($data_mtd_sma['stat_mtd_sma'] == "baik") {
			$error_sma[0] = $data_mtd_sma['mae_sma'];
			$error_sma[1] = $data_mtd_sma['mape_sma'];
			$error_sma[2] = $data_mtd_sma['msd_sma'];
			$hsl_sma = $data_mtd_sma['hasil_sma'];
			$moving_average = $data_mtd_sma['nilai_ma'];
		}
		$i++;
	}

	$query_mtd_ses = "SELECT * FROM tbl_peramalan INNER JOIN tbl_metode_ses ON tbl_peramalan.no_rml = tbl_metode_ses.no_rml WHERE tbl_metode_ses.no_rml='$no_rml'";
	$sql_mtd_ses = mysqli_query($conn, $query_mtd_ses) or die ($conn->error);
	$i = 0;
	while($data_mtd_ses = mysqli_fetch_array($sql_mtd_ses)) {
		$mae_ses[$i] = $data_mtd_ses['mae_ses'];
		$mape_ses[$i] = $data_mtd_ses['mape_ses'];
		$msd_ses[$i] = $data_mtd_ses['msd_ses'];
		if($data_mtd_ses['stat_mtd_ses'] == "baik") {
			$error_ses[0] = $data_mtd_ses['mae_ses'];
			$error_ses[1] = $data_mtd_ses['mape_ses'];
			$error_ses[2] = $data_mtd_ses['msd_ses'];
			$hsl_ses = $data_mtd_ses['hasil_ses'];
			$bobot_alpha =  $data_mtd_ses['nilai_alpha'];
		}
		$i++;
	}
 ?>
<link type="text/css" href="./isi/style_css/laporan_peramalan.css" rel="stylesheet">

<page backtop="8mm" backbottom="8mm" backleft="0mm" backright="3mm" style="font-size: 12px;">
	<page_header class="page_header" style="text-align: right; font-size: 10px; color: #575757; font-style: italic;">
		arsip apotek margo saras - laporan pembelian
	</page_header>
	<page_footer>
		<div class="page_footer" style="width: 100%; text-align: right; vertical-align: middle; padding: 5px; background-color: #c7c7c7; font-size: 10px;">
			Laporan Hasil Peramalan - Hal. [[page_cu]]
		</div>
	</page_footer>
	<div class="page-content page-laporan-penjualan-detail">
		<div class="kotak-judul">
			<table class="tabel-judul">
				<tr>
					<td class="kolom-keterangan">
						<table class="tabel-keterangan-laporan">
							<tr>
								<td colspan="3" class="nama-laporan">LAPORAN HASIL PERAMALAN PENJUALAN</td>
							</tr>
							<tr>
								<td class="keterangan">Nama Obat</td>
								<td>:</td>
								<td class="isi-keterangan"><?php echo $data_prm['nm_obat']; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Periode Ramalan</td>
								<td>:</td>
								<td class="isi-keterangan"><?php echo periode($data_prm['periode_rml']); ?></td>
							</tr>
							<tr>
								<td class="keterangan">Metode</td>
								<td>:</td>
								<td class="isi-keterangan">Single Moving Average dan Single Exponential Smoothing</td>
							</tr>
							<tr>
								<td class="keterangan">Nilai Moving Average</td>
								<td>:</td>
								<td class="isi-keterangan">2 bulanan dan 3 bulanan</td>
							</tr>
							<tr>
								<td class="keterangan">Nilai Bobot Pemulusan</td>
								<td>:</td>
								<td class="isi-keterangan">0.2 dan 0.8</td>
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
	<div class="kotak-tabel-periode" style="margin-top: 5px 0; border-bottom: 1px solid;"></div>

	<div class="kotak-tabel-periode" style="width: 100%; max-width: 100%; margin: 5px 0;">
		<div class="judul-tabel" style="font-weight: bold; padding-bottom: 5px;">
			Tabel Hasil Peramalan Metode Single Moving Average
		</div>
		<table class="tabel-periode" border="1" style="border-collapse: collapse;">
			<tr>
				<th class="nomor">No</th>
				<th class="periode">Periode</th>
				<th class="terjual">Jumlah Terjual <br> (X)</th>
				<th class="ramalan">Ramalan M=2 <br> (F<sub>2</sub>)</th>
				<th class="error">Error Absolute M=2 <br> |X-F<sub>2</sub>|</th>
				<th class="ramalan">Ramalan M=5 <br> (F<sub>5</sub>)</th>
				<th class="error">Error Absolute M=5 <br> |X-F<sub>5</sub>|</th>
			</tr>
			<?php 
				for($i=0; $i<$baris; $i++) {
			 ?>
			<tr>
				<td class="nomor"><?php echo $i+1; ?></td>
				<td class="periode" align="left"><?php echo periode($d_prd_sma[$i][0]); ?></td>
				<td class="terjual"><?php echo $d_prd_sma[$i][1]; ?></td>
				<td class="ramalan"><?php echo $d_prd_sma[$i][2]; ?></td>
				<td class="error"><?php echo $d_prd_sma[$i][3]; ?></td>
				<td class="ramalan"><?php echo $d_prd_sma[$i][4]; ?></td>
				<td class="error"><?php echo $d_prd_sma[$i][5]; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="kotak-perbandingan">
		<table class="tabel-perbandingan" border="1" style="border-collapse: collapse;">
			<tr>
				<th rowspan="2" class="keterangan-error"></th>
				<th colspan="2">Nilai Moving Average</th>
			</tr>
			<tr>
				<th class="moving-average">2 bulanan</th>
				<th class="moving-average">5 bulanan</th>
			</tr>
			<tr>
				<th align="left">Mean Absolute Error</th>
				<td Class="<?php if($mae_sma[0]<$mae_sma[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $mae_sma[0]; ?>
				</td>
				<td Class="<?php if($mae_sma[1]<$mae_sma[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $mae_sma[1]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($mape_sma[0]<$mape_sma[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $mape_sma[0]; ?>
				</td>
				<td Class="<?php if($mape_sma[1]<$mape_sma[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $mape_sma[1]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($msd_sma[0]<$msd_sma[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $msd_sma[0]; ?>
				</td>
				<td Class="<?php if($msd_sma[1]<$msd_sma[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $msd_sma[1]; ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="kotak-tabel-periode" style="width: 100%; max-width: 100%; margin: 25px 0;">
		<div class="judul-tabel" style="font-weight: bold; padding-bottom: 5px;">
			Tabel Hasil Peramalan Metode Single Exponential Smoothing
		</div>
		<table class="tabel-periode" border="1" style="border-collapse: collapse;">
			<tr>
				<th class="nomor">No</th>
				<th class="periode">Periode</th>
				<th class="terjual">Jumlah Terjual <br> (X)</th>
				<th class="ramalan">Ramalan a=0.2 <br> (F<sub>0.2</sub>)</th>
				<th class="error">Error Absolute a=0.2 <br> |X-F<sub>0.2</sub>|</th>
				<th class="ramalan">Ramalan a=0.8 <br> (F<sub>0.8</sub>)</th>
				<th class="error">Error Absolute a=0.8 <br> |X-F<sub>0.8</sub>|</th>
			</tr>
			<?php 
				for($i=0; $i<$baris; $i++) {
			 ?>
			<tr>
				<td class="nomor"><?php echo $i+1; ?></td>
				<td class="periode" align="left"><?php echo periode($d_prd_sma[$i][0]); ?></td>
				<td class="terjual"><?php echo $d_prd_ses[$i][1]; ?></td>
				<td class="ramalan"><?php echo $d_prd_ses[$i][2]; ?></td>
				<td class="error"><?php echo $d_prd_ses[$i][3]; ?></td>
				<td class="ramalan"><?php echo $d_prd_ses[$i][4]; ?></td>
				<td class="error"><?php echo $d_prd_ses[$i][5]; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="kotak-perbandingan">
		<table class="tabel-perbandingan" border="1" style="border-collapse: collapse;">
			<tr>
				<th rowspan="2" class="keterangan-error"></th>
				<th colspan="2">Nilai Alpha</th>
			</tr>
			<tr>
				<th class="moving-average">alpha = 0.2</th>
				<th class="moving-average">alpha = 0.8</th>
			</tr>
			<tr>
				<th align="left">Mean Absolute Error</th>
				<td Class="<?php if($mae_ses[0]<$mae_ses[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $mae_ses[0]; ?>
				</td>
				<td Class="<?php if($mae_ses[1]<$mae_ses[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $mae_ses[1]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($mape_ses[0]<$mape_ses[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $mape_ses[0]; ?>
				</td>
				<td Class="<?php if($mape_ses[1]<$mape_ses[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $mape_ses[1]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($msd_ses[0]<$msd_ses[1]) {echo 'lebih-kecil';} ?>">
					<?php echo $msd_ses[0]; ?>
				</td>
				<td Class="<?php if($msd_ses[1]<$msd_ses[0]) {echo 'lebih-kecil';} ?>">
					<?php echo $msd_ses[1]; ?>
				</td>
			</tr>
		</table>
	</div>

	<div style="margin-top: 35px 0; border-bottom: 1px solid;"></div>
	<div class="kotak-perbandingan">
		<div class="judul-tabel" style="font-weight: bold; padding-bottom: 5px; text-align: center; font-size: 14px;">
			Tabel Perbandingan Error Metode Single Moving Average dan Single Exponential Smoothing
		</div>
		<table class="tabel-perbandingan" border="1" style="border-collapse: collapse;">
			<tr>
				<th rowspan="2" class="keterangan-error"></th>
				<th colspan="2">Metode</th>
			</tr>
			<tr>
				<th class="moving-average">Single Moving Average</th>
				<th class="moving-average">Single Exponenetial Smoothing</th>
			</tr>
			<tr>
				<th align="left">Mean Absolute Error</th>
				<td Class="<?php if($error_sma[0]<$error_ses[0]) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $error_sma[0]; ?>
				</td>
				<td Class="<?php if($error_ses[0]<$error_sma[0]) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $error_ses[0]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($error_sma[1]<$error_ses[1]) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $error_sma[1]; ?>
				</td>
				<td Class="<?php if($error_ses[1]<$error_sma[1]) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $error_ses[1]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($error_sma[2]<$error_ses[2]) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $error_sma[2]; ?>
				</td>
				<td Class="<?php if($error_ses[2]<$error_sma[2]) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $error_ses[2]; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Hasil Peramalan</th>
				<td Class="<?php if($skor_sma>$skor_ses) {
					echo 'lebih-kecil';
					$metode_terbaik = "Single Moving Average ".$moving_average." bulanan";
				} ?>">
					<?php echo $hsl_sma; ?>
				</td>
				<td Class="<?php if($skor_ses>$skor_sma) {
					echo 'lebih-kecil';
					$metode_terbaik = "Single Exponential Smoothing dengan nilai alpha ".$bobot_alpha;
				} ?>">
					<?php echo $hsl_ses; ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="kotak-hasil-akhir" style="margin-top: 20px; font-size: 14px; text-align: justify; line-height: 1.6;">
		Dari hasil perhitungan peramalan penjualan obat <?php echo $data_prm['nm_obat']; ?> untuk periode <?php echo periode($data_prm['periode_rml']); ?>, diperoleh metode <?php echo $metode_terbaik; ?> memberikan hasil peramalan dengan tingkat error terendah. Sehingga angka penjualan obat <?php echo $data_prm['nm_obat']; ?> untuk periode bulan <?php echo periode($data_prm['periode_rml']); ?> diramalkan sebesar <?php echo round($data_prm['hasil'])." ".$data_prm['sat_obat']; ?>
	</div>
</page>