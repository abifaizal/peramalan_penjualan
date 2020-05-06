<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=entry_datapenjualan"><i class="fas fa-align-left"></i> Form Transaksi Penjualan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=datapenjualan"><i class="fas fa-file-invoice-dollar"></i> Data Penjualan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-invoice-dollar"></i> Data Penjualan per Obat</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Data Penjualan per Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapenjualan">
				<button class="btn btn-sm btn-info">Data Penjualan</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="tbl_pjlobat" class="table table-striped display tabel-data">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Obat</th>
					<th>Nama Obat</th>
					<th>Satuan</th>
					<th>Jumlah Terjual</th>
					<th>Pemasukan</th>
				</tr>
			</thead>
			<?php 
				$tgl_sekarang = date('Y-m-d');
				$nomor = 1;
				$query_pjlobat = "SELECT nm_obat, tbl_penjualandetail.kd_obat, sat_obat, SUM(tbl_penjualandetail.jml_jual) AS jml_terjual, SUM(tbl_penjualandetail.hrg_jual*tbl_penjualandetail.jml_jual) AS keuntungan FROM tbl_penjualandetail INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat INNER JOIN tbl_penjualan ON tbl_penjualandetail.no_penjualan = tbl_penjualan.no_penjualan WHERE (tbl_penjualan.tgl_penjualan BETWEEN '' AND '$tgl_sekarang') GROUP BY tbl_penjualandetail.kd_obat ORDER BY nm_obat ASC";
				$sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
			 ?>
			<tbody>
			<?php  
				while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {
			?>
				<tr>
					<td><?php echo $nomor++; ?></td>
					<td><?php echo $data_pjlobat['kd_obat']; ?></td>
					<td><?php echo $data_pjlobat['nm_obat']; ?></td>
					<td><?php echo $data_pjlobat['sat_obat']; ?></td>
					<td><?php echo $data_pjlobat['jml_terjual']; ?></td>
					<td><?php echo number_format($data_pjlobat['keuntungan']); ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
