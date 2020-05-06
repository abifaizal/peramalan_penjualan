<?php 
	include '../koneksi.php';
	$no_faktur = @$_GET['no_faktur'];
 ?>
<link type="text/css" href="./isi/style_css/nota_pembelian.css" rel="stylesheet">

<page backtop="15px">
	<page_header class="page_header">
		(Lampiran Apotek Margo Saras)
	</page_header>
	<div class="page-content">
		<div class="judul">
			NOTA PEMBELIAN
		</div>
		<div style="margin-bottom: 10px;">
			<table class="tabel-datautama">
				<tr>
					<td class="kolom_utama">
						<?php 
							$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_pegawai ON tbl_pembelian.id_peg = tbl_pegawai.id_peg INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE tbl_pembelian.no_faktur = '$no_faktur'";
							$sql = mysqli_query($conn, $query) or die ($conn->error);
							$data_pbl = mysqli_fetch_array($sql);
						 ?>
						<table class="data_nota">
							<tr>
								<td>No Faktur</td>
								<td>: <?php echo $no_faktur; ?></td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td>: <?php echo tgl_indo($data_pbl['tgl_pembelian']); ?></td>
							</tr>
							<tr>
								<td>Supplier</td>
								<td>: <?php echo $data_pbl['nama_supp']; ?></td>
							</tr>
						</table>
					</td>
					<td class="kolom_utama data_apotek">
						<span class="nama_apotek">APOTEK MARGO SARAS</span><br>
						Jl. Kebon Agung, Mriyan Kulon, Margomulyo, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561 <br>
						(Telp) 0822-2775-5005
					</td>
				</tr>
			</table>
		</div>
		<table class="data-item data-item-pembelian" border="1">
			<tr>
				<th class="col_no">No.</th>
				<th class="col_nmobat">Nama Obat</th>
				<th class="col_hrg">Harga</th>
				<th class="col_jml">Jumlah</th>
				<th class="col_sat">Satuan</th>
				<th class="col_subt">Subtotal</th>
			</tr>
	<?php 
		$no = 1;
		$total = 0;
		$query_lihat = "SELECT tbl_dataobat.nm_obat, tbl_pembeliandetail.hrg_beli, tbl_pembeliandetail.jml_beli, tbl_pembeliandetail.sat_beli, tbl_pembeliandetail.subtotal FROM tbl_pembeliandetail INNER JOIN tbl_dataobat ON tbl_pembeliandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_pembeliandetail.no_faktur = '$no_faktur'";
		$sql_lihat = mysqli_query($conn, $query_lihat) or die ($conn->error);
		while($data = mysqli_fetch_array($sql_lihat)) {
		$total = $total+$data['subtotal'];
	 ?>
			<tr>
				<td class="col_no"><?php echo $no++; ?></td>
				<td class="col_nmobat" align="left"><?php echo $data['nm_obat']; ?></td>
				<td class="col_hrg" align="right"><?php echo $data['hrg_beli']; ?></td>
				<td class="col_jml"><?php echo $data['jml_beli']; ?></td>
				<td class="col_sat"><?php echo $data['sat_beli']; ?></td>
				<td class="col_subt" align="right">Rp<?php echo number_format($data['subtotal']); ?></td>
			</tr>
	<?php } ?>
			<tr>
				<th colspan="5" class="col_tot" align="right">Total</th>
				<th class="col_tot" align="right">Rp<?php echo number_format($total); ?></th>
			</tr>
		</table>
		<div class="catatan">
			<table class="tabel-catatan">
				<tr>
					<th colspan="2">Catatan</th>
				</tr>
				<tr>
					<td>Jenis Pembayaran</td>
					<td>: <?php echo $data_pbl['cr_bayar']; ?></td>
				</tr>
				<tr>
					<td>Tgl Jatuh Tempo</td>
					<?php 
						$jth_tempo = tgl_indo($data_pbl['jth_tempo']);
						if ($data_pbl['cr_bayar'] == "Langsung") {
							$jth_tempo = "-";
						}
					 ?>
					<td>: <?php echo $jth_tempo; ?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>: <?php echo $data_pbl['status_byr']; ?></td>
				</tr>
				<?php 
					if ($data_pbl['cr_bayar'] == "Utang" && $data_pbl['status_byr'] == "Lunas") {
				?>
				<tr>
					<td>Tanggal Pelunasan</td>
					<td>: <?php echo tgl_indo($data_pbl['tgl_lunas']); ?></td>
				</tr>
				<?php
					}
				 ?>
			</table>
		</div>
		<div class="paraf">
			<table class="tabel-paraf">
				<tr>
					<td class="keterangan-paraf">Supplier</td>
					<td class="keterangan-paraf kanan">Pembeli</td>
				</tr>
				<tr>
					<td class="isi-paraf"></td>
					<td class="isi-paraf kanan"></td>
				</tr>
				<tr>
					<td class="nama-paraf"><?php echo $data_pbl['nama_supp']; ?></td>
					<td class="nama-paraf kanan">Apotek Margo Saras</td>
				</tr>
			</table>
		</div>
	</div>
	<page_footer>
	
	</page_footer>
</page>