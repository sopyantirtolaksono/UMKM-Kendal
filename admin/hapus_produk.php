<?php
	$conn->query("DELETE FROM tbl_produk WHERE id_produk = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus!')</script>";
	echo "<script>location ='index.php?halaman=produk';</script>";
?>