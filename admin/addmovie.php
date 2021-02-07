<?php
require 'crud/config.php';
include 'tamplate/header.php';

if (isset($_POST['add'])) {
  addmovie();
} else if ($_POST['edit']) {
  editmovie($_GET['id'], $_GET['current'], $_GET['pages'], $_GET['q']);
}
switch (isset($_GET['action'])) {
  case 'edit';
    $action = $_GET['action'];
    $data = getData($_GET['id'], 'movies');
    break;
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include 'tamplate/sidebar.php';
    ?>
    <div class="content-wrapper">
      <!-- Content Wrapper. Contains page content -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 style="margin-bottom: -20px;">Add New Series</h1>
            </div>
          </div>
        </div>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="row">
              <!-- general form elements -->
              <div class="col-md-9">
                <input type="hidden" class="title" value="<?php echo $data['judul'] ?>">
                <input type="hidden" class="action" value="<?php echo $action ?>">
                <label class="msg float-right"></label>
                <input name="judul" type="text" class="form-control judul" placeholder="judul" value="<?php echo $data['judul'] ?>" style="font-size: 20px; margin-bottom: 10px;">
                <textarea id="summernote" name="sinopsis" class="form-control sinopsis"><?php echo $data['sinopsis'] ?></textarea>
                <div class="card card-default">
                  <div class="card-header">Cover</div>
                  <div class="card-body">
                    <label>Gambar by link</label>
                    <div class="input-group">
                      <input name="gambar" type="text" class="form-control cover-link" value="<?php echo $data['gambar'] ?>">
                      <div class="input-group-append">
                        <a data-link="" name="grab" class="btn btn-secondary btn-preview-link">preview</a>
                      </div>
                      <img class="preview-link" style="min-width: 100%;">
                    </div>
                  </div>
                </div>
                <div class="card card-default">
                  <div class="card-header">Grabber</div>
                  <div class="card-body">
                    <label>masukan link dari Myanimelist</label>
                    <div class="input-group">
                      <input name="graber" type="text" class="form-control link" placeholder="https://myanimelist.net/anime/16498/Shingeki_no_Kyojin">
                      <div class="input-group-append">
                        <a data-link="" name="grab" class="btn btn-secondary btn-preview grab">grab</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-default">
                  <div class="card-header">Series Info</div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="Durasi">Durasi</label>
                      <input name="durasi" type="text" class="form-control durasi" value="<?php echo $data['durasi'] ?>" placeholder="durasi">
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <input name="status" class="form-control  status rounded-0" value="<?php echo $data['status'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="Type">Type</label>
                      <select name="type" class="custom-select type rounded-0">
                        <option>TV</option>
                        <option <?php check($data['type'], "BD"); ?>>BD</option>
                        <option <?php check($data['type'], "Movie"); ?>>Movie</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Episode">Jumlah Episode</label>
                      <input name="episode" type="text" class="form-control episode" value="<?php echo $data['episode'] ?>" placeholder="episode">
                    </div>
                    <div class="form-group">
                      <label for="Studio">Studio</label>
                      <input name="studio" type="text" class="form-control studio" value="<?php echo $data['studio'] ?>" placeholder="studio">
                    </div>
                    <div class="form-group">
                      <label for="Rilis Date">Rilis Date</label>
                      <input name="rilis" type="text" class="form-control rilis" value="<?php echo $data['rilis'] ?>" placeholder="rilis">
                    </div>
                    <div class="form-group">
                      <label for="Rate">Rate</label>
                      <input name="rate" type="text" class="form-control score" value="<?php echo $data['rate'] ?>" placeholder="rate">
                    </div>
                    <div class="form-group">
                      <label for="Genre">Genre</label>
                      <input name="genre" type="text" class="form-control genre" value="<?php echo $data['genre'] ?>" placeholder="genre">
                    </div>
                    <div class="form-group appen" style="display: none;">
                    </div>
                  </div>
                </div>
                <div class="card card-default">
                  <div class="card-header">Upload</div>
                  <div class="card-body">
                    <p>Saat anda telah selesai mengedit untuk menyimpanya klik add</p>
                    <p style="color: red;" class="warning"></p>
                    <input name="add" class="float-right btn btn-danger btn-submit" type="button" value="Add">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.content -->
    </div>
    <?php
    include 'tamplate/footer.php';
    ?>
  </div>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function() {
    var action = $('.action').val();
    var judul_p = $('.title').val();  
    
    $judul = $('.judul');
    $episode = $('.episode');
    $durasi = $('.durasi');
    $status = $('.status');
    $type = $('.type');
    $studio = $('.studio');
    $rilis = $('.rilis');
    $score = $('.score');
    $sinopsis = $('.sinopsis');
    $cover = $('.cover-link');
    $genre = $('.genre');

    var arr = [
      $judul,
      $episode,
      $durasi,
      $status,
      $type,
      $studio,
      $rilis,
      $genre,
      $score,
      $sinopsis,
      $cover,
    ];

    switch ($('.action').val()) {
      case 'edit':
        $('.btn-submit').attr('name', 'edit');
        $('.btn-submit').attr('value', 'edit');
        break;
    }

    $('.btn-submit').on('click', function(event) {
      $button = $(this);
      $form = $('.form');
      $form = $form.children().children().text();
      var a = 0;
      $.each(arr, function(index, value) {
        if (arr[index].val() == "") {
          a += 1;
        };
      });
      if (a == 0 && $('.msg').text() == "") {
        $('.btn-submit').attr('type', 'submit');
      } else {
        $('.warning').text('isi semua data dan pastikan data belum ada');
      }
    })

    $('.judul').on('blur', function(event) {
      $judul = $(this);
      $msg = $('.msg');
      $btn = $('.btn-submit');

      $.ajax({
        url: "crud/chek.php",
        method: "POST",
        data: {
          title: $judul.val(),
          judul: judul_p
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          if (!data) {
            $judul.attr('style', 'border-color: red; margin-bottom: 10px; font-size: 20px;');
            $msg.text('anime ini sudah ada');
          } else {
            $judul.removeAttr('style');
            $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
            $msg.text('');
          }
        }
      });
    })

    $('.btn-preview-link').on('click', function(event) {
      var cover = $('.cover-link').val();
      if ($('.cover-link').val() != "") {
        if ($('.btn-preview-link').text() == "preview") {
          $('.btn-preview-link').text("hide");
          $('.preview-link').attr("src", cover);
        } else {
          $('.btn-preview-link').text("preview");
          $('.preview-link').removeAttr("src");
        }
      }
    })
    $('.grab').on('click', function(event) {
      $link = $('.link').val();
      $.ajax({
        url: "crud/graber.php",
        method: "POST",
        data: {
          link: $link,
          judul: judul_p
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $a = data;
          $judul.val(data.judul);
          $episode.val(data.episode);
          $durasi.val(data.durasi);
          $status.val(data.status);
          $type.val(data.tipe);
          $studio.val(data.studio);
          $rilis.val(data.rilis);
          $score.val(data.score);
          $('.note-editable').text(data.sinopsis);
          $sinopsis.text(data.sinopsis);
          $cover.val(data.gambar);
          $('.appen').append(data.genre);
          var a = $('.appen').children().toArray();
          var gen = [];
          $.each(a, function(key, value) {
            var genre = value.getAttribute('title');
            if (genre != null) {
              gen.push(genre);
            }
          });
          var genre = "";
          $.each(gen, function(key, value) {
            genre += value + ",";
          });
          genre = genre.substr(0, genre.length - 1);
          $genre.val(genre);
          if (!data.cek) {
            $('.judul').attr('style', 'border-color: red; margin-bottom: 10px;');
            $('.msg').text('anime ini sudah ada');
          }
          else {
            $judul.removeAttr('style');
            $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
            $msg.text('');
          }
        }
      });
    })
    // Summernote
    $('#summernote').summernote();

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    })
  });
</script>