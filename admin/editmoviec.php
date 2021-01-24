<?php
session_start();
require 'crud/config.php';
if (isset($_POST['add'])) {
  editmovie($_GET['id']);
}
$data = getData($_GET['id'], 'movies');
include 'tamplate/header.php'
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
              <h1>Add New Series</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
              <input type="hidden" name="id" value="15">
              <!-- general form elements -->
              <div class="col-md-9">
                <input name="judul" type="text" class="form-control" placeholder="judul" value="<?php echo $data['judul'] ?>" style="font-size: 20px; margin-bottom: 10px;">
                <textarea id="summernote" name="sinopsis" class="form-control"><?php echo $data['sinopsis'] ?></textarea>
                <div class="card card-default">
                  <div class="card-header">Cover</div>
                  <div class="card-body">
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input costumfile">
                        <input style="width: 100%;" class="custom-file-label filename" name="filename" for="cover" value="<?php echo $data['gambar'] ?>">
                      </div>
                      <div class="input-group-append">
                        <a name="submit" class="btn btn-secondary btn-preview">preview</a>
                      </div>
                      <img class="preview" style="min-width: 100%;">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-default">
                  <div class="card-header">Upload</div>
                  <div class="card-body">
                    <p>Saat anda telah selesai mengedit untuk menyimpanya klik save</p>
                    <input name="add" class="float-right btn btn-danger" type="submit" value="save">
                  </div>
                </div>
                <div class="card card-default">
                  <div class="card-header">Series Info</div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="Durasi">Durasi</label>
                      <input name="durasi" type="text" class="form-control" value="<?php echo $data['durasi'] ?>" placeholder="durasi">
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" class="custom-select rounded-0">
                        <option>Ongoing</option>
                        <option <?php check($data['status'], "Complated"); ?>>Complated</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Type">Type</label>
                      <select name="type" class="custom-select rounded-0">
                        <option>TV</option>
                        <option <?php check($data['type'], "BD"); ?>>BD</option>
                        <option <?php check($data['type'], "Movie"); ?>>Movie</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Episode">Jumlah Episode</label>
                      <input name="episode" type="number" class="form-control" value="<?php echo $data['episode'] ?>" placeholder="episode">
                    </div>
                    <div class="form-group">
                      <label for="Studio">Studio</label>
                      <input name="studio" type="text" class="form-control" value="<?php echo $data['studio'] ?>" placeholder="studio">
                    </div>
                    <div class="form-group">
                      <label for="Rilis Date">Rilis Date</label>
                      <input name="rilis" type="text" class="form-control" value="<?php echo $data['rilis'] ?>" placeholder="rilis">
                    </div>
                    <div class="form-group">
                      <label for="Rate">Rate</label>
                      <input name="rate" type="text" class="form-control" value="<?php echo $data['rate'] ?>" placeholder="rate">
                    </div>
                    <div class="form-group">
                      <label for="Genre">Genre</label>
                      <input name="genre" type="text" class="form-control" value="<?php echo $data['genre'] ?>" placeholder="genre">
                    </div>
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
    include 'tamplate/footer.php'
    ?>
  </div>
</body>
<script>
  $(document).ready(function() {
    $('.costumfile').on('change', function(event) {
      var test = event.target.files[0].name;
      $('.filename').val(test);
      if ($('.btn-preview').text() == "hide") {
        $('.preview').attr("src", URL.createObjectURL($(this)[0].files[0]));
      }
    })
    $('.btn-preview').on('click', function(event) {
      if ($('.costumfile')[0].files[0]) {
        if ($('.btn-preview').text() == "preview") {
          $('.btn-preview').text("hide");
          $('.preview').attr("src", URL.createObjectURL($('.costumfile')[0].files[0]));
        } else {
          $('.btn-preview').text("preview");
          $('.preview').removeAttr("src");
        }
      } else if ($('.filename').val() != "") {
        if ($('.btn-preview').text() == "preview") {
          var a = 'upload/' + $('.filename').val();
          $('.preview').attr("src", a);
          var a = $('.preview');
          $('.btn-preview').text("hide");
        } else {
          $('.btn-preview').text("preview");
          $('.preview').removeAttr("src");
        }
      }
    })
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>