<?php 

  // mulai session
  session_start();
  // koneksi ke database
  require "admin/connection.php";

  // ambil id umkm dari url
  $idUmkm = $_GET["id"];

  // cek jika id umkm belum di set/salah
  if(!isset($idUmkm) || empty($idUmkm) || $idUmkm <= 0 || !is_numeric($idUmkm)) {
    echo "<script>location ='index.php';</script>";
    header('Location: index.php');
    exit();
  }

  // ambil data umkm dari tabel umkm
  $ambilUmkm = $conn->query("SELECT * FROM tbl_umkm WHERE id_umkm = '$idUmkm' ");
  // cek ada umkm apa tidak
  $jmlUmkm   = $ambilUmkm->num_rows;
  // jika umkm yang dicari tidak ada, alihkan ke halaman index
  if($jmlUmkm < 1) {
    echo "<script>location ='index.php';</script>";
    header('Location: index.php');
    exit();
  }
  $pecahUmkm = $ambilUmkm->fetch_assoc();

  // cek jika member sudah login/logout
  if(isset($_SESSION["member"])) {
    // set id member yang login
    $idMember     = $_SESSION["member"]["id_member"];
    $statusMember = $_SESSION["member"]["status"];
  }
  else {
    // unset session member
    unset($idMember);
  }

  // ambil data produk untuk produk yang kosong
  $ambilUtkProdukKosong = $conn->query("SELECT * FROM tbl_produk WHERE id_umkm = '$idUmkm' ");
  $jmlProdukKosong      = $ambilUtkProdukKosong->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - Menu</title>
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
            <h1 class="mb-2 bread"><?=$pecahUmkm["nama_umkm"]; ?></h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
	
		<section class="ftco-section">
    	<div class="container-fluid px-4">
    		<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<!-- <span class="subheading">Specialties</span> -->

            <?php if($jmlProdukKosong > 0) { ?>
            <h2 class="mb-4">Our Menu</h2>
            <?php } else { ?>
            <h2 class="mb-4">Sorry, Nothing Menu</h2>
            <?php } ?>

            <a href="<?=$pecahUmkm['lokasi_umkm']; ?>" class="btn btn-info py-3 px-5" target="_blank">Location</a>
          </div>
        </div>
        <div class="row">

          <!-- jika sudah ada member yang login -->
          <?php if(isset($_SESSION["member"])) { ?>

            <?php 
              $ambilProduk = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm WHERE tbl_umkm.id_umkm = '$idUmkm' AND tbl_umkm.id_member = '$idMember' ");
              $adaDataMember = $ambilProduk->num_rows;
            ?>
            <?php if($adaDataMember > 0) { ?>
              
              <?php while($pecahProduk = $ambilProduk->fetch_assoc()) { ?>
              <div class="col-md-6 col-lg-4 menu-wrap mb-0">
                <div class="menus d-flex ftco-animate">
                  <div class="menu-img img" style="background-image: url(admin/dist/img-produk/<?=$pecahProduk['gambar_produk']; ?>);"></div>
                  <div class="text">
                    <div class="d-flex">
                      <div class="one-half">
                        <h3><?=$pecahProduk["nama_produk"]; ?></h3>
                      </div>
                      <div class="one-forth">
                        <span class="price"><?=$pecahProduk["harga_produk"]; ?>k</span>
                      </div>
                    </div>
                    <p><?=$pecahProduk["deskripsi_produk"]; ?></p>
                  </div>
                </div>
                <div class="mb-4">
                  <?php if($statusMember == "Tidak Terverifikasi") { ?>
                  <a href="edit_menu.php?id=<?=$pecahProduk['id_produk']; ?>" class="btn btn-success py-2 px-4 disabled">Edit</a>
                  <a href="delete_menu.php?id=<?=$pecahProduk['id_produk']; ?>" class="btn btn-danger py-2 px-4 disabled" onclick="return confirm('Yakin ingin hapus produk?')">Delete</a>
                  <?php } else { ?>
                  <a href="edit_menu.php?id=<?=$pecahProduk['id_produk']; ?>" class="btn btn-success py-2 px-4">Edit</a>
                  <a href="delete_menu.php?id=<?=$pecahProduk['id_produk']; ?>" class="btn btn-danger py-2 px-4" onclick="return confirm('Yakin ingin hapus produk?')">Delete</a>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>

            <?php } else { ?>

              <?php 
                $ambilProduk = $conn->query("SELECT * FROM tbl_produk WHERE id_umkm = '$idUmkm' ");
                while($pecahProduk = $ambilProduk->fetch_assoc()) {
              ?>
              <div class="col-md-6 col-lg-4 menu-wrap mb-0">
                <div class="menus d-flex ftco-animate">
                  <div class="menu-img img" style="background-image: url(admin/dist/img-produk/<?=$pecahProduk['gambar_produk']; ?>);"></div>
                  <div class="text">
                    <div class="d-flex">
                      <div class="one-half">
                        <h3><?=$pecahProduk["nama_produk"]; ?></h3>
                      </div>
                      <div class="one-forth">
                        <span class="price"><?=$pecahProduk["harga_produk"]; ?>k</span>
                      </div>
                    </div>
                    <p><?=$pecahProduk["deskripsi_produk"]; ?></p>
                  </div>
                </div>
              </div>
              <?php } ?>

            <?php } ?>

          <?php } else { ?>
        	
          <?php 
            $ambilProduk = $conn->query("SELECT * FROM tbl_produk WHERE id_umkm = '$idUmkm' ");
            while($pecahProduk = $ambilProduk->fetch_assoc()) {
          ?>
          <div class="col-md-6 col-lg-4 menu-wrap mb-0">
            <div class="menus d-flex ftco-animate">
              <div class="menu-img img" style="background-image: url(admin/dist/img-produk/<?=$pecahProduk['gambar_produk']; ?>);"></div>
              <div class="text">
                <div class="d-flex">
                  <div class="one-half">
                    <h3><?=$pecahProduk["nama_produk"]; ?></h3>
                  </div>
                  <div class="one-forth">
                    <span class="price"><?=$pecahProduk["harga_produk"]; ?>k</span>
                  </div>
                </div>
                <p><?=$pecahProduk["deskripsi_produk"]; ?></p>
              </div>
            </div>
          </div>
          <?php } ?>

          <?php } ?>

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