<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=entry_datapenjualan"><i class="fas fa-align-left"></i> Form Transaksi Penjualan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-invoice-dollar"></i> Data Penjualan</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Data Penjualan Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=form_laporanpenjualan" class="btn btn-sm btn-pink">
				Buat Laporan Penjualan
			</a>
			<a href="?page=datapenjualan_perobat" class="btn btn-sm btn-green">
				Data Penjualan per Obat
			</a>
			<a href="?page=entry_datapenjualan">
				<button class="btn btn-sm btn-info">Transaksi Penjualan Obat</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="tbldata_penjualan" class="table table-striped display tabel-data">
			<thead>
		        <tr>
		            <th>No</th>
		            <th>No Penjualan</th>
		            <th>Tanggal Penjualan</th>
		            <th>Pegawai</th>
		            <th>Total Penjualan</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php 
		    		$no = 1;
		    		$query_tampil = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg ORDER BY tbl_penjualan.tgl_penjualan DESC, tbl_penjualan.no_penjualan DESC";
		    		$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
		    		while($data_pjl = mysqli_fetch_array($sql_tampil)) {
		    	 ?>
		    	 	<tr>
		    	 		<td><?php echo $no++; ?></td>
		    	 		<td><?php echo $data_pjl['no_penjualan']; ?></td>
		    	 		<td><?php echo $data_pjl['tgl_penjualan']; ?></td>
		    	 		<td><?php echo $data_pjl['nama_peg']; ?></td>
		    	 		<td class="text-right"><?php echo $data_pjl['total_penjualan']; ?></td>
			 			<td class="td-opsi">
	                        <button class="btn-transition btn btn-outline-primary btn-sm" title="detail penjualan" id="tombol_detail" name="tombol_detail" data-nopjl="<?php echo $data_pjl['no_penjualan']; ?>" data-tglpjl="<?php echo tgl_indo($data_pjl['tgl_penjualan']); ?>" data-nmpeg="<?php echo $data_pjl['nama_peg']; ?>" data-tunai="<?php echo $data_pjl['tunai']; ?>" data-kembali="<?php echo $data_pjl['kembali']; ?>" data-toggle="modal" data-target="#detail_penjualan">
	                            <i class="fas fa-info-circle"></i>
	                        </button>
	                        <a href="laporan/?page=nota_penjualan&no_pjl=<?php echo $data_pjl['no_penjualan']; ?>" target="_blank">
                              <button class="btn-transition btn btn-outline-dark btn-sm" title="cetak" id="tombol_cetak" name="tombol_cetak">
                                  <i class="fas fa-print"></i>
                              </button>
                            </a>
		    	 			<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager') { ?>
	                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-nopjl="<?php echo $data_pjl['no_penjualan']; ?>">
	                            <i class="fas fa-trash"></i>
	                        </button>
	                    	<?php } ?>
	                    </td>
		    	 	</tr>
		    	 <?php } ?>
		    </tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="detail_penjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<table class="tabel-profil">
        		<tr>
        			<th>No Penjualan</th>
        			<td id="no_penjualandetail">PJL00001</td>
        			<th>Tanggal</th>
        			<td id="tgl_penjualandetail">20/11/19</td>
        		</tr>
        		<tr>
        			<th>Pegawai</th>
        			<td id="nama_pegdetail">Faizal Abidin</td>
        		</tr>
        	</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody id="data_detailpjl">
					<!-- diisi dengan ajax jquery -->
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4" class="text-right">Total :<br>Tunai :<br>Kembali :</th>
						<th class="text-right">
							<span id="total_penjualandetail"></span><br>
							<span id="tunai_penjualandetail"></span><br>
							<span id="kembali_penjualandetail"></span>
						</th>
					</tr>
					<!-- <tr>
						<th colspan="4" class="text-right">Tunai :</th>
						<th class="text-right">
							<span id="tunai_penjualandetail"></span>
						</th>
					</tr> -->
				</tfoot>
			</table>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
</div>

<script>
	$("button[name='tombol_detail']").click(function() {
		var no_pjl = $(this).data("nopjl");
		var tgl_pjl = $(this).data("tglpjl");
		var nm_peg = $(this).data("nmpeg");
		var tunai = $(this).data("tunai");
		var kembali = $(this).data("kembali");
		$("#no_penjualandetail").html(no_pjl);
		$("#tgl_penjualandetail").html(tgl_pjl);
		$("#nama_pegdetail").html(nm_peg);
		$("#tunai_penjualandetail").html(tunai);
		$("#kembali_penjualandetail").html(kembali);

		$("#data_detailpjl").html("");
		$.ajax({
			type: "GET",
			url: "ajax/detail.php?page=penjualan",
			data: "no_pjl="+no_pjl,
			success : function(data) {
				// console.log(data);
				var total_penjualan = 0;
				var objData = JSON.parse(data);
				$.each(objData, function(key,val){
					// $("#data_detailpjl").append(val.nm_obat+"/"+val.hrg_jual+"/"+val.jml_jual+"/"+val.sat_jual+"/"+val.subtotal+"<br>");
					var baris_baru = '';
					baris_baru += '<tr>';
					baris_baru += 	'<td>'+val.nm_obat+'</td>';
					baris_baru += 	'<td class="text-right">'+val.hrg_jual+'</td>';
					baris_baru += 	'<td class="text-center">'+val.jml_jual+'</td>';
					baris_baru += 	'<td>'+val.sat_jual+'</td>';
					baris_baru += 	'<td class="text-right">'+val.subtotal+'</td>';
					baris_baru += '</tr>';

					total_penjualan = total_penjualan + Number(val.subtotal);
					$("#data_detailpjl").append(baris_baru);
					$("#total_penjualandetail").html(total_penjualan);
				})
			}
		});
	});

	$("button[name='tombol_hapus']").click(function() {
		var no_pjl = $(this).data("nopjl");
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data penjualan '+no_pjl+', anda tidak dapat mengembalikan data yang telah dihapus.',
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
              url: "ajax/hapus.php?page=datapenjualan",
              data: "id="+no_pjl,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=datapenjualan';
		          }
		        })
              }
            })  
          }
        })
	});
</script>