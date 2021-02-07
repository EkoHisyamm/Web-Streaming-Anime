<?php
    require "config.php";

    $view = $_POST['view'] + 1;
    $judul = $_POST['judul'];

    $sql = mysqli_query($con,'UPDATE `movies` SET `views` = "'.$view.'" WHERE `judul` = "'.$judul.'"');

    echo json_encode($_POST['judul']);
?>