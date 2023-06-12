<?php 
  // ambil semua data umkm pada tabel umkm
  $ambilUmkm = $conn->query("SELECT COUNT(*) FROM tbl_umkm");
  $pecahUmkm = $ambilUmkm->fetch_assoc();
  // jadikan tipe data array jadi string
  $jmlUmkm   = implode($pecahUmkm);

  // ambil semua data produk pada tabel produk
  $ambilProduk = $conn->query("SELECT COUNT(*) FROM tbl_produk");
  $pecahProduk = $ambilProduk->fetch_assoc();
  // jadikan tipe data array jadi string
  $jmlProduk   = implode($pecahProduk);

  // ambil semua data member pada tabel member
  $ambilMember = $conn->query("SELECT COUNT(*) FROM tbl_member");
  $pecahMmeber = $ambilMember->fetch_assoc();
  // jadikan tipe data array jadi string
  $jmlMember   = implode($pecahMmeber);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	 <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$jmlUmkm; ?></h3>

              <p>UMKM</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="index.php?halaman=umkm" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner" style="color: white;">
              <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
              <h3><?=$jmlProduk; ?></h3>

              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="index.php?halaman=produk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner" style="color: white;">
              <h3><?=$jmlMember; ?></h3>

              <p>Member</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="index.php?halaman=member" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <!-- /.row -->


</section>