<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-bar"></i> Peramalan Penjualan</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Peramalan Penjualan</h4></div>
		<div class="col-6 text-right">
      		<a href="?page=riwayat_peramalan">
				<!-- <button class="btn btn-sm btn-info">Riwayat Peramalan</button> -->
			</a>
		</div>
	</div>
	<form action="" method="POST" target="" id="form_peramalan">
		<div class="form-container">
			<div class="row">
				<div class="col-md-6 offset-md-3 offset-form">
					<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk melakukan peramalan penjualan</h6>
					
					  <div class="form-group row">
					    <label for="nm_obat" class="col-sm-3 col-form-label">Pilih Obat</label>
					    <div class="col-sm-9">
					      <div class="input-group">
					      	<textarea name="nm_obat" id="nm_obat" rows="2" class="form-control" placeholder="obat terpilih" style="font-size: 14px; height: 90px;" readonly=""></textarea>
					      	<div class="input-group-append">
	                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_dataobat" id="lihat_data_obat"><i class="fas fa-search"></i></button>
	                        </div>
					      </div>
					    </div>
					  </div>
					  <?php 
					  	$bulan_ini = date("m");
					  	$tahun_ini = date("Y");
					  	if($bulan_ini=="12") {
					  		$bulan_depan = 1;
					  		$tahun_depan = $tahun_ini+1;
					  	} else {
					  		$bulan_depan = $bulan_ini+1;
					  		$tahun_depan = $tahun_ini;
					  	}
					   ?>
					  <div class="form-group row">
					    <label for="ip_periode" class="col-sm-3 col-form-label">Periode Peramalan</label>
					    <div class="col-sm-9">
					      <div class="form-check">
					      	<label class="form-check-label" style="font-weight: normal;">
					      		<input name="ip_periode" id="ip_periode1" type="radio" class="form-check-input" value="bulan_ini" checked=""> 
					      		Bulan ini (<?php echo bulan_indo($bulan_ini)." ".$tahun_ini; ?>)
					      	</label>
					      </div>
	                      <div class="form-check">
	                    	<label class="form-check-label" style="font-weight: normal;">
	                    		<input name="ip_periode" id="ip_periode2" type="radio" class="form-check-input" value="bulan_depan">
	                    		Bulan depan (<?php echo bulan_indo($bulan_depan)." ".$tahun_depan; ?>)
	                    	</label>
	                	  </div>
	                	  <div class="form-check">
	                    	<label class="form-check-label" style="font-weight: normal;">
	                    		<input name="ip_periode" id="ip_periode3" type="radio" class="form-check-input" value="per_hari">
	                    		<input type="number" style="width: 80px; text-align: right;" name="jml_hari" id="jml_hari"> Hari kedepan
	                    	</label>
	                	  </div>
					    </div>
					  </div>
					  <!-- <div class="form-group row">
					    <label for="peri_bulan" class="col-sm-3 col-form-label">Pilih Periode</label>
					    <div class="col-sm-6">
					      <select name="peri_bulan" id="peri_bulan" class="form-control form-control-sm">
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
					      <select name="tahun_peri" id="tahun_peri" class="form-control form-control-sm">
				      	<?php 
				      		// $tahun_ini = date('Y');
				      		$tahun_ini = 2019;
				      		$tahun_akhir = $tahun_ini + 2;
				      		for($i=$tahun_ini; $i<=$tahun_akhir; $i++) {
				      	?>
					      	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					     <?php } ?>
					      </select>
					    </div>
					  </div> -->
					  <div class="form-group row" style="display: none;">
					    <label for="met_peramalan" class="col-sm-3 col-form-label">Metode Peramalan</label>
					    <div class="col-sm-9">
					      <select name="met_peramalan" id="met_peramalan" class="form-control form-control-sm">
					      	<option value="Semua" selected="">Semua</option>
					      	<option value="Single Moving Average">Single Moving Average</option>
					      	<option value="Single Exponential Smoothing">Single Exponential Smoothing</option>
					      </select>
					    </div>
					  </div>
					  <!-- <div class="form-group row">
					    <label for="nilai_ma" class="col-sm-3 col-form-label">Moving Average</label>
					    <div class="col-sm-9">
					      <div class="input-group input-group-sm">
							  <input type="number" class="form-control" id="nilai_ma" name="nilai_ma" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="banyak bulanan rata-rata">
							  <div class="input-group-append">
							    <span class="input-group-text" id="inputGroup-sizing-sm">Bulanan</span>
							  </div>
						  </div>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="nilai_alpha" class="col-sm-3 col-form-label">Weight Smoothing</label>
					    <div class="col-sm-9">
					      <div class="input-group input-group-sm">
							  <input type="text" class="form-control" id="nilai_alpha" name="nilai_alpha" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="nilai bobot pemulusan">
							  <div class="input-group-append">
							    <span class="input-group-text" id="inputGroup-sizing-sm">antara 0 - 1</span>
							  </div>
						  </div>
					    </div>
					  </div> -->
					  <div class="form-group row">
					    <div class="col-sm-12 text-right">
					      <button type="button" class="btn btn-info" id="hitung_ramal" name="hitung_ramal" >Hitung</button>
					    </div>
					  </div>
					
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal_dataobat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-xl" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Data Obat</h5>
		        <button type="button" class="close" data-dismiss="modal" id="tb_close" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <table id="" class="table table-striped display">
		            <thead>
		                <tr>
		                    <th>Kode</th>
		                    <th>Nama Obat</th>
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
		            $no=0;
		            while($data = mysqli_fetch_array($sql_tampil)) {
		         ?>
		                <tr>
		                    <td><?php echo $data['kd_obat']; ?></td>
		                    <td><?php echo $data['nm_obat']; ?></td>
		                    <td><?php echo $data['stk_obat']; ?></td>
		                    <td><?php echo $data['sat_obat']; ?></td>
		                    <td><?php echo $data['ktg_obat']; ?></td>
		                    <td class="td-opsi">
		                        <input class="form-check-input position-static pilih-obat" type="checkbox" name="obat[]" id="obat<?php echo $no++; ?>" value="<?php echo $data['kd_obat']; ?>" data-nama="<?php echo $data['nm_obat']; ?>">
		                    </td>
		                </tr>
		         <?php 
		            } 
		         ?>
		            </tbody>
		        </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" id="selesai_pilih" data-dismiss="modal">Selesai</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>
</div>

<!-- Modal -->

<script>
	var obat = [];
	var nama = [];
	var jml = 0;

	$("button[name='tombol_pilihobat']").click(function() {
        var kode = $(this).data("kode");
        var nama = $(this).data("nama");
        var satuan = $(this).data("satuan");
        $("#ip_kd_obat").val(kode);
        $("#ip_sat_obat").val(satuan);
        $("#nm_obat").val(nama);
    });

    $("#jml_hari").click(function() {
    	$("#ip_periode3").click();
    });

    // $(".pilih-obat").click(function() {
    // 	var kdobat = $(this).val();
    // 	alert(kdobat);
    // });

    $("#selesai_pilih").click(function() {
		$(':checkbox:checked').each(function(i){
	    	obat[i] = $(this).val();
	    	nama[i] = $(this).data('nama');
	   	});
	   	jml = obat.length;
	   	$("#nm_obat").val(nama);

	   	obat = [];
		nama = [];
    });

     $("#tb_close").click(function() {
		$("#selesai_pilih").click();
    });



 //    $("#met_peramalan").change(function() {
	// 	var metode = $(this).val();
	// 	if(metode == "Semua") {
	// 		$("#nilai_ma").removeAttr("disabled");
	// 		$("#nilai_alpha").removeAttr("disabled");
	// 	} else if(metode == "Single Moving Average") {
	// 		$("#nilai_ma").removeAttr("disabled");
	// 		$("#nilai_alpha").attr("disabled", true);
	// 		$("#nilai_alpha").val("");
	// 	} else if(metode == "Single Exponential Smoothing") {
	// 		$("#nilai_ma").attr("disabled", true);
	// 		$("#nilai_ma").val("");
	// 		$("#nilai_alpha").removeAttr("disabled");
	// 	}
	// });

    $("#hitung_ramal").click(function() {
    	var nama = $("#nm_obat").val();
    	var kdobat = $("#nm_obat").val();
    	var metode = $("#met_peramalan").val();
    	var periode = document.querySelector('input[name="ip_periode"]:checked').value;
    	var jml_hari = $("#jml_hari").val();
    	// var nilai_ma = $("#nilai_ma").val();
    	// var alpha = $("#nilai_alpha").val();

    	if(nama=="") {
    		document.getElementById("nm_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong pilih obat terlebih dulu',
              'warning'
            )
    	} 
    	// else if ((metode == "Semua" && (nilai_ma == "" || nilai_ma <= 0)) || (metode == "Single Moving Average" && (nilai_ma == "" || nilai_ma <= 0))) {
    	// 	document.getElementById("nilai_ma").focus();
     //        Swal.fire(
     //          'Data Belum Lengkap',
     //          'maaf, tolong isi nilai moving average untuk metode single moving average',
     //          'warning'
     //        )
    	// } 
    	// else if ((metode == "Semua" && (alpha == "" || alpha <= 0 || alpha >= 1)) || (metode == "Single Exponential Smoothing" && (alpha == "" || alpha <= 0 || alpha >= 1))) {
    	// 	document.getElementById("nilai_alpha").focus();
     //        Swal.fire(
     //          'Data Belum Lengkap',
     //          'maaf, tolong isi nilai bobot pemulusan untuk metode single exponential smoothing',
     //          'warning'
     //        )
    	// } 
    	else if(periode=="bulan_depan"){
    		var form_data = $("#form_peramalan").serialize();
    		$.ajax({
                url: "ajax/cek_datapenjualan.php",
                method: "GET",
                data: form_data,
                success:function(data) {
            		var objKode = JSON.parse(data);
                    if(objKode!="") {
	                    Swal.fire(
			              'Belum ada transaksi penjualan',
			              'maaf, untuk '+objKode+' belum terdapat transaksi penjualan yang dilakukan selama periode yang dipilih sebelumnya',
			              'warning'
			            )
	                } else {
	                	Swal.fire({
				          title: 'peringatan',
				          text: 'untuk melakukan peramalan bulan depan dibutuhkan data penjualan bulan ini, apakah anda yakin data penjualan bulan ini telah lengkap',
				          type: 'warning',
				          showCancelButton: true,
				          confirmButtonColor: '#3085d6',
				          cancelButtonColor: '#d33',
				          confirmButtonText: 'Ya',
				          cancelButtonText: 'Tidak'
				        }).then((yakin) => {
				          if (yakin.value) {
				            var form = document.getElementById("form_peramalan");
							form.action = '?page=hasil_peramalan';
							form.submit();
				          }
				        })
					}                
	            }
            })
    	} else if(periode=="per_hari" && (jml_hari=="" || jml_hari<=0)){
            document.getElementById("jml_hari").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan jumlah hari terlebih dahulu',
              'warning'
            )
    	}
    	else {
    		var form_data = $("#form_peramalan").serialize();
    		$.ajax({
                url: "ajax/cek_datapenjualan.php",
                method: "GET",
                data: form_data,
                success:function(data) {
            		var objKode = JSON.parse(data);
                    if(objKode!="") {
	                    Swal.fire(
			              'Belum ada transaksi penjualan',
			              'maaf, untuk '+objKode+' belum terdapat transaksi penjualan yang dilakukan selama periode yang dipilih sebelumnya',
			              'warning'
			            )
	                } else {
	                	var form = document.getElementById("form_peramalan");
						form.action = '?page=hasil_peramalan';
						form.submit();	                
					}                
	            }
            })
    	}
    });
</script>