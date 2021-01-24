<?php
require 'crud/config.php';
session_start();

if (!isset($_SESSION['LOGIN']) || $_SESSION['LOGIN'] !== true) {
  header('Location: index.php');
  exit;
}

if (isset($_POST['delete'])) {
  deletepisode($_POST['id']);
}

$lenght = mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `episode`'));
$search = $_GET['search'];

switch (isset($_GET)) {
  case ($_GET['page1']):
    $arr = selectPage($_GET['page1'], $lenght);
    $current = $_GET['page1'];
    if (!empty($search)) {
      $result = mysqli_query(
        $con,
        'SELECT * FROM episode
      WHERE `judul` LIKE "%' . $search . '%"
      ORDER BY judul ASC
      LIMIT 12'
      );
      $lenght = mysqli_num_rows(mysqli_query($con, 'SELECT * FROM episode WHERE `judul` LIKE "%' . $search . '%"'));
    }
    $arr = selectPage($_GET['page1'], $lenght);
    break;
  default:
    $arr = selectPage(1, $lenght);
    $current = 1;
    if (!empty($search)) {
      $result = mysqli_query(
        $con,
        'SELECT * FROM episode
      WHERE `judul` LIKE "%' . $search . '%"
      ORDER BY judul ASC
      LIMIT 12'
      );
      $lenght = mysqli_num_rows(mysqli_query($con, 'SELECT * FROM episode WHERE `judul` LIKE "%' . $search . '%"'));
    }
    break;
}

if (isset($_GET['search']) && !empty($search)) {
  $sql = 
  'SELECT * FROM episode
  WHERE `judul` LIKE "%' . $search . '%"
  ORDER BY `judul` ASC
  LIMIT ?,?';
  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii",$pram_limit, $pram_offset);

    $pram_limit = (($current * 12) - 12);
    $pram_offset = 12;

    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
    }
  }
} else {
  $sql = "SELECT * FROM `episode` LIMIT ?,?";
  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii", $pram_limit, $pram_offset);

    $pram_limit = (($current * 12) - 12);
    $pram_offset = 12;

    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
    }
  }
}
include 'tamplate/header.php'
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include 'tamplate/navbar.php';
    include 'tamplate/sidebar.php';
    ?>
    <div class="content-wrapper">
      <section class="content" style="margin-top: 10px;">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <form action="" method="GET">
                <ul class="pagination pagination-sm float-right pages">
                  <li class="page-item"><input name="search" type="hidden" value="<?php echo $_GET['search'] ?>"></a></li>
                  <li class="page-item"><input name="left" type="submit" class="page-link left" value="&laquo;"></a></li>
                  <li class="page-item"><input name="page1" type="submit" class="page-link page1" value="<?php echo $arr[0]; ?>"></li>
                </ul>
              </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table" id="test">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Episode</th>
                  <th style="width: 50px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $row) {
                ?>
                  <tr>
                    <td><?php echo $row['judul'] ?></td>
                    <td><?php echo $row['episode'] ?></td>
                    <td>
                      <a href="editepisode.php?id=<?php echo $row['id'] . '-' . $current ?>" name="edit" title='Update Record' data-toggle='tooltip'><span class='fas fa-edit'></span></a>
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
      </section>
    </div>
    <?php
    include 'tamplate/footer.php'
    ?>
  </div>
  <!-- /.content-wrapper -->
</body>
<script type="text/javascript">
  $(document).ready(function() {
    var count = <?php echo $lenght; ?>;
    if (count > 12) {
      $('.pages').append("<li class='page-item'><input name='page1' type='submit' class='page-link' value='<?php echo $arr[1]; ?>'></li>");
      if (count > 24) {
        $('.pages').append("<li class='page-item'><input name='page1' type='submit' class='page-link page3' value='<?php echo $arr[2]; ?>'></li>");
      }
      $('.pages').append("<li class='page-item'><input name='right' type='submit' class='page-link right' value='&raquo;'></li>");
    }
    $(".left").click(function() {
      $('.page1').attr("type", "hidden");
    })
    $(".right").click(function() {
      $('.page3').attr("type", "hidden");
    })
    $(".delete").click(function() {
      var value = $(this).data("id");
      $(".id").val(value);
    })
    $(".deletemodal").click(function() {
      $("#deletemodal").modal('hide');
    })
  })
</script>