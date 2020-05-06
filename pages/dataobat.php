<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-capsules"></i> Data Obat</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Data Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=info_kadaluarsa">
				<button class="btn btn-sm btn-danger">Info Kadaluarsa Obat</button>
			</a>
			 <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
			<!-- <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" title="<under maintenance>">
				<i class="far fa-file-excel"></i> Import Excel
			</button> -->
			<a href="?page=tambah_dataobat">
				<button class="btn btn-sm btn-info">Tambah Data</button>
			</a>
			<?php } ?>
		</div>
	</div>
	<div class="table-container">
		<table id="tabel_dataobat" class="table table-striped display tabel-data">
			<thead>
		        <tr>
		            <th>Kode</th>
		            <th>Nama Obat</th>
		            <!-- <th>Exp Date</th> -->
		            <th>Harga</th>
		            <th>Stok</th>
		            <th>Satuan</th>
		            <th>Kategori</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		<?php 
			$query_tampil = "SELECT * FROM tbl_dataobat ORDER BY nm_obat ASC";
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $data['kd_obat']; ?></td>
		 			<td><?php echo $data['nm_obat']; ?></td>
		 			<!-- <td><?php echo $data['exp_obat']; ?></td> -->
		 			<td><?php echo $data['hrg_obat']; ?></td>
		 			<td><?php echo $data['stk_obat']; ?></td>
		 			<td><?php echo $data['sat_obat']; ?></td>
		 			<td><?php echo $data['ktg_obat']; ?></td>

		 			<td class="td-opsi">
		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail obat" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_obat"
		 				data-kode="<?php echo $data['kd_obat']; ?>"
		 				data-nama="<?php echo $data['nm_obat']; ?>"
		 				data-exp="<?php echo tgl_indo($data['exp_obat']); ?>"
		 				data-ktg="<?php echo $data['ktg_obat']; ?>"
		 				data-bentuk="<?php echo $data['bnt_obat']; ?>"
		 				data-satuan="<?php echo $data['sat_obat']; ?>"
		 				data-harbel="<?php echo "Rp".number_format($data['hrgbeli_obat'], 0,",", "."); ?>"
		 				data-harju="<?php echo "Rp".number_format($data['hrg_obat'], 0,",", ".");; ?>"
		 				data-stok="<?php echo $data['stk_obat']; ?>"
		 				data-minstok="<?php echo $data['minstk_obat']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>
		 			<?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                        <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-kode="<?php echo $data['kd_obat']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-kode="<?php echo $data['kd_obat']; ?>" data-nama="<?php echo $data['nm_obat']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    <?php } ?>
                    </td>
		 		</tr>
		 <?php 
			} 
		 ?>
		    </tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih File Data Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="pages/proses.php" method="post" enctype="multipart/form-data">
		  <div class="position-relative row form-group">
        	<label for="file" class="col-sm-2 col-form-label">File</label>
            <div class="col-sm-10">
            	<input name="file" id="file" type="file" class="form-control-file">
                <small class="form-text text-muted">pilih file bertipe excel (.xlsx)</small>
            </div>
        </div>
		  <div class="form-group row">
		    <div class="col-sm-12 text-right">
		      <input type="submit" name="import" value="import" class="btn btn-sm btn-info">
		    </div>
		  </div>
		</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detail_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Info Detail Obat</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table class="tabel-detail-obat" style="font-size: 14px;">
        <tr>
          <th>Kode</th>
          <td id="det_kode"></td>
        </tr>
        <tr>
          <th>Nama</th>
          <td id="det_nama"></td>
        </tr>
        <tr>
          <th>Kategori</th>
          <td id="det_kat"></td>
        </tr>
        <tr>
          <th>Bentuk</th>
          <td id="det_bentuk"></td>
        </tr>
        <tr>
          <th>Harga Pokok</th>
          <td id="det_harbel"></td>
        </tr>
        <tr>
          <th>Harga Jual (20%)</th>
          <td id="det_harju"></td>
        </tr>
        <tr>
          <th>Satuan Jual</th>
          <td id="det_satuan"></td>
        </tr>
        <tr>
          <th>Jumlah Min. Stok</th>
          <td id="det_mstok"></td>
        </tr>
        <tr>
          <th>Jumlah Stok</th>
          <td id="det_jstok"></td>
        </tr>
        <tr>
          <th>Kadaluarsa (Stok)</th>
          <td id="det_exp"></td>
        </tr>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">tutup</button>
    </div>
  </div>
</div>
</div>

<script>
	$("button[name='tombol_detail']").click(function(){
		var kode = $(this).data('kode');
		var nama = $(this).data('nama');
		var exp = $(this).data('exp');
		var ktg = $(this).data('ktg');
		var bentuk = $(this).data('bentuk');
		var satuan = $(this).data('satuan');
		var harbel = $(this).data('harbel');
		var harju = $(this).data('harju');
		var stok = $(this).data('stok');
		var minstok = $(this).data('minstok');

		$("#det_kode").html(kode);
		$("#det_nama").html(nama);
		$("#det_kat").html(ktg);
		$("#det_bentuk").html(bentuk);
		$("#det_satuan").html(satuan);
		$("#det_harju").html(harju);
		$("#det_harbel").html(harbel);
		$("#det_mstok").html(minstok);
		$("#det_jstok").html(stok);
		$("#det_exp").html("");
		$.ajax({
	      type: "GET",
	      url: "ajax/detail.php?page=expstok_obat",
	      data: "kd_obat="+kode,
	      success: function(data_expstok) {
	        var objData = JSON.parse(data_expstok);
	        $.each(objData, function(key, val) {
	          $("#det_exp").append(val.tgl_exp+" ("+val.stok+")<br>");
	        })
	      }
	    });
	});

	$("button[name='tombol_edit']").click(function(){
		var kode = $(this).data('kode');
		window.location='?page=edit_dataobat&kode='+kode;
	});

	$("button[name='tombol_hapus']").click(function(){
		var kode = $(this).data('kode');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan obat ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=dataobat",
              data: "id="+kode,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=dataobat';
		          }
		        })
              }
            })  
          }
        })
	});
</script>