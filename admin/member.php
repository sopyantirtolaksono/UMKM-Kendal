<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Member
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Member</a></li>
    <li class="active">Semua member</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Members</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Password</th>
                  <th class="text-center">Nama Lengkap</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php $no = 1; ?>
                <?php $ambil = $conn->query("SELECT * FROM tbl_member"); ?>
                <?php while($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?=$no; ?></td>
                  <td><?=$pecah["username"]; ?></td>
                  <td><?=$pecah["password"]; ?></td>
                  <td><?=$pecah["nama_lengkap"]; ?></td>

                  <?php if($pecah["status"] == "Tidak Terverifikasi") { ?>
                  <td><span class="label label-warning"><?=$pecah["status"]; ?></span></td>
                  <?php } else { ?>
                  <td><span class="label label-success"><?=$pecah["status"]; ?></span></td>
                  <?php } ?>

                  <td>
                    <?php if($pecah["status"] == "Tidak Terverifikasi") { ?>
                    <a href="index.php?halaman=terverifikasi&id=<?=$pecah['id_member']; ?>" class="btn btn-success"><i class="fa fa-check"></i> Verifikasi</a>
                    <?php } else { ?>
                    <a href="index.php?halaman=tidak_terverifikasi&id=<?=$pecah['id_member']; ?>" class="btn btn-default"><i class="fa fa-close"></i> Tidak Verifikasi</a>
                    <?php } ?>

                    <a href="index.php?halaman=hapus_member&id=<?=$pecah['id_member']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                <?php $no++; ?>
                <?php } ?>
                </tbody>

              </table>
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