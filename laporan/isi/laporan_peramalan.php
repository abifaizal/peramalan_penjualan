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
	$jml_obat = $data_prm['jml_obat'];
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
			<?php 
				$query_obrml = "SELECT * FROM tbl_obatramal INNER JOIN tbl_peramalan ON tbl_obatramal.no_rml=tbl_peramalan.no_rml WHERE tbl_peramalan.no_rml='$no_rml'";
				$sql_obrml = mysqli_query($conn, $query_obrml) or die ($conn->error);
				$data_obrml = mysqli_fetch_array($sql_obrml);
				$no_obatramal = $data_obrml['no_obatramal'];
				$nm_obat = $data_obrml['nm_obat'];
			 ?>
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
								<td class="isi-keterangan"><?php echo $nm_obat; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Periode Ramalan</td>
								<td>:</td>
								<td class="isi-keterangan"><?php echo $data_prm['periode_rml']; ?></td>
							</tr>
							<tr>
								<td class="keterangan">Metode</td>
								<td>:</td>
								<td class="isi-keterangan">Single Moving Average dan Single Exponential Smoothing</td>
							</tr>
							<tr>
								<td class="keterangan">Nilai Moving Average</td>
								<td>:</td>
								<td class="isi-keterangan"><?php echo $data_prm['nilai_ma1']; ?> periode dan <?php echo $data_prm['nilai_ma2']; ?> periode</td>
							</tr>
							<tr>
								<td class="keterangan">Nilai Bobot Pemulusan</td>
								<td>:</td>
								<td class="isi-keterangan"><?php echo $data_prm['nilai_alpha1']; ?> dan <?php echo $data_prm['nilai_alpha2']; ?></td>
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
				$query_prd_sma = "SELECT * FROM tbl_prd_sma INNER JOIN tbl_metode_sma ON tbl_prd_sma.no_mtd_sma=tbl_metode_sma.no_mtd_sma WHERE tbl_metode_sma.no_obatramal='$no_obatramal'";
				$sql_prd_sma = mysqli_query($conn, $query_prd_sma) or die ($conn->error);
				$no = 1;
				while($data_prd_sma = mysqli_fetch_array($sql_prd_sma)) {
			 ?>
			<tr>
				<td class="nomor"><?php echo $no++; ?></td>
				<td class="periode" align="left"><?php echo $data_prd_sma['periode']; ?></td>
				<td class="terjual"><?php echo $data_prd_sma['jml_penjualan']; ?></td>
				<td class="ramalan"><?php echo $data_prd_sma['rml_sma1']; ?></td>
				<td class="error"><?php echo $data_prd_sma['ea_sma1']; ?></td>
				<td class="ramalan"><?php echo $data_prd_sma['rml_sma2']; ?></td>
				<td class="error"><?php echo $data_prd_sma['ea_sma2']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="kotak-perbandingan">
		<?php 
			$query_mtd_sma = "SELECT * FROM tbl_metode_sma INNER JOIN tbl_obatramal ON tbl_metode_sma.no_obatramal=tbl_obatramal.no_obatramal WHERE tbl_metode_sma.no_obatramal='$no_obatramal'";
			$sql_mtd_sma = mysqli_query($conn, $query_mtd_sma) or die ($conn->error);
			$data_mtd_sma = mysqli_fetch_array($sql_mtd_sma);
		 ?>
		<table class="tabel-perbandingan" border="1" style="border-collapse: collapse;">
			<tr>
				<th rowspan="2" class="keterangan-error"></th>
				<th colspan="2">Nilai Moving Average</th>
			</tr>
			<tr>
				<th class="moving-average">2 periode</th>
				<th class="moving-average">5 periode</th>
			</tr>
			<tr>
				<th align="left">Mean Absolute Error</th>
				<td Class="<?php if($data_mtd_sma['mae_sma1']<$data_mtd_sma['mae_sma2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['mae_sma1']; ?>
				</td>
				<td Class="<?php if($data_mtd_sma['mae_sma2']<$data_mtd_sma['mae_sma1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['mae_sma2']; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($data_mtd_sma['mape_sma1']<$data_mtd_sma['mape_sma2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['mape_sma1']; ?>
				</td>
				<td Class="<?php if($data_mtd_sma['mape_sma2']<$data_mtd_sma['mape_sma1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['mape_sma2']; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($data_mtd_sma['msd_sma1']<$data_mtd_sma['msd_sma2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['msd_sma1']; ?>
				</td>
				<td Class="<?php if($data_mtd_sma['msd_sma2']<$data_mtd_sma['msd_sma1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_sma['msd_sma2']; ?>
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
				$query_prd_ses = "SELECT * FROM tbl_prd_ses INNER JOIN tbl_metode_ses ON tbl_prd_ses.no_mtd_ses=tbl_metode_ses.no_mtd_ses WHERE tbl_metode_ses.no_obatramal='$no_obatramal'";
				$sql_prd_ses = mysqli_query($conn, $query_prd_ses) or die ($conn->error);
				$no = 1;
				while($data_prd_ses = mysqli_fetch_array($sql_prd_ses)) {
			 ?>
			<tr>
				<td class="nomor"><?php echo $no++; ?></td>
				<td class="periode" align="left"><?php echo $data_prd_ses['periode']; ?></td>
				<td class="terjual"><?php echo $data_prd_ses['jml_penjualan']; ?></td>
				<td class="ramalan"><?php echo $data_prd_ses['rml_ses1']; ?></td>
				<td class="error"><?php echo $data_prd_ses['ea_ses1']; ?></td>
				<td class="ramalan"><?php echo $data_prd_ses['rml_ses2']; ?></td>
				<td class="error"><?php echo $data_prd_ses['ea_ses2']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="kotak-perbandingan">
		<?php 
			$query_mtd_ses = "SELECT * FROM tbl_metode_ses INNER JOIN tbl_obatramal ON tbl_metode_ses.no_obatramal=tbl_obatramal.no_obatramal WHERE tbl_metode_ses.no_obatramal='$no_obatramal'";
			$sql_mtd_ses = mysqli_query($conn, $query_mtd_ses) or die ($conn->error);
			$data_mtd_ses = mysqli_fetch_array($sql_mtd_ses);
		 ?>
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
				<td Class="<?php if($data_mtd_ses['mae_ses1']<$data_mtd_ses['mae_ses2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['mae_ses1']; ?>
				</td>
				<td Class="<?php if($data_mtd_ses['mae_ses2']<$data_mtd_ses['mae_ses1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['mae_ses2']; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($data_mtd_ses['mape_ses1']<$data_mtd_ses['mape_ses2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['mape_ses1']; ?>
				</td>
				<td Class="<?php if($data_mtd_ses['mape_ses2']<$data_mtd_ses['mape_ses1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['mape_ses2']; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($data_mtd_ses['msd_ses1']<$data_mtd_ses['msd_ses2']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['msd_ses1']; ?>
				</td>
				<td Class="<?php if($data_mtd_ses['msd_ses2']<$data_mtd_ses['msd_ses1']) {echo 'lebih-kecil';} ?>">
					<?php echo $data_mtd_ses['msd_ses2']; ?>
				</td>
			</tr>
		</table>
	</div>

	<div style="margin-top: 35px 0; border-bottom: 1px solid;"></div>
	<!-- PERBANDINGAN HASIL TERBAIK KEDUA METODE -->
	<div class="kotak-perbandingan">
		<div class="judul-tabel" style="font-weight: bold; padding-bottom: 5px; text-align: center; font-size: 14px;">
			Tabel Perbandingan Error Metode Single Moving Average dan Single Exponential Smoothing
		</div>
		<?php 
			if($data_mtd_sma['stat_sma1']=="baik") {
				$mae_sma_akhir = $data_mtd_sma['mae_sma1'];
				$mape_sma_akhir = $data_mtd_sma['mape_sma1'];
				$msd_sma_akhir = $data_mtd_sma['msd_sma1'];
				$rml_sma_akhir = $data_mtd_sma['hasil_sma1'];
				$nilai_ma_terbaik = $data_prm['nilai_ma1'];
			} else if($data_mtd_sma['stat_sma2']=="baik") {
				$mae_sma_akhir = $data_mtd_sma['mae_sma2'];
				$mape_sma_akhir = $data_mtd_sma['mape_sma2'];
				$msd_sma_akhir = $data_mtd_sma['msd_sma2'];
				$rml_sma_akhir = $data_mtd_sma['hasil_sma2'];
				$nilai_ma_terbaik = $data_prm['nilai_ma2'];
			}

			if($data_mtd_ses['stat_ses1']=="baik") {
				$mae_ses_akhir = $data_mtd_ses['mae_ses1'];
				$mape_ses_akhir = $data_mtd_ses['mape_ses1'];
				$msd_ses_akhir = $data_mtd_ses['msd_ses1'];
				$rml_ses_akhir = $data_mtd_ses['hasil_ses1'];
				$nilai_alpha_terbaik = $data_prm['nilai_alpha1'];
			} else if($data_mtd_ses['stat_ses2']=="baik") {
				$mae_ses_akhir = $data_mtd_ses['mae_ses2'];
				$mape_ses_akhir = $data_mtd_ses['mape_ses2'];
				$msd_ses_akhir = $data_mtd_ses['msd_ses2'];
				$rml_ses_akhir = $data_mtd_ses['hasil_ses2'];
				$nilai_alpha_terbaik = $data_prm['nilai_alpha2'];
			}
		 ?>
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
				<td Class="<?php if($mae_sma_akhir<$mae_ses_akhir) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $mae_sma_akhir; ?>
				</td>
				<td Class="<?php if($mae_ses_akhir<$mae_sma_akhir) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $mae_ses_akhir; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Absolute Percentage Error</th>
				<td Class="<?php if($mape_sma_akhir<$mape_ses_akhir) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $mape_sma_akhir; ?>
				</td>
				<td Class="<?php if($mape_ses_akhir<$mape_sma_akhir) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $mape_ses_akhir; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Mean Square Deviation Error</th>
				<td Class="<?php if($msd_sma_akhir<$msd_ses_akhir) {
					echo 'lebih-kecil';
					$skor_sma++;
				} ?>">
					<?php echo $msd_sma_akhir; ?>
				</td>
				<td Class="<?php if($msd_ses_akhir<$msd_sma_akhir) {
					echo 'lebih-kecil';
					$skor_ses++;
				} ?>">
					<?php echo $msd_ses_akhir; ?>
				</td>
			</tr>
			<tr>
				<th align="left">Hasil Peramalan</th>
				<td Class="<?php if($skor_sma>$skor_ses) {
					echo 'lebih-kecil';
					$metode_terbaik = "Single Moving Average ".$nilai_ma_terbaik." periode";
				} ?>">
					<?php echo $rml_sma_akhir; ?>
				</td>
				<td Class="<?php if($skor_ses>$skor_sma) {
					echo 'lebih-kecil';
					$metode_terbaik = "Single Exponential Smoothing dengan nilai alpha ".$nilai_alpha_terbaik;
				} ?>">
					<?php echo $rml_ses_akhir; ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="kotak-hasil-akhir" style="margin-top: 20px; font-size: 14px; text-align: justify; line-height: 1.6;">
		Dari hasil perhitungan peramalan penjualan obat <?php echo $nm_obat; ?> untuk periode <?php echo $data_prm['periode_rml']; ?>, diperoleh metode <?php echo $metode_terbaik; ?> memberikan hasil peramalan dengan tingkat error terendah. Sehingga angka penjualan obat <?php echo $nm_obat; ?> untuk periode <?php echo $data_prm['periode_rml']; ?> diramalkan sebesar <?php echo round($data_obrml['hasil_rml'])." ".$data_obrml['sat_obat']; ?>
	</div>
</page>