<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';
if (isset($_GET['id'])) {
  $id = trim($_GET['id']);
}
$detail = mysqli_query($con, "SELECT * FROM `movies` WHERE `id` = '$id'");
?>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <?php include 'tamplate/navbar.php'; ?>
  <!-- Anime Section Begin -->
  <section class="anime-details spad">
    <div class="container">
      <div class="anime__details__content">
        <div class="row">
          <?php
          foreach ($detail as $row) {
          ?>
            <div class="col-lg-3">
              <div class="anime__details__pic set-bg" data-setbg="admin/upload/<?php echo $row['gambar'] ?>">
              </div>
            </div>
            <div class="col-lg-9">
              <div class="anime__details__text">
                <div class="anime__details__title">
                  <h3><?php echo $row['judul'] ?></h3>
                  <span><?php echo $row['judul'] ?></span>
                </div>
                <p><?php echo $row['sinopsis'] ?></p>
                <div class="anime__details__widget">
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <ul>
                        <li><span>Type:</span> <?php echo $row['type'] ?></li>
                        <li><span>Studios:</span> <?php echo $row['studio'] ?></li>
                        <li><span>Date aired:</span><?php echo $row['rilis'] ?></li>
                        <li><span>Status:</span> <?php echo $row['status'] ?></li>
                        <li><span>Rating:</span><?php echo $row['rate'] ?></li>
                      </ul>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <ul>
                        <li><span>Duration:</span> <?php echo $row['durasi'] ?></li>
                        <li><span>Jumlah Episode:</span><?php echo $row['episode'] ?></li>
                      </ul>
                    </div>
                  </div>
                  <div>
                    <?php
                    $genrelist = $row['genre'];
                    $genre = explode(",", $genrelist);
                    for ($i = 0; $i < count($genre); $i++) {
                    ?>
                      <a style="color: white; margin-bottom: 5px;  scale: 90%;" class="btn btn-dark"><?php echo $genre[$i] ?></a>
                    <?php
                    } ?>
                  </div>
                </div>
                <div class="anime__details__episodes">
                  <div class="section-title">
                    <h5>Episode</h5>
                  </div>
                  <div style="overflow:auto; height: 185px;">
                    <?php
                    foreach ($detail as $arr) {
                      for ($a = 0; $a < (int)$arr['episode']; $a++) {
                        $b = $arr['id'] . '-' . ($a + 1);
                    ?>
                        <a href="anime-watching.php?id=<?php echo $b; ?>"><?php echo $a + 1 ?></a>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Anime Section End -->
  <?php include 'tamplate/footer.php'; ?>
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