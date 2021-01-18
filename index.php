<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';

$result = mysqli_query($con, "SELECT * FROM `movies` WHERE 1");
?>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <?php include 'tamplate/navbar.php' ?>
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="trending__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Ongoing Anime</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              foreach ($result as $row) {
                if (strtolower($row['status']) == 'ongoing') {
              ?>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <div class="product__item__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <?php
                          $genrelist = $row['genre'];
                          $genre = explode(",", $genrelist);
                          for ($i = 0; $i < count($genre); $i++) {
                            if ($i > 2)
                              break;
                          ?>
                            <li><a href="#"><?php echo $genre[$i] ?></a></li>
                          <?php } ?>
                        </ul>
                        <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      </div>
                    </div>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
          <div class="popular__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Popular Anime</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              if (mysqli_num_rows($result)) {
                foreach ($result as $row) {
              ?>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <div class="product__item__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <?php
                          $genrelist = $row['genre'];
                          $genre = explode(",", $genrelist);
                          for ($i = 0; $i < count($genre); $i++) {
                            if ($i > 2)
                              break;
                          ?>
                            <li><a href="#"><?php echo $genre[$i] ?></a></li>
                          <?php } ?>
                        </ul>
                        <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      </div>
                    </div>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
          <div class="recent__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Recently Added Shows</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              if (mysqli_num_rows($result)) {
                foreach ($result as $row) {
              ?>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <div class="product__item__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <?php
                          $genrelist = $row['genre'];
                          $genre = explode(",", $genrelist);
                          for ($i = 0; $i < count($genre); $i++) {
                            if ($i > 2)
                              break;
                          ?>
                            <li><a href="#"><?php echo $genre[$i] ?></a></li>
                          <?php } ?>
                        </ul>
                        <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      </div>
                    </div>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
          <div class="live__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Live Action</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              if (mysqli_num_rows($result)) {
                foreach ($result as $row) {
              ?>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                      <div class="product__item__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                      <div class="product__item__text">
                        <ul>
                          <?php
                          $genrelist = $row['genre'];
                          $genre = explode(",", $genrelist);
                          for ($i = 0; $i < count($genre); $i++) {
                            if ($i > 2)
                              break;
                          ?>
                            <li><a href="#"><?php echo $genre[$i] ?></a></li>
                          <?php } ?>
                        </ul>
                        <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      </div>
                    </div>
                  </div>
              <?php
                }
              }
              ?>
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
                  if ($a >= 5) {
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