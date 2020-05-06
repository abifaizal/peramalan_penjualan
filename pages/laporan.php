<style>
	.canvas {
		padding: 20px;
		height: 450px;
		/*width: 90%;*/
	}
</style>

<div class="canvas">
	<canvas id="myChart">
		
	</canvas>
</div>

<?php 
	// $tanggal_akhir = "2020-03-01";
	$tanggal_akhir = date('Y-m-01');
	$kd_obat = "520013421";
	$judul = "Pola Data Penjualan Obat Sanmol";
	$labels = array();
	$data = array();
	$data2 = array(1, 2, 4, 6, 7, 8);
	// echo json_encode($data);

	for($i=10; $i>=0; $i--) {
		$query_tjl = "SELECT YEAR(DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH)) AS dua, MONTH(DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH)) AS satu, DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH) AS tgl_awal, IFNULL(SUM(tbl_penjualandetail.jml_jual), 0) AS jumlah_terjual FROM tbl_penjualan INNER JOIN tbl_penjualandetail ON tbl_penjualan.no_penjualan = tbl_penjualandetail.no_penjualan WHERE tbl_penjualandetail.kd_obat = '$kd_obat' AND (tbl_penjualan.tgl_penjualan >= DATE_SUB('$tanggal_akhir', INTERVAL 1 MONTH) AND tbl_penjualan.tgl_penjualan < '$tanggal_akhir')";
		$sql_tjl = mysqli_query($conn, $query_tjl) or die ($conn->error);
		$dpenjualan = mysqli_fetch_array($sql_tjl);
		$labels[$i] = bulan_indo($dpenjualan['satu'])." ".$dpenjualan['dua'];
		$data[$i] = (int)$dpenjualan['jumlah_terjual'];

		$tanggal_akhir = $dpenjualan['tgl_awal'];
	}

	$labels2 = array();
	$data2 = array();

	for($i=0; $i<=10; $i++) {
		$labels2[] = $labels[$i];
		$data2[] = $data[$i];
	}

	// echo json_encode($data);
	// echo "<br>";
	// echo json_encode($labels);
	// echo "<br>";
	// echo json_encode($data2);
	// echo "<br>";
	// echo json_encode($labels2);
	// echo "<br>";
	// echo json_encode($data2);
 ?>

<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: <?php echo json_encode($labels2); ?>,
	        datasets: [{
	            label: <?php echo json_encode($judul); ?>,
	            fill: false,
	            // borderDash: [5, 5],
	            data: <?php echo json_encode($data2); ?>,
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.2)',
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)',
	                'rgba(75, 192, 192, 0.2)',
	                'rgba(153, 102, 255, 0.2)',
	                'rgba(255, 159, 64, 0.2)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	    	responsive: true,
	    	maintainAspectRatio: false,
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
</script>