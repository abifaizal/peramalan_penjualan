<style>
	.baris-prdramalan td {
		background-color: #d6d6d6;
		font-weight: bold;
	}
	.tabel-data-peramalan th {
		text-align: center;
		vertical-align: middle;
	}
	.lebih-kecil {
		background-color: #d6d6d6;
		font-weight: bold;
	}
	.kotak-alert {
		padding: 10px 40px;
		margin: 0;
		text-align: center;
	}
	.kotak-hasil p{
		font-weight: bold;
		font-size: 16px;
	}
	ul.nav-pills{
        padding: 12px 15px;
        /*border-bottom: 1px solid #169BB0;*/
    }
    .kotak-data-tab .nav-item{
        font-size: 12px;
        font-weight: lighter;
        padding-bottom: 5px;
        border-bottom: 1px solid #D9DADB;
        margin-right: 15px;
    }
    .kotak-data-tab .nav-link{
        color: #000000;
    }
    .kotak-data-tab .nav-link.active{
        background-color: #169BB0;
    }
</style>
<div class="form-container">
	<div class="keterangan-hasil" style="padding: 0 10px;">
		<table class="tabel-keterangan">
			<tr>
				<th>Periode Ramalan</th>
				<td>: 
					<?php 
						echo "$periode_ramal";
					?>
				</td>
			</tr>
			<tr>
				<th>Metode</th>
				<td>: Single Moving Average dan Single Exponential Smoothing</td>
			</tr>
			<?php if($metode=="Semua" || $metode=="Single Moving Average") { ?>
			<tr>
				<th>Nilai Moving Average</th>
				<td>: <?php echo $nilai_ma[0]; ?> periode dan <?php echo $nilai_ma[1]; ?> periode</td>
			</tr>
			<?php } ?>
			<?php if($metode=="Semua" || $metode=="Single Exponential Smoothing") { ?>
			<tr>
				<th>Nilai Bobot Pemulusan</th>
				<td>: <?php echo $alpha[0]; ?> dan <?php echo $alpha[1]; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="tabel-periode table-responsive" style="padding: 0 10px; margin-top: 8px;">
	<table class="table table-striped tab;e-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>
				<th>Satuan</th>
				<th>MEA</th>
				<th>MAPE</th>
				<th>MSD</th>
				<th>Hasil Ramalan</th>
				<th>Akurasi</th>
			</tr>
		</thead>
	<?php 
	for($x=0; $x<$jml_obat; $x++) {
		$skor_sma = 0;
		$skor_ses = 0;
		
		$data = array();
		$rml_sma = array();
		$hsl_mae_sma = array();
		$hsl_mape_sma = array();
		$hsl_msd_sma = array();
		$stat_sma = array();

		$data_ses = array();
		$rml_ses = array();
		$hsl_mae_ses = array();
		$hsl_mape_ses = array();
		$hsl_msd_ses = array();
		$stat_ses = array();
		$baris = 11;

		$bulan_ini = date('m');
		$tahun_ini = date('Y');

		if($prd_ramalan=="bulan_depan") {
			if($bulan_ini=="12") {
		  		$bulan_ini = 1;
		  		$tahun_ini = $tahun_ini+1;
		  	} else {
		  		$bulan_ini = $bulan_ini+1;
		  	}
		  	$tanggal_akhir = $tahun_ini."-".$bulan_ini."-01";
		} else if($prd_ramalan=="bulan_ini"){
			$tanggal_akhir = date('Y-m-01');
		} else if($prd_ramalan=="per_hari"){
			$tanggal_akhir = date('Y-m-d');
		}
		
		
		for($i=10; $i>=0; $i--) {
			if($prd_ramalan=="per_hari") {
				$query_tjl = "SELECT DATE_SUB('$tanggal_akhir', INTERVAL '$interval_sql' DAY) AS tgl_awal, DATE_SUB('$tanggal_akhir', INTERVAL '$interval' DAY) AS tgl_akhir_baru, IFNULL(SUM(tbl_penjualandetail.jml_jual), 0) AS jumlah_terjual FROM tbl_penjualan INNER JOIN tbl_penjualandetail ON tbl_penjualan.no_penjualan = tbl_penjualandetail.no_penjualan WHERE tbl_penjualandetail.kd_obat = '$kd_obat[$x]' AND tbl_penjualan.tgl_penjualan BETWEEN (DATE_SUB('$tanggal_akhir', INTERVAL '$interval_sql' DAY)) AND '$tanggal_akhir'";
				$sql_tjl = mysqli_query($conn, $query_tjl) or die ($conn->error);
				$dpenjualan = mysqli_fetch_array($sql_tjl);
				$data[$i][0] = $dpenjualan['tgl_awal'];
				$data[$i][1] = $tanggal_akhir;
				$data[$i][2] = $dpenjualan['jumlah_terjual'];

				$data_ses[$i][0] = $dpenjualan['tgl_awal'];
				$data_ses[$i][1] = $tanggal_akhir;
				$data_ses[$i][2] = $dpenjualan['jumlah_terjual'];

				$tanggal_akhir = $dpenjualan['tgl_akhir_baru'];
			} else {
				$query_tjl = "SELECT YEAR(DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH)) AS dua, MONTH(DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH)) AS satu, DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH) AS tgl_awal, IFNULL(SUM(tbl_penjualandetail.jml_jual), 0) AS jumlah_terjual FROM tbl_penjualan INNER JOIN tbl_penjualandetail ON tbl_penjualan.no_penjualan = tbl_penjualandetail.no_penjualan WHERE tbl_penjualandetail.kd_obat = '$kd_obat[$x]' AND (tbl_penjualan.tgl_penjualan >= DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH) AND tbl_penjualan.tgl_penjualan < '$tanggal_akhir')";
				$sql_tjl = mysqli_query($conn, $query_tjl) or die ($conn->error);
				$dpenjualan = mysqli_fetch_array($sql_tjl);
				$data[$i][0] = $dpenjualan['satu'];
				$data[$i][1] = $dpenjualan['dua'];
				$data[$i][2] = $dpenjualan['jumlah_terjual'];

				$data_ses[$i][0] = $dpenjualan['satu'];
				$data_ses[$i][1] = $dpenjualan['dua'];
				$data_ses[$i][2] = $dpenjualan['jumlah_terjual'];

				$tanggal_akhir = $dpenjualan['tgl_awal'];
			}
		}

		if($metode=="Semua" || $metode=="Single Moving Average") {
			include 'alg_ramalan/met_sma.php';
		}
		if($metode=="Semua" || $metode=="Single Exponential Smoothing") {
			include 'alg_ramalan/met_ses.php';
		}

		// HITUNG SKOR ERROR SMA
		if($hsl_mae_sma[0]<$hsl_mae_sma[1]) {
			$skor_m2++;
		} else if($hsl_mae_sma[1]<$hsl_mae_sma[0]) {
			$skor_m5++;
		}
		if($hsl_mape_sma[0]<$hsl_mape_sma[1]) {
			$skor_m2++;
		} else if($hsl_mape_sma[1]<$hsl_mape_sma[0]) {
			$skor_m5++;
		}
		if($hsl_msd_sma[0]<$hsl_msd_sma[1]) {
			$skor_m2++;
		} else if($hsl_msd_sma[1]<$hsl_msd_sma[0]) {
			$skor_m5++;
		}

		if($skor_m5>$skor_m2) {
			$hasil_ramalan = $data[$baris][4];
			$mae_sma = $hsl_mae_sma[1];
			$mape_sma = $hsl_mape_sma[1];
			$msd_sma = $hsl_msd_sma[1];
			$stat_sma[0] = "kurang";
			$stat_sma[1] = "baik";
		} else {
			$hasil_ramalan = $data[$baris][3];
			$mae_sma = $hsl_mae_sma[0];
			$mape_sma = $hsl_mape_sma[0];
			$msd_sma = $hsl_msd_sma[0];
			$stat_sma[0] = "baik";
			$stat_sma[1] = "kurang";
		}

		// HITUNG SKOR ERROR SES
		if($hsl_mae_ses[0]<$hsl_mae_ses[1]) {
			$skor_e02++;
		} else if($hsl_mae_ses[1]<$hsl_mae_ses[0]) {
			$skor_e08++;
		}
		if($hsl_mape_ses[0]<$hsl_mape_ses[1]) {
			$skor_e02++;
		} else if($hsl_mape_ses[1]<$hsl_mape_ses[0]) {
			$skor_e08++;
		}
		if($hsl_msd_ses[0]<$hsl_msd_ses[1]) {
			$skor_e02++;
		} else if($hsl_msd_ses[1]<$hsl_msd_ses[0]) {
			$skor_e08++;
		}

		if($skor_e08>$skor_e02) {
			$hasil_ramalan_es = $data_ses[$baris][4];
			$mae_ses = $hsl_mae_ses[1];
			$mape_ses = $hsl_mape_ses[1];
			$msd_ses = $hsl_msd_ses[1];
			$stat_ses[0] = "kurang";
			$stat_ses[1] = "baik";
		} else {
			$hasil_ramalan_es = $data_ses[$baris][3];
			$mae_ses = $hsl_mae_ses[0];
			$mape_ses = $hsl_mape_ses[0];
			$msd_ses = $hsl_msd_ses[0];
			$stat_ses[0] = "baik";
			$stat_ses[1] = "kurang";
		}

		// HITUNG SKOR KEDUA METODE
		if($mae_sma<$mae_ses) {
			$skor_sma++;
		} else if($mae_ses<$mae_sma) {
			$skor_ses++;
		}
		if($mape_sma<$mape_ses) {
			$skor_sma++;
		} else if($mape_ses<$mape_sma) {
			$skor_ses++;
		}
		if($msd_sma<$msd_ses) {
			$skor_sma++;
		} else if($msd_ses<$msd_sma) {
			$skor_ses++;
		}

		if($skor_sma>$skor_ses) {
			$hasil_ramalan_akhir = $hasil_ramalan;
			$mtd_terbaik = "SMA";
			$mae_rml = $mae_sma;
			$mape_rml = $mape_sma;
			$msd_rml = $msd_sma;
		} else if($skor_ses>$skor_sma) {
			$hasil_ramalan_akhir = $hasil_ramalan_es;
			$mtd_terbaik = "SES";
			$mae_rml = $mae_ses;
			$mape_rml = $mape_ses;
			$msd_rml = $msd_ses;
		}

	?>
		
		<tr>
			<td><?php echo $x+1; ?></td>
			<td><?php echo $nama_obat[$x]; ?></td>
			<td><?php echo $sat_obat[$x]; ?></td>
			<td><?php echo $mae_rml; ?></td>
			<td><?php echo $mape_rml; ?></td>
			<td><?php echo $msd_rml; ?></td>
			<?php 
				$akurasi = 100 - $mape_rml;
			 ?>
			<th><?php echo round($hasil_ramalan_akhir); ?></th>
			<th><?php echo round($akurasi, 2); ?>%</th>
		</tr>
		
		<?php 
			// $carikode = mysqli_query($conn, "SELECT MAX(no_obatramal) FROM tbl_obatramal INNER JOIN tbl_peramalan ON tbl_obatramal.no_rml = tbl_peramalan.no_rml WHERE tbl_peramalan.tgl_rml = '$tgl_rml'") or die (mysql_error());
			// $datakode = mysqli_fetch_array($carikode);
			// if($datakode) {
		 //        $nilaikode = substr($datakode[0], 13);
		 //        $kode = (int) $nilaikode;
		 //        $kode = $kode + 1;
		 //        $no_obatramal = "ORM/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
		 //    } else {
		 //        $no_obatramal = "ORM/".$tgl."/001";
		 //    }
			// $query_obtrml = "INSERT INTO tbl_obatramal VALUES('$no_obatramal', '$no_rml', '$kd_obat[$x]', '$nama_obat[$x]', '$sat_obat[$x]', '$mtd_terbaik', '$hasil_ramalan_akhir')";
			// mysqli_query($conn, $query_obtrml) or die ($conn->error);
			

			// // SIMPAN TABEL MTD SMA
			// $carikode = mysqli_query($conn, "SELECT MAX(no_mtd_sma) FROM tbl_metode_sma INNER JOIN tbl_obatramal ON tbl_metode_sma.no_obatramal = tbl_obatramal.no_obatramal INNER JOIN tbl_peramalan ON tbl_obatramal.no_rml = tbl_peramalan.no_rml WHERE tbl_peramalan.tgl_rml = '$tgl_rml'") or die (mysql_error());
			// $datakode = mysqli_fetch_array($carikode);
			// if($datakode) {
		 //        $nilaikode = substr($datakode[0], 13);
		 //        $kode = (int) $nilaikode;
		 //        $kode = $kode + 1;
		 //        $no_mtd_sma = "SMA/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
		 //    } else {
		 //        $no_mtd_sma = "SMA/".$tgl."/001";
		 //    }

		 //    $hasil_sma1 = $data[$baris][3];
	  //       $hasil_sma2 = $data[$baris][4];
	  //       $mae_sma1 = $hsl_mae_sma[0];
	  //       $mae_sma2 = $hsl_mae_sma[1];
	  //       $mape_sma1 = $hsl_mape_sma[0];
	  //       $mape_sma2 = $hsl_mape_sma[1];
	  //       $msd_sma1 = $hsl_msd_sma[0];
	  //       $msd_sma2 = $hsl_msd_sma[1];
	  //       $stat_sma1 = $stat_sma[0];
	  //       $stat_sma2 = $stat_sma[1];

	  //       $query_sma = "INSERT INTO tbl_metode_sma VALUES('$no_mtd_sma', '$no_obatramal', '$mae_sma1', '$mae_sma2', '$mape_sma1', '$mape_sma2', '$msd_sma1', '$msd_sma2', '$hasil_sma1', '$hasil_sma2', '$stat_sma1', '$stat_sma2')";
			// mysqli_query($conn, $query_sma) or die ($conn->error);

			// // SIMPAN TABEL MTD SES
			// $carikode = mysqli_query($conn, "SELECT MAX(no_mtd_ses) FROM tbl_metode_ses INNER JOIN tbl_obatramal ON tbl_metode_ses.no_obatramal = tbl_obatramal.no_obatramal INNER JOIN tbl_peramalan ON tbl_obatramal.no_rml = tbl_peramalan.no_rml WHERE tbl_peramalan.tgl_rml = '$tgl_rml'") or die (mysql_error());
			// $datakode = mysqli_fetch_array($carikode);
			// if($datakode) {
		 //        $nilaikode = substr($datakode[0], 13);
		 //        $kode = (int) $nilaikode;
		 //        $kode = $kode + 1;
		 //        $no_mtd_ses = "SES/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
		 //    } else {
		 //        $no_mtd_ses = "SES/".$tgl."/001";
		 //    }

		 //    $hasil_ses1 = $data_ses[$baris][3];
	  //       $hasil_ses2 = $data_ses[$baris][4];
	  //       $mae_ses1 = $hsl_mae_ses[0];
	  //       $mae_ses2 = $hsl_mae_ses[1];
	  //       $mape_ses1 = $hsl_mape_ses[0];
	  //       $mape_ses2 = $hsl_mape_ses[1];
	  //       $msd_ses1 = $hsl_msd_ses[0];
	  //       $msd_ses2 = $hsl_msd_ses[1];
	  //       $stat_ses1 = $stat_ses[0];
	  //       $stat_ses2 = $stat_ses[1];

	  //       $query_ses = "INSERT INTO tbl_metode_ses VALUES('$no_mtd_ses', '$no_obatramal', '$mae_ses1', '$mae_ses2', '$mape_ses1', '$mape_ses2', '$msd_ses1', '$msd_ses2', '$hasil_ses1', '$hasil_ses2', '$stat_ses1', '$stat_ses2')";
			// mysqli_query($conn, $query_ses) or die ($conn->error);

	  //       // SIMPAN TABEL PERIODE SMA
	  //   	for($j=0; $j<=$baris; $j++) {
	  //   		if($prd_ramalan=="per_hari"){
			// 		$periode_prd = tgl_indo($data[$j][0])." sd. ".tgl_indo($data[$j][1]); 
			// 	} else {
			// 		$periode_prd = bulan_indo($data[$j][0])." ".$data[$j][1]; 
			// 	}
	  //   		$jml_penjualan = $data[$j][2];
	  //   		$ramal_sma1 = $data[$j][3];
	  //   		$ramal_sma2 = $data[$j][4];
	  //   		$ea_sma1 = $data[$j][5];
	  //   		$ea_sma2 = $data[$j][6];
	  //   		$pea_sma1 = $data[$j][7];
	  //   		$pea_sma2 = $data[$j][8];
	  //   		$sd_sma1 = $data[$j][9];
	  //   		$sd_sma2 = $data[$j][10];
	  //   		if($j==$baris) {
	  //   			$stat_sma = "hasil";
	  //   		}else {
	  //   			$stat_sma = "latih";
	  //   		}
	  //   		$query_prdsma = "INSERT INTO tbl_prd_sma (no_mtd_sma, periode, jml_penjualan, rml_sma1, rml_sma2, ea_sma1, ea_sma2, pea_sma1, pea_sma2, sd_sma1, sd_sma2, stat_sma) VALUES ('$no_mtd_sma', '$periode_prd', '$jml_penjualan', '$ramal_sma1', '$ramal_sma2', '$ea_sma1', '$ea_sma2', '$pea_sma1', '$pea_sma2', '$sd_sma1', '$sd_sma2', '$stat_sma')";
	  //   		mysqli_query($conn, $query_prdsma) or die ($conn->error);
	  //   	}

	  //   	// SIMPAN TABEL PERIODE SES
	  //   	for($j=0; $j<=$baris; $j++) {
	  //   		if($prd_ramalan=="per_hari"){
			// 		$periode_prd = tgl_indo($data_ses[$j][0])." sd. ".tgl_indo($data_ses[$j][1]); 
			// 	} else {
			// 		$periode_prd = bulan_indo($data_ses[$j][0])." ".$data_ses[$j][1]; 
			// 	}
	  //   		$jml_penjualan = $data_ses[$j][2];
	  //   		$ramal_ses1 = $data_ses[$j][3];
	  //   		$ramal_ses2 = $data_ses[$j][4];
	  //   		$ea_ses1 = $data_ses[$j][5];
	  //   		$ea_ses2 = $data_ses[$j][6];
	  //   		$pea_ses1 = $data_ses[$j][7];
	  //   		$pea_ses2 = $data_ses[$j][8];
	  //   		$sd_ses1 = $data_ses[$j][9];
	  //   		$sd_ses2 = $data_ses[$j][10];
	  //   		if($j==$baris) {
	  //   			$stat_ses = "hasil";
	  //   		}else {
	  //   			$stat_ses = "latih";
	  //   		}
	  //   		$query_prdses = "INSERT INTO tbl_prd_ses (no_mtd_ses, periode, jml_penjualan, rml_ses1, rml_ses2, ea_ses1, ea_ses2, pea_ses1, pea_ses2, sd_ses1, sd_ses2, stat_ses) VALUES ('$no_mtd_ses', '$periode_prd', '$jml_penjualan', '$ramal_ses1', '$ramal_ses2', '$ea_ses1', '$ea_ses2', '$pea_ses1', '$pea_ses2', '$sd_ses1', '$sd_ses2', '$stat_ses')";
	  //   		mysqli_query($conn, $query_prdses) or die ($conn->error);
	  //   	}
		?>	
<?php 
	}
?>
	</table>
	</div>
</div>