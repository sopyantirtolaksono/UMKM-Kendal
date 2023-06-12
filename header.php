<?php 

	// cek jika member sudah login/logout
	if(isset($_SESSION["member"])) {
		// ambil id member yang tidak punya toko/umkm
		$idMemberTdkPnyUmkm	 = $_SESSION['member']['id_member'];
		// cek jika member yang masuk tidak punya toko/umkm
		$amblMembrTdkAdaUmkm = $conn->query("SELECT * FROM tbl_umkm WHERE id_member = '$idMemberTdkPnyUmkm' ");
		$dataMembrTdkAdaUmkm = $amblMembrTdkAdaUmkm->num_rows;
	}
	else {
		// unset session member
		unset($idMemberTdkPnyUmkm);
	}


?>

<div class="py-1 bg-black top">
	<div class="container">
		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
			<div class="col-lg-12 d-block">
	    		<div class="row d-flex">
	    			<div class="col-md pr-4 d-flex topper align-items-center">
				    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
					    <span class="text">+ 1235 2355 98</span>
				    </div>
				    <div class="col-md pr-4 d-flex topper align-items-center">
				    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    <span class="text">umkmkendal@gmail.com</span>
				    </div>
				    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right justify-content-end">
					    <p class="mb-0 register-link"><span>Open hours:</span> <span>Monday - Sunday</span> <span>8:00AM - 9:00PM</span></p>
				    </div>
			    </div>
		    </div>
	    </div>
	</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.php">UMKMKendal</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
		    <ul class="navbar-nav ml-auto">
		    	<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>

		    	<?php if(isset($_SESSION["member"])) { ?>
		    		<?php if($dataMembrTdkAdaUmkm > 0) { ?>
		    		<li class="nav-item"><a href="mymenu.php" class="nav-link">My Menu</a></li>
		    		<?php } ?>
		      	<?php } ?>

		    	<li class="nav-item"><a href="umkm.php" class="nav-link">Umkm</a></li>

		    	<?php if(isset($_SESSION["member"])) { ?>
		    	<li class="nav-item"><a href="myaccount.php" class="nav-link">My Account</a></li>
		      	<?php } ?>

		      	<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>

		      	<?php if(isset($_SESSION["member"])) { ?>
		      	<li class="nav-item cta"><a href="logout.php" class="nav-link">Logout</a></li>
		      	<?php } else { ?>
		      	<li class="nav-item cta"><a href="login.php" class="nav-link" target="_blank">Login / Registration</a></li>
		      	<?php } ?>
		    </ul>
		</div>
	</div>
</nav>
<!-- END nav -->