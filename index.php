<?php 
  // mulai session
  session_start();
  // koneksi ke database
  require "admin/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMKMKendal - Home</title>
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
    
    <section class="home-slider owl-carousel js-fullheight">
      <div class="slider-item js-fullheight" style="background-image: url(images/bg_1.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text js-fullheight justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-12 col-sm-12 text-center ftco-animate">
              <h1 class="mb-4 mt-5">Our Delicious Specialties</h1>
              <p>
                <?php if(isset($_SESSION["member"])) { ?>
                <a href="logout.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Logout</a> 
                <?php } else { ?>
                <a href="login.php" class="btn btn-primary p-3 px-xl-4 py-xl-3" target="_blank">Login / Registration</a> 
                <?php } ?>
                <a href="#ourMenu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a>
              </p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item js-fullheight" style="background-image: url(images/bg_2.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text js-fullheight justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-12 col-sm-12 text-center ftco-animate">
              <h1 class="mb-4 mt-5">The Best Place to Kick of Your Day</h1>
              <p>
                <?php if(isset($_SESSION["member"])) { ?>
                <a href="logout.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Logout</a> 
                <?php } else { ?>
                <a href="login.php" class="btn btn-primary p-3 px-xl-4 py-xl-3" target="_blank">Login / Registration</a> 
                <?php } ?>
                <a href="#ourMenu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a>
              </p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item js-fullheight" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-12 col-sm-12 text-center ftco-animate">
              <h1 class="mb-4 mt-5">Creamy Hot and Ready to Serve</h1>
              <p>
                <?php if(isset($_SESSION["member"])) { ?>
                <a href="logout.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Logout</a> 
                <?php } else { ?>
                <a href="login.php" class="btn btn-primary p-3 px-xl-4 py-xl-3" target="_blank">Login / Registration</a> 
                <?php } ?>
                <a href="#ourMenu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </section>
	

		<section class="ftco-section ftco-wrap-about ftco-no-pb">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-10 wrap-about ftco-animate text-center">
	          <div class="heading-section mb-4 text-center">
	          	<!-- <span class="subheading">About</span> -->
	            <h2 class="mb-4">UMKM Kendal</h2>
	          </div>
						<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

						<div class="video justify-content-center">
							<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
  							<span class="ion-ios-play"></span>
	  					</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_4.jpg);" data-stellar-background-ratio="0.5">
		<!-- <section class="ftco-section ftco-counter img ftco-no-pt" id="section-counter"> -->

      <!-- ambil jumlah data umkm & produk & member -->
      <?php
        // jumlah data umkm
        $ambilJmlUmkm   = $conn->query("SELECT COUNT(*) FROM tbl_umkm");
        $pecahJmlUmkm   = $ambilJmlUmkm->fetch_assoc();
        $jmlUmkm        = implode($pecahJmlUmkm);
        // jumlah data produk
        $ambilJmlProduk = $conn->query("SELECT COUNT(*) FROM tbl_produk");
        $pecahJmlProduk = $ambilJmlProduk->fetch_assoc();
        $jmlProduk      = implode($pecahJmlProduk);
        // jumlah data member
        $ambilJmlMember = $conn->query("SELECT COUNT(*) FROM tbl_member");
        $pecahJmlMember = $ambilJmlMember->fetch_assoc();
        $jmlMember      = implode($pecahJmlMember);

      ?>

    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-center">
    			<div class="col-lg-10">
    				<div class="row d-md-flex align-items-center">
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="18">0</strong>
		                <span>Years of Experienced</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="<?=$jmlUmkm; ?>">0</strong>
		                <span>UMKM</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="<?=$jmlProduk; ?>">0</strong>
		                <span>Menus</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="<?=$jmlMember; ?>">0</strong>
		                <span>Member</span>
		              </div>
		            </div>
		          </div>
	          </div>
          </div>
        </div>
    	</div>
    </section>

		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<!-- <span class="subheading">Services</span> -->
            <h2 class="mb-4">Our Services</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
            <div class="media block-6 services d-block">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-cake"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Birthday Party</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
            <div class="media block-6 services d-block">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-meeting"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Business Meetings</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>    
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
            <div class="media block-6 services d-block">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-tray"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Wedding Party</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

    <section class="ftco-section" id="ourMenu">
    	<div class="container-fluid px-4">
    		<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<!-- <span class="subheading">Specialties</span> -->
            <h2 class="mb-4">Our Menu</h2>
          </div>
        </div>
        <div class="row">

          <?php 
            $ambilProduk = $conn->query("SELECT * FROM tbl_produk");
            while($pecahProduk = $ambilProduk->fetch_assoc()) {
          ?>
        	<div class="col-md-6 col-lg-4 menu-wrap mb-0">
            <a href="menu.php?id=<?=$pecahProduk['id_umkm']; ?>">
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
            </a>
        	</div>
          <?php } ?>

        </div>
    	</div>
    </section>
    
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<!-- <span class="subheading">Owner</span> -->
            <h2 class="mb-4">Our Success Owner</h2>
          </div>
        </div>	
				<div class="row">
					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="staff">
							<div class="img" style="background-image: url(images/chef-4.jpg);"></div>
							<div class="text pt-4">
								<h3>Rangga Wijaya</h3>
								<span class="position mb-2">Cabe-Cabe Resto Owner</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<div class="faded">
									<!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
									<ul class="ftco-social d-flex">
		                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		              </ul>
	              </div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="staff">
							<div class="img" style="background-image: url(images/chef-2.jpg);"></div>
							<div class="text pt-4">
								<h3>Jeng Maryam</h3>
								<span class="position mb-2">Warna Cafe Owner</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<div class="faded">
									<!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
									<ul class="ftco-social d-flex">
		                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		              </ul>
	              </div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="staff">
							<div class="img" style="background-image: url(images/chef-3.jpg);"></div>
							<div class="text pt-4">
								<h3>Cak Jono</h3>
								<span class="position mb-2">Rawit Abang Resto Owner</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<div class="faded">
									<!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
									<ul class="ftco-social d-flex">
		                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		              </ul>
	              </div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="staff">
							<div class="img" style="background-image: url(images/chef-1.jpg);"></div>
							<div class="text pt-4">
								<h3>Den Rasiman</h3>
								<span class="position mb-2">Kopi Yes Cafe Owner</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<div class="faded">
									<!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
									<ul class="ftco-social d-flex">
		                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
		                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		              </ul>
	              </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- <section class="ftco-section testimony-section" style="background-image: url(images/bg_5.jpg);" data-stellar-background-ratio="0.5"> -->
		<section class="ftco-section testimony-section img" style="background-image: url(images/bg_5.jpg);">
			<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<!-- <span class="subheading">Testimony</span> -->
            <h2 class="mb-4">Happy Customer</h2>
          </div>
        </div>
        <div class="row ftco-animate justify-content-center">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap text-center pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Agus Wijaya M.Pol Ssc</p>
                    <span class="position">Kapolres Kendal</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_2.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Ibu Sinok Mirna M.Sos KppsK</p>
                    <span class="position">Bupati Kendal</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Sigit Raharjo</p>
                    <span class="position">Kepdin Ekonomi Kreatif Kendal</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_4.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Haikal Herlambang</p>
                    <span class="position">Ketua Asosiasi UMKM kendal</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Ian Langgeng</p>
                    <span class="position">Customer</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container-fluid px-0">
				<div class="row no-gutters">

          <!-- menampilkan gambar produk/menu-menu dari banyak umkm -->
          <!-- ambil gambar produk -->
          <?php 
            $ambilGambarProduk = $conn->query("SELECT * FROM tbl_produk LIMIT 0, 5");
            while($pecahGambarProduk = $ambilGambarProduk->fetch_assoc()) {
          ?>
  					<div class="col-md">
  						<a class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(admin/dist/img-produk/<?=$pecahGambarProduk['gambar_produk']; ?>);">
  							<!-- <span class="ion-logo-instagram"></span> -->
  						</a>
  					</div>
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