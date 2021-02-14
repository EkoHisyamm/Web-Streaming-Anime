<?php
require 'admin/crud/config.php';
include 'tamplate/header.php';
if (isset($_GET['id'])) {
  $id = trim($_GET['id']);
}
$detail = mysqli_query($con, "SELECT * FROM `episode` WHERE `id` = '$id'");
$detail = mysqli_fetch_array($detail);

$result = mysqli_query($con, "SELECT * FROM `movies`");
foreach ($result as $anime) {
  if ($anime['judul'] == $detail['judul']) {
    $detailAnime  = $anime;
    $id_movie     = $anime['id'];
    break;
  }
}

$random   = rand(0, mysqli_num_rows($result) - 5);
$result   = mysqli_query($con, "SELECT * FROM `movies` LIMIT $random,5");
$result   = anime($result);
$listeps  = getEps($detail['judul']);
$comment  = mysqli_query($con, 'SELECT * FROM `comment` WHERE `episode_id` = ' . $id . ' ORDER BY `time` DESC');

lastWatch($id_movie, $detail['id']);
recentWatch($id_movie);
// print_r($_COOKIE['lastWatch']);
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
              <p style="display: none;" id="episode_id"><?php echo $id; ?></p>
              <a style="background-color: unset; padding: 0px;" href="anime-details.php?id=<?php echo $detailAnime['id'] ?>">
                <h5 style=""><?php echo $detail['judul'] . ' episode ' . $detail['episode'] ?></h5>
              </a>
            </div>
          </div>
          <div class="anime__video__player">
            <iframe class="video" width="100%" id="mediaplayer" src="<?php echo $detail['link'] ?>" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" marginwidth="0" marginheight="0" scrolling="NO" frameborder="0"></iframe>
          </div>
          <div class="anime__details__episodes">
            <div class="section-title">
              <h5>Episode</h5>
            </div>
            <div style="overflow:auto; height: auto; max-height: 185px;">
              <?php
              foreach ($listeps as $row) {
              ?>
                <a style="margin-right: 5px; margin-bottom: 10px; font-weight: bold;" class="btn_eps btn <?php echo cekLastWatch($id_movie,$row['id']) ?>" href="anime-watching.php?id= <?php echo $row['id'] ?>"><?php echo $row['episode'] ?></a>
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
                    <a href="anime-details.php?id=<?php echo $row['id'] ?>">
                      <div class="product__item__pic set-bg" data-setbg="<?php echo $row['gambar'] ?>">
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
                          <li><a href="viewallq.php?current=genre&q=<?php echo $gen[$i]; ?>"><?php echo $gen[$i] ?></a></li>
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
          <div class="row">
            <div class="col-lg-8">
            <div class="anime__details__form">
                <div class="section-title">
                  <h5>your comments</h5>
                </div>
                <form action="#">
                  <input id="name" class="form-control" placeholder="Name" value="<?php echo $_COOKIE['name_comment'] ?>" style="margin-bottom: 10px; padding-left: 20px; width: 50%;">
                  <textarea id="msg" style="color: #495057;" placeholder="Comment"></textarea>
                  <button type="button" class="btn_comment float-right"><i class="fa fa-location-arrow"></i> Review</button>
                </form>
              </div>
              <div class="anime__details__review" style="margin-top: 55px;">
                <div class="section-title">
                  <h5>Reviews</h5>
                </div>
                <div id="commentlist">
                  <?php
                  if (count(mysqli_fetch_assoc($comment)) == 0) {
                  ?>
                    <p style="color: white;" class="first_comment">Jadilah yang pertama berkomentar</p>
                    <?php
                  } else {
                    foreach ($comment as $b) {
                    ?>
                      <div class="anime__review__item child">
                        <div class="anime__review__item__text">
                          <h6><?php echo $b['name']; ?> - <span><?php echo timeComment($b['time']) ?></span></h6>
                          <p><?php echo $b['msg']; ?></p>
                        </div>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
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

<script>
  $(document).ready(function() {
    var comment = JSON.parse('<?php echo json_encode($arr) ?>');

    $('.btn_comment').on('click', function(event) {
      var name = $('#name').val();
      var msg = $('#msg').val();
      var id_episode = $('#episode_id').text();

      if (msg != "") {
        if (name == "") {
          name = "Anonim";
        }
        $.ajax({
          url: 'admin/crud/comment.php',
          method: 'POST',
          data: {
            name: name,
            msg: msg,
            ideps: id_episode
          },
          dataType: 'json',
          success: function(data) {
            document.cookie = "name_comment=" + name;
            $('#commentlist').prepend("<div class='anime__review__item'><div class='anime__review__item__text'><h6>" + name + " - <span>1 seconds ago</span></h6><p>" + msg + "</p></div></div>");
            $('#name').val(getCookie('name_comment'));
            $('#msg').val("");
            $('.first_comment').remove();
          }
        });
      }
    });

    function subtractarrays(array1, array2) {
      var difference = [];
      for (var i = 0; i < array1.length; i++) {
        if ($.inArray(array1[i], array2) == -1) {
          difference.push(array1[i]);
        }
      }
      return difference;
    }

    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

  });
</script>