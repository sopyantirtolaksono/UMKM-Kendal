<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Produk</a></li>
    <li class="active">Data Produk</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Semua Produk</h3><br><br>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Cari produk disini</label>
                    <input type="text" class="form-control" id="cari-produk" placeholder="Ketikkan nama produk, nama umkm..">
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="table-load">
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
                <?php $ambil = $conn->query("SELECT * FROM tbl_produk JOIN tbl_umkm ON tbl_produk.id_umkm = tbl_umkm.id_umkm JOIN tbl_kategori ON tbl_produk.id_kategori = tbl_kategori.id_kategori"); ?>
                <?php while($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?=$no; ?></td>
                  <td><?=$pecah["nama_umkm"]; ?></td>
                  <td><?=$pecah["nama_produk"]; ?></td>
                  <td><?=number_format($pecah["harga_produk"]); ?>k</td>
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
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- javascript -->
    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- script cari produk -->
    <script type="text/javascript">
      $(document).ready(function() {
        $("#cari-produk").on("keyup", function() {
          let valueCariProduk = $("#cari-produk").val();
          $("#table-load").load("dist/data-load/produk_data_load.php?keyword=" + valueCariProduk);
        })
      })
    </script>