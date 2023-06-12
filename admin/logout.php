<?php 
	// cek jika admin belum login
	if(!isset($_SESSION["admin"])) {
	    echo "<script>location ='login.php';</script>";
	    header("Location: login.php");
	    exit();
	}
  	// hilangkan session admin dan alihkan admin ke halaman login
	session_destroy();
	echo "<script>alert('Logout berhasil!')</script>";
	echo "<script>location ='login.php';</script>";
?>