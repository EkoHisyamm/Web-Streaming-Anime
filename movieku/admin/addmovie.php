<?php
session_start();
require "crud/config.php";

if (isset($_POST['submit'])) {
    addmovie();
}

$id = $_POST['id'];
?>

<?php
include "tamplate/header.php"
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include "tamplate/navbar.php"
        ?>
        <?php
        include "tamplate/sidebar.php"
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Movie</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Movie</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Judul">Judul</label>
                                    <input name="judul" type="text" class="form-control" placeholder="judul">
                                </div>
                                <div class="form-group">
                                    <label for="Durasi">Durasi</label>
                                    <input name="durasi" type="text" class="form-control" placeholder="durasi">
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <input name="status" type="text" class="form-control" placeholder="status">
                                </div>
                                <div class="form-group">
                                    <label for="Type">Type</label>
                                    <input name="type" type="text" class="form-control" placeholder="type">
                                </div>
                                <div class="form-group">
                                    <label for="Episode">Episode</label>
                                    <input name="episode" type="text" class="form-control" placeholder="episode">
                                </div>
                                <div class="form-group">
                                    <label for="Studio">Studio</label>
                                    <input name="studio" type="text" class="form-control" placeholder="studio">
                                </div>
                                <div class="form-group">
                                    <label for="Rilis Date">Rilis Date</label>
                                    <input name="rilis" type="text" class="form-control" placeholder="rilis">
                                </div>
                                <div class="form-group">
                                    <label for="Rate">Rate</label>
                                    <input name="rate" type="text" class="form-control" placeholder="rate">
                                </div>
                                <div class="form-group">
                                    <label for="Genre">Genre</label>
                                    <input name="genre" type="text" class="form-control" placeholder="genre">
                                </div>
                                <div class="form-group">
                                    <label for="Sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" type="text" class="form-control" placeholder="Sinopsis"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Cover">
                                        <Cap>Cover</Cap>
                                    </label>
                                    <div class="custom-file">
                                        <input name="file" type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="cover">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Upload</button>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <?php
        include "tamplate/footer.php"
        ?>
        <!-- /.content-wrapper -->
</body>
