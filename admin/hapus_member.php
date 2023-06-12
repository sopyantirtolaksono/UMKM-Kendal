<?php 
	$conn->query("DELETE FROM tbl_member WHERE id_member = '$_GET[id]' ");
	echo "<script>alert('Data berhasil dihapus!')</script>";
	echo "<script>location ='index.php?halaman=member';</script>";
?>
