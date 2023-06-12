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
      echo "<script>location ='index.php?halaman=tambah_umkm';</script>";
      exit();
    }

    // aktifkan uniqid
    $uniqId = uniqid();
    $namaFotoBaru = $uniqId."_".$namaFoto;
    move_uploaded_file($lokasiFoto, "dist/img-umkm/" .$namaFotoBaru);

    // ambil data dari form
    $namaMember   = $_POST["nama_member"];
    $nama         = $_POST["nama"];
    $alamat       = $_POST["alamat"];
    $kontak       = $_POST["kontak"];
    $lokasi       = $_POST["lokasi"];
    $foto         = $namaFotoBaru;

    $conn->query("INSERT INTO tbl_umkm (id_member, nama_umkm, alamat_umkm, kontak_umkm, lokasi_umkm, gambar_umkm) VALUES ('$namaMember', '$nama', '$alamat', '$kontak', '$lokasi', '$foto')");
    echo "<script>alert('Data berhasil ditambahkan!')</script>";
    echo "<script>location ='index.php?halaman=umkm';</script>";
  }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah UMKM
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Tambah UMKM</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">UMKM Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">

                <div class="form-group">
                  <label>Nama Member</label>
                  <select class="form-control" name="nama_member">
                    <?php $ambilMember = $conn->query("SELECT * FROM tbl_member"); ?>
                    <?php while($pecahMember = $ambilMember->fetch_assoc()) { ?>
                      <option value="<?=$pecahMember['id_member']; ?>"><?=$pecahMember["nama_lengkap"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="namaUmkm">Nama UMKM</label>
                  <input type="text" class="form-control" id="namaUmkm" name="nama" placeholder="Nama umkm" required>
                </div>

                <div class="form-group">
                  <label for="alamatUmkm">Alamat UMKM</label>
                  <input type="text" class="form-control" id="alamatUmkm" name="alamat" placeholder="Alamat umkm" required>
                </div>

                <div class="form-group">
                  <label for="kontakUmkm">Kontak UMKM </label>
                  <input type="text" class="form-control" id="kontakUmkm" name="kontak" placeholder="Kontak umkm" required>
                </div>

                <div class="form-group">
                  <label for="lokasiUmkm">Lokasi UMKM</label>
                  <input type="text" class="form-control" id="lokasiUmkm" name="lokasi" placeholder="Lokasi umkm" required>
                </div>

                <div class="form-group">
                  <label for="fotoUmkm">Foto UMKM</label>
                  <input type="file" id="fotoUmkm" name="foto" required>

                  <em><p class="help-block">Masukkan file berupa gambar</p></em>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btn_simpan"><i class="fa fa-send"></i> Simpan</button>
                <a href="index.php?halaman=umkm" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>