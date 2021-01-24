<?php
require 'admin/crud/config.php';
include 'tamplate/header.php';

$result = mysqli_query($con, "SELECT * FROM `movies` WHERE 1");
$genre = mysqli_query($con, 'SELECT `nama` FROM `genre`');
?>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <?php include 'tamplate/navbar.php' ?>
  <!-- Product Section Begin -->
  <section class="product spad">
    <div class="container ">
      <div class="row">
        <div class="col-lg-8">
          <div class="trending__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Genre</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
              </div>
            </div>
            <div class="row" style="padding-left: 10px;">
              <ul class="taxindex" style="list-style-type:none; min-width: 100%;">
                <?php
                foreach ($genre as $data) {
                ?>
                  <li class="btn btn-dark" style=" margin-bottom: 5px; text-align: left;"><a><?php echo $data['nama']; ?></a></li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8">
          <div class="product__sidebar">
            <div class="product__sidebar__view">
              <div class="section-title">
                <h5>Top Views</h5>
              </div>
              <?php
              $a = 0;
              if (mysqli_num_rows($result)) {
                foreach ($result as $row) {
                  if ($a >= 3) {
                    break;
                  }
                  $a++;
              ?>
                  <div class="filter__gallery set-bg" data-setbg="admin/upload/<?php echo $row['gambar']; ?>">
                    <div class="product__sidebar__view__item set-bg mix day years" data-setbg="img/transparant.png" style="border-radius: 0;">
                      <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      <div class="ep"><?php echo $row['type'] ?></div>
                      <div class="view"> <?php echo $row['status'] ?></div>
                    </div>
                  </div>
              <?php
                }
              } ?>
            </div>
          </div>
          <div class="product__sidebar">
            <div class="product__sidebar__view">
              <div class="section-title">
                <h5>Genre</h5>
              </div>
              <div class="genre">
                <?php
                foreach ($genre as $data) {
                ?>
                  <a class="btn" style="color: white; margin-bottom: 5px; text-align: left;"><?php echo $data['nama'] ?></a>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Section End -->
  <?php include 'tamplate/footer.php' ?>
  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-switch"><i class="icon_close"></i></div>
      <form class="search-model-form">
        <input type="text" id="search-input" placeholder="Search here.....">
      </form>
    </div>
  </div>
  <!-- Search model end -->
  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/player.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>