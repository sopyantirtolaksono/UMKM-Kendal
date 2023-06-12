<?php
  // jika tombol update ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto"]["name"];
    $lokasiFoto = $_FILES["foto"]["tmp_name"];
    // ambil data dari form
    $namaUmkm   = $_POST["nama_umkm"];
    $nama       = $_POST["nama"];
    $harga      = $_POST["harga"];
    $kategori   = $_POST["kategori"];
    $deskripsi  = $_POST["deskripsi"];

    // cek jika ada foto/tidak ada foto yang diupload
    if(!empty($lokasiFoto)) {
      // cek jika gambar/foto yang diupload bukan gambar
      $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
      $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
      if(!in_array($tipeFile, $fotoValid))
      {
        echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
        echo "<script>location ='index.php?halaman=tambah_produk';</script>";
        exit();
      }

      // hapus foto produk lama difolder img-produk
      $ambilFotoProdukLama = $conn->query("SELECT * FROM tbl_produk WHERE id_produk = '$_GET[id]' ");
      $pecahFotoProdukLama = $ambilFotoProdukLama->fetch_assoc();
      $fotoProdukLama      = $pecahFotoProdukLama["gambar_produk"];
      if(file_exists("dist/img-produk/$fotoProdukLama")) {
        unlink("dist/img-produk/$fotoProdukLama");
      }

      // aktifkan uniqid
      $uniqId = uniqid();
      $namaFotoBaru = $uniqId."_".$namaFoto;
      move_uploaded_file($lokasiFoto, "dist/img-produk/" .$namaFotoBaru);
      $foto = $namaFotoBaru;
      // update produk pada tabel produk
      $conn->query("UPDATE tbl_produk SET id_umkm = '$namaUmkm', id_kategori = '$kategori', nama_produk = '$nama', harga_produk = '$harga', gambar_produk = '$foto', deskripsi_produk = '$deskripsi' WHERE id_produk = '$_GET[id]' ");
      echo "<script>alert('Data berhasil ditambahkan!')</script>";
      echo "<script>location ='index.php?halaman=produk';</script>";
    }
    else {
      // update produk pada tabel produk
      $conn->query("UPDATE tbl_produk SET id_umkm = '$namaUmkm', id_kategori = '$kategori', nama_produk = '$nama', harga_produk = '$harga', deskripsi_produk = '$deskripsi' WHERE id_produk = '$_GET[id]' ");
      echo "<script>alert('Data berhasil ditambahkan!')</script>";
      echo "<script>location ='index.php?halaman=produk';</script>";
    }
    
  }

?>

<!-- ambil id_produk dari url -->
<?php $idProduk = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm JOIN tbl_kategori ON tbl_produk.id_kategori = tbl_kategori.id_kategori WHERE tbl_produk.id_produk = '$_GET[id]'"); ?>
<?php $produkSatuan = $idProduk->fetch_assoc(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
    <li><a href="#">Data Tabel</a></li>
    <li class="active">Edit Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Set Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">

                <div class="form-group">
                  <label for="namaUmkm">Nama Umkm</label>
                  <select class="form-control" id="namaUmkm" name="nama_umkm">
                    <option value="<?=$produkSatuan['id_umkm']; ?>"><?=$produkSatuan["nama_umkm"]; ?></option>
                    <?php $ambilUmkm = $conn->query("SELECT * FROM tbl_umkm"); ?>
                    <?php while($pecahUmkm = $ambilUmkm->fetch_assoc()) { ?>
                      <option value="<?=$pecahUmkm['id_umkm']; ?>"><?=$pecahUmkm["nama_umkm"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="namaProduk">Nama Produk</label>
                  <input type="text" class="form-control" id="namaProduk" name="nama" placeholder="Nama produk" value="<?=$produkSatuan['nama_produk']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="hargaProduk">Harga Produk</label>
                  <input type="number" class="form-control" id="hargaProduk" name="harga" placeholder="Harga produk" value="<?=$produkSatuan['harga_produk']; ?>" required>
                </div>

                <div class="form-group">
                  <label>Kategori Produk</label>
                  <select class="form-control" name="kategori">
                    <option value="<?=$produkSatuan['id_kategori']; ?>"><?=$produkSatuan['kategori']; ?></option>
                    <?php $ambil = $conn->query("SELECT * FROM tbl_kategori"); ?>
                    <?php while($pecah = $ambil->fetch_assoc()) { ?>
                      <option value="<?=$pecah['id_kategori']; ?>"><?=$pecah["kategori"]; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea id="deskripsi" name="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi produk" required><?=$produkSatuan["deskripsi_produk"]; ?></textarea>
                </div>

                <div class="form-group">
                  <img src="dist/img-produk/<?=$produkSatuan['gambar_produk']; ?>" width="200">
                </div>

                <div class="form-group">
                  <label for="fotoProduk">Foto Produk</label>
                  <input type="file" id="fotoProduk" name="foto">

                  <em><p class="help-block">Masukkan file berupa gambar</p></em>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btn_simpan"><i class="fa fa-send"></i> Update</button>
                <a href="index.php?halaman=produk" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>