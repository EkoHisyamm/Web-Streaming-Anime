<?php
require 'config.php';

$name     = $_POST['name'];
$msg      = $_POST['msg'];
$id_eps   = $_POST['ideps'];

$commentList = comment($name,$msg,$id_eps);

echo json_encode($commentList);
?>