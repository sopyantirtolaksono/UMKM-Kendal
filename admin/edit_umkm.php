<?php
  // jika tombol update ditekan
  if(isset($_POST["btn_simpan"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto"]["name"];
    $lokasiFoto = $_FILES["foto"]["tmp_name"];
    // ambil data dari form
    $namaMember = $_POST["nama_member"];
    $nama       = $_POST["nama"];
    $alamat     = $_POST["alamat"];
    $kontak     = $_POST["kontak"];
    $lokasi     = $_POST["lokasi"];

    // cek jika ada foto/tidak ada foto yang diupload
    if(!empty($lokasiFoto)) {
      // cek jika gambar/foto yang diupload bukan gambar
      $tipeFile = pathinfo($namaFoto, PATHINFO_EXTENSION);
      $fotoValid = ["jpg", "JPG", "png", "PNG", "jpeg", "JPEG"];
      if(!in_array($tipeFile, $fotoValid))
      {
        echo "<script>alert('Maaf! file yang anda upload bukan gambar.')</script>";
        echo "<script>location ='index.php?halaman=umkm';</script>";
        exit();
      }

      // hapus foto umkm lama difolder img-produk
      $ambilFotoUmkmLama   = $conn->query("SELECT * FROM tbl_umkm WHERE id_umkm = '$_GET[id]' ");
      $pecahFotoUmkmLama   = $ambilFotoUmkmLama->fetch_assoc();
      $fotoUmkmLama        = $pecahFotoUmkmLama["gambar_umkm"];
      if(file_exists("dist/img-umkm/$fotoUmkmLama")) {
        unlink("dist/img-umkm/$fotoUmkmLama");
      }

      // aktifkan uniqid
      $uniqId = uniqid();
      $namaFotoBaru = $uniqId."_".$namaFoto;
      move_uploaded_file($lokasiFoto, "dist/img-umkm/" .$namaFotoBaru);
      $foto = $namaFotoBaru;
      // update umkm pada tabel umkm
      $conn->query("UPDATE tbl_umkm SET id_member = '$namaMember', nama_umkm = '$nama', alamat_umkm = '$alamat', kontak_umkm = '$kontak', lokasi_umkm = '$lokasi', gambar_umkm = '$foto' WHERE id_umkm = '$_GET[id]' ");
      echo "<script>alert('Data berhasil ditambahkan!')</script>";
      echo "<script>location ='index.php?halaman=umkm';</script>";
    }
    else {
      // update umkm pada tabel umkm
      $conn->query("UPDATE tbl_umkm SET id_member = '$namaMember', nama_umkm = '$nama', alamat_umkm = '$alamat', kontak_umkm = '$kontak', lokasi_umkm = '$lokasi' WHERE id_umkm = '$_GET[id]' ");
      echo "<script>alert('Data berhasil ditambahkan!')</script>";
      echo "<script>location ='index.php?halaman=umkm';</script>";
    }
    
  }

?>

<!-- ambil id_produk dari url -->
<?php $idUmkm     = $conn->query("SELECT * FROM tbl_umkm JOIN tbl_member ON tbl_umkm.id_member = tbl_member.id_member WHERE tbl_umkm.id_umkm = '$_GET[id]'"); ?>
<?php $umkmSatuan = $idUmkm->fetch_assoc(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit UMKM
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cube"></i> UMKM</a></li>
    <li><a href="#">Data Tabel</a></li>
    <li class="active">Edit UMKM</li>
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
                  <label>Nama Member</label>
                  <select class="form-control" name="nama_member">
                    <option value="<?=$umkmSatuan['id_member']; ?>"><?=$umkmSatuan["nama_lengkap"]; ?></option>
                    <?php $ambilMember = $conn->query("SELECT * FROM tbl_member"); ?>
                    <?php while($pecahMember = $ambilMember->fetch_assoc()) { ?>
                      <option value="<?=$pecahMember['id_member']; ?>"><?=$pecahMember["nama_lengkap"]; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="namaUmkm">Nama UMKM</label>
                  <input type="text" class="form-control" id="namaUmkm" name="nama" placeholder="Nama umkm" required value="<?=$umkmSatuan['nama_umkm']; ?>">
                </div>

                <div class="form-group">
                  <label for="alamatUmkm">Alamat UMKM</label>
                  <input type="text" class="form-control" id="alamatUmkm" name="alamat" placeholder="Alamat umkm" required value="<?=$umkmSatuan['alamat_umkm']; ?>">
                </div>

                <div class="form-group">
                  <label for="kontakUmkm">Kontak UMKM </label>
                  <input type="number" class="form-control" id="kontakUmkm" name="kontak" placeholder="Kontak umkm" required value="<?=$umkmSatuan['kontak_umkm']; ?>">
                </div>

                <div class="form-group">
                  <label for="lokasiUmkm">Lokasi UMKM</label>
                  <input type="text" class="form-control" id="lokasiUmkm" name="lokasi" placeholder="Lokasi umkm" required value="<?=$umkmSatuan['lokasi_umkm']; ?>">
                </div>

                <div class="form-group">
                  <img src="dist/img-umkm/<?=$umkmSatuan['gambar_umkm']; ?>" width="200">
                </div>

                <div class="form-group">
                  <label for="fotoUmkm">Foto UMKM</label>
                  <input type="file" id="fotoUmkm" name="foto">

                  <em><p class="help-block">Masukkan file berupa gambar</p></em>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btn_simpan"><i class="fa fa-send"></i> Update</button>
                <a href="index.php?halaman=umkm" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>