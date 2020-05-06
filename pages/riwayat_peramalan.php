<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=peramalan"><i class="fas fa-chart-bar"></i> Peramalan Penjualan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-history"></i> Riwayat Peramalan</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Riwayat Peramalan Penjualan</h4></div>
		<div class="col-6 text-right">
      		<a href="?page=peramalan">
				<button class="btn btn-sm btn-info">Form Peramalan</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="tbl_riwayatperamalan" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>No Peramalan</th>
					<th>Tanggal Hitung</th>
					<th>Periode Ramalan</th>
					<th>Jumlah Obat</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no=1;
				$query_prm = "SELECT * FROM tbl_peramalan ORDER BY tgl_rml ASC";
				$sql_prm = mysqli_query($conn, $query_prm) or die ($conn->error);
				while($data_prm=mysqli_fetch_array($sql_prm)) {
			?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data_prm['no_rml']; ?></td>
						<td><?php echo $data_prm['tgl_rml']; ?></td>
						<td><?php echo $data_prm['periode_rml']; ?></td>
						<td>
							<?php 
								echo $data_prm['jml_obat'];
								if($data_prm['jml_obat']==1){
									$nama_laporan = "laporan_peramalan";
								} else if($data_prm['jml_obat']>1){
									$nama_laporan = "laporan_peramalan_multi";
								}
							?>
						</td>
						<td class="td-opsi">
							<a href="laporan/?page=<?php echo $nama_laporan; ?>&no_rml=<?php echo $data_prm['no_rml']; ?>" target="_blank">
                              <button class="btn-transition btn btn-outline-dark btn-sm" title="cetak" id="tombol_cetak" name="tombol_cetak">
                                  <i class="fas fa-print"></i>
                              </button>
                            </a>
                            <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-norml="<?php echo $data_prm['no_rml']; ?>">
	                            <i class="fas fa-trash"></i>
	                        </button>
						</td>
					</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("button[name='tombol_hapus']").click(function() {
		var no_rml = $(this).data("norml");
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus riwayat peramalan '+no_rml+', anda tidak dapat mengembalikan data yang telah dihapus.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Hapus'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=riwayat_peramalan",
              data: "id="+no_rml,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=riwayat_peramalan';
		          }
		        })
              }
            })  
          }
        })
	});
</script>