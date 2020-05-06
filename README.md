# Aplikasi POS Apotek dan Peramalan Penjualan Obat dengan Metode Single Moving Average dan Single Exponential Smoothing
Daftar fitur :
- Transaksi Penjualan Obat dan laporan
- Transaksi Pembelian Obat dan laporan
- Peramalan Angka Penjualan Obat untuk Periode Berikutnya

Metode Peramalan yang digunakan :
- Single Moving Average (MA 2 dan 5 periode)
- Single Exponential Smoothing (alpha 0.2 dan 0.8)

Hasil Peramalan disini adalah ramalan angka penjualan obat untuk n periode kedepan.
Hasil Peramalan diperoleh dari perbandingan hasil perhitungan dari kedua metode dengan tingkat error terendah.

Cara install di localhost :
- Import database "db_apt_margosaras" ke dalam database anda.
- Ubah data untuk koneksi ke localhost anda dengan mengubah file "koneksi.php".
- Siap di akses melalui localhost.
- username / pasword : admin / admin.
