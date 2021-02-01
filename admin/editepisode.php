<?php
session_start();
require 'crud/config.php';

if (isset($_POST['add'])) {
  editepisode($_GET['id'],$_GET['current'],$_GET['pages'],$_GET['q']);
}

$data = getDataEpisode($_GET['id'], '');
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
              <h1>Edit Episode</h1>
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
                <input name="judul" type="text" class="form-control" value="<?php echo $data['judul'] ?>" placeholder="judul" style="font-size: 20px; margin-bottom: 10px;">
                <textarea id="summernote" name="sinopsis" class="form-control"></textarea>
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
                      <label for="Episode">Episode</label>
                      <input name="episode" value="<?php echo $data['episode'] ?>" type="text" class="form-control" placeholder="episode">
                    </div>
                    <div class="form-group">
                      <label for="LInk">Link</label>
                      <input name="link" value="<?php echo $data['link'] ?>" type="text" class="form-control" placeholder="link">
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
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>