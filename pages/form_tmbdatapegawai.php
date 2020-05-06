<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapegawai"><i class="fas fa-users"></i> Data Pegawai</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Pegawai</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Pegawai</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapegawai">
				<button class="btn btn-sm btn-info">Daftar Data Pegawai</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data obat baru</h6>
				<form action="javascrip:void(0);">
				  <div class="form-group row pt-3">
				    <label for="nama_peg" id="label_nama" class="col-sm-3 col-form-label">Nama</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_peg" placeholder="masukkan nama pegawai" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="pos_peg" class="col-sm-3 col-form-label">Posisi</label>
				    <div class="col-sm-9">
				      <select name="pos_peg" id="pos_peg" class="form-control form-control-sm">
				      	<option value="0">pilih posisi pegawai</option>
				      	<option value="Admin">Admin</option>
				      	<option value="Manager">Manager</option>
				      	<option value="Apoteker">Apoteker</option>
				      	<option value="Kasir">Kasir</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="jk_peg" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_peg" id="jk_peg1" type="radio" class="form-check-input" value="Laki-laki" checked=""> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_peg" id="jk_peg2" type="radio" class="form-check-input" value="Perempuan">
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="tlahir_peg" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="tlahir_peg" placeholder="masukkan tanggal lahir pegawai">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="alm_peg" class="col-sm-3 col-form-label">Alamat</label>
				    <div class="col-sm-9">
				      <textarea name="alm_peg" id="alm_peg" rows="2" class="form-control" placeholder="masukkan alamat pegawai" style="font-size: 14px;"></textarea>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="hp_peg" class="col-sm-3 col-form-label">No HP</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="hp_peg" placeholder="masukkan nomor handphone pegawai">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="usern_peg" class="col-sm-3 col-form-label">Username</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="usern_peg" placeholder="masukkan username pegawai">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="pass_peg" class="col-sm-3 col-form-label">Password</label>
				    <div class="col-sm-9">
				      <div class="input-group input-group-password">
                        <input type="password" class="form-control form-control-sm" id="pass_peg" placeholder="masukkan password pegawai">
                        <div class="input-group-append">
                            <div class="btn btn-secondary btn-sm" title="lihat password" id="lihat_password"><i class="fas fa-eye"></i></div>
                        </div>
                      </div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
				      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>
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

	function reset_form() {
		$("#nama_peg").val("");
		$("#pos_peg").val(0);
		$("#tlahir_peg").val("");
		$("#alm_peg").val("");
		$("#hp_peg").val("");
		$("#usern_peg").val("");
		$("#pass_peg").val("");
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_peg").focus();
	});

	function hasNumber(nama) {
		return /\d/.test(nama);
	}
	$("#label_nama").click(function() {
		var nama = $("#nama_peg").val();
		var cek = hasNumber(nama);
		if(cek) {
			alert();
		}
	});

	$("#btn_simpan").click(function() {
		var nama = $("#nama_peg").val();
		var cek_nama = hasNumber(nama);
		var posisi = $("#pos_peg").val();
		var tgl_lahir = $("#tlahir_peg").val();
		var alamat = $("#alm_peg").val();
		var no_hp = $("#hp_peg").val();
		var username = $("#usern_peg").val();
		var password = $("#pass_peg").val();
		var jk = document.querySelector('input[name="jk_peg"]:checked').value;

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if(nama=="" || cek_nama) {
			document.getElementById("nama_peg").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pegawai dengan benar',
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
			$.ajax({
				type: "POST",
				url: "ajax/simpan_pegawai.php",
				data: "nama="+nama+"&posisi="+posisi+"&tgl_lahir="+tgl_lahir+"&alamat="+alamat+"&username="+username+"&password="+password+"&jk="+jk+"&no_hp="+no_hp,
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
				          text: 'Data Berhasil Disimpan',
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
						  'Data Gagal Disimpan',
						  'error'
						)
					}
				}
			});
		}
	});
</script>