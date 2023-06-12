<?php 
	// Update status member dari belum terverifikasi ke terverifikasi
	$conn->query("UPDATE tbl_member SET status = 'Terverifikasi' WHERE id_member = '$_GET[id]' ");
	echo "<script>alert('Status member terverifikasi.')</script>";
	echo "<script>location ='index.php?halaman=member';</script>";
?>