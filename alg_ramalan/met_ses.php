<?php 
	$n = $baris-1;
	$jml_ae02 = 0;
	$jml_ae08 = 0;
	$jml_pe02 = 0;
	$jml_pe08 = 0;
	$jml_sd02 = 0;
	$jml_sd08 = 0;
	$skor_e02 = 0;
	$skor_e08 = 0;
	$pola_ses0 = array();
	$pola_ses1 = array();

	for($i=0; $i<=$baris; $i++) {
		if($i==$baris) {
			if($prd_ramalan=="per_hari"){
				$tanggal_akhir = date('Y-m-d');
				$data_ses[$i][0] = date_add(date_create($tanggal_akhir), date_interval_create_from_date_string("1 DAYS"));
				$data_ses[$i][1] = date_add(date_create($tanggal_akhir), date_interval_create_from_date_string("$interval DAYS"));
				$data_ses[$i][0] = date_format($data_ses[$i][0], 'Y-m-d');
				$data_ses[$i][1] = date_format($data_ses[$i][1], 'Y-m-d');
			} else {
				$data_ses[$i][0] = $bulan_ini;
				$data_ses[$i][1] = $tahun_ini;
			}
			$data_ses[$i][2] = 0;
			$data_ses[$i][5] = 0;
			$data_ses[$i][6] = 0;
			$data_ses[$i][7] = 0;
			$data_ses[$i][8] = 0;
			$data_ses[$i][9] = 0;
			$data_ses[$i][10] = 0;
		}

		if($i==0) {
			$data_ses[$i][3] = $data_ses[$i][2];
			$data_ses[$i][4] = $data_ses[$i][2];
			$data_ses[$i][5] = "0";
			$data_ses[$i][6] = "0";
			$data_ses[$i][7] = "0";
			$data_ses[$i][8] = "0";
			$data_ses[$i][9] = "0";
			$data_ses[$i][10] = "0";
		} else if($i>0){
			$data_ses[$i][3] = $data_ses[$i-1][3] + ($alpha[0] * ($data_ses[$i-1][2] - $data_ses[$i-1][3]));
			$data_ses[$i][3] = round($data_ses[$i][3], 3);
			$pola_ses0[$i] = $data_ses[$i][3];
			$data_ses[$i][4] = $data_ses[$i-1][4] + ($alpha[1] * ($data_ses[$i-1][2] - $data_ses[$i-1][4]));
			$data_ses[$i][4] = round($data_ses[$i][4], 3);
			$pola_ses1[$i] = $data_ses[$i][4];

			if($i!=$baris) {
				$data_ses[$i][5] = abs($data_ses[$i][2] - $data_ses[$i][3]);
				if($data_ses[$i][2]==0) {
					$data_ses[$i][7] = 0;
				} else {
					$data_ses[$i][7] = ($data_ses[$i][5]/$data_ses[$i][2])*100;
				}
				$data_ses[$i][7] = round($data_ses[$i][7],3);
				$data_ses[$i][9] = round(pow($data_ses[$i][5], 2),3);

				$data_ses[$i][6] = abs($data_ses[$i][2] - $data_ses[$i][4]);
				if($data_ses[$i][2]==0) {
					$data_ses[$i][8] = 0;
				} else {
					$data_ses[$i][8] = ($data_ses[$i][6]/$data_ses[$i][2])*100;
				}
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
	}
	$data_ses[0][3] = 0;
	$pola_ses0[0] = null;
	$data_ses[0][4] = 0;
	$pola_ses1[0] = null;
	$hsl_mae_ses[0] = $jml_ae02/$n;
	$hsl_mae_ses[1] = $jml_ae08/$n;
	$hsl_mape_ses[0] = $jml_pe02/$n;
	$hsl_mape_ses[1] = $jml_pe08/$n;
	$hsl_msd_ses[0] = $jml_sd02/$n;
	$hsl_msd_ses[1] = $jml_sd08/$n;
 ?>