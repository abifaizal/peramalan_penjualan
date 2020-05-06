<?php 
	$n2 = 0;
	$n5 = 0;
	$jml_ae2 = 0;
	$jml_ae5 = 0;
	$jml_pe2 = 0;
	$jml_pe5 = 0;
	$jml_sd2 = 0;
	$jml_sd5 = 0;
	$skor_m2 = 0;
	$skor_m5 = 0;
	$pola_sma0 = array();
	$pola_sma1 = array();
	

	for($i=0; $i<=$baris; $i++) {
		if($i==$baris) {
			if($prd_ramalan=="per_hari") {
				$tanggal_akhir = date('Y-m-d');
				$data[$i][0] = date_add(date_create($tanggal_akhir), date_interval_create_from_date_string("1 DAYS"));
				$data[$i][1] = date_add(date_create($tanggal_akhir), date_interval_create_from_date_string("$interval DAYS"));
				$data[$i][0] = date_format($data[$i][0], 'Y-m-d');
				$data[$i][1] = date_format($data[$i][1], 'Y-m-d');
			} else {
				$data[$i][0] = $bulan_ini;
				$data[$i][1] = $tahun_ini;
			}
			$data[$i][2] = 0;
			$data[$i][5] = 0;
			$data[$i][6] = 0;
			$data[$i][7] = 0;
			$data[$i][8] = 0;
			$data[$i][9] = 0;
			$data[$i][10] = 0;
		}

		if($i<$nilai_ma[0]) {
			$pola_sma0[$i] = null;
			$data[$i][3] = 0;
			$data[$i][5] = 0;
			$data[$i][7] = 0;
			$data[$i][9] = 0;
		} else if($i>=$nilai_ma[0]){
			$sum = 0;
			for($j=($i-1); $j>=($i-$nilai_ma[0]); $j--) {
				$sum = $sum + $data[$j][2];
			}

			$data[$i][3] = $sum/$nilai_ma[0];
			$data[$i][3] = round($data[$i][3], 3);
			$pola_sma0[$i] = $data[$i][3];
			if($i!=$baris) {
				$data[$i][5] = abs($data[$i][2] - $data[$i][3]);
				if($data[$i][2]==0) {
					$data[$i][7] = 0;	
				} else {
					$data[$i][7] = ($data[$i][5]/$data[$i][2])*100;
				}
				$data[$i][7] = round($data[$i][7],3);
				$data[$i][9] = pow($data[$i][5], 2);
				$jml_ae2 = $jml_ae2 + $data[$i][5];
				$jml_pe2 = $jml_pe2 + $data[$i][7];
				$jml_sd2 = $jml_sd2 + $data[$i][9];
				$n2++;
			}
		}

		if($i<$nilai_ma[1]) {
			$pola_sma1[$i] = null;
			$data[$i][4] = 0;
			$data[$i][6] = 0;
			$data[$i][8] = 0;
			$data[$i][10] = 0;
		} else if($i>=$nilai_ma[1]){
			$sum = 0;
			for($j=($i-1); $j>=($i-$nilai_ma[1]); $j--) {
				$sum = $sum + $data[$j][2];
			}

			$data[$i][4] = $sum/$nilai_ma[1];
			$data[$i][4] = round($data[$i][4], 3);
			$pola_sma1[$i] = $data[$i][4];
			if($i!=$baris) {
				$data[$i][6] = abs($data[$i][2] - $data[$i][4]);
				if($data[$i][2]==0) {
					$data[$i][8] = 0;
				} else {
					$data[$i][8] = ($data[$i][6]/$data[$i][2])*100;
				}
				$data[$i][8] = round($data[$i][8],3);
				$data[$i][10] = pow($data[$i][6], 2);
				$jml_ae5 = $jml_ae5 + $data[$i][6];
				$jml_pe5 = $jml_pe5 + $data[$i][8];
				$jml_sd5 = $jml_sd5 + $data[$i][10];
				$n5++;
			}
		}
	}
	$hsl_mae_sma[0] = $jml_ae2/$n2;
	$hsl_mae_sma[1] = $jml_ae5/$n5;
	$hsl_mape_sma[0] = $jml_pe2/$n2;
	$hsl_mape_sma[1] = $jml_pe5/$n5;
	$hsl_msd_sma[0] = $jml_sd2/$n2;
	$hsl_msd_sma[1] = $jml_sd5/$n5;
 ?>