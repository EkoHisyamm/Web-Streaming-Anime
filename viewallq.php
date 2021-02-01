<?php
require 'admin/crud/config.php';
include 'tamplate/header.php';

$current = $_GET['current'];
$pages = 1;
$q = $_GET['q'];
if (isset($_GET['pages'])) {
  $pages = $_GET['pages'];
}

switch (isset($current)) {
  case $current == 'genre':
    $sql = mysqli_query($con, 'SELECT * FROM `movies`');
    $sql = Genre($sql,$_GET['q']);
    $lenght = count($sql);
    $title = $_GET['q'];
    break;
  case $current == 'search':
    $sql = mysqli_query($con, 'SELECT * FROM `movies` WHERE `judul` LIKE "%' . $q . '%"');
    $lenght = mysqli_num_rows($sql);
    $title = 'Search Result: '.$q;
    break;
}
$result = limitSql($sql, $pages, 18);

$arr = selectPage($pages, $lenght, 18);

$genre = mysqli_query($con, 'SELECT `nama` FROM `genre`');
$topview = mysqli_query($con, 'SELECT * FROM `movies` ORDER BY `views` DESC LIMIT 3');
?>

<body>
  <?php include 'tamplate/navbar.php' ?>
  <!-- Product Section Begin -->
  <section class="product-page spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="product__page__content">
            <div class="product__page__title">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6">
                  <div class="section-title">
                    <h4><?php echo $title ?></h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6"></div>
              </div>
            </div>
            <div class="row">
              <?php
              foreach ($result as $row) {
              ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo $row['gambar'] ?>">
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
          <div class="product__pagination pages"></div>
        </div>
        <?php include "tamplate/sidebar.php" ?>
      </div>
    </div>
  </section>
  <?php include "tamplate/footer.php" ?>
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

<script type="text/javascript">
  $(document).ready(function() {
    var count = <?php echo $lenght; ?>;
    if (count > 18) {
      $('.pages').append("<a current=<?php echo $_GET['current'] ?>&pages=<?php echo limitPage($pages, $lenght, 18, 'left') ?>&q=<?php echo $q ?>'><i class='fa fa-angle-double-left'></i></a>");
      $('.pages').append("<a class='<?php echo openPage($pages,$arr[0],"current-page") ?>' href='?current=<?php echo $_GET['current'] ?>&pages=<?php echo $arr[0] ?>&q=<?php echo $q ?>'><?php echo $arr[0] ?></a>");
      $('.pages').append("<a class='<?php echo openPage($pages,$arr[1],"current-page") ?>' href='?current=<?php echo $_GET['current'] ?>&pages=<?php echo $arr[1] ?>&q=<?php echo $q ?>'><?php echo $arr[1] ?></a>");
      if (count > 36) {
        $('.pages').append("<a class='<?php echo openPage($pages,$arr[2],"current-page") ?>' href='?current=<?php echo $_GET['current'] ?>&pages=<?php echo $arr[2] ?>&q=<?php echo $q ?>'><?php echo $arr[2] ?></a>");
      }
      $('.pages').append("<a href='?current=<?php echo $_GET['current'] ?>&pages=<?php echo limitPage($pages,$lenght,18,"right") ?>&q=<?php echo $q ?>'><i class='fa fa-angle-double-right'></i></a>");
    }
  })
</script>