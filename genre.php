<?php
require 'admin/crud/config.php';
include 'tamplate/header.php';

$topview = mysqli_query($con, 'SELECT * FROM `movies` ORDER BY `views` DESC LIMIT 3');
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
                  <a href="viewallq.php?current=genre&q=<?php echo $data['nama'];?>" class="btn btn-dark" style=" margin-bottom: 5px; text-align: left;"><li><?php echo $data['nama']; ?></li></a>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <?php include "tamplate/sidebar.php"?>
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