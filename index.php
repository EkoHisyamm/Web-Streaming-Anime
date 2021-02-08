<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';
?>

<body>
  <!-- Page Preloder -->
  <!-- <div id="preloder">
    <div class="loader"></div>
  </div> -->
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
                  <a href="viewall.php?current=ongoing" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              $result = mysqli_query($con, 'SELECT * FROM `movies` WHERE `status` = "Currently Airing" ORDER BY `time` DESC LIMIT 6');
              $result = anime($result);
              foreach ($result as $row) {
              ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <a href="anime-details.php?id=<?php echo $row['id'] ?>">
                      <div class="product__item__pic set-bg" data-setbg="<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="comment" style="background-color: #e53637;">EP <?php echo $row[0] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                    </a>
                    <div class="product__item__text">
                      <ul>
                        <?php
                        $genrelist = $row['genre'];
                        $gen = explode(",", $genrelist);
                        for ($i = 0; $i < count($gen); $i++) {
                          if ($i > 2)
                            break;
                        ?>
                          <li><a href="viewallq.php?current=genre&q=<?php echo $gen[$i] ?>"><?php echo $gen[$i] ?></a></li>
                        <?php } ?>
                      </ul>
                      <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                    </div>
                  </div>
                </div>
              <?php
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
                  <a href="viewall.php?current=popular" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              $result = mysqli_query($con, 'SELECT * FROM `movies` WHERE `rate` > "8" ORDER BY `time` DESC LIMIT 6 ');
              $result = anime($result);
              foreach ($result as $row) {
              ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                  <a href="anime-details.php?id=<?php echo $row['id'] ?>">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo $row['gambar']; ?>">
                      <div class="ep"><?php echo $row['type'] ?></div>
                      <div class="comment" style="background-color: #e53637;">EP <?php echo $row[0] ?></div>
                      <div class="view"> <?php echo $row['status'] ?></div>
                    </div>
                  </a>
                    <div class="product__item__text">
                      <ul>
                        <?php
                        $genrelist = $row['genre'];
                        $gen = explode(",", $genrelist);
                        for ($i = 0; $i < count($gen); $i++) {
                          if ($i > 2)
                            break;
                        ?>
                          <li><a href="viewallq.php?current=genre&q=<?php echo $gen[$i] ?>"><?php echo $gen[$i] ?></a></li>
                        <?php } ?>
                      </ul>
                      <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="live__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Movie</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                  <a href="viewall.php?current=movie" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <?php
              $result = mysqli_query($con, 'SELECT * FROM `movies` WHERE `type` = "Movie" ORDER BY `time` DESC');
              $result = anime($result);
              foreach ($result as $row) {
              ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <a href="anime-details.php?id=<?php echo $row['id'] ?>">
                      <div class="product__item__pic set-bg" data-setbg="<?php echo $row['gambar']; ?>">
                        <div class="ep"><?php echo $row['type'] ?></div>
                        <div class="comment" style="background-color: #e53637;">EP <?php echo $row[0] ?></div>
                        <div class="view"> <?php echo $row['status'] ?></div>
                      </div>
                    </a>
                      <div class="product__item__text">
                        <ul>
                          <?php
                          $genrelist = $row['genre'];
                          $gen = explode(",", $genrelist);
                          for ($i = 0; $i < count($gen); $i++) {
                            if ($i > 2)
                              break;
                          ?>
                            <li><a href="viewallq.php?current=genre&q=<?php echo $gen[$i] ?>"><?php echo $gen[$i] ?></a></li>
                          <?php } ?>
                        </ul>
                        <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                      </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php include "tamplate/sidebar.php" ?>
      </div>
    </div>
  </section>
  <!-- Product Section End -->
  <?php include 'tamplate/footer.php' ?>
  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/player.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>