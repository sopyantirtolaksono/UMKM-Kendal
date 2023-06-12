<?php 
	$conn = mysqli_connect("localhost", "root", "", "db_umkm_kendal");
?>

<div class="box-body table-responsive">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama UMKM</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Harga</th>
      <th class="text-center">Kategori</th>
      <th class="text-center">Deskripsi</th>
      <th class="text-center">Foto</th>
      <th class="text-center">Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php $no = 1; ?>
    <?php $ambil = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm JOIN tbl_kategori ON tbl_produk.id_kategori = tbl_kategori.id_kategori WHERE nama_umkm LIKE '%$_GET[keyword]%' OR nama_produk LIKE '%$_GET[keyword]%' OR kategori LIKE '%$_GET[keyword]%' "); ?>
    <?php //$adaDataProduk = $ambil->num_rows; ?>
    <?php while($pecah = $ambil->fetch_assoc()) { ?>
      <tr>
        <td><?=$no; ?></td>
        <td><?=$pecah["nama_umkm"]; ?></td>
        <td><?=$pecah["nama_produk"]; ?></td>
        <td>Rp. <?=number_format($pecah["harga_produk"]); ?></td>
        <td><?=$pecah["kategori"]; ?></td>
        <td><?=$pecah["deskripsi_produk"]; ?></td>
        <td><img src="dist/img-produk/<?=$pecah['gambar_produk']; ?>" alt="Gambar produk." width="100" height="70"></td>
        <td>
          <a href="index.php?halaman=edit_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
          <a href="index.php?halaman=hapus_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
        </td>
      </tr>
      <?php $no++; ?>
    <?php } ?>
    </tbody>

  </table>
</div>
<!-- /.box-body -->