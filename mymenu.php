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
    // set id member yang login
    $idMember = $_SESSION["member"]["id_member"];
    $statusMember = $_SESSION["member"]["status"];
  }
  else {
    // unset session member
    unset($idMember);
  }

  // jika tombol simpan/create product ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto = $_FILES["foto_produk"]["name"];
    $lokasiFoto = $_FILES["foto_produk"]["tmp_name"];

    // cek jika gambar/foto yang diupload bukan gambar
    $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
    $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
    if(!in_array($tipeFile, $fotoValid))
    {
      echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
      echo "<script>location ='mymenu.php';</script>";
      exit();
    }

    // aktifkan uniqid
    $uniqId = uniqid();
    $namaFotoBaru = $uniqId."_".$namaFoto;
    move_uploaded_file($lokasiFoto, "admin/dist/img-produk/" .$namaFotoBaru);

    // ambil data dari form
    $namaUmkm         = $_POST["nama_umkm"];
    $namaProduk       = $_POST["nama_produk"];
    $hargaProduk      = $_POST["harga_produk"];
    $kategoriProduk   = $_POST["kategori_produk"];
    $deskripsiProduk  = $_POST["deskripsi_produk"];
    $fotoProduk       = $namaFotoBaru;

    $conn->query("INSERT INTO tbl_produk (id_umkm, id_kategori, nama_produk, harga_produk, gambar_produk, deskripsi_produk) VALUES ('$namaUmkm', '$kategoriProduk', '$namaProduk', '$hargaProduk', '$fotoProduk', '$deskripsiProduk')");
    echo "<script>alert('Data berhasil ditambahkan.')</script>";
    echo "<script>location ='mymenu.php';</script>";
  }

  // ambil data umkm dari member yang login
  $ambilUmkm = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMember' ");
  $jmlUmkm   = $ambilUmkm->num_rows;
  $pecahUmkm = $ambilUmkm->fetch_assoc();
  
  // ambil data produk untuk produk yang kosong
  $ambilUtkProdukKosong = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm WHERE tbl_umkm.id_member = '$idMember' ");
  $pecahUtkProdukKosong = $ambilUtkProdukKosong->fetch_assoc();

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
            <?php if($jmlUmkm > 1) { ?>
              <h1 class="mb-2 bread">Our Specialties</h1>
            <?php } else { ?>
            <h1 class="mb-2 bread"><?=$pecahUmkm["nama_umkm"]; ?></h1>
            <?php } ?>
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
            <?php if($pecahUtkProdukKosong["id_produk"] == null) { ?>
            <h2 class="mb-4">You're not have menu</h2>
            <?php } else { ?>
            <h2 class="mb-4">Our Menu</h2>
            <?php } ?>

            <?php if($statusMember == "Tidak Terverifikasi") { ?>
            <a href="#formNewProduct" class="btn btn-primary py-3 px-5 disabled">Add New Product <br> <small>( Waiting for verification.. )</small></a>
            <?php } else { ?>
            <a href="#formNewProduct" class="btn btn-primary py-3 px-5">Add New Product</a>
            <?php } ?>

            <a href="<?=$pecahUmkm['lokasi_umkm']; ?>" class="btn btn-info py-3 px-5" target="_blank">Location</a>
          </div>
        </div>
        <div class="row">

          <!-- jika member punya 1 umkm atau lebih -->
          <?php if($jmlUmkm > 1) { ?>

            <?php 
              $ambilSemuaUmkmMember = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMember' ");
              while($pecahSemuaUmkmMember = $ambilSemuaUmkmMember->fetch_assoc()) {
            ?>
            <div class="col-md-6 col-lg-4 menu-wrap">
              <div class="heading-menu text-center ftco-animate">
                <h3><?=$pecahSemuaUmkmMember["nama_umkm"]; ?></h3>
              </div>

              <?php 
                $ambilSemuaProdukMember = $conn->query("SELECT * FROM tbl_produk WHERE id_umkm = '$pecahSemuaUmkmMember[id_umkm]' ");
                $jmlProduk = $ambilSemuaProdukMember->num_rows;

                // jika tidak ada produk/belum ada produk
                if($jmlProduk < 1) {
                  echo "<h5 class='text-secondary text-center'><em>Nothing menu</em></h5>";
                }
                
                while($pecahSemuaProdukMember = $ambilSemuaProdukMember->fetch_assoc()) {
              ?>
              <div class="menus d-flex ftco-animate">
                <div class="menu-img img" style="background-image: url(admin/dist/img-produk/<?=$pecahSemuaProdukMember['gambar_produk']; ?>);"></div>
                <div class="text">
                  <div class="d-flex">
                    <div class="one-half">
                      <h3><?=$pecahSemuaProdukMember["nama_produk"]; ?></h3>
                    </div>
                    <div class="one-forth">
                      <span class="price"><?=$pecahSemuaProdukMember["harga_produk"]; ?>k</span>
                    </div>
                  </div>
                  <p><?=$pecahSemuaProdukMember["deskripsi_produk"]; ?></p>
                </div>
              </div>
              <div class="mb-4">
                <?php if($statusMember == "Tidak Terverifikasi") { ?>
                <a href="edit_menu.php?id=<?=$pecahSemuaProdukMember['id_produk']; ?>" class="btn btn-success py-2 px-4 disabled">Edit</a>
                <a href="delete_menu.php?id=<?=$pecahSemuaProdukMember['id_produk']; ?>" class="btn btn-danger py-2 px-4 disabled" onclick="return confirm('Yakin ingin hapus produk?')">Delete</a>
                <?php } else { ?>
                <a href="edit_menu.php?id=<?=$pecahSemuaProdukMember['id_produk']; ?>" class="btn btn-success py-2 px-4">Edit</a>
                <a href="delete_menu.php?id=<?=$pecahSemuaProdukMember['id_produk']; ?>" class="btn btn-danger py-2 px-4" onclick="return confirm('Yakin ingin hapus produk?')">Delete</a>
                <?php } ?>
              </div>
              <?php } ?>

            </div>
            <?php } ?>

          <?php } else { ?>

            <?php 
              $ambilProduk = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm WHERE tbl_umkm.id_member = '$idMember' ");
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

          <?php } ?>
        	
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb" id="formNewProduct">
			<div class="container-fluid px-0">
				<div class="row d-flex no-gutters">
          <div class="col-md-12 ftco-animate makereservation p-4 p-md-5 pt-5 pt-md-0">
          	<div class="heading-section ftco-animate mb-5">
	          	<!-- <span class="subheading">New Product Form</span> -->
	            <h2 class="mb-4">Add New Product</h2>
	          </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namaUmkm">UMKM Name</label>
                    <div class="select-wrap one-third">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="nama_umkm" id="namaUmkm" class="form-control">
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
                    <input type="text" class="form-control" id="namaProduk" name="nama_produk" placeholder="Product name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hargaProduk">Price</label>
                    <input type="number" class="form-control" id="hargaProduk" name="harga_produk" placeholder="Product Price" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kategori">Category</label>
                    <div class="select-wrap one-third">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="kategori_produk" id="kategori" class="form-control">
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
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi_produk" placeholder="Description product" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fotoProduk">Photo</label>
                    <input type="file" class="form-control" id="fotoProduk" name="foto_produk" placeholder="Photo product" required>
                  </div>
                </div>
                
                <div class="col-md-12 mt-3">
                  <div class="form-group">
                  <?php if($statusMember == "Tidak Terverifikasi") { ?>
                    <a href="#" class="btn btn-primary py-3 px-5 disabled" name="btn_simpan">Create a New Product <br> <small>( Waiting for verification.. )</small></a>
                  <?php } else { ?>
                    <input type="submit" value="Create a New Product" class="btn btn-primary py-3 px-5" name="btn_simpan">
                  <?php } ?>
                  </div>
                </div>
              </div>
            </form>
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