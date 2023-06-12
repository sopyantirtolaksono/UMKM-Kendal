<?php 

  // mulai session
  session_start();
  // koneksi ke database
  require "admin/connection.php";
  // cek jika belum ada member yang login
  if(!isset($_SESSION['member'])) {
    echo "<script>location ='login.php';</script>";
    header('Location: login.php');
    exit();
  }

  // cek jika member sudah login/logout
  if(isset($_SESSION["member"])) {
    // set id member yang login & status member
    $idMember     = $_SESSION["member"]["id_member"];
    $statusMember = $_SESSION["member"]["status"];
    // cek jika member yg akses belum terverifikasi
    if($statusMember == "Tidak Terverifikasi") {
      echo "<script>location ='umkm.php';</script>";
      header('Location: umkm.php');
      exit();
    }
    // jika id umkm belum diset/salah
    if(!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] <= 0 || !is_numeric($_GET["id"])) {
      echo "<script>location ='umkm.php';</script>";
      header('Location: umkm.php');
      exit();
    }
    // ambil data umkm dari tabel umkm, utk cek jika data umkm tdk ada
    $ambilUmkmYgDicari = $conn->query("SELECT * FROM tbl_umkm WHERE id_umkm = '$_GET[id]' ");
    // cek ada umkm apa tidak
    $jmlUmkm           = $ambilUmkmYgDicari->num_rows;
    $pecahUmkmYgDicari = $ambilUmkmYgDicari->fetch_assoc();
    // jika umkm yang dicari tidak ada, alihkan ke halaman umkm
    if($jmlUmkm < 1) {
      echo "<script>location ='umkm.php';</script>";
      header('Location: umkm.php');
      exit();
    }
    // cek jika member mengedit umkm yang bukan miliknya
    if($pecahUmkmYgDicari["id_member"] != $idMember) {
      echo "<script>location ='umkm.php';</script>";
      header('Location: umkm.php');
      exit();
    }
  }
  else {
    // unset session member
    unset($idMember);
  }

  // jika tombol update umkm ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto_umkm"]["name"];
    $lokasiFoto = $_FILES["foto_umkm"]["tmp_name"];
    // ambil data dari form
    $namaUmkm         = $_POST["nama_umkm"];
    $alamatUmkm       = $_POST["alamat_umkm"];
    $kontakUmkm       = $_POST["kontak_umkm"];
    $lokasiUmkm       = $_POST["lokasi_umkm"];

    // cek jika ada foto/tidak ada foto yang diupload
    if(!empty($lokasiFoto)) {
      // cek jika gambar/foto yang diupload bukan gambar
      $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
      $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
      if(!in_array($tipeFile, $fotoValid))
      {
        echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
        echo "<script>location ='umkm.php';</script>";
        exit();
      }

      // hapus foto umkm lama difolder img-produk
      $ambilFotoUmkmLama   = $conn->query("SELECT * FROM tbl_umkm WHERE id_umkm = '$_GET[id]' ");
      $pecahFotoUmkmLama   = $ambilFotoUmkmLama->fetch_assoc();
      $fotoUmkmLama        = $pecahFotoUmkmLama["gambar_umkm"];
      if(file_exists("admin/dist/img-umkm/$fotoUmkmLama")) {
        unlink("admin/dist/img-umkm/$fotoUmkmLama");
      }

      // aktifkan uniqid
      $uniqId = uniqid();
      $namaFotoBaru = $uniqId."_".$namaFoto;
      move_uploaded_file($lokasiFoto, "admin/dist/img-umkm/" .$namaFotoBaru);
      $fotoUmkm = $namaFotoBaru;
      // update umkm pada tabel umkm
      $conn->query("UPDATE tbl_umkm SET nama_umkm = '$namaUmkm', alamat_umkm = '$alamatUmkm', kontak_umkm = '$kontakUmkm', lokasi_umkm = '$lokasiUmkm', gambar_umkm = '$fotoUmkm' WHERE id_umkm = '$_GET[id]' ");
      echo "<script>alert('Data berhasil diupdate.')</script>";
      echo "<script>location ='umkm.php';</script>";
    }
    else {
      // update umkm pada tabel umkm
      $conn->query("UPDATE tbl_umkm SET nama_umkm = '$namaUmkm', alamat_umkm = '$alamatUmkm', kontak_umkm = '$kontakUmkm', lokasi_umkm = '$lokasiUmkm' WHERE id_umkm = '$_GET[id]' ");
      echo "<script>alert('Data berhasil diupdate.')</script>";
      echo "<script>location ='umkm.php';</script>";
    }
    
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - Reservation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Miss+Fajardose&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <!-- header -->
    <?php require "header.php"; ?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Edit UMKM</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit UMKM <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
	
	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container-fluid px-0">
			<div class="row d-flex no-gutters">
			    <div class="col-md-6 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5">
			      	<div class="py-md-5">
			          	<div class="heading-section ftco-animate mb-5">
				          	<span class="subheading">Form Edit UMKM</span>
				            <h2 class="mb-4">Edit UMKM</h2>
				          </div>
			            
				        <form action="" method="post" enctype="multipart/form-data">
				            <div class="row">
				              
				                <div class="col-md-6">
				                  <div class="form-group">
				                    <label for="namaUmkm">UMKM Name</label>
				                    <input type="text" class="form-control" id="namaUmkm" name="nama_umkm" placeholder="Umkm name" value="<?=$pecahUmkmYgDicari['nama_umkm']; ?>" required>
				                  </div>
				                </div>
				                <div class="col-md-6">
				                  <div class="form-group">
				                    <label for="alamatUmkm">Address</label>
				                    <input type="text" class="form-control" id="alamatUmkm" name="alamat_umkm" placeholder="Umkm address" value="<?=$pecahUmkmYgDicari['alamat_umkm']; ?>" required>
				                  </div>
				                </div>
				                <div class="col-md-6">
				                  <div class="form-group">
				                    <label for="kontakUmkm">Contact</label>
				                    <input type="number" class="form-control" id="kontakUmkm" name="kontak_umkm" placeholder="Umkm contact" value="<?=$pecahUmkmYgDicari['kontak_umkm']; ?>"  required>
				                  </div>
				                </div>
				                <div class="col-md-6">
				                  <div class="form-group">
				                    <label for="lokasiUmkm">Location</label>
				                    <input type="text" class="form-control" id="lokasiUmkm" name="lokasi_umkm" placeholder="Umkm location" value="<?=$pecahUmkmYgDicari['lokasi_umkm']; ?>"  required>
				                  </div>
				                </div>
				                <div class="col-md-6">
				                  <div class="form-group">
				                    <label for="fotoUmkm">Photo</label>
				                    <input type="file" class="form-control" id="fotoUmkm" name="foto_umkm" placeholder="Photo umkm">
				                  </div>
				                </div>
				                
				                <div class="col-md-12 mt-3">
				                  <div class="form-group">
				                    <input type="submit" value="Update UMKM" class="btn btn-primary py-3 px-5" name="btn_simpan">
                            <a href="umkm.php" class="btn btn-secondary py-3 px-5">Cancle</a>
				                  </div>
				                </div>
				            </div>
				        </form>

			        </div>
			    </div>
      			<div class="col-md-6 d-flex align-items-stretch pb-5 pb-md-0" style="background-image: url(admin/dist/img-umkm/<?=$pecahUmkmYgDicari['gambar_umkm']; ?>); background-repeat: no-repeat; background-position: center; background-size: cover;">
				</div>
    		</div>
		</div>
	</section>

    <!-- footer -->
    <?php require "footer.php"; ?>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>