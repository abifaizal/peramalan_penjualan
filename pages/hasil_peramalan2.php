<?php 
	$nama_obat = @$_POST['nm_obat'];
	$kd_obat = @$_POST['ip_kd_obat'];
	$sat_obat = @$_POST['ip_sat_obat'];
	$prd_ramalan = @$_POST['ip_periode'];
	$metode = @$_POST['met_peramalan'];
	$nilai_ma1 = 2;
	$nilai_ma2 = 5;
	$alpha1 = 0.2;
	$alpha2 = 0.8;

	$bulan_ini = date('m');
	$tahun_ini = date('Y');
	
	$data_ses = array();
	$baris = 0;
	
	if($prd_ramalan=="bulan_depan") {
		if($bulan_ini=="12") {
	  		$bulan_ini = 1;
	  		$tahun_ini = $tahun_ini+1;
	  	} else {
	  		$bulan_ini = $bulan_ini+1;
	  	}
	}

	if($bulan_ini==12) {
		$prd_bulan2 = 11; 
		$prd_tahun2 = $tahun_ini;

		$prd_bulan1 = 1;
		$prd_tahun1 = $tahun_ini;
	} else if($bulan_ini<12) {
		$prd_bulan2 = $bulan_ini-1; 
		if($prd_bulan2==0) {
			$prd_bulan2 = 12;
			$prd_tahun2 = $tahun_ini-1;
		} else {
			$prd_tahun2 = $tahun_ini;
		}

		$prd_bulan1 = 1+$bulan_ini;
		$prd_tahun1 = $tahun_ini-1;
	}
	$periode1 = $prd_tahun1."-".$prd_bulan1."-01";
	$periode2 = $prd_tahun2."-".$prd_bulan2."-31";

	$query_dpenjualan = "SELECT YEAR(tbl_penjualan.tgl_penjualan) AS tahun, MONTH(tbl_penjualan.tgl_penjualan) AS bulan, SUM(tbl_penjualandetail.jml_jual) AS jumlah_terjual FROM tbl_penjualan INNER JOIN tbl_penjualandetail ON tbl_penjualan.no_penjualan = tbl_penjualandetail.no_penjualan WHERE tbl_penjualandetail.kd_obat = '$kd_obat' AND tbl_penjualan.tgl_penjualan BETWEEN '$periode1' AND '$periode2' GROUP BY YEAR(tbl_penjualan.tgl_penjualan), MONTH(tbl_penjualan.tgl_penjualan)";
	// $query_dpenjualan = "SELECT * FROM tbl_pegawai";
	$sql_dpenjualan = mysqli_query($conn, $query_dpenjualan) or die ($conn->error);
	while($dpenjualan = mysqli_fetch_array($sql_dpenjualan)) {
		$data_ses[$baris][0] = $dpenjualan['bulan'];
		$data_ses[$baris][1] = $dpenjualan['tahun'];
		$data_ses[$baris][2] = $dpenjualan['jumlah_terjual'];
		$baris = $baris+1;
	}

	$n = $baris-1;
	$jml_ae02 = 0;
	$jml_ae08 = 0;
	$jml_pe02 = 0;
	$jml_pe08 = 0;
	$jml_sd02 = 0;
	$jml_sd08 = 0;
	$skor_e02 = 0;
	$skor_e08 = 0;

	for($i=0; $i<=$baris; $i++) {
		if($i==$baris) {
			$data_ses[$i][0] = $bulan_ini;
			$data_ses[$i][1] = $tahun_ini;
			$data_ses[$i][2] = "-";
			$data_ses[$i][5] = "-";
			$data_ses[$i][6] = "-";
			$data_ses[$i][7] = "-";
			$data_ses[$i][8] = "-";
			$data_ses[$i][9] = "-";
			$data_ses[$i][10] = "-";
		}

		if($i==0) {
			$data_ses[$i][3] = $data_ses[$i][2];
			$data_ses[$i][4] = $data_ses[$i][2];
			$data_ses[$i][5] = "-";
			$data_ses[$i][6] = "-";
			$data_ses[$i][7] = "-";
			$data_ses[$i][8] = "-";
			$data_ses[$i][9] = "-";
			$data_ses[$i][10] = "-";
		} else if($i>0){
			$data_ses[$i][3] = $data_ses[$i-1][3] + ($alpha1 * ($data_ses[$i-1][2] - $data_ses[$i-1][3]));
			$data_ses[$i][3] = round($data_ses[$i][3], 3);
			$data_ses[$i][4] = $data_ses[$i-1][4] + ($alpha2 * ($data_ses[$i-1][2] - $data_ses[$i-1][4]));
			$data_ses[$i][4] = round($data_ses[$i][4], 3);

			if($i!=$baris) {
				$data_ses[$i][5] = abs($data_ses[$i][2] - $data_ses[$i][3]);
				$data_ses[$i][7] = ($data_ses[$i][5]/$data_ses[$i][2])*100;
				$data_ses[$i][7] = round($data_ses[$i][7],3);
				$data_ses[$i][9] = round(pow($data_ses[$i][5], 2),3);

				$data_ses[$i][6] = abs($data_ses[$i][2] - $data_ses[$i][4]);
				$data_ses[$i][8] = ($data_ses[$i][6]/$data_ses[$i][2])*100;
				$data_ses[$i][8] = round($data_ses[$i][8],3);
				$data_ses[$i][10] = round(pow($data_ses[$i][6], 2),3);

				$jml_ae02 = $jml_ae02 + $data_ses[$i][5];
				$jml_pe02 = $jml_pe02 + $data_ses[$i][7];
				$jml_sd02 = $jml_sd02 + $data_ses[$i][9];

				$jml_ae08 = $jml_ae08 + $data_ses[$i][6];
				$jml_pe08 = $jml_pe08 + $data_ses[$i][8];
				$jml_sd08 = $jml_sd08 + $data_ses[$i][10];
			}
		}

		// if($i<$nilai_ma2) {
		// 	$data_ses[$i][4] = "-";
		// 	$data_ses[$i][6] = "-";
		// 	$data_ses[$i][8] = "-";
		// 	$data_ses[$i][10] = "-";
		// } else if($i>=$nilai_ma2){
		// 	$sum = 0;
		// 	for($j=($i-1); $j>=($i-$nilai_ma2); $j--) {
		// 		$sum = $sum + $data_ses[$j][2];
		// 	}

		// 	$data_ses[$i][4] = $sum/$nilai_ma2;
		// 	$data_ses[$i][4] = round($data_ses[$i][4], 3);
		// 	if($i!=$baris) {
		// 		$data_ses[$i][6] = abs($data_ses[$i][2] - $data_ses[$i][4]);
		// 		$data_ses[$i][8] = ($data_ses[$i][6]/$data_ses[$i][2])*100;
		// 		$data_ses[$i][8] = round($data_ses[$i][8],3);
		// 		$data_ses[$i][10] = pow($data_ses[$i][6], 2);
		// 		$jml_ae08 = $jml_ae08 + $data_ses[$i][6];
		// 		$jml_pe08 = $jml_pe08 + $data_ses[$i][8];
		// 		$jml_sd08 = $jml_sd08 + $data_ses[$i][10];
		// 		$n5++;
		// 	}
		// }
	}
	$nilai_mae02 = $jml_ae02/$n;
	$nilai_mae08 = $jml_ae08/$n;
	$nilai_pe02 = $jml_pe02/$n;
	$nilai_pe08 = $jml_pe08/$n;
	$nilai_sd02 = $jml_sd02/$n;
	$nilai_sd08 = $jml_sd08/$n;
 ?>

 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-tachometer-alt"></i> Navigasi</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-bar"></i> Peramalan Penjualan</li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-bar"></i> Hasil Peramalan Penjualan</li>
  </ol>
</nav>

<style>
	.tabel-keterangan th, .tabel-keterangan td {
		padding: 3px;
	}
</style>
<div class="page-content" style="font-size: 14px;">
	<div class="row">
		<div class="col-6"><h4>Hasil Peramalan Penjualan</h4></div>
		<div class="col-6 text-right">
      		<a href="?page=peramalan">
				<button class="btn btn-sm btn-info">Form Peramalan</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="keterangan-hasil" style="padding: 0 10px;">
			<table class="tabel-keterangan">
				<tr>
					<th>Nama Obat</th>
					<td>: <?php echo $nama_obat; ?></td>
				</tr>
				<tr>
					<th>Periode Ramalan</th>
					<td>: <?php echo bulan_indo($bulan_ini)."  ".$tahun_ini; ?></td>
				</tr>
				<tr>
					<th>Metode</th>
					<td>: <?php echo $metode; ?></td>
				</tr>
				<tr>
					<th>Nilai Moving Average</th>
					<td>: <?php echo $nilai_ma1; ?> bulanan dan <?php echo $nilai_ma2; ?> bulanan</td>
				</tr>
				<tr>
					<th>Nilai Bobot Pemulusan</th>
					<td>: <?php echo $alpha1; ?> dan <?php echo $alpha2; ?></td>
				</tr>
			</table>
		</div>
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
		</style>
		<div class="tabel-periode table-responsive" style="padding: 0 10px; margin-top: 8px;">
			<table class="table table-bordered tabel-data-peramalan">
				<thead>
					<tr>
						<th style="vertical-align: middle;">No</th>
						<th style="vertical-align: middle;">Periode</th>
						<th style="vertical-align: middle;">Jumlah Terjual <br> (X)</th>
						<th style="vertical-align: middle;">Ramalan a=0.2 <br> (F<sub>0.2</sub>)</th>
						<th style="vertical-align: middle;">Error Absolute a=0.2 <br> |X-F<sub>0.2</sub>|</th>
						<th style="vertical-align: middle;">Absolute Percentage a=0.2 <br> |(X-F<sub>0.2</sub>)/X|*100</th>
						<th style="vertical-align: middle;">Square Deviation a=0.2 <br> |X-F<sub>0.2</sub>|<sup>2</sup></th>
						<th style="vertical-align: middle;">Ramalan a=0.8 <br> (F<sub>0.8</sub>)</th>
						<th style="vertical-align: middle;">Error Absolute a=0.8 <br> |X-F<sub>0.8</sub>|</th>
						<th style="vertical-align: middle;">Absolute Percentage a=0.8 <br> |(X-F<sub>0.8</sub>)/X|*100</th>
						<th style="vertical-align: middle;">Square Deviation a=0.8 <br> |X-F<sub>0.8</sub>|<sup>2</sup></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					for($i=0; $i<=$baris; $i++) {
				 ?>
				 		<tr <?php if($i==$baris) echo "Class='baris-prdramalan'"; ?>>
				 			<td width="6%" align="center"><?php echo $i+1; ?></td>
				 			<td><?php echo bulan_indo($data_ses[$i][0])." ".$data_ses[$i][1]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][2]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][3]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][5]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][7]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][9]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][4]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][6]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][8]; ?></td>
				 			<td align="center"><?php echo $data_ses[$i][10]; ?></td>
				 		</tr>
				<?php } ?>
						<!-- <tr>
							<td colspan="2">Jumlah Error</td>
							<td>-</td>
							<td>-</td>
							<td><?php echo $jml_ae02; ?></td>
							<td><?php echo $jml_pe02; ?></td>
							<td><?php echo $jml_sd02; ?></td>
							<td>-</td>
							<td><?php echo $jml_ae08; ?></td>
							<td><?php echo $jml_pe08; ?></td>
							<td><?php echo $jml_sd08; ?></td>
						</tr> -->
				</tbody>
			</table>
		</div>
		<div class="kotak-pembandingan" style="padding: 0 10px; margin-top: 8px;">
			<table class="table">
				<thead>
					<tr>
						<th></tthd>
						<th>Ramalan a=0.2</th>
						<th>Ramalan a=0.8</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Mean Absolute Error</td>
						<td <?php if($nilai_mae02<$nilai_mae08) {
							echo "Class='lebih-kecil'";
							$skor_e02++;
						} ?>>
							<?php echo $nilai_mae02; ?>
						</td>
						<td <?php if($nilai_mae08<$nilai_mae02) {
							echo "Class='lebih-kecil'";
							$skor_e08++;
						} ?>>
							<?php echo $nilai_mae08; ?>
						</td>
					</tr>
					<tr>
						<td>Mean Absolute Percentage Error</td>
						<td <?php if($nilai_pe02<$nilai_pe08) {
							echo "Class='lebih-kecil'";
							$skor_e02++;
						} ?>>
							<?php echo $nilai_pe02; ?>
						</td>
						<td <?php if($nilai_pe08<$nilai_pe02) {
							echo "Class='lebih-kecil'";
							$skor_e08++;
						} ?>>
							<?php echo $nilai_pe08; ?>
						</td>
					</tr>
					<tr>
						<td>Mean Square Deviation Error</td>
						<td <?php if($nilai_sd02<$nilai_sd08) {
							echo "Class='lebih-kecil'";
							$skor_e02++;
						} ?>>
							<?php echo $nilai_sd02; ?>
						</td>
						<td <?php if($nilai_sd08<$nilai_sd02) {
							echo "Class='lebih-kecil'";
							$skor_e08++;
						} ?>>
							<?php echo $nilai_sd08; ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php 
			if($skor_e08>$skor_e02) {
				$hasil_ramalan_es = $data_ses[$baris][4];
			} else {
				$hasil_ramalan_es = $data_ses[$baris][3];
			}
		 ?>
		<div class="kotak-hasil hasil-sma" style="padding: 0 10px; margin-top: 8px;">
			<div class="kotak-alert alert alert-success" role="alert">
				<p>
					Hasil peramalan penjualan obat <span id="nama_obat"><?php echo $nama_obat; ?></span> untuk periode bulan <span id="prd_bulan"><?php echo bulan_indo($bulan_ini); ?></span> <span id="prd_tahun"><?php echo "$tahun_ini"; ?></span> adalah sebesar <span id="hasil_ramalan"><?php echo round($hasil_ramalan_es); ?></span> <span id="satuan"><?php echo $sat_obat; ?></span>
				</p>
			</div>
		</div>
	</div>
</div>