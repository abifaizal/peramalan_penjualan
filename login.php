<?php 
  session_start();
  if(@$_SESSION['posisi_peg']) {
    echo "<script>window.location='./';</script>";
  } else {
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap_4/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/private_style/style.css">
    <link rel="stylesheet" href="asset/sweetalert/dist/sweetalert2.min.css">

    <title>Aplikasi Forecasting Apotek Margo Saras | Login</title>
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="welcome col-lg-8">
  				SELAMAT DATANG DI APLIKASI SALES FORECASTING MILIK APOTEK MARGO SARAS
  			</div>
	    	<div class="form-login col-lg-4">
	    		<form>
	    		  <h6>Mohon login terlebih dahulu</h6>
  				  <div class="form-group">
  				    <label for="username">username</label>
  				    <input type="email" class="form-control" id="username" placeholder="username" autofocus="">
  				  </div>
  				  <div class="form-group">
  				    <label for="password">password</label>
  				    <input type="password" class="form-control" id="password" placeholder="password">
  				  </div>
  				  <!-- <div class="form-group form-check">
  				    <input type="checkbox" class="form-check-input" id="exampleCheck1">
  				    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  				  </div> -->
            <div class="form-group tombol-login">
              <a href="javascript:void(0)">        
                <div class="btn btn-sm btn-info" id="tombol_login">LOGIN</div>
              </a>
            </div>
  				</form>
	    	</div>
  		</div>	
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="asset/Jquery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="asset/bootstrap_4/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="asset/sweetalert/dist/sweetalert2.min.js"></script>

    <script>
      $("#tombol_login").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
          type: "GET",
          url: "ajax/ceklogin.php",
          data: "username="+username+"&password="+password,
          success: function(hasil) {
            if(hasil=="berhasil") {
              window.location='./';
            } else {
              document.getElementById("username").focus();
              Swal.fire({
                type: 'error',
                title: 'Gagal',
                text: 'Periksa kembali username dan password anda',
                showConfirmButton: true
                // timer: 1500
              })
            }
          }
        });
      });
    </script>
  </body>
</html>
<?php } ?>