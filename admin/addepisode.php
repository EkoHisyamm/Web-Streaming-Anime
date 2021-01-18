<?php
session_start();
require 'crud/config.php';

if (isset($_POST['add'])) {
  addepisode();
}

$id = $_POST['id'];
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
                <input name="judul" type="text" class="form-control" placeholder="judul" style="font-size: 20px; margin-bottom: 10px;">
                <textarea id="summernote" name="sinopsis" class="form-control"></textarea>
                <!-- <div class="card card-default">
                  <div class="card-header">Genre</div>
                  <div class="card-body">
                    <div class="input-group">
                      <input name="" type="text" class="form-control" placeholder="genre">
                      <div class="input-group-append">
                        <button name="submit" class="btn btn-dark" type="submit">add</button>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="col-md-3">
                <div class="card card-default">
                  <div class="card-header">Upload</div>
                  <div class="card-body">
                    <p>Saat anda telah selesai mengedit untuk menyimpanya klik add</p>
                    <input name="add" class="float-right btn btn-danger" type="submit" value="Add">
                  </div>
                </div>
                <div class="card card-default">
                  <div class="card-header">Series Info</div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="Episode">Episode</label>
                      <input name="episode" type="text" class="form-control" placeholder="episode">
                    </div>
                    <div class="form-group">
                      <label for="LInk">Link</label>
                      <input name="link" type="text" class="form-control" placeholder="link">
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
  <!-- /.content-wrapper -->
</body>

<script>
  $(document).ready(function() {
    $('.costumfile').on('change', function(event) {
      var test = event.target.files[0].name;
      $('.filename').text(test);
    })

    $('.btn-preview').on('click', function(event) {
      console.log($('.costumfile')[0].files[0]);
      if ($('.costumfile')[0].files[0]) {
        if ($('.btn-preview').text() == "preview") {
          $('.btn-preview').text("hide");
          $('.preview').attr("src", URL.createObjectURL($('.costumfile')[0].files[0]));
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