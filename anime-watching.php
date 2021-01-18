<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';
if (isset($_GET['id'])) {
  $id = trim($_GET['id']);
}
$detail = mysqli_query($con, "SELECT * FROM `movies` WHERE `id` = '$id'");
$detail = mysqli_fetch_array($detail);
$row = explode('-', $_GET['id']);
?>
<body>
  <?php include 'tamplate/navbar.php'; ?>
  <!-- Anime Section Begin -->
  <section class="anime-details spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="anime__details__episodes">
            <div class="section-title">
              <h5 style="font-size: 30px;"><?php echo $detail['judul'] . ' episode ' . $row[1] ?></h5>
            </div>
          </div>
          <div class="anime__video__player">
              <iframe width="1080" height="600" frameborder="0" src="https://femax20.com/v/p8gjrsme6j57e34" allowfullscreen=""></iframe>
          </div>
          <div class="anime__details__episodes">
            <div class="section-title">
              <h5>Episode</h5>
            </div>
            <div style="overflow:auto; height: 185px;">
              <?php
              for ($a = 0; $a < (int)$detail['episode']; $a++) {
              ?>
                <a href="anime-watching.php?id= <?php echo $detail['id'].'-'.($a+1);?>"><?php echo $a + 1 ?></a>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="anime__details__review">
            <div class="section-title">
              <h5>Reviews</h5>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-1.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                  "demons" LOL</p>
              </div>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-2.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                <p>Finally it came out ages ago</p>
              </div>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-3.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                <p>Where is the episode 15 ? Slow update! Tch</p>
              </div>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-4.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                  "demons" LOL</p>
              </div>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-5.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                <p>Finally it came out ages ago</p>
              </div>
            </div>
            <div class="anime__review__item">
              <div class="anime__review__item__pic">
                <img src="img/anime/review-6.jpg" alt="">
              </div>
              <div class="anime__review__item__text">
                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                <p>Where is the episode 15 ? Slow update! Tch</p>
              </div>
            </div>
          </div>
          <div class="anime__details__form">
            <div class="section-title">
              <h5>Your Comment</h5>
            </div>
            <form action="#">
              <textarea placeholder="Your Comment"></textarea>
              <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Anime Section End -->
  <!-- Footer Section Begin -->
  <footer class="footer">
    <div class="page-up">
      <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="footer__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="footer__nav">
            <ul>
              <li class="active"><a href="./index.html">Homepage</a></li>
              <li><a href="./categories.html">Categories</a></li>
              <li><a href="./blog.html">Our Blog</a></li>
              <li><a href="#">Contacts</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>

        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->
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