<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Supplier</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Supplier</h4></div>
		<div class="col-6 text-right">
			<a href="?page=tambah_datasupplier">
				<button class="btn btn-sm btn-info">Tambah Data</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
		        <tr>
		            <th>No</th>
		            <th>Nama Supplier</th>
		            <th>Alamat</th>
		            <th>Nama Petugas</th>
		            <th>Kontak Petugas</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		<?php 
			$no = 1;
			$query_tampil = "SELECT * FROM tbl_supplier";
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $no++; ?></td>
		 			<td><?php echo $data['nama_supp']; ?></td>
		 			<td><?php echo $data['alm_supp']; ?></td>
		 			<td><?php echo $data['nama_pet']; ?></td>
		 			<td><?php echo $data['nohp_pet']; ?></td>
		 			<td class="td-opsi">
                        <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_supp']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_supp']; ?>" data-nama="<?php echo $data['nama_supp']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
		 		</tr>
		 <?php 
			} 
		 ?>
		    </tbody>
		</table>
	</div>
</div>

<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data '+nama+', semua data transaksi pembelian yang berkaitan dengan supplier ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=supplier",
              data: "id="+id,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=datasupplier';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_datasupplier&id='+id;
	});
</script>