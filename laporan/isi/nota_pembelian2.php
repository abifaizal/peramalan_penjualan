<?php 
	include '../koneksi.php';
	$no_faktur = @$_GET['no_faktur'];
 ?>
<link type="text/css" href="./isi/style_css/tanda_pembayaran.css" rel="stylesheet">

<page backtop="15px">
	<page_header class="page_header">
		(Lampiran Apotek Margo Saras)
	</page_header>
	<page_footer>
	</page_footer>
	<div class="page-content">
		<div class="data-apotek">
			<span class="nama_apotek" style="font-weight: bold;">APOTEK MARGO SARAS</span><br>
			Jl. Kebon Agung, Mriyan Kulon, Margomulyo, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561 <br>
			(Telp) 0822-2775-5005
		</div>
		<div style="border-bottom: 1px solid; margin: 15px 0;"></div>
		<div class="judul-surat">
			<span class="judul">SURAT TANDA PELUNASAN</span>
		</div>
		<div class="data-transaksi" style="line-height: 1.6; margin-bottom: 12px;">
			Dengan surat ini menyatakan bahwa transaksi :
			<?php 
				$query = "SELECT * FROM tbl_pembelian INNER JOIN tbl_pegawai ON tbl_pembelian.id_peg = tbl_pegawai.id_peg INNER JOIN tbl_supplier ON tbl_pembelian.no_supplier = tbl_supplier.no_supp WHERE tbl_pembelian.no_faktur = '$no_faktur'";
				$sql = mysqli_query($conn, $query) or die ($conn->error);
				$data_pbl = mysqli_fetch_array($sql);
			 ?>
			<table class="data-nota">
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
		<div class="pernyataan">
			Telah <b>LUNAS</b> dibayar kepada petugas supplier dari  <?php echo $data_pbl['nama_supp']; ?> pada tanggal <?php echo tgl_indo($data_pbl['tgl_lunas']); ?>.
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
</page>