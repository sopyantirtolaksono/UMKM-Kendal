<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data UMKM
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> UMKM</a></li>
    <li class="active">Data UMKM</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Semua UMKM</h3><br><br>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Cari UMKM disini</label>
                    <input type="text" class="form-control" id="cari-umkm" placeholder="Ketikkan nama umkm, nama owner..">
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
                <?php $ambil = $conn->query("SELECT * FROM tbl_umkm JOIN tbl_member ON tbl_umkm.id_member = tbl_member.id_member"); ?>
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
        $("#cari-umkm").on("keyup", function() {
          let valueCariUmkm = $("#cari-umkm").val();
          $("#table-load").load("dist/data-load/umkm_data_load.php?keyword=" + valueCariUmkm);
        })
      })
    </script>