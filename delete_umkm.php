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
	    // set id member yang login & status member
    	$idMember     = $_SESSION["member"]["id_member"];
	    $statusMember = $_SESSION["member"]["status"];
	    // cek jika member yg akses belum terverifikasi
	    if($statusMember == "Tidak Terverifikasi") {
	      echo "<script>location ='umkm.php';</script>";
	      header('Location: umkm.php');
	      exit();
	    }
	    // jika id umkm belum diset/salah
	    if(!isset($_GET["id"]) || empty($_GET["id"]) || $_GET["id"] <= 0 || !is_numeric($_GET["id"])) {
	      echo "<script>location ='umkm.php';</script>";
	      header('Location: umkm.php');
	      exit();
	    }
	    // ambil data umkm dari tabel umkm, utk cek jika data umkm tdk ada
	    $ambilUmkmYgDicari = $conn->query("SELECT * FROM tbl_umkm WHERE id_umkm = '$_GET[id]' ");
	    // cek ada umkm apa tidak
	    $jmlUmkm   		   = $ambilUmkmYgDicari->num_rows;
	    $pecahUmkmYgDicari = $ambilUmkmYgDicari->fetch_assoc();
	    // jika umkm yang dicari tidak ada, alihkan ke halaman umkm
	    if($jmlUmkm < 1) {
	      echo "<script>location ='umkm.php';</script>";
	      header('Location: umkm.php');
	      exit();
	    }
	    // cek jika member menghapus umkm yang bukan miliknya
		if($pecahUmkmYgDicari["id_member"] != $idMember) {
		    echo "<script>location ='umkm.php';</script>";
		    header('Location: umkm.php');
		    exit();
		}
	}
	else {
	    // unset session member
	    unset($idMember);
	}
	
	// hapus data umkm yang dipilih dari tabel umkm
	$conn->query("DELETE FROM tbl_umkm WHERE id_umkm = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus.')</script>";
	echo "<script>location ='umkm.php';</script>";
?>