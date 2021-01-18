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

if (isset($_GET['search'])) {
  $sql = 'SELECT * FROM `episode` where judul LIKE "%' . $_GET['search'] . '%"';
} else {
  $sql = 'SELECT * FROM `episode` WHERE 1';
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
        <?php
        $result = mysqli_query($con, $sql);
        ?>
        <table class="table" style="text-align: center; background-color: white;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Judul</th>
              <th scope="col">Episode</th>
              <th scope="col">Link</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($result as $row) {
            ?>
              <tr>
                <td><?php echo $row['judul'] ?></td>
                <td><?php echo $row['episode'] ?></td>
                <td><?php echo $row['link'] ?></td>
                <td>
                  <a href="editepisode.php?id=<?php echo $row['id'] ?>" name="edit" title='Update Record' data-toggle='tooltip'><span class='fas fa-edit'></span></a>
                  <a href="#deletemodal" name="delete" data-id="<?php echo $row['episode'] ?>" title='Delete Record' data-toggle='modal' class="delete"> <span class='fas fa-trash-alt'></span></a>
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
                      <input type="hidden" name="id" class="id"/>
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
    $(".delete").click(function() {
      var value = $(this).data("id");
      console.log(value);
      $(".id").val(value);
    })
  })
</script>