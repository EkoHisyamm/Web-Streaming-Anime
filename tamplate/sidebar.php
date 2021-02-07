<div class="col-lg-4 col-md-6 col-sm-8">
  <div class="product__sidebar">
    <div class="product__sidebar__view">
      <div class="section-title">
        <h5>Top Views</h5>
      </div>
      <?php
      $topview = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`,
      `rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM `movies` ORDER BY `views` DESC LIMIT 3');
      $a = 0;
      if (mysqli_num_rows($topview)) {
        foreach ($topview as $row) {
          if ($a >= 3) {
            break;
          }
          $a++;
      ?>
          <a href="anime-details.php?id=<?php echo $row['id'] ?>">
            <div class="filter__gallery set-bg" data-setbg="<?php echo $row['gambar']; ?>">
              <div class="product__sidebar__view__item set-bg mix day years" data-setbg="img/transparant.png" style="border-radius: 0;">
                <h5><a href="anime-details.php?id=<?php echo $row['id'] ?>"><?php echo $row['judul'] ?></a></h5>
                <div class="ep"><?php echo $row['type'] ?></div>
                <div class="view"> <?php echo $row['status'] ?></div>
              </div>
            </div>
          </a>
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
        $genre = mysqli_query($con, 'SELECT `nama` FROM `genre` ORDER BY `nama`');
        foreach ($genre as $data) {
        ?>
          <a href="viewallq.php?current=genre&q=<?php echo $data['nama']; ?>" class="btn" style="color: white; margin-bottom: 5px; text-align: left;"><?php echo $data['nama'] ?></a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>