<?php 
  require_once "koneksi.php";
  session_start();
  if(!@$_SESSION['posisi_peg']) {
    echo "<script>window.location='login.php';</script>";
  } else {
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="asset/img/logo/logo.jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap_4/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/private_style/style_index.css">
    <link rel="stylesheet" href="asset/font_awesome/css/all.css">
    <link rel="stylesheet" href="asset/DataTables/datatables.min.css">
    <link rel="stylesheet" href="asset/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="asset/bootstrap_datepicker1.9.0/css/bootstrap-datepicker.min.css">

    <title>
      Aplikasi Forecasting Apotek Margo Saras | 
      <?php 
        if(@$_GET['page']=='') {
          echo "Dashboard";
        } else if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat') {
          echo "Data Obat";
        } else if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {
          echo "Data Pegawai";
        } else if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='datapenjualan_perobat') {
          echo "Data Penjualan";
        } else if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian') {
          echo "Data Pembelian";
        } else if(@$_GET['page']=='laporan') {
          echo "Laporan";
        }
      ?>
    </title>
  </head>
  <body class="bg-light">
  	<!-- <div class="logo bg-info">
  		<span class="navbar-brand logo-atas text-white" href="#">Aplikasi Sales Forecasting - Apotek Margo Saras</span>
  	</div> -->
  	<div id="container">
  	<div id="main">
  	<div class="col-md-12 bg-info p-1 title">
  		<!-- <div class="container"> -->
  		<div class="row">
  			<div class="col-md-6">
  				<span class="text-white font-weight-light">Aplikasi Sale Forecasting - Apotek Margo Saras</span>
  			</div>
  			<div class="col-md-6 text-right">
  				<!-- <button class="btn btn-sm bg-light text-info">
  					<i class="fas fa-user-circle"></i> Admin
  				</button> -->
          <span class="text-white tanggal-jam" id="tanggal"><?php echo date('d M Y'); ?> -</span><span class="text-white tanggal-jam" id="jam"></span>
  				<div class="btn-group">
  				  <button type="button" class="btn btn-light btn-sm dropdown-toggle font-weight-light" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
  				    <i class="fas fa-user-circle"></i> <?php echo $_SESSION['posisi_peg']; ?>
  				  </button>
  				  <div class="dropdown-menu dropdown-menu-right p-1">
  				    <!-- <button class="dropdown-item" type="button">Lihat Profil</button>
  				    <button class="dropdown-item" type="button">Logout</button> -->
  				    <div class="col-12 text-center nama-posisi">
  				    	<h2>
  				    		<i class="fas fa-user-circle"></i>
  				    	</h2>
  				    	<span class="nama"><?php echo $_SESSION['nama_peg']; ?></span><br>
  				    	<span class="posisi">ID : <span id="id_session" class="posisi"><?php echo $_SESSION['id_peg']; ?></span></span>
  				    </div>
  				    <div class="row tombol">
  				    	<div class="col-6">
  				    		<button class="btn btn-sm btn-success" id="tombol_profil" data-toggle="modal" data-target="#profil_user">Profil</button>
  				    	</div>
  				    	<div class="col-6 text-right">
  				    		<button class="btn btn-sm btn-danger" id="tombol_keluar">Logout</button>
  				    	</div>
  				    </div>
  				  </div>
  				</div>
  			</div>
  		</div>
  		<!-- </div> -->
  	</div>
  	<div class="row">
  		<div class="col-md-2 sidebar">
        <div class="accordion" id="menu">
          <ul class="list-group">
            <li href="#" class="list-group-item list-group-item-action menu-utama" data-toggle="collapse" data-target="#menu-collapse" aria-expanded="true" aria-controls="menu-collapse" style="border-radius: 5px 5px 0 0;">
              Menu <i class="fas fa-list float-right mt-1"></i>
            </li>
          </ul>
          <div id="menu-collapse" class="collapse show" aria-labelledby="" data-parent="#menu">
            <div class="accordion" id="daftar_menu">
              <ul class="list-group">
                <a href="./" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='') {echo "active";} ?>" style="border-radius: 0;">
                  <i class="fas fa-home"></i> Home
                </a>

                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier' || @$_GET['page']=='info_kadaluarsa') {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-master" aria-expanded="true" aria-controls="menu-collapse-master">
                  <i class="fas fa-folder"></i> Data Master <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <div id="menu-collapse-master" class="collapse <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='info_kadaluarsa' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier') {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  <ul class="list-group list-group-collapse">
                    <a href="?page=dataobat" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='info_kadaluarsa') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Data Obat <i class="fas fa-capsules float-right mt-1"></i>
                    </a>
                    <a href="?page=datapegawai" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Pegawai <i class="fas fa-users float-right mt-1"></i>
                    </a>
                    <a href="?page=datasupplier" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Supplier <i class="fas fa-briefcase-medical float-right mt-1"></i>
                    </a>
                  </ul>
                </div>

                <a href="?page=entry_datapenjualan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='datapenjualan_perobat') {echo "active";} ?>">
                  <i class="fas fa-file-invoice-dollar"></i> Transaksi Penjualan
                </a>

                <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                <a href="?page=entry_datapembelian" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian') {echo "active";} ?>">
                  <i class="fas fa-shopping-bag"></i> Transaksi Pembelian
                </a>
                
                <a href="?page=peramalan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='peramalan' || @$_GET['page']=='hasil_peramalan' || @$_GET['page']=='riwayat_peramalan') {echo "active";} ?>">
                  <i class="fas fa-chart-bar"></i> Peramalan Penjualan
                </a>
              <?php } ?>

                <!-- <a href="?page=laporan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='laporan') {echo "active";} ?>">
                  <i class="fas fa-file-alt"></i> Test Page
                </a>  -->
              </ul>
            </div>
          </div>
        </div>
  		</div>

      <script src="asset/Jquery/jquery-3.3.1.min.js"></script>
      <script src="asset/sweetalert/dist/sweetalert2.min.js"></script>
      <script src="asset/bootstrap_datepicker1.9.0/js/bootstrap-datepicker.min.js"></script>
      <script src="asset/bootstrap_datepicker1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
      <script src="asset/ChartJs/Chart.min.js"></script>

  		<div class="col-md-10 content">
  			<?php 
  				if(@$_GET['page']=='') {
    					include 'pages/home.php';
    					// echo "Halaman Dashboard";
    				} else if(@$_GET['page']=='dataobat') {
    					include 'pages/dataobat.php';
    				} else if(@$_GET['page']=='info_kadaluarsa') {
              include 'pages/info_kadaluarsa.php';
            } else if(@$_GET['page']=='datapegawai') {
          		include 'pages/datapegawai.php';
        		} else if(@$_GET['page']=='tambah_datapegawai') {
          		include 'pages/form_tmbdatapegawai.php';
        		} else if(@$_GET['page']=='tambah_datapegawai') {
          		include 'pages/form_tmbdatapegawai.php';
        		} else if(@$_GET['page']=='edit_datapegawai') {
    					include 'pages/form_editdatapegawai.php';
    				} else if(@$_GET['page']=='tambah_dataobat') {
    					include 'pages/form_tmbdataobat.php';
    				} else if(@$_GET['page']=='edit_dataobat') {
  		        	include 'pages/form_editdataobat.php';
		        } else if(@$_GET['page']=='datasupplier') {
		            include 'pages/datasupplier.php';
		        } else if(@$_GET['page']=='tambah_datasupplier') {
		            include 'pages/form_tmbdatasupplier.php';
		        } else if(@$_GET['page']=='edit_datasupplier') {
		            include 'pages/form_editdatasupplier.php';
		        } else if(@$_GET['page']=='datapenjualan') {
		            include 'pages/datapenjualan.php';
		        } else if(@$_GET['page']=='datapenjualan_perobat') {
                include 'pages/datapjl_perobat.php';
            } else if(@$_GET['page']=='datapembelian') {
		            include 'pages/datapembelian.php';
		        } else if(@$_GET['page']=='entry_datapenjualan') {
		            include 'pages/form_entrypenjualan.php';
		        } else if(@$_GET['page']=='entry_datapembelian') {
		            include 'pages/form_entrypembelian.php';
		        } else if(@$_GET['page']=='form_laporanpenjualan') {
		            include 'pages/form_laporanpenjualan.php';
		        } else if(@$_GET['page']=='form_laporanpembelian') {
		            include 'pages/form_laporanpembelian.php';
		        } else if(@$_GET['page']=='peramalan') {
                if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') {
  		            include 'pages/peramalan.php';
                } else {

                }
		        } else if(@$_GET['page']=='hasil_peramalan') {
		            include 'pages/hasilperamalan.php';
		        } else if(@$_GET['page']=='riwayat_peramalan') {
		            include 'pages/riwayat_peramalan.php';
		        } else if(@$_GET['page']=='laporan') {
		            include 'pages/laporan.php';
		        } 
  			 ?>
  		</div>

      <!-- Modal -->
      <div class="modal fade" id="profil_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Profil Pegawai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="tabel-profil">
                <?php 
                  $query = "SELECT * FROM tbl_pegawai WHERE id_peg = '$_SESSION[id_peg]'";
                  $sql = mysqli_query($conn, $query) or die ($conn->error);
                  $data = mysqli_fetch_array($sql);
                ?>
                <tr>
                  <th>ID</th>
                  <td> <?php echo $data['id_peg']; ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td> <?php echo $data['nama_peg']; ?></td>
                </tr>
                <tr>
                  <th>Posisi</th>
                  <td> <?php echo $data['pos_peg']; 
                    if ($data['pos_peg']=="Manager" || $data['pos_peg']=="Admin") {
                  ?> 
                    <i class="fas fa-check-circle text-info"></i>
                  <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td> <?php echo $data['jk_peg']; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <td> <?php echo $data['lhr_peg']; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top;">Alamat</th>
                  <td> <?php echo $data['alamat_peg']; ?></td>
                </tr>
                <tr>
                  <th>No Handphone</th>
                  <td> <?php echo $data['hp_peg']; ?></td>
                </tr>
                <tr>
                  <th>Username</th>
                  <td> <?php echo $data['username']; ?></td>
                </tr>
                <tr>
                  <th>Password</th>
                  <td> xxxxxxxx</td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <a href="?page=edit_datapegawai&id=<?php echo $_SESSION['id_peg'] ?>" class="">
              <button type="button" class="btn btn-primary btn-sm">Edit</button>
              </a>
            </div>
          </div>
        </div>
      </div>
  	</div>
  	</div>
  	</div>

  	<footer>
  		<i class="fas fa-copyright"></i> Faizal Nur Abidin / 5140411217 (Universitas Teknologi Yogyakarta)
  	</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="asset/bootstrap_4/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="asset/DataTables/datatables.min.js"></script>
    <script>
      var id_session = $("#id_session").text();
    	$(document).ready(function() {
		    $('#example').DataTable({
          
        });
        $('#example2').DataTable({
          
        });
        $('#example3').DataTable({
          
        });

        $('#tbldata_penjualan').DataTable({
           lengthMenu : [[25, 50, -1], [25, 50, "All"]]
        });

        $('#tbl_riwayatperamalan').DataTable({
           lengthMenu : [[30, 50, -1], [30, 50, "All"]]
        });

        $('#tbl_pjlobat').DataTable({
           lengthMenu : [[50, -1], [50, "All"]]
        });

        $('#tabel_dataobat').DataTable({
          // ordering: false,
          lengthMenu : [[30, 50, 100, -1], [30, 50, 100, "All"]],
          order: [[1, "asc"]]
        });
        
		  });
      $("#tombol_keluar").click(function(){
        // alert("Log Out");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan keluar dari aplikasi',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((tes) => {
          if (tes.value) {
            $.ajax({
              type: "POST",
              url: "ajax/logout.php",
              success: function(hasil) {
                window.location='./';
              }
            })  
          }
        })
      });
      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function() {
          startTime()
        }, 500);
      }
      startTime();
    </script>
  </body>
</html>
<?php 
  }
?>