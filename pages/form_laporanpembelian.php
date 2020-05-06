<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="?page=datapembelian"><i class="fas fa-shopping-bag"></i> Data Pembelian</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file"></i> Form Laporan Pembelian</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Laporan Pembelian</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapembelian">
				<button class="btn btn-sm btn-info">Data Pembelian</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mencetak laporan pembelian</h6>
					<form action="" method="POST" target="blank" id="form_laporanpembelian">
					  <div class="form-group row">
					    <label for="periode_lap" class="col-sm-3 col-form-label">Pilih Periode</label>
					    <div class="col-sm-3">
					      <div class="form-check">
					      	<label class="form-check-label" style="font-weight: normal;">
					      		<input name="periode_lap" id="per_1" type="radio" class="form-check-input" value="hari_ini" checked=""> 
					      		Hari ini
					      	</label>
					      </div>
		            	  <div class="form-check">
			              	<label class="form-check-label" style="font-weight: normal;">
			              		<input name="periode_lap" id="per_2" type="radio" class="form-check-input" value="bulan_ini">
			              		Bulan ini
			              	</label>
			          	  </div>
			          	  <div class="form-check">
			              	<label class="form-check-label" style="font-weight: normal;">
			              		<input name="periode_lap" id="per_3" type="radio" class="form-check-input" value="tahun_ini">
			              		Tahun ini
			              	</label>
			          	  </div>
					    </div>
					    <div class="col-sm-3">
					      <div class="form-check">
					      	<label class="form-check-label" style="font-weight: normal;">
					      		<input name="periode_lap" id="per_4" type="radio" class="form-check-input" value="pertanggal"> 
					      		Per Tanggal
					      	</label>
					      </div>
		                  <div class="form-check">
			              	<label class="form-check-label" style="font-weight: normal;">
			              		<input name="periode_lap" id="per_5" type="radio" class="form-check-input" value="perbulan">
			              		Per Bulan
			              	</label>
			          	  </div>
			          	  <div class="form-check">
			              	<label class="form-check-label" style="font-weight: normal;">
			              		<input name="periode_lap" id="per_6" type="radio" class="form-check-input" value="pertahun">
			              		Per Tahun
			              	</label>
			          	  </div>
					    </div>
					  </div>
					  <div class="form-group row pt-3" style="height: 86px;">
					    <label for="per_tanggal1" class="col-sm-3 col-form-label">
					    	Pilih Tanggal
					    	<div class="form-check">
				              	<label class="form-check-label" id="label_tgl_akhir" style="font-weight: lighter; font-size: 14px; display: none;">
				              		<input name="tgl_akhir" id="tgl_akhir" type="checkbox" class="form-check-input" value="yes">
				              		tgl akhir
				              	</label>
				          	</div>
					    </label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control form-control-sm" name="per_tanggal1" id="per_tanggal1" placeholder="pilih tanggal awal" disabled="">
					      <input type="text" class="form-control form-control-sm mt-1" name="per_tanggal2" id="per_tanggal2" placeholder="pilih tanggal akhir" disabled="">
					    </div>
					  </div>
					  <div class="form-group row pt-3" style="height: 86px;">
					    <label for="per_bulan1" class="col-sm-3 col-form-label">
					    	Pilih Bulan
					    	<div class="form-check">
	              	<label class="form-check-label" id="label_bulan_akhir" style="font-weight: lighter; font-size: 14px; display: none;">
	              		<input name="bulan_akhir" id="bulan_akhir" type="checkbox" class="form-check-input" value="yes">
	              		bulan akhir
	              	</label>
	          	  </div>
					    </label>
					    <div class="col-sm-6">
					      <select name="per_bulan1" id="per_bulan1" class="form-control form-control-sm" disabled="">
					      	<option value="01">Januari</option>
					      	<option value="02">Februari</option>
					      	<option value="03">Maret</option>
					      	<option value="04">April</option>
					      	<option value="05">Mei</option>
					      	<option value="06">Juni</option>
					      	<option value="07">Juli</option>
					      	<option value="08">Agustus</option>
					      	<option value="09">September</option>
					      	<option value="10">Oktober</option>
					      	<option value="11">November</option>
					      	<option value="12">Desember</option>
					      </select>
					      <select name="per_bulan2" id="per_bulan2" class="form-control form-control-sm mt-1" disabled="">
					      	<option value="01">Januari</option>
					      	<option value="02">Februari</option>
					      	<option value="03">Maret</option>
					      	<option value="04">April</option>
					      	<option value="05">Mei</option>
					      	<option value="06">Juni</option>
					      	<option value="07">Juli</option>
					      	<option value="08">Agustus</option>
					      	<option value="09">September</option>
					      	<option value="10">Oktober</option>
					      	<option value="11">November</option>
					      	<option value="12">Desember</option>
					      </select>
					    </div>
					    <div class="col-sm-3">
					      <select name="tahun_perbulan1" id="tahun_perbulan1" class="form-control form-control-sm" disabled="">
				      	<?php 
				      		$tahun_ini = date('Y');
				      		for($i=$tahun_ini; $i>=2017; $i--) {
				      	?>
					      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					     <?php } ?>
					      </select>
					      <select name="tahun_perbulan2" id="tahun_perbulan2" class="form-control form-control-sm mt-1" disabled="">
					    <?php 
				      		$tahun_ini = date('Y');
				      		for($i=$tahun_ini; $i>=2017; $i--) {
				      	?>
					      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					     <?php } ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row pt-3" style="height: 86px;">
					    <label for="per_tahun1" class="col-sm-3 col-form-label">
					    	Pilih Tahun
					    	<div class="form-check">
	              	<label class="form-check-label" id="label_tahun_akhir" style="font-weight: lighter; font-size: 14px; display: none;">
	              		<input name="tahun_akhir" id="tahun_akhir" type="checkbox" class="form-check-input" value="yes">
	              		tahun akhir
	              	</label>
	          	  </div>
					    </label>
					    <div class="col-sm-9">
					      <select name="per_tahun1" id="per_tahun1" class="form-control form-control-sm" disabled="">
					    <?php 
				      		$tahun_ini = date('Y');
				      		for($i=$tahun_ini; $i>=2017; $i--) {
				      	?>
					      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					     <?php } ?>
					      </select>
					      <select name="per_tahun2" id="per_tahun2" class="form-control form-control-sm mt-1" disabled="">
					    <?php 
				      		$tahun_ini = date('Y');
				      		for($i=$tahun_ini; $i>=2017; $i--) {
				      	?>
					      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					     <?php } ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="nm_supplier" class="col-sm-3 col-form-label">Supplier</label>
					    <div class="col-sm-9">
					      <select name="nm_supplier" id="nm_supplier" class="form-control form-control-sm">
					      		<option value="semua">semua</option>
					      <?php 
					      	$sql_supp = mysqli_query($conn, "SELECT no_supp, nama_supp FROM tbl_supplier ORDER BY nama_supp ASC") or die ($conn->error);
					      	while($data_supp = mysqli_fetch_array($sql_supp)) {
					       ?>
					       		<option value="<?php echo $data_supp['no_supp']; ?>"><?php echo $data_supp['nama_supp']; ?></option>
					      <?php } ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="status_pbl" class="col-sm-3 col-form-label">Status</label>
					    <div class="col-sm-9">
					      <select name="status_pbl" id="status_pbl" class="form-control form-control-sm">
				      		<option value="semua">semua</option>
					      	<option value="Lunas">Lunas</option>
					      	<option value="Belum Lunas">Belum Lunas</option>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					  	<div class="col-sm-4" style="padding: 0;">
					      <!-- <button type="button" class="btn btn-danger btn-sm" id="tbl_reset" style="height: 52px; width: 81px;">Reset</button> -->
					    </div>
					    <div class="col-sm-8 text-right">
					      <button type="button" class="btn btn-dark btn-sm" id="tbl_cetakrangkuman" style="width: 81px;">Cetak <br> <small>(rangkuman)</small></button>
					      <button type="button" class="btn btn-success btn-sm" id="tbl_cetakdetail" style="width: 81px;">Cetak <br> <small>(detail)</small></button>
					    </div>
					  </div>
					</form>
			</div>
		</div>
	</div>
</div>

<script>
	var id_tglakhir = 0;
	var id_bulanakhir = 0;
	var id_tahunakhir = 0;

	function alldisable() {
		$("#per_bulan1").attr("disabled", true);
		$("#tahun_perbulan1").attr("disabled", true);
		$("#per_bulan2").attr("disabled", true);
		$("#tahun_perbulan2").attr("disabled", true);
		$("#per_tahun1").attr("disabled", true);
		$("#per_tahun2").attr("disabled", true);
		$("#per_tanggal1").attr("disabled", true);
		$("#per_tanggal2").attr("disabled", true);
		$("#label_tgl_akhir").hide();
		$("#label_bulan_akhir").hide();
		$("#label_tahun_akhir").hide();
		$("#tgl_akhir").prop('checked', false);
		id_tglakhir = 0;
		$("#bulan_akhir").prop('checked', false);
		id_bulanakhir = 0;
		$("#tahun_akhir").prop('checked', false);
		id_tahunakhir = 0;
	};

	$('#per_1').click(function() {
 		alldisable();
	});

	$('#per_2').click(function() {
 		alldisable();
	});

	$('#per_3').click(function() {
 		alldisable();
	});

	$('#per_4').click(function() {
 		$("#per_bulan1").attr("disabled", true);
		$("#tahun_perbulan1").attr("disabled", true);
		$("#per_bulan2").attr("disabled", true);
		$("#tahun_perbulan2").attr("disabled", true);
		$("#per_tahun1").attr("disabled", true);
		$("#per_tahun2").attr("disabled", true);
		$("#per_tanggal1").attr("disabled", false);
		$("#per_tanggal2").attr("disabled", true);
		$("#label_tgl_akhir").show();
		$("#label_bulan_akhir").hide();
		$("#label_tahun_akhir").hide();
		$("#tgl_akhir").prop('checked', false);
		id_tglakhir = 0;
		$("#bulan_akhir").prop('checked', false);
		id_bulanakhir = 0;
		$("#tahun_akhir").prop('checked', false);
		id_tahunakhir = 0;
	});

	$('#per_5').click(function() {
 		$("#per_bulan1").attr("disabled", false);
		$("#tahun_perbulan1").attr("disabled", false);
		$("#per_bulan2").attr("disabled", true);
		$("#tahun_perbulan2").attr("disabled", true);
		$("#per_tahun1").attr("disabled", true);
		$("#per_tahun2").attr("disabled", true);
		$("#per_tanggal1").attr("disabled", true);
		$("#per_tanggal2").attr("disabled", true);
		$("#label_tgl_akhir").hide();
		$("#label_bulan_akhir").show();
		$("#label_tahun_akhir").hide();
		$("#tgl_akhir").prop('checked', false);
		id_tglakhir = 0;
		$("#bulan_akhir").prop('checked', false);
		id_bulanakhir = 0;
		$("#tahun_akhir").prop('checked', false);
		id_tahunakhir = 0;
	});

	$('#per_6').click(function() {
 		$("#per_bulan1").attr("disabled", true);
		$("#tahun_perbulan1").attr("disabled", true);
		$("#per_bulan2").attr("disabled", true);
		$("#tahun_perbulan2").attr("disabled", true);
		$("#per_tahun1").attr("disabled", false);
		$("#per_tahun2").attr("disabled", true);
		$("#per_tanggal1").attr("disabled", true);
		$("#per_tanggal2").attr("disabled", true);
		$("#label_tgl_akhir").hide();
		$("#label_bulan_akhir").hide();
		$("#label_tahun_akhir").show();
		$("#tgl_akhir").prop('checked', false);
		id_tglakhir = 0;
		$("#bulan_akhir").prop('checked', false);
		id_bulanakhir = 0;
		$("#tahun_akhir").prop('checked', false);
		id_tahunakhir = 0;
	});

	$("#tgl_akhir").click(function() {
		if(id_tglakhir == 0) {
			$("#per_tanggal2").attr("disabled", false);
			id_tglakhir = 1;
		} else {
			$("#per_tanggal2").attr("disabled", true);
			$("#per_tanggal2").val("");
			id_tglakhir = 0;
		}
	});

	$("#bulan_akhir").click(function() {
		if(id_bulanakhir == 0) {
			$("#per_bulan2").attr("disabled", false);
			$("#tahun_perbulan2").attr("disabled", false);
			id_bulanakhir = 1;
		} else {
			$("#per_bulan2").attr("disabled", true);
			$("#tahun_perbulan2").attr("disabled", true);
			id_bulanakhir = 0;
		}
	});

	$("#tahun_akhir").click(function() {
		if(id_tahunakhir == 0) {
			$("#per_tahun2").attr("disabled", false);
			id_tahunakhir = 1;
		} else {
			$("#per_tahun2").attr("disabled", true);
			id_tahunakhir = 0;
		}
	});

	function cetak(action) {
		var form_data = $("#form_laporanpembelian").serialize();
		$.ajax({
			url: 'ajax/cek_laporan.php?page=laporan_pembelian',
			method: 'POST',
			data: form_data,
			success:function(data) {
				if(data=="kosong") {
	                Swal.fire({
	                  title: 'Kosong',
	                  text: 'maaf, tidak ditemukan data pembelian dengan kriteria tersebut',
	                  type: 'error',
	                  confirmButtonColor: '#3085d6',
	                  confirmButtonText: 'OK'
	                }).then((ok) => {
	                  
	                })
	            } else {
	            	var form = document.getElementById("form_laporanpembelian");
					form.action = action;
					form.submit();
	            }
            }
		});
	}

	$("#tbl_cetakdetail").click(function() {
		cetak('laporan/?page=laporan_pembelian_detail');
	});

	$("#tbl_cetakrangkuman").click(function() {
		cetak('laporan/?page=laporan_pembelian_rangkuman');
	});
</script>