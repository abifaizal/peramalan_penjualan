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
<link type="text/css" href="./isi/style_css/laporan_peramalan_multi.css" rel="stylesheet">

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
			Tabel Hasil Peramalan
		</div>
		<table class="tabel-hasil" border="1" style="border-collapse: collapse;">
			<tr>
				<th class="nomor">No</th>
				<th class="nama">Nama Obat</th>
				<th class="satuan">Satuan</th>
				<th class="mae">MAE</th>
				<th class="mape">MAPE</th>
				<th class="msd">MSD</th>
				<th class="hasil">Hasil Ramalan</th>
			</tr>	
		<?php 
			$no=1;
			$query_obrml = "SELECT * FROM tbl_obatramal INNER JOIN tbl_peramalan ON tbl_obatramal.no_rml=tbl_peramalan.no_rml WHERE tbl_peramalan.no_rml='$no_rml'";
			$sql_obrml = mysqli_query($conn, $query_obrml) or die ($conn->error);
			while($data_obrml = mysqli_fetch_array($sql_obrml)) {
				$no_obatramal = $data_obrml['no_obatramal'];
				$mtd_terbaik = $data_obrml['mtd_terbaik'];
				if($mtd_terbaik=="SMA") {
					$query_mtd = "SELECT * FROM tbl_metode_sma WHERE no_obatramal='$no_obatramal'";
					$sql_mtd = mysqli_query($conn, $query_mtd) or die ($conn->error);
					$data_mtd = mysqli_fetch_array($sql_mtd);
					if($data_mtd['stat_sma1']=="baik") {
						$hasil_mae = $data_mtd['mae_sma1'];
						$hasil_mape = $data_mtd['mape_sma1'];
						$hasil_msd = $data_mtd['msd_sma1'];
					} else if($data_mtd['stat_sma2']=="baik") {
						$hasil_mae = $data_mtd['mae_sma2'];
						$hasil_mape = $data_mtd['mape_sma2'];
						$hasil_msd = $data_mtd['msd_sma2'];
					}
				} else if($mtd_terbaik=="SES") {
					$query_mtd = "SELECT * FROM tbl_metode_ses WHERE no_obatramal='$no_obatramal'";
					$sql_mtd = mysqli_query($conn, $query_mtd) or die ($conn->error);
					$data_mtd = mysqli_fetch_array($sql_mtd);
					if($data_mtd['stat_ses1']=="baik") {
						$hasil_mae = $data_mtd['mae_ses1'];
						$hasil_mape = $data_mtd['mape_ses1'];
						$hasil_msd = $data_mtd['msd_ses1'];
					} else if($data_mtd['stat_ses2']=="baik") {
						$hasil_mae = $data_mtd['mae_ses2'];
						$hasil_mape = $data_mtd['mape_ses2'];
						$hasil_msd = $data_mtd['msd_ses2'];
					}
				}
		 ?>
		 		<tr>
					<td class="nomor"><?php echo $no++; ?></td>
					<td align="left" class="nama"><?php echo $data_obrml['nm_obat']; ?></td>
					<td class="satuan"><?php echo $data_obrml['sat_obat']; ?></td>
					<td class="mae"><?php echo round($hasil_mae, 5); ?></td>
					<td class="mape"><?php echo round($hasil_mape, 5); ?></td>
					<td class="msd"><?php echo round($hasil_msd, 5); ?></td>
					<td class="hasil"><?php echo round($data_obrml['hasil_rml']); ?></td>
				</tr>
		 <?php } ?>
		</table>
	</div>
</page>