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

  // ambil id member dan status member yang login
  $idMember     = $_SESSION["member"]["id_member"];
  $statusMember = $_SESSION["member"]["status"];
  // ambil data account member yang masuk
  $ambilMember = $conn->query("SELECT * FROM tbl_member WHERE id_member = '$idMember' ");
  $pecahMember = $ambilMember->fetch_assoc();

  // cek jika tombol update member ditekan
  if(isset($_POST["btn_simpan"])) {
  	// ambil semua data dari setiap field diform edit member
  	$namaLengkap = $_POST["nama_lengkap"];
  	$username 	 = $_POST["username"];
  	$password 	 = $_POST["password"];

  	// update data member dari table member
  	$conn->query("UPDATE tbl_member SET nama_lengkap = '$namaLengkap', username = '$username', password = '$password' WHERE id_member = '$idMember' ");
  	echo "<script>alert('Update data member sukses.')</script>";
  	echo "<script>location ='myaccount.php';</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - My Account</title>
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
            <h1 class="mb-2 bread">My Account</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My Account <i class="ion-ios-arrow-forward"></i></span></p>
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
					          	<!-- <span class="subheading">Your Account</span> -->
					            <h2 class="mb-4">Account</h2>
					        </div>
				            <form>
				              	<div class="row">
					                <div class="col-md-6">
					                  <div class="form-group">
					                    <label for="namaLengkap">Full Name</label>
					                    <input type="text" class="form-control" id="namaLengkap" placeholder="Your full name" value="<?=$pecahMember['nama_lengkap']; ?>" disabled>
					                  </div>
					                </div>
					                <div class="col-md-6">
					                  <div class="form-group">
					                    <label for="username">Username</label>
					                    <input type="text" class="form-control" id="username" placeholder="Your username" value="<?=$pecahMember['username']; ?>" disabled>
					                  </div>
					                </div>
					                <div class="col-md-12">
					                  <div class="form-group">
					                    <label for="password">Password</label>
					                    <input type="text" class="form-control" id="password" placeholder="Your password" value="<?=$pecahMember["password"]; ?>" disabled>
					                  </div>
					                </div>
				              	</div>
				            </form>
			          	</div>
		          	</div>
		          	<div class="col-md-6 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5">
		          		<div class="py-md-5">
				          	<div class="heading-section ftco-animate mb-5">
					          	<!-- <span class="subheading">Account Edit Form</span> -->
					            <h2 class="mb-4">Edit Account</h2>
					        </div>
				            <form action="" method="post">
				              	<div class="row">
					                <div class="col-md-6">
					                  <div class="form-group">
					                    <label for="namaLengkap">Full Name</label>
					                    <input type="text" class="form-control" id="namaLengkap" placeholder="Your full name" name="nama_lengkap" value="<?=$pecahMember['nama_lengkap']; ?>" required>
					                  </div>
					                </div>
					                <div class="col-md-6">
					                  <div class="form-group">
					                    <label for="username">Username</label>
					                    <input type="text" class="form-control" id="username" placeholder="Your username" name="username" value="<?=$pecahMember['username']; ?>" required>
					                  </div>
					                </div>
					                <div class="col-md-12">
					                  <div class="form-group">
					                    <label for="password">Password</label>
					                    <input type="password" class="form-control" id="password" placeholder="Your password" name="password" value="<?=$pecahMember['password']; ?>" required>
					                  </div>
					                </div>
					                
					                <div class="col-md-12 mt-3">
					                  <div class="form-group">
                                <!-- jika member belum terverifikasi/tidak terverifikasi -->
                                <?php if($statusMember == "Tidak Terverifikasi") { ?>
                                  <a href="#" class="btn btn-primary py-3 px-5 disabled" name="btn_simpan">Update Account <br> <small>( Waiting for verification.. )</small></a>
                                <?php } else { ?>
                                  <input type="submit" value="Update Account" class="btn btn-primary py-3 px-5" name="btn_simpan">
                                <?php } ?>
					                  </div>
					                </div>
				              	</div>
				            </form>
			          	</div>
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