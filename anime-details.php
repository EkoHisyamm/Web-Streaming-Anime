<?php
require 'admin/crud/config.php';

include 'tamplate/header.php';

if (isset($_GET['id'])) {
  $id   = trim($_GET['id']);
}
$detail = mysqli_query($con, "SELECT * FROM `movies` WHERE `id` = '$id'");
$arr    = mysqli_fetch_array($detail);
$result = getEps($arr['judul']);
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
            $bookmark = checkBookmark($_COOKIE['bookmark'],$row['id']);
          ?>
            <p class="id" style="display: none;"><?php echo $row['id'] ?></p>
            <div class="col-lg-3">
              <div class="anime__details__pic set-bg" data-setbg="<?php echo $row['gambar'] ?>"></div>
              <div class="anime__details__btn" style="margin-top: 10px; width: 100%;">
                <button id="bookmark" class="follow-btn" style="width: 100%; text-align: center; border: unset;"><i id="icon_bookmark" class="<?php echo $bookmark ?> fa-bookmark"></i> Bookmark</button>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="anime__details__text">
                <div class="anime__details__title">
                  <h3 class="judul"><?php echo $row['judul'] ?></h3>
                  <span><?php echo $row['judul'] ?></span>
                  <p class="views" style="display: none;"><?php echo $row['views'] ?></p>
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
                  <div class="anime__details__episodes">
                    <div class="section-title">
                      <h5>Genre</h5>
                    </div>
                    <div>
                      <?php
                      $genrelist = $row['genre'];
                      $genre = explode(",", $genrelist);
                      for ($i = 0; $i < count($genre); $i++) {
                      ?>
                        <a href="viewallq.php?current=genre&q=<?php echo $genre[$i]; ?>" style="margin-right: 5px; margin-bottom: 5px; padding: 5px 15px; font-size: 11px;" class="btn btn-dark"><?php echo $genre[$i] ?></a>
                      <?php
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="anime__details__episodes">
                  <div class="section-title">
                    <h5>Episode</h5>
                  </div>
                  <div style="overflow:auto; height: auto; max-height: 185px;">
                    <?php
                    foreach ($result as $b) {
                    ?>
                      <a style="margin-right: 5px; margin-bottom: 10px; font-weight: bold;" class="btn_eps btn <?php echo cekLastWatch($id,$b['id']) ?>" href="anime-watching.php?id=<?php echo $b['id']; ?>"><?php echo $b['episode'] ?></a>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <?php }
      ?>
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

<script type="text/javascript">
  $(document).ready(function() {
    var icon = $('#icon_bookmark');
    // document.cookie = "bookmark=";
    var cookie = getCookie('bookmark');
    var id = $('.id').text();
    if (cookie == id) {
      icon.attr('class', 'fas fa-bookmark');
    }

    $(".btn_eps").click(function() {
      $judul = $(".judul").text();
      $view = $(".views").text();
      $.ajax({
        url: "admin/crud/views.php",
        method: "POST",
        data: {
          view: $view,
          judul: $judul,
        },
        dataType: "json",
        success: function(data) { 
          // console.log(data);
          // document.cookie = "recent=" + "teststst";
        }
      });
    })

    $('#bookmark').click(function() {
      if (icon.attr('class') == 'far fa-bookmark') {
        icon.attr('class', 'fas fa-bookmark');
        var a = cookie.split(',');
        b = checkBookmark(id, a);
        if (b == false) {
          document.cookie = "bookmark=" + cookie + id + ",";
          if(cookie == ""){
          document.cookie = "bookmark=" + id + ",";
          console.log('masuk');
          }
        }
      } else {
        icon.attr('class', 'far fa-bookmark');
        document.cookie = "bookmark=" + cookie.replace(id + ',','');
      }
      console.log(b);
      console.log(cookie);
    });

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

    function checkBookmark(id, listbookmark) {
      var a = false;
      console.log(listbookmark);
      $.each(listbookmark, function(key, value) {
        if (id == value) {
          a = true;
        }
      })
      return a;
    }
  });
</script>