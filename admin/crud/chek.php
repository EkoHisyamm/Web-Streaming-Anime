<?php
require "config.php";
if (isset($_POST['title'])) {
    $result = checkJudul($_POST['title'],$_POST['judul']);
    if (isset($_POST['episode'])) {
        $result = array(
            'judul'   => checkJudul($_POST['title'],$_POST['judul']),
            'episode' => checkEpisode($_POST['title'], $_POST['episode'],$_POST['eps'])
        );
    }
}
echo json_encode($result);
