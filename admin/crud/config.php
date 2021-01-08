<?php
session_start();
$con = mysqli_connect("localhost", "root", "a", "db_movieku");

// Check connection
if (!$con) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

function login()
{
    global $con;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where name = '$username'";

    $json["hasil"] = array();
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);


    if (empty($username)) {
        header("Location: index.php?username=username tidak boleh kosong ");
    }else if(empty($password)){
        header("Location: index.php?password=password tidak boleh kosong");
    }
    else if ($count > 0) {
        if($password == $row['password']){
            $_SESSION["LOGIN"] = true;
            $_SESSION["USERNAME"] = $username;
            $_SESSION["PASSWORD"] = $username;
            header("Location: listmovie.php");
        }else{
            header("Location: index.php?password=password salah");
        }
    } else {
        header("Location: index.php?username=username salah");
    }
}

function addmovie()
{
    global $con;

    $judul = $_POST['judul'];
    $type = $_POST['type'];
    $episode = $_POST['episode'];
    $genre = $_POST['genre'];
    $durasi = $_POST['durasi'];
    $rate = $_POST['rate'];
    $rilis = $_POST['rilis'];
    $sinopsis = $_POST['sinopsis'];
    $studio = $_POST['studio'];
    $status = $_POST['status'];
    $gambar = upload();

    $sql = "INSERT INTO movies ( gambar,judul, sinopsis, status, studio, rilis, rate, genre, durasi, type, episode) 
    VALUES ('$gambar','$judul','$sinopsis','$status','$studio','$rilis','$rate','$genre','$durasi', '$type', '$episode')";

    if (mysqli_query($con, $sql)) {
        header("Location: listmovie.php");
    } else {
        header("Location: addmovie.php");
    }
}

function deletemovie($id)
{
    global $con;

    $id = $_POST['id'];

    $sql = mysqli_query($con, "DELETE FROM `movies` WHERE id = '$id'");

    if ($sql) {
        header(header("Location: listmovie.php"));
    } else {
        die("gagal hapus");
    }
}

function upload()
{
    if (isset($_FILES['file'])) {
        $namaFile = $_FILES['file']['name'];
        $namaFile = str_replace(' ','-',$namaFile);
        $ukuranFile = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];

        $fileExtension = explode('.', $namaFile);
        $fileExtension = strtolower(end($fileExtension));
        $extention_arr = array("jpg", "png", "jpeg", "gif");

        if ($ukuranFile > 2100000) {
            echo "<script>alert('Ukuran gambar terlalu besar!')</script>";
            return false;
        } else if (in_array($fileExtension, $extention_arr)) {
            move_uploaded_file($tmpName, 'upload/' . $namaFile);
            return $namaFile;
        }
        return false;
    }

}

function deleteimg($nameimg){

    global $con;
    $path = "upload/". $nameimg;

    $cek = false;
    $sql = mysqli_query($con, "SELECT * FROM movies");
    while($row = mysqli_fetch_array($sql)){
        if($nameimg == $row['gambar']){
            $cek = true;
        }
    }
    if($cek == false){
    if(!unlink($path)){
        echo "<script>alert('gambar tidak ditemukan')</script>";
    }
}
}

function check($a,$b){
    if($a == $b){
        echo 'selected';
    }
}

?>