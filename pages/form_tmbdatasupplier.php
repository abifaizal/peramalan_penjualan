<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Supplier</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Supplier</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Supplier</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datasupplier">
				<button class="btn btn-sm btn-info">Daftar Data Supplier</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data supplier baru</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="nama_supp" class="col-sm-3 col-form-label">Nama Supplier</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_supp" placeholder="masukkan nama supplier" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="nama_pet" class="col-sm-3 col-form-label">Nama Petugas</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pet" placeholder="masukkan nama petugas" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_petugas" class="col-sm-3 col-form-label">No HP Petugas</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm" id="no_petugas" placeholder="masukkan nomor hp petugas" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="alm_supp" class="col-sm-3 col-form-label">Alamat Supplier</label>
				    <div class="col-sm-9">
				      <textarea name="alm_supp" id="alm_supp" rows="2" class="form-control" placeholder="masukkan alamat supplier" style="font-size: 14px;"></textarea>
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
	function reset_form() {
		$("#nama_supp").val("");
		$("#nama_pet").val("");
		$("#no_petugas").val("");
		$("#alm_supp").val("");
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_supp").focus();
	});

	$("#btn_simpan").click(function() {
		var nama_supp = $("#nama_supp").val();
		var nama_pet = $("#nama_pet").val();
		var no_petugas = $("#no_petugas").val();
		var alm_supp = $("#alm_supp").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if(nama_supp=="") {
			document.getElementById("nama_supp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama supplier',
			  'warning'
			)
		} else if (nama_pet=="") {
			document.getElementById("nama_pet").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama petugas supplier',
			  'warning'
			)
		} else if (no_petugas=="") {
			document.getElementById("no_petugas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas supplier',
			  'warning'
			)
		} else if (alm_supp=="") {
			document.getElementById("alm_supp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat supplier',
			  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_supplier.php",
				data: "nama_supp="+nama_supp+"&nama_pet="+nama_pet+"&no_petugas="+no_petugas+"&alm_supp="+alm_supp,
				success: function(hasil) {
					if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Disimpan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=datasupplier' ;
				          }
				        })
					} else if(hasil=="gagal") {
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