<?php 
	// mulai session
	session_start();
	// unset session member
	session_destroy();
	// alihkan ke halaman index
	echo "<script>location ='index.php';</script>";
?>