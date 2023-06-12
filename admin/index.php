<?php require "header.php"; ?>

<div class="content-wrapper">
	<section class="content container-fluid">
		<?php 
			// $ambilDataAdminMasuk = $conn->query("SELECT * FROM tbl_admin WHERE id_admin = '$dataAdmin[id_admin]' ");
			// $pecahDataAdminMasuk = $ambilDataAdminMasuk->fetch_assoc();
		?>
		<!-- <h1 class="text-primary">Selamat datang Kang ??? :)</h1> -->

		<?php
			if(isset($_GET["halaman"])) {
				if($_GET["halaman"] == "dashboard") {
					require "dashboard.php";
				}
				else if($_GET["halaman"] == "umkm") {
					require "umkm.php";
				}
				else if($_GET["halaman"] == "tambah_umkm") {
					require "tambah_umkm.php";
				}
				else if($_GET["halaman"] == "edit_umkm") {
					require "edit_umkm.php";
				}
				else if($_GET["halaman"] == "hapus_umkm") {
					require "hapus_umkm.php";
				}
				else if($_GET["halaman"] == "produk") {
					require "produk.php";
				}
				else if($_GET["halaman"] == "tambah_produk") {
					require "tambah_produk.php";
				}
				else if($_GET["halaman"] == "edit_produk") {
					require "edit_produk.php";
				}
				else if($_GET["halaman"] == "hapus_produk") {
					require "hapus_produk.php";
				}
				else if($_GET["halaman"] == "member") {
					require "member.php";
				}
				else if($_GET["halaman"] == "terverifikasi") {
					require "terverifikasi.php";
				}
				else if($_GET["halaman"] == "tidak_terverifikasi") {
					require "tidak_terverifikasi.php";
				}
				else if($_GET["halaman"] == "hapus_member") {
					require "hapus_member.php";
				}
				else if($_GET["halaman"] == "logout") {
					require "logout.php";
				}
				
			}
		?>

	</section>
</div>

<?php require "footer.php"; ?>