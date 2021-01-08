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
        include "tamplate/sidebar.php"
        ?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid" style="margin-top: 10px;">
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="Durasi">Durasi</label>
                                            <input name="durasi" type="text" class="form-control" placeholder="durasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="custom-select rounded-0">
                                                <option>Onoing</option>
                                                <option>Complated</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Type">Type</label>
                                            <select name="type" class="custom-select rounded-0">
                                                <option>TV</option>
                                                <option>BD</option>
                                                <option>Movie</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Episode">Jumlah Episode</label>
                                            <input name="episode" type="text" class="form-control" placeholder="episode">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" type="text" style="height: 250px;" class="form-control" placeholder="Sinopsis"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Cover">
                                        <Cap>Cover</Cap>
                                    </label>
                                    <div class="custom-file">
                                        <input name="file" type="file" class="custom-file-input costumfile">
                                        <label class="custom-file-label filename" for="cover">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="submit" type="submit" class="btn btn-primary float-right">Upload</button>
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

<script>
    $(document).ready(function() {
        $('.costumfile').on('change', function(event) {
            console.log(event.target.files[0].name);
            var test = event.target.files[0].name;
            $('.filename').text(test);
        })
    })
</script>