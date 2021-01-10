<?php
require "crud/config.php";

$judul = $status = $studio = $rilis = $rate = $genre = $sinopsis = $type = $episode = $durasi;
$gambar;

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $result = mysqli_query($con, "SELECT * FROM `movies` WHERE `id` = '".$id."'");
    $row = mysqli_fetch_array($result);
    deleteimg($row['gambar']); 

    $judul = $_POST['judul'];
    $status = $_POST['status'];
    $studio = $_POST['studio'];
    $rilis = $_POST['rilis'];
    $rate = $_POST['rate'];
    $genre = $_POST['genre'];
    $sinopsis = $_POST['sinopsis'];
    $type = $_POST['type'];
    $episode = $_POST['episode'];
    $durasi = $_POST['durasi'];
    if($_FILES['file']['size']==0 && $_FILES['file']['error']==4){
        $gambar = $row['gambar'];
    }else{
        $gambar = upload();
    }

    $sql = "UPDATE movies SET judul=?, status=?, studio=?, rilis=?, rate=?, genre=?, sinopsis=?, type=?, episode=?, durasi=?, gambar=? WHERE id=?";

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssssssi", $pram_name, $pram_status, $pram_studio, $pram_rilis, $pram_rate, $pram_genre, $pram_sinopsis, $pram_type, $pram_episode, $pram_durasi, $pram_gambar, $pram_id);

        $pram_name = $judul;
        $pram_status = $status;
        $pram_studio = $studio;
        $pram_rilis = $rilis;
        $pram_rate = $rate;
        $pram_genre = $genre;
        $pram_sinopsis = $sinopsis;
        $pram_type = $type;
        $pram_episode = $episode;
        $pram_durasi = $durasi;
        $pram_gambar = $gambar;
        $pram_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to landing page
            header("location: listmovie.php");
            exit();
        }
    }
} else {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = trim($_GET['id']);

        $sql = "SELECT * FROM movies WHERE id = ?";
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $pram_id);

            $pram_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $judul = $row['judul'];
                    $status = $row['status'];
                    $studio = $row['studio'];
                    $rilis = $row['rilis'];
                    $rate = $row['rate'];
                    $genre = $row['genre'];
                    $sinopsis = $row['sinopsis'];
                    $type = $row['type'];
                    $episode = $row['episode'];
                    $durasi = $row['durasi'];
                    $gambar = $row['gambar'];
                }
            }
        }
    }
}

$sql = "SELECT * FROM `movies` where `id` ='".$id."'";
?>

<?php
include 'tamplate/header.php'
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include 'tamplate/sidebar.php'
        ?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid" style="margin-top: 10px;">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Movie</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="" enctype='multipart/form-data'>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Judul">Judul</label>
                                    <input name="judul" type="text" class="form-control" value="<?php echo $judul; ?>" placeholder="judul">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Durasi">Durasi</label>
                                    <input name="durasi" type="text" class="form-control" value="<?php echo $durasi; ?>" placeholder="durasi">
                                </div>
                                <div class="form-group">
                                    <label >Type</label>
                                    <select name="type" class="custom-select rounded-0">
                                        <option>BD</option>
                                        <option <?php check($type,"TV"); ?>>TV</option>
                                        <option <?php check($type,"Movie"); ?>>Movie</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Episode">Episode</label>
                                    <input name="episode" type="text" class="form-control" value="<?php echo $episode; ?>" placeholder="episode">
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <select name="status" class="custom-select rounded-0">
                                        <option >Ongoing</option>
                                        <option <?php check($status,"Complated"); ?>>Complated</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Studio">Studio</label>
                                    <input name="studio" type="text" class="form-control" value="<?php echo $studio; ?>" placeholder="studio">
                                </div>
                                <div class="form-group">
                                    <label for="Rilis Date">Rilis Date</label>
                                    <input name="rilis" type="text" class="form-control" value="<?php echo $rilis; ?>" placeholder="rilis">
                                </div>
                                <div class="form-group">
                                    <label for="Rate">Rate</label>
                                    <input name="rate" type="text" class="form-control" value="<?php echo $rate; ?>" placeholder="rate">
                                </div>
                                <div class="form-group">
                                    <label for="Genre">Genre</label>
                                    <input name="genre" type="text" class="form-control" value="<?php echo $genre; ?>" placeholder="genre">
                                </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="Sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" type="text" style="height: 250px;" class="form-control" placeholder="Sinopsis"><?php echo $sinopsis; ?></textarea>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>" />

                                <div class="form-group">
                                    <label for="Cover">
                                        <Cap>Cover</Cap>
                                    </label>
                                    <div class="custom-file">
                                        <input name="file" type="file" class="custom-file-input costumfile">
                                        <label class="custom-file-label filename" for="cover"><?php echo $gambar ?></label>
                                    </div>
                                    <!-- <img style="width: -moz-available; margin-top: 10px;" src="upload/" /> -->
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
        include 'tamplate/footer.php'
        ?>
    </div> 
        <!-- /.content-wrapper -->
</body>

<script>
    $(document).ready(function() {
        $('.costumfile').on('change',function(event) {
            console.log(event.target.files[0].name);
            var test = event.target.files[0].name;
            $('.filename').text(test);
        })
    })
</script>