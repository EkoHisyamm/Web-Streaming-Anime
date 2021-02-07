<?php
require 'crud/config.php';
include 'tamplate/header.php';

$limit = 12;

$action = "listmovieq.php";
$current = $_GET['current'];
$active = "active";
$pages = 1;
$th = [];

if (isset($_GET['pages'])) {
  $pages = $_GET['pages'];
}

switch ($current) {
  case 'movie':
    $sql = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`,
    `rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM `movies` ORDER BY `id` DESC');
    array_push($th, 'judul', '', 'durasi', 'rate','rilis','type','studio','status');
    break;
  case 'episode':
    $sql = mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` ORDER BY `id` DESC');
    array_push($th, 'judul', 'episode');
    break;
}
while ($a = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
  $result[] = $a;
}

$lenght = mysqli_num_rows($sql);
$result = limitSql($sql, $pages, $limit);

if(empty($result)){
  $pages = ceil($lenght/$limit);
  header('Location: ?current='.$current.'&pages='.$pages);
}

$arr = selectPage($pages, $lenght, $limit);

if (isset($_POST['delete'])) {
  delete($_POST['id'], $current, $pages,$current);
}
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
              <ul class="pages pagination pagination-sm float-right"></ul>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table" id="test">
              <thead>
                <tr>
                  <?php
                  $i = 0;
                  foreach ($th as $a) {
                    $i++;
                    if($i > 2)
                    {
                      $hidden = 'hidden';
                    }
                  ?>
                    <th class="<?php echo $hidden ?>"><?php echo $a ?></th>
                  <?php
                  }
                  ?>
                  <th style="width: 50px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($result as $row) {
                ?>
                  <tr>
                    <?php
                    $i = 0;
                    foreach ($th as $c) {
                      $i++;
                      $hidden = "";
                      if($i > 2)
                      {
                        $hidden = 'hidden';
                      }
                    ?>
                      <td class="<?php echo $hidden ?>"><?php echo $row[$c] ?></td>
                    <?php
                    }
                    ?>
                    <td>
                      <a href="add<?php echo $current ?>.php?id=<?php echo $row['id'] . '&current=' . $current . '&pages=' . $pages .'&action=edit' ?>" name="edit" title='Update Record' data-toggle='tooltip'><span class='fas fa-edit'></span></a>
                      <a href="#deletemodal" name="delete" data-id="<?php echo $row['id']; ?>" title='Delete Record' data-toggle='modal' class="delete"> <span class='fas fa-trash-alt'></span></a>
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
</body>
<script type="text/javascript">
  $(document).ready(function() {
    var count = <?php echo $lenght ?>;
    var limit = <?php echo $limit ?>;
    if (count > limit) {
      $('.pages').append("<li><a href='?current=<?php echo $current ?>&pages=<?php echo limitPage($pages, $lenght, $limit, 'left') ?>'class='page-link'>&laquo;</a></li>");
      $('.pages').append("<li class='page-item <?php echo openPage($pages,$arr[0],$active) ?>'><a href='?current=<?php echo $current ?>&pages=<?php echo $arr[0] ?>' class='page-link'><?php echo $arr[0] ?></a></li>");
      $('.pages').append("<li class='page-item <?php echo openPage($pages,$arr[1],$active) ?>'><a href='?current=<?php echo $current ?>&pages=<?php echo $arr[1] ?>' class='page-link'><?php echo $arr[1] ?></a></li>");
      if (count > limit * 2) {
        $('.pages').append("<li class='page-item <?php echo openPage($pages,$arr[2],$active) ?>'><a href='?current=<?php echo $current ?>&pages=<?php echo $arr[2] ?>' class='page-link'><?php echo $arr[2] ?></a></li>");
      }
      $('.pages').append("<li><a href='?current=<?php echo $current ?>&pages=<?php echo limitPage($pages, $lenght, $limit, 'right') ?>'class='page-link'>&raquo;</a></li>");
    }
    $(".delete").click(function() {
      var value = $(this).data("id");
      $(".id").val(value);
    })
  });
</script>