<?php 
	$conn = mysqli_connect("localhost", "root", "", "db_umkm_kendal");
?>

<div class="box-body table-responsive">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Member</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Alamat</th>
      <th class="text-center">Kontak</th>
      <th class="text-center" style="max-width: 100px;">Lokasi</th>
      <th class="text-center">Foto</th>
      <th class="text-center">Aksi</th> 
    </tr>
    </thead>

    <tbody>
    <?php $no = 1; ?>
    <?php $ambil = $conn->query("SELECT * FROM tbl_umkm JOIN tbl_member ON tbl_umkm.id_member = tbl_member.id_member WHERE tbl_umkm.nama_umkm LIKE '%$_GET[keyword]%' OR tbl_member.nama_lengkap LIKE '%$_GET[keyword]%' "); ?>
    <?php //$adaDataUmkm = $ambil->num_rows; ?>
    <?php while($pecah = $ambil->fetch_assoc()) { ?>
      <tr>
        <td><?=$no; ?></td>
        <td><?=$pecah["nama_lengkap"]; ?></td>
        <td><?=$pecah["nama_umkm"]; ?></td>
        <td><?=$pecah["alamat_umkm"]; ?></td>
        <td><?=$pecah["kontak_umkm"]; ?></td>
        <td style="max-width: 100px;"><?=$pecah["lokasi_umkm"]; ?></td>
        <td><img src="dist/img-umkm/<?=$pecah['gambar_umkm']; ?>" alt="Gambar umkm." width="100" height="70"></td>
        <td>
          <a href="index.php?halaman=edit_umkm&id=<?=$pecah['id_umkm']; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
          <a href="index.php?halaman=hapus_umkm&id=<?=$pecah['id_umkm']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
        </td>
      </tr>
      <?php $no++; ?>
    <?php } ?>
    </tbody>

  </table>
</div>
<!-- /.box-body -->