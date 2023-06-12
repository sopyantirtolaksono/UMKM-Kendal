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
      echo "<script>location ='mymenu.php';</script>";
      header('Location: mymenu.php');
      exit();
    }
    // jika id produk belum diset/salah
    if(!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] <= 0 || !is_numeric($_GET["id"])) {
      echo "<script>location ='mymenu.php';</script>";
      header('Location: mymenu.php');
      exit();
    }
    // ambil data produk dari tabel produk, utk cek jika data produk tdk ada
    $ambilProdukYgDicari = $conn->query("SELECT * FROM tbl_produk WHERE id_produk = '$_GET[id]' ");
    // cek ada umkm apa tidak
    $jmlProduk   = $ambilProdukYgDicari->num_rows;
    // jika umkm yang dicari tidak ada, alihkan ke halaman index
    if($jmlProduk < 1) {
      echo "<script>location ='mymenu.php';</script>";
      header('Location: mymenu.php');
      exit();
    }
  }
  else {
    // unset session member
    unset($idMember);
  }



  // jika tombol update ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto_produk"]["name"];
    $lokasiFoto = $_FILES["foto_produk"]["tmp_name"];
    // ambil data dari form
    $namaUmkm 		  = $_POST["nama_umkm"];
    $namaProduk       = $_POST["nama_produk"];
    $hargaProduk      = $_POST["harga_produk"];
    $kategoriProduk   = $_POST["kategori_produk"];
    $deskripsiProduk  = $_POST["deskripsi_produk"];

    // cek jika ada foto/tidak ada foto yang diupload
    if(!empty($lokasiFoto)) {
      // cek jika gambar/foto yang diupload bukan gambar
      $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
      $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
      if(!in_array($tipeFile, $fotoValid))
      {
        echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
        echo "<script>location ='mymenu.php';</script>";
        exit();
      }

      // hapus foto produk lama difolder img-produk
      $ambilFotoProdukLama = $conn->query("SELECT * FROM tbl_produk WHERE id_produk = '$_GET[id]' ");
      $pecahFotoProdukLama = $ambilFotoProdukLama->fetch_assoc();
      $fotoProdukLama      = $pecahFotoProdukLama["gambar_produk"];
      if(file_exists("admin/dist/img-produk/$fotoProdukLama")) {
        unlink("admin/dist/img-produk/$fotoProdukLama");
      }

      // aktifkan uniqid
      $uniqId = uniqid();
      $namaFotoBaru = $uniqId."_".$namaFoto;
      move_uploaded_file($lokasiFoto, "admin/dist/img-produk/" .$namaFotoBaru);
      $fotoProduk = $namaFotoBaru;
      // update produk pada tabel produk
      $conn->query("UPDATE tbl_produk SET id_umkm = '$namaUmkm', id_kategori = '$kategoriProduk', nama_produk = '$namaProduk', harga_produk = '$hargaProduk', gambar_produk = '$fotoProduk', deskripsi_produk = '$deskripsiProduk' WHERE id_produk = '$_GET[id]' ");
      echo "<script>alert('Data berhasil diupdate.')</script>";
      echo "<script>location ='mymenu.php';</script>";
    }
    else {
      // update produk pada tabel produk
      $conn->query("UPDATE tbl_produk SET id_umkm = '$namaUmkm', id_kategori = '$kategoriProduk', nama_produk = '$namaProduk', harga_produk = '$hargaProduk', deskripsi_produk = '$deskripsiProduk' WHERE id_produk = '$_GET[id]' ");
      echo "<script>alert('Data berhasil diupdate.')</script>";
      echo "<script>location ='mymenu.php';</script>";
    }
    
  }

  // ambil data produk yg akan diedit/update
  $ambilProduk = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm JOIN tbl_member ON tbl_umkm.id_member = tbl_member.id_member JOIN tbl_kategori ON tbl_produk.id_kategori = tbl_kategori.id_kategori WHERE id_produk = '$_GET[id]' ");
  $pecahProduk = $ambilProduk->fetch_assoc();

  // cek jika member mengedit produk yang bukan miliknya
  if($pecahProduk["id_member"] != $idMember) {
    echo "<script>location ='mymenu.php';</script>";
    header('Location: mymenu.php');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - Edit Product</title>
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
            <h1 class="mb-2 bread">Edit Product</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Product <i class="ion-ios-arrow-forward"></i></span></p>
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
				          	<span class="subheading">Form Edit Product</span>
				            <h2 class="mb-4">Edit Product</h2>
				          </div>
			            
				        <form action="" method="post" enctype="multipart/form-data">
				            <div class="row">
				                <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="namaUmkm">UMKM Name</label>
					                    <div class="select-wrap one-third">
					                      	<div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                    <select name="nama_umkm" id="namaUmkm" class="form-control">
						                    	<option value="<?=$pecahProduk['id_umkm']; ?>"><?=$pecahProduk["nama_umkm"]; ?></option>
								                <?php $ambilUmkmSelect = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMember' "); ?>
								                <?php while($pecahUmkmSelect = $ambilUmkmSelect->fetch_assoc()) { ?>
								                  <option value="<?=$pecahUmkmSelect['id_umkm']; ?>"><?=$pecahUmkmSelect["nama_umkm"]; ?></option>
								                <?php } ?>
								            </select>
					                    </div>
				                  	</div>
				                </div>
				                <div class="col-md-6">
					                <div class="form-group">
					                    <label for="namaProduk">Product Name</label>
					                    <input type="text" class="form-control" id="namaProduk" name="nama_produk" placeholder="Product name" value="<?=$pecahProduk['nama_produk']; ?>" required>
					                </div>
				                </div>
				                <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="hargaProduk">Price</label>
					                    <input type="number" class="form-control" id="hargaProduk" name="harga_produk" placeholder="Product Price" value="<?=$pecahProduk['harga_produk']; ?>" required>
				                  	</div>
				                </div>
				                <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="kategori">Category</label>
					                    <div class="select-wrap one-third">
					                      	<div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                    <select name="kategori_produk" id="kategori" class="form-control">
						                    	<option value="<?=$pecahProduk['id_kategori']; ?>"><?=$pecahProduk["kategori"]; ?></option>
						                        <?php $ambilKategoriSelect = $conn->query("SELECT * FROM tbl_kategori"); ?>
						                        <?php while($pecahKategoriSelect = $ambilKategoriSelect->fetch_assoc()) { ?>
						                          <option value="<?=$pecahKategoriSelect['id_kategori']; ?>"><?=$pecahKategoriSelect["kategori"]; ?></option>
						                        <?php } ?>
						                    </select>
					                    </div>
				                  	</div>
				                </div>
				                <div class="col-md-6">
				                  	<div class="form-group">
				                    	<label for="deskripsi">Description</label>
				                    	<input type="text" class="form-control" id="deskripsi" name="deskripsi_produk" placeholder="Description product" value="<?=$pecahProduk['deskripsi_produk']; ?>" required>
				                  	</div>
				                </div>
				                <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="fotoProduk">Photo</label>
					                    <input type="file" class="form-control" id="fotoProduk" name="foto_produk" placeholder="Photo product">
				                  	</div>
				                </div>
				                
				                <div class="col-md-12 mt-3">
				                  	<div class="form-group">
				                    	<input type="submit" value="Update Product" class="btn btn-primary py-3 px-5" name="btn_simpan">
                              <a href="mymenu.php" class="btn btn-secondary py-3 px-5">Cancle</a>
				                  	</div>
				                </div>
				            </div>
				        </form>

			        </div>
			    </div>
      			<div class="col-md-6 d-flex align-items-stretch pb-5 pb-md-0" style="background-image: url(admin/dist/img-produk/<?=$pecahProduk['gambar_produk']; ?>); background-repeat: no-repeat; background-position: center; background-size: cover;">
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