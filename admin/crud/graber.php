<?php
require "config.php";

$judul = $_POST['judul'];
$eps = $_POST['eps'];

if (isset($_POST['link'])) {
  $anime = getMAL($_POST['link'],$judul);
} else if (isset($_POST['anime'])) {
  $anime = getAnime($_POST['anime'],$judul,$eps);
}

echo json_encode($anime);
?>
