<?php
session_start();
require 'crud/config.php';

if (isset($_POST['add'])) {
  addgenre();
}

if (isset($_POST['delete'])) {
  deletegenre($_POST['id']);
}

if (isset($_GET['search'])) {
  $sql  = 'SELECT * FROM `genre` where judul LIKE "%' . $_GET['search'] . '%"';
} else {
  $sql  = 'SELECT * FROM `genre` WHERE 1';
}

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
              <h1>Genre</h1>
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
              <div class="col-md-4">
                <h4><strong>Add new genre</strong></h4>
                <label>name</label>
                <input class="id" type="hidden">
                <input name="name" type="text" class="form-control inputnama" placeholder="name" style=" margin-bottom: 10px;">
                <label>description</label>
                <textarea name="info" type="text" class="form-control inputinfo" placeholder="deskripsi" style="margin-bottom: 10px; height: 100px;"></textarea>
                <input name="add" class="btn btn-danger" type="submit" value="Add">
              </div>
              <div class="col-md-8">
                <?php
                $result = mysqli_query($con, $sql);
                ?>
                <table class="table" style="text-align: center; background-color: white;">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $row) {
                    ?>
                      <tr>
                        <td class="nama"><?php echo $row['nama'] ?></td>
                        <td class="info"><?php echo $row['info'] ?></td>
                        <td>
                          <a class="edit" name="edit" title='Update Record' data-id="<?php echo $row['id'] ?>" data-toggle='tooltip'><span class='fas fa-edit'></span></a>
                          <a href="#deletemodal" name="delete" data-id="<?php echo $row['id'] ?>" title='Delete Record' data-toggle='modal' class="delete"> <span class='fas fa-trash-alt'></span></a>
                        </td>
                      </tr>
                    <?php } ?>
                    <!-- Modal -->
                    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" style="padding: 0;">
                            <form method="post" action="">
                              <input type="hidden" name="id" class="id" />
                              <div class="card-body">
                                <div class="form-group">
                                  <p for="Confirm">data yang telah dihapus tidak dapat di kembalikan</p>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tbody>
                </table>
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

    $(".delete").click(function() {
      var value = $(this).data("id");
      console.log(value);
      $(".id").val(value);
    })

    $('.edit').on('click', function(event) {
      var id = $(this).data('id');
      $('.id').val(id);
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