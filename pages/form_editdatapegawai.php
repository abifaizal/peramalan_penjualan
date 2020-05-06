<?php 
	$id_peg = @$_GET['id'];
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapegawai"><i class="fas fa-users"></i> Data Pegawai</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-edit"></i> Form Edit Data Pegawai</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Pegawai</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapegawai">
				<button class="btn btn-sm btn-info">Daftar Data Pegawai</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data pegawai</h6>
				<form action="javascrip:void(0);">
				  <div class="form-group row pt-3">
				    <label for="id_peg" class="col-sm-3 col-form-label">ID</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="id_peg" value="<?php echo $id_peg; ?>" disabled>
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM tbl_pegawai WHERE id_peg='$id_peg'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nama_peg" class="col-sm-3 col-form-label">Nama</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_peg" value="<?php echo $data['nama_peg'] ?>" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="pos_peg" class="col-sm-3 col-form-label">Posisi</label>
				    <div class="col-sm-9">
				      <select name="pos_peg" id="pos_peg" class="form-control form-control-sm" <?php if($_SESSION['id_peg'] == $id_peg) { echo "disabled";} ?>>
				      	<option value="0">pilih posisi pegawai</option>
				      	<option value="Admin" <?php if($data['pos_peg'] == "Admin") {echo "selected";} ?>>Admin</option>
				      	<option value="Manager" <?php if($data['pos_peg'] == "Manager") {echo "selected";} ?>>Manager</option>
				      	<option value="Apoteker" <?php if($data['pos_peg'] == "Apoteker") {echo "selected";} ?>>Apoteker</option>
				      	<option value="Kasir" <?php if($data['pos_peg'] == "Kasir") {echo "selected";} ?>>Kasir</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="jk_peg" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_peg" id="jk_peg1" type="radio" class="form-check-input" value="Laki-laki" <?php if($data['jk_peg'] == "Laki-laki") {echo "checked";} ?>> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_peg" id="jk_peg2" type="radio" class="form-check-input" value="Perempuan" <?php if($data['jk_peg'] == "Perempuan") {echo "checked";} ?>>
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="tlahir_peg" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="tlahir_peg" value="<?php echo $data['lhr_peg'] ?>">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="alm_peg" class="col-sm-3 col-form-label">Alamat</label>
				    <div class="col-sm-9">
				      <textarea name="indikasi_obat" id="alm_peg" rows="2" class="form-control" placeholder="masukkan alamat pegawai" style="font-size: 14px;"><?php echo $data['alamat_peg'] ?></textarea>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="hp_peg" class="col-sm-3 col-form-label">No HP</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="hp_peg" value="<?php echo $data['hp_peg'] ?>">
				    </div>
				  </div>

				  <?php if($_SESSION['id_peg'] == $id_peg) { ?>
				  <div class="form-group row">
				    <label for="usern_peg" class="col-sm-3 col-form-label">Username</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="usern_peg" value="<?php echo $data['username'] ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="pass_peg" class="col-sm-3 col-form-label">Password</label>
				    <div class="col-sm-9">
				      <div class="input-group input-group-password">
                        <input type="password" class="form-control form-control-sm" id="pass_peg" value="<?php echo $data['password'] ?>">
                        <div class="input-group-append">
                            <div class="btn btn-secondary btn-sm" title="lihat password" id="lihat_password"><i class="fas fa-eye"></i></div>
                        </div>
                      </div>
				    </div>
				  </div>
				  <?php } else { ?>
				  	<input type="hidden" class="form-control form-control-sm" id="usern_peg" value="<?php echo $data['username'] ?>">
				  	<input type="hidden" class="form-control form-control-sm" id="pass_peg" value="<?php echo $data['password'] ?>">
				  <?php } ?>

				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <!-- <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button> -->
				      <button class="btn btn-info btn-sm" id="btn_simpan_edit">Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	var status_password = 0;
	$("#lihat_password").click(function() {
		// alert();
		if(status_password==0) {
			$('.input-group-password').find('input:password').prop({type:"text"});
			status_password = 1;
		} else if(status_password==1) {
			$('.input-group-password').find('input:text').prop({type:"password"});
			status_password = 0;
		}
	});

	$("#btn_simpan_edit").click(function() {
		var id = $("#id_peg").val();
		var nama = $("#nama_peg").val();
		var posisi = $("#pos_peg").val();
		var tgl_lahir = $("#tlahir_peg").val();
		var alamat = $("#alm_peg").val();
		var no_hp = $("#hp_peg").val();
		var username = $("#usern_peg").val();
		var password = $("#pass_peg").val();
		var jk = document.querySelector('input[name="jk_peg"]:checked').value;

		if(nama=="") {
			document.getElementById("nama_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pegawai',
			  'warning'
			)
		} else if (posisi=="0") {
			document.getElementById("pos_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih posisi pegawai',
			  'warning'
			)
		} else if (tgl_lahir=="") {
			document.getElementById("tlahir_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi tanggal lahir pegawai',
			  'warning'
			)
		} else if (alamat=="") {
			document.getElementById("alm_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat pegawai',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("hp_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor handphone pegawai',
			  'warning'
			)
		} else if (username=="") {
			document.getElementById("usern_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi username pegawai',
			  'warning'
			)
		} else if (password=="") {
			document.getElementById("pass_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi password pegawai',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data pegawai',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_pegawai.php",
	              data: "nama="+nama+"&posisi="+posisi+"&tgl_lahir="+tgl_lahir+"&alamat="+alamat+"&username="+username+"&password="+password+"&jk="+jk+"&no_hp="+no_hp+"&id="+id,
	              success: function(hasil) {
	              	if(hasil=="gagal-username") {
						document.getElementById("usern_peg").focus();
						Swal.fire(
						  'Peringatan',
						  'Username Telah Digunakan, Ganti Username Pegawai',
						  'warning'
						)
					} else if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Diubah',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=datapegawai' ;
				          }
				        })
					}else if(hasil=="gagal") {
						Swal.fire(
						  'Gagal',
						  'Data Gagal Diubah',
						  'error'
						)
					}
	              }
	            })  
	          }
	        })
	    }
	});
</script>