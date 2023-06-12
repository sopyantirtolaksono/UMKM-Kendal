<?php 
	// Update status member dari terverifikasi ke belum terverifikasi
	$conn->query("UPDATE tbl_member SET status = 'Tidak Terverifikasi' WHERE id_member = '$_GET[id]' ");
	echo "<script>alert('Status member Tidak Terverifikasi.')</script>";
	echo "<script>location ='index.php?halaman=member';</script>";
?>