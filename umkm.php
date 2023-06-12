<?php 

  // mulai session
  session_start();
  // koneksi ke database
  require "admin/connection.php";

  // cek jika member sudah login/logout
  if(isset($_SESSION["member"])) {
    // set id member yang login
    $idMember     = $_SESSION["member"]["id_member"];
    $statusMember = $_SESSION["member"]["status"];
    // ambil data/umkm member yg login, punya toko/umkm atau tidak
    $amblUmkmMemberAdaAtauTdk = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMember' ");
    $adaAtauTdkUmkmMember     = $amblUmkmMemberAdaAtauTdk->num_rows;
  }
  else {
    // unset session member
    unset($idMember);
  }


  // cek jika tombol create new umkm ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto_umkm"]["name"];
    $lokasiFoto = $_FILES["foto_umkm"]["tmp_name"];

    // cek jika gambar/foto yang diupload bukan gambar
    $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
    $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
    if(!in_array($tipeFile, $fotoValid))
    {
      echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
      echo "<script>location ='umkm.php';</script>";
      exit();
    }

    // aktifkan uniqid
    $uniqId = uniqid();
    $namaFotoBaru = $uniqId."_".$namaFoto;
    move_uploaded_file($lokasiFoto, "admin/dist/img-umkm/" .$namaFotoBaru);

    // ambil data dari form
    $namaUmkm         = $_POST["nama_umkm"];
    $alamatUmkm       = $_POST["alamat_umkm"];
    $kontakUmkm       = $_POST["kontak_umkm"];
    $lokasiUmkm       = $_POST["lokasi_umkm"];
    $fotoUmkm         = $namaFotoBaru;
    // tambahkan data baru kedalam tabel umkm
    $conn->query("INSERT INTO tbl_umkm (id_member, nama_umkm, alamat_umkm, kontak_umkm, lokasi_umkm, gambar_umkm) VALUES ('$idMember', '$namaUmkm', '$alamatUmkm', '$kontakUmkm', '$lokasiUmkm', '$fotoUmkm')");
    echo "<script>alert('Data berhasil ditambahkan!')</script>";
    echo "<script>location ='umkm.php';</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - UMKM</title>
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
            <h1 class="mb-2 bread">All UMKM</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>UMKM <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

    <!-- cek jika sudah ada yang login -->
    <?php if(isset($_SESSION["member"])) { ?>

    <section class="ftco-section pb-0">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <!-- <span class="subheading">Welcome</span> -->
            <?php if($adaAtauTdkUmkmMember > 0) { ?>
            <h2 class="mb-4">My UMKM</h2>
            <?php } else { ?>
            <h2 class="mb-4">You're not have UMKM</h2>
            <?php } ?>

            <?php if($statusMember == "Tidak Terverifikasi") { ?>
            <a href="#formNewUmkm" class="btn btn-primary py-3 px-5 disabled">Add New UMKM <br> <small>( Waiting for verification.. )</small></a>
            <?php } else { ?>
            <a href="#formNewUmkm" class="btn btn-primary py-3 px-5">Add New UMKM</a>
            <?php } ?>
          </div>
        </div>
        <div class="row">

          <!-- ambil data umkm member yang login -->
          <?php
            $ambilUmkmMember = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMember' ");
            while($pecahUmkmMember = $ambilUmkmMember->fetch_assoc()) {
          ?>

          <div class="col-md-4 ftco-animate">
            <div class="blog-entry mb-0">
              <a class="block-20" style="background-image: url('admin/dist/img-umkm/<?=$pecahUmkmMember['gambar_umkm']; ?>');">
              </a>
              <div class="text pt-3 pb-4">
                <div class="meta">
                  <a><?=$pecahUmkmMember["kontak_umkm"]; ?></a>
                </div>
                <h3 class="heading"><a href="mymenu.php"><?=$pecahUmkmMember["nama_umkm"]; ?></a></h3>
                <p class="clearfix">
                  <a class="float-left read"><?=$pecahUmkmMember["alamat_umkm"]; ?></a>
                  <a href="<?=$pecahUmkmMember['lokasi_umkm']; ?>" class="float-right btn btn-info" target="_blank">Location</a>
                </p>
              </div>
            </div>
            <div class="mb-4">
              <?php if($statusMember == "Tidak Terverifikasi") { ?>
                <a href="edit_umkm.php?id=<?=$pecahUmkmMember['id_umkm']; ?>" class="btn btn-success py-2 px-4 disabled">Edit</a>
                <a href="delete_umkm.php?id=<?=$pecahUmkmMember['id_umkm']; ?>" class="btn btn-danger py-2 px-4 disabled" onclick="return confirm('Yakin ingin hapus umkm?')">Delete</a>
              <?php } else { ?>
                <a href="edit_umkm.php?id=<?=$pecahUmkmMember['id_umkm']; ?>" class="btn btn-success py-2 px-4">Edit</a>
                <a href="delete_umkm.php?id=<?=$pecahUmkmMember['id_umkm']; ?>" class="btn btn-danger py-2 px-4" onclick="return confirm('Yakin ingin hapus umkm?')">Delete</a>
              <?php } ?>
            </div>
          </div>

          <?php } ?>
          
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb" id="formNewUmkm">
      <div class="container-fluid px-0">
        <div class="row d-flex no-gutters">
          <div class="col-md-12 ftco-animate makereservation p-4 p-md-5 pt-5 pt-md-0">
            <div class="heading-section ftco-animate mb-5">
              <!-- <span class="subheading">New UMKM Form</span> -->
              <h2 class="mb-4">Add New UMKM</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namaUmkm">UMKM Name</label>
                    <input type="text" class="form-control" id="namaUmkm" name="nama_umkm" placeholder="Umkm name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="alamatUmkm">Address</label>
                    <input type="text" class="form-control" id="alamatUmkm" name="alamat_umkm" placeholder="Umkm address" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kontakUmkm">Contact</label>
                    <input type="number" class="form-control" id="kontakUmkm" name="kontak_umkm" placeholder="Umkm contact" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasiUmkm">Location</label>
                    <input type="text" class="form-control" id="lokasiUmkm" name="lokasi_umkm" placeholder="Umkm location" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fotoUmkm">Photo</label>
                    <input type="file" class="form-control" id="fotoUmkm" name="foto_umkm" placeholder="Photo umkm" required>
                  </div>
                </div>
                
                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <?php if($statusMember == "Tidak Terverifikasi") { ?>
                    <a href="#" class="btn btn-primary py-3 px-5 disabled" name="btn_simpan">Create a New UMKM <br> <small>( Waiting for verification.. )</small></a>
                    <?php } else { ?>
                    <input type="submit" value="Create a New UMKM" class="btn btn-primary py-3 px-5" name="btn_simpan">
                    <?php } ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>

    <section class="ftco-section ">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <!-- <span class="subheading">For All</span> -->
            <h2 class="mb-4">Our UMKM</h2>
          </div>
        </div>
        <div class="row">

          <?php 
            $ambilUmkm = $conn->query("SELECT * FROM tbl_umkm WHERE id_member != '$idMember' ");
            while($pecahUmkm = $ambilUmkm->fetch_assoc()) {
          ?>
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry">
              <a class="block-20" style="background-image: url('admin/dist/img-umkm/<?=$pecahUmkm['gambar_umkm']; ?>');">
              </a>
              <div class="text pt-3 pb-4">
                <div class="meta">
                  <a><?=$pecahUmkm["kontak_umkm"]; ?></a>
                </div>
                <h3 class="heading"><a href="menu.php?id=<?=$pecahUmkm['id_umkm']; ?>"><?=$pecahUmkm["nama_umkm"]; ?></a></h3>
                <p class="clearfix">
                  <a class="float-left read"><?=$pecahUmkm["alamat_umkm"]; ?></a>
                  <a href="<?=$pecahUmkm['lokasi_umkm']; ?>" class="float-right btn btn-info" target="_blank">Location</a>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
          
        </div>
        <!-- <div class="row no-gutters my-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
      </div>
    </section>

    <?php } else { ?>
	
		<section class="ftco-section pb-0">
			<div class="container">
        <div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <!-- <span class="subheading">For All</span> -->
            <h2 class="mb-4">Our UMKM</h2>
          </div>
        </div>
				<div class="row">

          <?php 
            $ambilUmkm = $conn->query("SELECT * FROM tbl_umkm");
            while($pecahUmkm = $ambilUmkm->fetch_assoc()) {
          ?>
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry">
              <a class="block-20" style="background-image: url('admin/dist/img-umkm/<?=$pecahUmkm['gambar_umkm']; ?>');">
              </a>
              <div class="text pt-3 pb-4">
                <div class="meta">
                  <a class="read"><?=$pecahUmkm["kontak_umkm"]; ?></a>
                </div>
                <h3 class="heading"><a href="menu.php?id=<?=$pecahUmkm['id_umkm']; ?>"><?=$pecahUmkm["nama_umkm"]; ?></a></h3>
                <p class="clearfix">
                  <a class="float-left read"><?=$pecahUmkm["alamat_umkm"]; ?></a>
                  <a href="<?=$pecahUmkm['lokasi_umkm']; ?>" class="float-right btn btn-info" target="_blank">Location</a>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
          
        </div>
        <!-- <div class="row no-gutters my-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
			</div>
		</section>

    <?php } ?>

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