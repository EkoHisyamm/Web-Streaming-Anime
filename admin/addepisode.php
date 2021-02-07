<?php
require 'crud/config.php';
include 'tamplate/header.php';

if (isset($_POST['add'])) {
  addepisode();
} else if ($_POST['edit']) {
  editepisode($_GET['id'], $_GET['current'], $_GET['pages'], $_GET['q']);
}
switch (isset($_GET['action'])) {
  case 'edit';
    $action = $_GET['action'];
    $data = getData($_GET['id'], 'episode');
    break;
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include 'tamplate/sidebar.php'
    ?>
    <div class="content-wrapper">
      <!-- Content Wrapper. Contains page content -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Episode</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
              <!-- general form elements -->
              <div class="col-md-9">
                <input type="hidden" class="title" value="<?php echo $data['judul'] ?>">
                <input type="hidden" class="eps" value="<?php echo $data['episode'] ?>">
                <input class="action" type="hidden" value="<?php echo $action ?>">
                <label class="msg float-right"></label>
                <input name="judul" type="text" class="form-control judul" placeholder="judul" value="<?php echo $data['judul'] ?>" style="font-size: 20px; margin-bottom: 10px;">
                <textarea id="summernote" name="sinopsis" class="form-control"></textarea>
              </div>
              <div class="col-md-3">
                <div class="card card-default">
                  <div class="card-header">Series Info</div>
                  <div class="card-body">
                    <div class="form-group">
                      <label class="msg2 float-right"></label>
                      <label for="Episode">Episode</label>
                      <input name="episode" type="text" class="form-control episode" value="<?php echo $data['episode'] ?>" placeholder="episode">
                    </div>
                    <div class="form-group">
                      <label for="Link">Link</label>
                      <input name="link" type="text" class="form-control video" value="<?php echo $data['link'] ?>" placeholder="link">
                    </div>
                  </div>
                </div>
                <div class="card card-default">
                  <div class="card-header">Grabber</div>
                  <div class="card-body">
                    <label>masukan link dari Anime-indo.cc</label>
                    <div class="input-group">
                      <input name="graber" type="text" class="form-control link" placeholder="https://anime-indo.cc/non-non-biyori-nonstop-episode-04/">
                      <div class="input-group-append">
                        <a data-link="" name="grab" class="btn btn-secondary btn-preview grab">grab</a>
                      </div>
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
                <div class="appen" style="display: none;"></div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.content -->
    </div>
    <?php
    include 'tamplate/footer.php'
    ?>

  </div>
  <!-- /.content-wrapper -->
</body>

<script>
  $(document).ready(function() {
    var action = $('.action').val();
    var judul_p = $('.title').val();
    var eps = $('.eps').val();

    $judul = $('.judul');
    $episode = $('.episode');
    $link = $('.video');

    var arr = [
      $judul,
      $episode,
      $link
    ];

    switch ($('.action').val()) {
      case 'edit':
        $('.btn-submit').attr('name', 'edit');
        $('.btn-submit').attr('value', 'edit');
        break;
    }
    $('.costumfile').on('change', function(event) {
      var test = event.target.files[0].name;
      $('.filename').text(test);
    })

    $('.btn-submit').on('click', function(event) {
      $button = $(this);
      var a = 0;
      $.each(arr, function(index, value) {
        if (arr[index].val() == "") {
          console.log(value);
          a += 1;
        };
      });
      if (a == 0 && $('.msg').text() == "" && $('.msg2').text() == "") {
        $('.btn-submit').attr('type', 'submit');
      } else {
        $('.warning').text('isi semua data dan pastikan series tersedia dan belum ada');
      }
    })

    $('.judul').on('blur', function(event) {
      $msg = $('.msg');
      $.ajax({
        url: "crud/chek.php",
        method: "POST",
        data: {
          title: $judul.val(),
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          if (data) {
            $judul.attr('style', 'border-color: red; margin-bottom: 10px; font-size: 20px;');
            $msg.text('tambah series dahulu');
          } else {
            $judul.removeAttr('style');
            $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
            $msg.text('');
          }
        }
      });
    })

    $('.episode').on('blur', function(event) {
      $judul = $('.judul');
      $episode = $('.episode');
      $msg = $('.msg2');
      $.ajax({
        url: "crud/chek.php",
        method: "POST",
        data: {
          title: $judul.val(),
          episode: $episode.val(),
          eps: eps
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          if (!data.episode) {
            $episode.attr('style', 'border-color: red; margin-bottom: 10px;');
            $msg.text('episode ini sudah ada');
          } else {
            $episode.removeAttr('style');
            $episode.attr('style', 'margin-bottom: 10px;');
            $msg.text('');
          }
        }
      });
    })

    $('.grab').on('click', function(event) {
      $.ajax({
        url: "crud/graber.php",
        method: "POST",
        data: {
          anime: $('.link').val(),
        },
        dataType: "json",
        success: function(data) {
          $judul.val(data.judul);
          $episode.val(data.episode);
          $('.appen').append(data.anime);
          var a = $('.appen').children().toArray();
          var gen = "";
          $.each(a, function(key, value) {
            var video = value.text;
            var data = value.getAttribute('data-video');
            switch (video) {
              case 'YUP HD':
                gen = data;
                gen = gen.split('=');
                gen = gen[1];
                break;
              case 'YUP':
                gen = data;
                gen = gen.split('=');
                gen = gen[1];
                break;
              default:
                gen = data;
                break;
            }
          });
          $link.val(gen);
          if (data.cekjudul) {
            $('.msg').text('tambah series dahulu');
            $judul.attr('style', 'border-color: red; margin-bottom:10px; font-size: 20px;');
          } else {
            $judul.removeAttr('style');
            $judul.attr('style', 'font-size: 20px; margin-bottom: 10px;');
            $('.msg').text('');
          }

          if (!data.cekepisode) {
            $('.msg2').text('episode ini sudah ada');
            $('.episode').attr('style', 'border-color: red;');
          } else {
            $('.msg2').text('');
            $episode.removeAttr('style');
            $episode.attr('style', 'margin-bottom: 10px;');
          }
        }
      });
    });

    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>