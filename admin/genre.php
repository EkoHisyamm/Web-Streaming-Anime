<?php
require 'crud/config.php';
include 'tamplate/header.php';

$limit = 10;

$active = "active";
$pages = 1;
$th = [];
$q = $_GET['q'];

if (isset($_GET['pages'])) {
  $pages = $_GET['pages'];
}

if ($pages == 0){
  header('Location: genre.php');
  die();
}

$sql = mysqli_query($con, 'SELECT * FROM `genre` ORDER BY `nama`');
if(!empty($q)){
  $sql = mysqli_query($con, 'SELECT * FROM `genre` WHERE `nama` LIKE "%'.$q.'%"');
}
array_push($th, 'nama', 'info');

while ($a = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
  $result[] = $a;
}

$lenght = mysqli_num_rows($sql);
$result = limitSql($sql, $pages, $limit);

if(empty($result)){
  $pages = ceil($lenght/$limit);
  if(!empty($q)){
    $pages = $pages.'&q='.$q;
  }
  header('Location: ?pages='.$pages);
}

$arr = selectPage($pages, $lenght, $limit);

if (isset($_POST['add'])) {
  if ($_POST['add'] == "Add") {
    addgenre();
  } else {
    if(!empty($q)){
      $pages = $pages.'&q='.$q;
    }
    editgenre($_POST['id'],$pages);
  }
}
if (isset($_POST['delete'])) {
  deletegenre($_POST['id'],$pages);
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include 'tamplate/navbar.php';
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
          <div class="row">
            <!-- general form elements -->
            <div class="col-md-4" style="margin-bottom: 10px;">
              <form action="" method="POST">
                <h4 class="judul"><strong>Add new genre</strong></h4>
                <label>name</label>
                <input name="id" class="id" type="hidden">
                <input name="name" type="text" class="form-control inputnama" placeholder="name" style=" margin-bottom: 12px;">
                <label>description</label>
                <textarea name="info" type="text" class="form-control inputinfo" placeholder="deskripsi" style="margin-bottom: 10px; height: 100px;"></textarea>
                <input name="add" class="btn btn-danger" type="submit" value="Add">
              </form>
            </div>
            <div class="col-md-8">
              <?php
              ?>
              <div class="card">
                <div class="card-header">
                  <div class="card-tools">
                    <form action="" method="GET">
                      <ul class="pagination pagination-sm float-right pages"></ul>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table" id="test">
                    <thead>
                      <tr>
                        <?php
                        foreach ($th as $a) {
                        ?>
                          <th><?php echo $a ?></th>
                        <?php
                        }
                        ?>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($result as $row) {
                        $imp = implode(",",$row);
                      ?>
                        <tr>
                          <?php
                          foreach ($th as $c) {
                          ?>
                            <td><?php echo $row[$c] ?></td>
                          <?php
                          }
                          ?>
                          <td>
                            <a href="" name="edit" data-id="<?php echo $imp ?>" title='Update Record' data-toggle='modal' class="edit"> <span class='fas fa-edit'></span></a>
                            <a href="#deletemodal" name="delete" data-id="<?php echo $row['id'] ?>" title='Delete Record' data-toggle='modal' class="delete"> <span class='fas fa-trash-alt'></span></a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                      <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="delete">Delete Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="padding: 0;">
                              <form method="post" action="">
                                <input type="hidden" class="id" name="id" id="id" />
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
            </div>
          </div>
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
    var count = <?php echo $lenght ?>;
    var limit = <?php echo $limit ?>;
    if (count > limit) {
      $('.pages').append("<li><a href='?pages=<?php echo limitPage($pages, $lenght, $limit, 'left') ?>'class='page-link'>&laquo;</a></li>");
      $('.pages').append("<li class='page-item <?php echo openPage($pages, $arr[0], $active) ?>'><a href='?pages=<?php echo $arr[0] ?>' class='page-link'><?php echo $arr[0] ?></a></li>");
      $('.pages').append("<li class='page-item <?php echo openPage($pages, $arr[1], $active) ?>'><a href='?pages=<?php echo $arr[1] ?>' class='page-link'><?php echo $arr[1] ?></a></li>");
      if (count > limit * 2) {
        $('.pages').append("<li class='page-item <?php echo openPage($pages, $arr[2], $active) ?>'><a href='?pages=<?php echo $arr[2] ?>' class='page-link'><?php echo $arr[2] ?></a></li>");
      }
      $('.pages').append("<li><a href='?pages=<?php echo limitPage($pages, $lenght, $limit, 'right') ?>'class='page-link'>&raquo;</a></li>");
    }
    $(".delete").click(function() {
      var value = $(this).data("id");
      $(".id").val(value);
    })

    $('.edit').click(function() {
      var id = $(this).data('id');
      id = id.split(",");
      $('.id').val(id[0]);
      $('.inputnama').val(id[1]);
      $('.inputinfo').val(id[2]);
      $('.btn').val("save");
      $('.judul').text("Edit genre");
    })
  })
</script>