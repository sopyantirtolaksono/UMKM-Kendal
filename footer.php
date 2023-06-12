<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container-fluid px-md-5 px-3">
    <div class="row mb-5">
      <div class="col-md-6 col-lg-4">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">UMKMKendal</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Open Hours Office</h2>
          <ul class="list-unstyled open-hours">
            <li class="d-flex"><span>Monday</span><span>9:00 - 24:00</span></li>
            <li class="d-flex"><span>Tuesday</span><span>9:00 - 24:00</span></li>
            <li class="d-flex"><span>Wednesday</span><span>9:00 - 24:00</span></li>
            <li class="d-flex"><span>Thursday</span><span>9:00 - 24:00</span></li>
            <li class="d-flex"><span>Friday</span><span>9:00 - 02:00</span></li>
            <li class="d-flex"><span>Saturday</span><span>9:00 - 02:00</span></li>
            <li class="d-flex"><span>Sunday</span><span> 9:00 - 02:00</span></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
         <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Menu's</h2>

          <div class="thumb d-sm-flex">
            <?php 
              $ambilGambarProdukF1 = $conn->query("SELECT * FROM tbl_produk LIMIT 0, 3");
              while($pecahGambarProdukF1 = $ambilGambarProdukF1->fetch_assoc()) {
            ?>
          	<a class="thumb-menu img" style="background-image: url(admin/dist/img-produk/<?=$pecahGambarProdukF1['gambar_produk']; ?>);">
          	</a>
            <?php } ?>
          </div>

          <div class="thumb d-flex">
            <?php 
              $ambilGambarProdukF2 = $conn->query("SELECT * FROM tbl_produk LIMIT 3, 3");
              while($pecahGambarProdukF2 = $ambilGambarProdukF2->fetch_assoc()) {
            ?>
          	<a class="thumb-menu img" style="background-image: url(admin/dist/img-produk/<?=$pecahGambarProdukF2['gambar_produk']; ?>);">
          	</a>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">

        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Website for all <i class="icon-heart" aria-hidden="true"></i> by <a href="index.php" target="_blank">UMKMKendal</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </div>
</footer>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>