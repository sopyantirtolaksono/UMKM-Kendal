<?php
  // jika tombol simpan ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto = $_FILES["foto"]["name"];
    $lokasiFoto = $_FILES["foto"]["tmp_name"];

    // cek jika gambar/foto yang diupload bukan gambar
    $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
    $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
    if(!in_array($tipeFile, $fotoValid))
    {
      echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
      echo "<script>location ='index.php?halaman=tambah_produk';</script>";
      exit();
    }

    // aktifkan uniqid
    $uniqId = uniqid();
    $namaFotoBaru = $uniqId."_".$namaFoto;
    move_uploaded_file($lokasiFoto, "dist/img-produk/" .$namaFotoBaru);

    // ambil data dari form
    $namaUmkm   = $_POST["nama_umkm"];
    $nama       = $_POST["nama"];
    $harga      = $_POST["harga"];
    $kategori   = $_POST["kategori"];
    $deskripsi  = $_POST["deskripsi"];
    $foto       = $namaFotoBaru;

    $conn->query("INSERT INTO tbl_produk (id_umkm, id_kategori, nama_produk, harga_produk, gambar_produk, deskripsi_produk) VALUES ('$namaUmkm', '$kategori', '$nama', '$harga', '$foto', '$deskripsi')");
    echo "<script>alert('Data berhasil ditambahkan!')</script>";
    echo "<script>location ='index.php?halaman=produk';</script>";
  }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Produk</a></li>
    <li class="active">Tambah Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Produk Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama Umkm</label>
                  <select class="form-control" name="nama_umkm">
                    <?php $ambil = $conn->query("SELECT * FROM tbl_umkm"); ?>
                    <?php while($pecah = $ambil->fetch_assoc()) { ?>
                      <option value="<?=$pecah['id_umkm']; ?>"><?=$pecah["nama_umkm"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="namaProduk">Nama Produk</label>
                  <input type="text" class="form-control" id="namaProduk" name="nama" placeholder="Nama produk" required>
                </div>
                <div class="form-group">
                  <label for="hargaProduk">Harga Produk</label>
                  <input type="number" class="form-control" id="hargaProduk" name="harga" placeholder="Harga produk" required>
                </div>

                <div class="form-group">
                  <label>Kategori Produk</label>
                  <select class="form-control" name="kategori">
                    <?php $ambil = $conn->query("SELECT * FROM tbl_kategori"); ?>
                    <?php while($pecah = $ambil->fetch_assoc()) { ?>
                      <option value="<?=$pecah['id_kategori']; ?>"><?=$pecah["kategori"]; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi </label>
                  <textarea id="deskripsi" name="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi produk" required></textarea>
                </div>
                <div class="form-group">
                  <label for="fotoProduk">Foto Produk</label>
                  <input type="file" id="fotoProduk" name="foto" required>

                  <em><p class="help-block">Masukkan file berupa gambar</p></em>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btn_simpan"><i class="fa fa-send"></i> Simpan</button>
                <a href="index.php?halaman=produk" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>