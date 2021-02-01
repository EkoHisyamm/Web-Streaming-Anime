<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';
if (isset($_GET['id'])) {
  $id = trim($_GET['id']);
}
$detail = mysqli_query($con, "SELECT * FROM `episode` WHERE `id` = '$id'");
$detail = mysqli_fetch_array($detail);
$result = mysqli_query($con, "SELECT * FROM `movies` LIMIT 5");
$row = explode('-', $_GET['id']);
$listeps = getEps($detail['judul']);
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
              <h5 style=""><?php echo $detail['judul'] . ' episode ' . $detail['episode'] ?></h5>
            </div>
          </div>
          <div class="anime__video__player">
            <iframe class="video" width="100%" src="https://shirodrive.my.id/stream/74897624" frameborder="0" scrolling="no" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <div class="anime__details__episodes">
            <div class="section-title">
              <h5>List Name</h5>
            </div>
            <div style="overflow:auto; height: auto; max-height: 185px;">
              <?php
              foreach($listeps as $row){
              ?>
                <a style="margin-right: 5px; margin-bottom: 10px;" href="anime-watching.php?id= <?php echo $row['id']?>"><?php echo $row['episode'] ?></a>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="trending__product">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                  <h4>Rekomendasi</h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4"></div>
            </div>
            <div class="row">
              <?php
              foreach ($result as $row) {
              ?>
                <div class="col-lg-4 col-md-6 col-sm-6 rekomend">
                  <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="https://i.pinimg.com/originals/7b/17/2a/7b172aa8bf04c1bcbd3ad919457a86f2.jpg">
                      <div class="ep"><?php echo $row['type'] ?></div>
                      <div class="view"> <?php echo $row['status'] ?></div>
                    </div>
                    <div class="product__item__text">
                      <ul>
                        <?php
                        $genrelist = $row['genre'];
                        $gen = explode(",", $genrelist);
                        for ($i = 0; $i < count($gen); $i++) {
                          if ($i > 2)
                            break;
                        ?>
                          <li><a href="viewallq.php?current=genre&q=<?php echo $gen[$i];?>"><?php echo $gen[$i] ?></a></li>
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
      </div>
    </div>
  </section>
  <!-- Anime Section End -->
  <!-- Footer Section Begin -->
  <?php include "tamplate/footer.php" ?>

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