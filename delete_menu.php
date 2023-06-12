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

	// cek jika member sudah login/logout
	if(isset($_SESSION["member"])) {
	    // set id member dan status member yang login
	    $idMember     = $_SESSION["member"]["id_member"];
	    $statusMember = $_SESSION["member"]["status"];
	    // cek jika member yg akses belum terverifikasi
	    if($statusMember == "Tidak Terverifikasi") {
	      echo "<script>location ='mymenu.php';</script>";
	      header('Location: mymenu.php');
	      exit();
	    }
	    // jika id produk belum diset/salah
	    if(!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] <= 0 || !is_numeric($_GET["id"])) {
	      echo "<script>location ='mymenu.php';</script>";
	      header('Location: mymenu.php');
	      exit();
	    }
	    // ambil data produk dari tabel produk, utk cek jika data produk tdk ada
	    $ambilProdukYgDicari = $conn->query("SELECT * FROM tbl_produk WHERE id_produk = '$_GET[id]' ");
	    // cek ada umkm apa tidak
	    $jmlProduk   = $ambilProdukYgDicari->num_rows;
	    // jika umkm yang dicari tidak ada, alihkan ke halaman index
	    if($jmlProduk < 1) {
	      echo "<script>location ='mymenu.php';</script>";
	      header('Location: mymenu.php');
	      exit();
	    }
	    // ambil data produk yg akan dihapus
		  $ambilProduk = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm JOIN tbl_member ON tbl_umkm.id_member = tbl_member.id_member JOIN tbl_kategori ON tbl_produk.id_kategori = tbl_kategori.id_kategori WHERE id_produk = '$_GET[id]' ");
		  $pecahProduk = $ambilProduk->fetch_assoc();

		  // cek jika member edit produk yang bukan miliknya
		  if($pecahProduk["id_member"] != $idMember) {
		    echo "<script>location ='mymenu.php';</script>";
		    header('Location: mymenu.php');
		    exit();
		  }
	}
	else {
	    // unset session member
    	unset($idMember);
	}

	// hapus data produk yang dipilih dari tabel produk
	$conn->query("DELETE FROM tbl_produk WHERE id_produk = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus.')</script>";
	echo "<script>location ='mymenu.php';</script>";
?>