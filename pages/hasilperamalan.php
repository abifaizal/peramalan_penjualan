<?php 
	$kd_obat = @$_POST['obat'];
	// $kd_obat = array('520013421','623341057');
	$jml_obat = count($kd_obat);

	for($i=0; $i<$jml_obat; $i++) {
		$query_obat = "SELECT kd_obat, nm_obat, sat_obat FROM tbl_dataobat WHERE kd_obat='$kd_obat[$i]'";
		$sql_obat = mysqli_query($conn, $query_obat) or die ($conn->error);
		$data_obat = mysqli_fetch_array($sql_obat);
		// $kd_obat[$i] = $data_obat['kd_obat'];
		$sat_obat[$i] = $data_obat['sat_obat'];
		$nama_obat[$i] = $data_obat['nm_obat'];
	}

	$prd_ramalan = @$_POST['ip_periode'];

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
		$tanggal_akhir = date('2019-12-01');
	} else if($prd_ramalan=="per_hari"){
		$tanggal_akhir = date('Y-m-d');
	}

	$tgl_rml = date('Y-m-d');
	if($prd_ramalan=="per_hari") {
		$interval = @$_POST['jml_hari'];
		$interval_sql = $interval-1;
		$tanggal_awal_rml = date_add(date_create($tgl_rml), date_interval_create_from_date_string("1 DAYS"));
		$tanggal_akhir_rml = date_add(date_create($tgl_rml), date_interval_create_from_date_string("$interval DAYS"));
		$tanggal_awal_rml = date_format($tanggal_awal_rml, 'Y-m-d');
		$tanggal_akhir_rml = date_format($tanggal_akhir_rml, 'Y-m-d');
		$periode_ramal = tgl_indo($tanggal_awal_rml)." sd. ".tgl_indo($tanggal_akhir_rml);
	} else {
		$periode_ramal = periode($tanggal_akhir);
	}
	$metode = @$_POST['met_peramalan'];
	$nilai_ma = array();
	$alpha = array();
	$nilai_ma[0] = 2;
	$nilai_ma[1] = 5;
	$alpha[0] = 0.2;
	$alpha[1] = 0.8;

	
	$hari= substr($tgl_rml, 8, 2);
	$bulan = substr($tgl_rml, 5, 2);
	$tahun = substr($tgl_rml, 0, 4);
	$tgl = $tahun.$bulan.$hari;
	$carikode = mysqli_query($conn, "SELECT MAX(no_rml) FROM tbl_peramalan WHERE tgl_rml = '$tgl_rml'") or die (mysql_error());
	$datakode = mysqli_fetch_array($carikode);
	if($datakode) {
	    $nilaikode = substr($datakode[0], 13);
	    $kode = (int) $nilaikode;
	    $kode = $kode + 1;
	    $no_rml = "PRM/".$tgl."/".str_pad($kode, 3, "0", STR_PAD_LEFT);
	} else {
	    $no_rml = "PRM/".$tgl."/001";
	}
	$query_prm = "INSERT INTO tbl_peramalan VALUES('$no_rml', '$tgl_rml', '$periode_ramal', '$jml_obat', '$nilai_ma[0]', '$nilai_ma[1]', '$alpha[0]', '$alpha[1]')";
	// mysqli_query($conn, $query_prm) or die ($conn->error);

	
 ?>

 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=peramalan"><i class="fas fa-chart-bar"></i> Peramalan Penjualan</a></li>
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
	<?php 
		if($jml_obat==1){
			include 'pages/peramalan_singleobat.php';
			$nama_laporan = "laporan_peramalan";
		} else if($jml_obat>1){
			include 'pages/peramalan_multiobat.php';
			$nama_laporan = "laporan_peramalan_multi";
		}
	 ?>
	<!-- <div style="padding: 20px 10px; text-align: right;">
		<a href="laporan/?page=<?php echo $nama_laporan; ?>&no_rml=<?php echo $no_rml; ?>" target="_blank">
			<button type="button" class="btn btn-success" id="cetak" name="cetak">Cetak</button>
		</a>
	</div> -->
</div>