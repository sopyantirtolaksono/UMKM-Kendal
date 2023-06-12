<?php
	$conn->query("DELETE FROM tbl_umkm WHERE id_umkm = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus!')</script>";
	echo "<script>location ='index.php?halaman=umkm';</script>";
?>