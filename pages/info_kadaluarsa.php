<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=dataobat"><i class="fas fa-capsules"></i> Data Obat </a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-calendar-times"></i> Info Kadaluarsa Obat</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6">
            <h4>Info Kadaluarsa Obat</h4>
            <input type="hidden" id="pos_pgw" value="<?php echo $_SESSION['posisi_peg']; ?>">
        </div>
		<div class="col-6 text-right">
			<a href="?page=dataobat">
				<button class="btn btn-sm btn-info">Daftar Data Obat</button>
			</a>
		</div>
	</div>
	<style>
        ul.nav-pills{
            padding: 12px 15px;
            /*border-bottom: 1px solid #169BB0;*/
        }
        .kotak-data-tab .nav-item{
            font-size: 12px;
            font-weight: lighter;
            padding-bottom: 5px;
            border-bottom: 1px solid #D9DADB;
            margin-right: 15px;
        }
        .kotak-data-tab .nav-link{
            color: #000000;
        }
        .kotak-data-tab .nav-link.active{
            background-color: #169BB0;
        }
        .badge-status {
            padding: 5px;
        }
    </style>
    <div class="kotak-data-tab">
    	<ul class="nav nav-pills" id="pills-tab" role="tablist">
    	  <?php 
    	  	$query_30 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 30 DAY) AND tbl_stokexpobat.stok > 0";
    	  	$sql_30 = mysqli_query($conn, $query_30) or die ($conn->error);
    	  	$jml_30 = mysqli_num_rows($sql_30);

    	  	$query_10 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>CURDATE() AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0";
    	  	$sql_10 = mysqli_query($conn, $query_10) or die ($conn->error);
    	  	$jml_10 = mysqli_num_rows($sql_10);

    	  	$query_telahexp = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp<=CURDATE() AND tbl_stokexpobat.stok > 0";
    	  	$sql_telahexp = mysqli_query($conn, $query_telahexp) or die ($conn->error);
    	  	$jml_telahexp = mysqli_num_rows($sql_telahexp);
    	   ?>
          <li class="nav-item">
            <a class="nav-link active" id="tigapuluh_hari-tab" data-toggle="pill" href="#tigapuluh_hari" role="tab" aria-controls="tigapuluh_hari" aria-selected="true">Kurang Dari 30 Hari <sup>( <?php echo $jml_30; ?> )</sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="sepuluh_hari-tab" data-toggle="pill" href="#sepuluh_hari" role="tab" aria-controls="sepuluh_hari" aria-selected="false">Kurang Dari 10 Hari <sup>( <?php echo $jml_10; ?> )</sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="telah_kadaluarsa-tab" data-toggle="pill" href="#telah_kadaluarsa" role="tab" aria-controls="telah_kadaluarsa" aria-selected="false">Telah Kadaluarsa <sup>( <?php echo $jml_telahexp; ?> )</sup></a>
          </li>
    	</ul>
    	<div class="tab-content" id="pills-tabContent">

    	  <!-- TAB 30 HARI -->
    	  <div class="tab-pane fade show active" id="tigapuluh_hari" role="tabpanel" aria-labelledby="tigapuluh_hari-tab">
            <div class="table-container">
                <table id="example" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Exp Date</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Sisa Hari</th>
                            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                            <th>Kosongkan</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    	$nomor = 1;
                    	while($data_30 = mysqli_fetch_array($sql_30)) {
                    		$exp = date_create($data_30['tgl_exp']);
					    	$today = date_create(date("Y-m-d"));
					    	$sisa = date_diff($today,$exp);
					    	$sisa_hari = $sisa->format("%a");
                     ?>
                     		<tr>
                     			<td><?php echo $nomor++; ?></td>
                     			<td><?php echo $data_30['kd_obat']; ?></td>
                     			<td><?php echo $data_30['nm_obat']; ?></td>
                     			<td><?php echo $data_30['tgl_exp']; ?></td>
                     			<td><?php echo $data_30['stok']; ?></td>
                     			<td><?php echo $data_30['sat_obat']; ?></td>
                     			<td><?php echo $data_30['ktg_obat']; ?></td>
                     			<td><?php echo $sisa_hari; ?> Hari</td>
                                <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                     			<td class="td-opsi">
                     				<button class="btn-transition btn btn-outline-danger btn-sm" title="kosongkan" id="tombol_kosongkan<?php echo $data_30['kd_obat']; ?>" name="tombol_kosongkan" data-kd_obat="<?php echo $data_30['kd_obat']; ?>"
                                     data-exp="<?php echo $data_30['tgl_exp'] ?>"
                                     data-nm_obat="<?php echo $data_30['nm_obat'] ?>"
                                     data-stok="<?php echo $data_30['stok'] ?>">
                                        <i class="fas fa-minus-square"></i>
                                    </button>
                     			</td>
                            <?php } ?>
                     		</tr>
                 	<?php } ?>
                    </tbody>
                </table>
            </div>   
          </div>

          <!-- TAB 10 HARI -->
    	  <div class="tab-pane fade" id="sepuluh_hari" role="tabpanel" aria-labelledby="sepuluh_hari-tab">
            <div class="table-container">
                <table id="example2" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Exp Date</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Sisa Hari</th>
                            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                            <th>Kosongkan</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
	                    	$nomor = 1;
	                    	while($data_10 = mysqli_fetch_array($sql_10)) {
	                    		$exp = date_create($data_10['tgl_exp']);
						    	$today = date_create(date("Y-m-d"));
						    	$sisa = date_diff($today,$exp);
						    	$sisa_hari = $sisa->format("%a");
	                     ?>
	                     		<tr>
	                     			<td><?php echo $nomor++; ?></td>
	                     			<td><?php echo $data_10['kd_obat']; ?></td>
	                     			<td><?php echo $data_10['nm_obat']; ?></td>
	                     			<td><?php echo $data_10['tgl_exp']; ?></td>
	                     			<td><?php echo $data_10['stok']; ?></td>
	                     			<td><?php echo $data_10['sat_obat']; ?></td>
	                     			<td><?php echo $data_10['ktg_obat']; ?></td>
	                     			<td><?php echo $sisa_hari; ?> Hari</td>
                                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
	                     			<td class="td-opsi">
	                     				<button class="btn-transition btn btn-outline-danger btn-sm" title="kosongkan" id="tombol_kosongkan<?php echo $data_10['kd_obat']; ?>" name="tombol_kosongkan" data-kd_obat="<?php echo $data_10['kd_obat']; ?>"
                                         data-exp="<?php echo $data_10['tgl_exp'] ?>"
                                         data-nm_obat="<?php echo $data_10['nm_obat'] ?>"
                                         data-stok="<?php echo $data_10['stok'] ?>">
	                                        <i class="fas fa-minus-square"></i>
	                                    </button>
	                     			</td>
                                <?php } ?>
	                     		</tr>
	                 	<?php } ?>
                    </tbody>
                </table>
            </div>
          </div>

          <!-- TAB TELAH KADALUARSA -->
    	  <div class="tab-pane fade" id="telah_kadaluarsa" role="tabpanel" aria-labelledby="telah_kadaluarsa-tab">
            <div class="table-container">
                <table id="example3" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Exp Date</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Lama Kadaluarsa</th>
                            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                            <th>Kosongkan</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
	                    	$nomor = 1;
	                    	while($data_telahexp = mysqli_fetch_array($sql_telahexp)) {
	                    		$exp = date_create($data_telahexp['tgl_exp']);
						    	$today = date_create(date("Y-m-d"));
						    	$sisa = date_diff($today,$exp);
						    	$sisa_hari = $sisa->format("%a");
	                     ?>
	                     		<tr>
	                     			<td><?php echo $nomor++; ?></td>
	                     			<td><?php echo $data_telahexp['kd_obat']; ?></td>
	                     			<td><?php echo $data_telahexp['nm_obat']; ?></td>
	                     			<td><?php echo $data_telahexp['tgl_exp']; ?></td>
	                     			<td><?php echo $data_telahexp['stok']; ?></td>
	                     			<td><?php echo $data_telahexp['sat_obat']; ?></td>
	                     			<td><?php echo $data_telahexp['ktg_obat']; ?></td>
	                     			<td><?php echo $sisa_hari; ?> Hari</td>
                                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
	                     			<td class="td-opsi">
	                     				<button class="btn-transition btn btn-outline-danger btn-sm" title="kosongkan" id="tombol_kosongkan<?php echo $data_telahexp['kd_obat']; ?>" name="tombol_kosongkan" data-kd_obat="<?php echo $data_telahexp['kd_obat']; ?>"
                                         data-exp="<?php echo $data_telahexp['tgl_exp'] ?>"
                                         data-nm_obat="<?php echo $data_telahexp['nm_obat'] ?>"
                                         data-stok="<?php echo $data_telahexp['stok'] ?>">
	                                        <i class="fas fa-minus-square"></i>
	                                    </button>
	                     			</td>
                                <?php } ?>
	                     		</tr>
	                 	<?php } ?>
                    </tbody>
                </table>
            </div>
          </div>
    	</div>
    </div>
</div>
<script>
    $("button[name='tombol_kosongkan']").click(function() {
        var pos_pgw = $("#pos_pgw").val();
        var kd_obat = $(this).data('kd_obat');
        var nm_obat = $(this).data('nm_obat');
        var exp = $(this).data('exp');
        var stok = $(this).data('stok');

        if(pos_pgw == "Kasir") {
            Swal.fire(
              'Gagal',
              'maaf, anda tidak memiliki hak untuk mengosongkan stok',
              'warning'
            )
        } else {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: 'anda akan mengosongkan stok '+nm_obat+' dengan tanggal kadaluarsa '+exp+'. Tindakan ini tidak akan dapat diubah kembali',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((hapus) => {
              if (hapus.value) {
                $.ajax({
                  type: "POST",
                  url: "ajax/hapus.php?page=kosongkan_stok",
                  data: "id="+kd_obat+"&exp="+exp+"&stok="+stok,
                  success: function(hasil) {
                    Swal.fire({
                      title: 'Berhasil',
                      text: 'Stok '+nm_obat+' untuk tanggal kadaluarsa '+exp+' tersebut telah kosong',
                      type: 'success',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                    }).then((ok) => {
                      if (ok.value) {
                        window.location='?page=info_kadaluarsa';
                      }
                    })
                  }
                })  
              }
            })
        }
    });
</script>