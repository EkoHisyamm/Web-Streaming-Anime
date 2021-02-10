<?php
require 'config.php';

$name = $_POST['name'];
$msg  = $_POST['msg'];
$id   = $_POST['id'];

$commentList = comment($name,$msg,$id);

echo json_encode($commentList);
?>