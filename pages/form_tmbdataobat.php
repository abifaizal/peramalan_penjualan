<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=dataobat"><i class="fas fa-capsules"></i> Data Obat</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Obat</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=dataobat">
				<button class="btn btn-sm btn-info">Daftar Data Obat</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data obat baru</h6>
				<form action="javascrip:void" autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="ip_kdobat" class="col-sm-3 col-form-label">Kode Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="ip_kdobat" placeholder="masukkan kode obat" autofocus>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_nmobat" class="col-sm-3 col-form-label">Nama Obat</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="ip_nmobat" placeholder="masukkan nama obat">
				    </div>
				  </div>
				  
				  <div class="form-group row">
				    <label for="ip_ktgobat" class="col-sm-3 col-form-label">Kategori</label>
				    <div class="col-sm-9">
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="ip_ktgobat" id="ktg_gen" type="radio" class="form-check-input" value="GENERIK" checked=""> 
				      		Generik
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="ip_ktgobat" id="ktg_paten" type="radio" class="form-check-input" value="PATEN">
                    		Paten
                    	</label>
                	  </div>
                	  <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="ip_ktgobat" id="ktg_hv" type="radio" class="form-check-input" value="HV">
                    		HV
                    	</label>
                	  </div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_bntobat" class="col-sm-3 col-form-label">Bentuk Obat</label>
				    <div class="col-sm-9">
				      <select name="ip_bntobat" id="ip_bntobat" class="form-control form-control-sm">
				      	<option value="0">pilih bentuk obat</option>
				      	<option value="TABLET">Tablet</option>
				      	<option value="KAPLET">Kaplet</option>
				      	<option value="KAPSUL">Kapsul</option>
				      	<option value="SIRUP">Sirup</option>
				      	<option value="CAIR">Cair</option>
				      	<option value="CAIRAN INFUS">Cairan Infus</option>
				      	<option value="SALEP">Salep</option>
				      	<option value="GEL">Gel</option>
				      	<option value="INHALER">Inhaler</option>
				      	<option value="BATANG">Batang</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_stobat" class="col-sm-3 col-form-label">Satuan Jual</label>
				    <div class="col-sm-9">
				      <select name="ip_stobat" id="ip_stobat" class="form-control form-control-sm">
				      	<option value="0">pilih satuan penjualan obat</option>
				      	<option value="TABLET">Tablet</option>
				      	<option value="STRIP">Strip</option>
				      	<option value="SACHET">Sachet</option>
				      	<option value="PCS">Pcs</option>
				      	<option value="PAK">Pak</option>
				      	<option value="TUBE">Tube</option>
				      	<option value="BOTOL">Botol</option>
				      	<option value="BATANG">Batang</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_hrgobat" class="col-sm-3 col-form-label">Harga per <span class="u_satuan" id="u_satuan">Satuan</span></label>
				    <div class="col-sm-9">
				      <div class="input-group input-group-sm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
						  </div>
						  <input type="number" class="form-control" id="ip_hrgobat" name="ip_hrgobat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="masukkan harga obat">
					  </div>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_minstok" class="col-sm-3 col-form-label">Stok Minimal</label>
				    <div class="col-sm-9">
				    	<div class="input-group input-group-sm">
						    <input type="number" class="form-control form-control-sm" id="ip_minstok" name="ip_minstok" placeholder="masukkan jumlah minimal stok obat">
						    <div class="input-group-append">
							    <span class="input-group-text u_satuan" id="inputGroup-sizing-sm">Satuan</span>
							</div>
						</div>
					</div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_expobat" class="col-sm-3 col-form-label">Kadaluarsa</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="ip_expobat" placeholder="masukkan tanggal kadaluarsa">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ip_stokobat" class="col-sm-3 col-form-label">Stok</label>
				    <div class="col-sm-9">
				    	<div class="input-group input-group-sm">
						    <input type="number" class="form-control form-control-sm" id="ip_stokobat" name="ip_stokobat" placeholder="masukkan jumlah stok obat">
						    <div class="input-group-append">
							    <span class="input-group-text u_satuan" id="inputGroup-sizing-sm">Satuan</span>
							</div>
						</div>
					</div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="simpan_obat" name="simpan_obat" >Simpan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#ip_stobat").change(function() {
		var satuan = $("#ip_stobat").val();
		if(satuan=="0")
		{
			satuan = "Satuan";
		}
		$(".u_satuan").text(satuan);
	});

	$("#simpan_obat").click(function(){
		var kode = $("#ip_kdobat").val();
		var nama = $("#ip_nmobat").val();
		var exp = $("#ip_expobat").val();
		var ktg = document.querySelector('input[name="ip_ktgobat"]:checked').value;
		var bentuk = $("#ip_bntobat").val();
		var satuan = $("#ip_stobat").val();
		var harga = $("#ip_hrgobat").val();
		var stok = $("#ip_stokobat").val();
		var min_stok = $("#ip_minstok").val();

		if(kode=="") {
			document.getElementById("ip_kdobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi kode obat',
			  'warning'
			)
		} else if (nama=="") {
			document.getElementById("ip_nmobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama obat',
			  'warning'
			)
		} else if (exp=="") {
			document.getElementById("ip_expobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi tanggal kadaluarsa obat',
			  'warning'
			)
		} else if (ktg=="") {
			document.getElementById("ip_ktgobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih kategori obat',
			  'warning'
			)
		} else if (bentuk=="0") {
			document.getElementById("ip_bntobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih bentuk obat',
			  'warning'
			)
		} else if (satuan=="0") {
			document.getElementById("ip_stobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong pilih satuan penjualan obat',
			  'warning'
			)
		} else if (harga=="" || harga<=0) {
			document.getElementById("ip_hrgobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga obat',
			  'warning'
			)
		} else if (stok=="" || stok<=0) {
			document.getElementById("ip_stokobat").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi jumlah stok obat',
			  'warning'
			)
		} else if (min_stok=="" || min_stok<=0) {
			document.getElementById("ip_minstok").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi jumlah minimal stok obat',
			  'warning'
			)
		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_obat.php",
				data: "nama="+nama+"&kode="+kode+"&exp="+exp+"&ktg="+ktg+"&bentuk="+bentuk+"&satuan="+satuan+"&harga="+harga+"&stok="+stok+"&min_stok="+min_stok,
				success: function(hasil) {
					if(hasil=="tersimpan") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Disimpan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=tambah_dataobat' ;
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
	})
</script>