<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"></i> Home</li>
  </ol>
</nav>
<div class="page-content">
	<div>
		<div class="col-12"><h5>Selamat datang <?php echo $_SESSION['nama_peg']; ?></h5></div>
	</div>
	<style>
		h6 {
			font-size: 14px;
		}
	</style>
	<div class="konten-home" style="margin-top: 25px;">
		<div class="row" style="margin-bottom: 18px;">
			<div class="col-lg-6">
				<?php 
					$tgl_ini = date('Y-m-d');
					$query_tpenjualan = "SELECT SUM(total_penjualan) AS total FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_ini'";
					$sql_tpenjualan = mysqli_query($conn, $query_tpenjualan) or die ($conn->error);
					$dpenjualan = mysqli_fetch_array($sql_tpenjualan);
					$tpenjualan = $dpenjualan['total'];
				 ?>
				<div class="card text-white" style="background-color: #58898c;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Total Penjualan Hari ini</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	Rp<?php echo number_format($tpenjualan); ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-6">
				<?php 
					$query_tpembelian = "SELECT SUM(total_pembelian) AS total_pbl FROM tbl_pembelian WHERE tgl_pembelian = '$tgl_ini'";
					$sql_tpembelian = mysqli_query($conn, $query_tpembelian) or die ($conn->error);
					$dpembelian = mysqli_fetch_array($sql_tpembelian);
					$tpembelian = $dpembelian['total_pbl'];
				 ?>
				<div class="card text-white" style="background-color: #877652;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Total Pembelian Hari ini</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	Rp<?php echo number_format($tpembelian); ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 18px;">
			<div class="col-lg-6">
				<?php 
					$query_jpenjualan = "SELECT no_penjualan FROM tbl_penjualan WHERE tgl_penjualan='$tgl_ini'";
					$sql_jpenjualan = mysqli_query($conn, $query_jpenjualan) or die ($conn->error);
					$jpenjualan = mysqli_num_rows($sql_jpenjualan);
				 ?>
				<div class="card text-white" style="background-color: #527b87;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jumlah Transaksi Penjualan Hari ini</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jpenjualan; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-3">
				<?php 
					$query_pblutang = "SELECT no_faktur FROM tbl_pembelian WHERE status_byr='Belum Lunas'";
					$sql_pblutang = mysqli_query($conn, $query_pblutang) or die ($conn->error);
					$jpblutang = mysqli_num_rows($sql_pblutang);
				 ?>
				<div class="card text-white" style="background-color: #876952;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jml T. Pembelian Belum Lunas</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jpblutang; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-3">
				<?php 
					$query_pbljtempo = "SELECT no_faktur FROM tbl_pembelian WHERE status_byr='Belum Lunas' AND jth_tempo='$tgl_ini'";
					$sql_pbljtempo = mysqli_query($conn, $query_pbljtempo) or die ($conn->error);
					$jpbljtempo = mysqli_num_rows($sql_pbljtempo);
				 ?>
				<div class="card text-white" style="background-color: #878452;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Pembelian Jth Tempo Hari ini</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jpbljtempo; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 18px;">
			<div class="col-lg-6">
				<?php 
					$query_jproduk = "SELECT kd_obat FROM tbl_dataobat";
					$sql_jproduk = mysqli_query($conn, $query_jproduk) or die ($conn->error);
					$jproduk = mysqli_num_rows($sql_jproduk);
				 ?>
				<div class="card text-white" style="background-color: #87526d;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jumlah Produk</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        <?php echo $jproduk; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-6">
				<?php 
					$query_jstok = "SELECT kd_obat FROM tbl_dataobat WHERE stk_obat<=minstk_obat";
					$sql_jstok = mysqli_query($conn, $query_jstok) or die ($conn->error);
					$jstok = mysqli_num_rows($sql_jstok);
				 ?>
				<div class="card text-white" style="background-color: #875259;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jumlah Produk dengan Stok Kurang</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jstok; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 18px;">
			<div class="col-lg-4">
				<?php 
					$query_30 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 30 DAY) AND tbl_stokexpobat.stok > 0";
		    	  	$sql_30 = mysqli_query($conn, $query_30) or die ($conn->error);
		    	  	$jml_30 = mysqli_num_rows($sql_30);
				 ?>
				<div class="card text-white" style="background-color: #5a8752;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jml Produk kadaluarsa < 30 Hari</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        <?php echo $jml_30; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-4">
				<?php 
					$query_10 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>CURDATE() AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0";
		    	  	$sql_10 = mysqli_query($conn, $query_10) or die ($conn->error);
		    	  	$jml_10 = mysqli_num_rows($sql_10);	
				 ?>
				<div class="card text-white" style="background-color: #8c5731;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jml Produk kadaluarsa < 10 Hari</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jml_10; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
			<div class="col-lg-4">
				<?php 
					$query_exp = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp<=CURDATE() AND tbl_stokexpobat.stok > 0";
					$sql_exp = mysqli_query($conn, $query_exp) or die ($conn->error);
					$jexp = mysqli_num_rows($sql_exp);
				 ?>
				<div class="card text-white" style="background-color: #7b5287;">
			      <div class="card-body" style="padding: 10px 20px;">
			        <h6 class="card-title">Jml Produk Telah Kadaluarsa</h6>
			        <div class="card-text" align="right" style="font-size: 34px; font-weight: lighter;">
			        	<?php echo $jexp; ?>
			        </div>
			        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
			      </div>
			    </div>
			</div>
		</div>
	</div>
</div>
