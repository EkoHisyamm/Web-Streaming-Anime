<?php
require "crud/config.php";

$judul = $status = $studio = $rilis = $rate = $genre = $sinopsis = $type = $episode = $durasi;
$gambar;

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $result = mysqli_query($con, "SELECT * FROM movies WHERE id = '$id'");
    $row = mysqli_fetch_array($result);
    deleteimg($row['gambar']); 

    $judul = $_POST["judul"];
    $status = $_POST["status"];
    $studio = $_POST["studio"];
    $rilis = $_POST["rilis"];
    $rate = $_POST["rate"];
    $genre = $_POST["genre"];
    $sinopsis = $_POST["sinopsis"];
    $type = $_POST["type"];
    $episode = $_POST["episode"];
    $durasi = $_POST["durasi"];
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
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM movies WHERE id = ?";
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $pram_id);

            $pram_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $judul = $row["judul"];
                    $status = $row["status"];
                    $studio = $row["studio"];
                    $rilis = $row["rilis"];
                    $rate = $row["rate"];
                    $genre = $row["genre"];
                    $sinopsis = $row["sinopsis"];
                    $type = $row["type"];
                    $episode = $row["episode"];
                    $durasi = $row["durasi"];
                    $gambar = $row['gambar'];
                }
            }
        }
    }
}

$sql = "SELECT * FROM movies where id ='$id'";
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
                            <h1>Edit Movie</h1>
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
                        <form method="post" action="" enctype='multipart/form-data'>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Judul">Judul</label>
                                    <input name="judul" type="text" class="form-control" value="<?php echo $judul; ?>" placeholder="judul">
                                </div>
                                <div class="form-group">
                                    <label for="Durasi">Durasi</label>
                                    <input name="durasi" type="text" class="form-control" value="<?php echo $durasi; ?>" placeholder="durasi">
                                </div>
                                <div class="form-group">
                                    <label for="Type">Type</label>
                                    <input name="type" type="text" class="form-control" value="<?php echo $type; ?>" placeholder="type">
                                </div>
                                <div class="form-group">
                                    <label for="Episode">Episode</label>
                                    <input name="episode" type="text" class="form-control" value="<?php echo $episode; ?>" placeholder="episode">
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <input name="status" type="text" class="form-control" value="<?php echo $status; ?>" placeholder="status">
                                </div>
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
                                <div class="form-group">
                                    <label for="Sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" type="text" class="form-control" placeholder="Sinopsis"><?php echo $sinopsis; ?></textarea>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>" />


                                <div class="form-group">
                                    <label for="Cover">
                                        <Cap>Cover</Cap>
                                    </label>
                                    <input type="file" name="file" />
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