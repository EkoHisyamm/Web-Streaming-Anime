<?php
session_start();
$con = mysqli_connect("localhost", "root", "a", "db_movieku");

// Check connection
if (!$con) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
 
if ($_POST['test']) {
$myarr = array(
  'stack'=>'overflow',
  'key'=>'value'
);
exit();  // getMAL("");
}

function login()
{
  global $con;
  $username = addslashes($_POST['username']);
  $password = addslashes($_POST['password']);

  $sql = 'SELECT `name`, `password` FROM `users` WHERE `name` = "' . $username . '"';

  $result = mysqli_query($con, $sql);
  $count  = mysqli_num_rows($result);
  $row    = mysqli_fetch_array($result);

  if (empty($username)) {
    header('Location: index.php?username=username tidak boleh kosong');
  } else if (empty($password)) {
    header('Location: index.php?password=password tidak boleh kosong');
  } else if ($count > 0) {
    if ($password == $row['password']) {
      $_SESSION['LOGIN']      = true;
      $_SESSION['USERNAME']   = $username;
      $_SESSION['PASSWORD']   = $username;
      header('Location: listmovie.php?current=movie');
    } else {
      header('Location: index.php?password=password salah');
    }
  } else {
    header('Location: index.php?username=username salah');
  }
}

function addmovie()
{
  global $con;
  $judul      = $_POST['judul'];
  $type       = $_POST['type'];
  $episode    = $_POST['episode'];
  $genre      = $_POST['genre'];
  $durasi     = $_POST['durasi'];
  $rate       = $_POST['rate'];
  $rilis      = $_POST['rilis'];
  $sinopsis   = $_POST['sinopsis'];
  $studio     = $_POST['studio'];
  $status     = $_POST['status'];
  $views      = 1;
  $gambar     = upload();
  $gambar     = $_POST['gambar'];
  $sql = 'INSERT INTO `movies` ( `judul`, `gambar`, `sinopsis`, `status`, `studio`, `rilis`, `rate`, `genre`, `durasi`, `type`, `episode`, `views`) 
                              VALUES ( "' . $judul . '", "' . $gambar . '", "' . $sinopsis . '", "' . $status . '", "' . $studio . '", "' . $rilis . '", "' . $rate . '",  "' . $genre . '", "' . $durasi . '", "' . $type . '",' . $episode . ', ' . $views . ')';
  if (mysqli_query($con, $sql)) {
    header('Location: listmovie.php?current=movie');
  }
}

function addepisode()
{
  global $con;
  $judul    = $_POST['judul'];
  $episode  = $_POST['episode'];
  $link     = $_POST['link'];
  $sql      = 'INSERT INTO `episode` (`judul`,`episode`, `link`) 
                                 VALUES ("' . $judul . '", "' . $episode . '", "' . $link . '")';
  if (mysqli_query($con, $sql)) {
    header('Location: listmovie.php?current=episode');
  } else {
    header('Location: addmovie.php');
  }
}

function addgenre()
{
  global $con;
  $name = ucfirst($_POST['name']);
  $info = ucfirst($_POST['info']);
  $sql  = 'INSERT INTO `genre` (`nama`,`info`) 
                                 VALUES ("' . $name . '", "' . $info . '")';
  if (mysqli_query($con, $sql)) {
    header('Location: genre.php');
  } else {
    header('Location: ');
  }
}


function editmovie($id, $current, $pages, $q = "")
{
  global $con;
  $judul    = $_POST['judul'];
  $type     = $_POST['type'];
  $episode  = $_POST['episode'];
  $genre    = $_POST['genre'];
  $durasi   = $_POST['durasi'];
  $rate     = $_POST['rate'];
  $rilis    = $_POST['rilis'];
  $sinopsis = $_POST['sinopsis'];
  $studio   = $_POST['studio'];
  $status   = $_POST['status'];
  $gambar   = $_POST['filename'];
  if ($_FILES['file']['size'] != 0 && $_FILES['file']['error'] != 4) {
    $gambar = upload();
  }
  $sql = "UPDATE `movies` SET `judul`='" . $judul . "', `status`='" . $status . "', `studio`='" . $studio . "', `rilis`='" . $rilis . "', `rate`='" . $rate . "', `genre`='" . $genre . "', `sinopsis`='" . $sinopsis . "', `type`='" . $type . "', `episode`='$episode', `durasi`='" . $durasi . "', `gambar`='" . $gambar . "' WHERE `id`='$id' ";
  if (mysqli_query($con, $sql)) {
    if (!empty($q)) {
      header('Location: listmovieq.php?current=' . $current . '&pages=' . $pages . '&q=' . $q);
    } else {
      header('Location: listmovie?current=' . $current . '&pages=' . $pages);
    }
  } else {
    header('Location: editmoviec.php');
  }
}

function editepisode($id, $current, $pages, $q = "")
{
  global $con;
  $a = explode("-", $id);
  $id = $a[0];
  $judul    = $_POST['judul'];
  $link     = $_POST['link'];
  $episode  = $_POST['episode'];

  $sql = "UPDATE `episode` SET `judul`='" . $judul . "', `episode`='" . $episode . "',`link`='" . $link . "' WHERE `id` = '" . $id . "' ";
  if (mysqli_query($con, $sql)) {
    if (!empty($q)) {
      header('Location: listmovieq.php?current=' . $current . '&pages=' . $pages . '&q=' . $q);
    } else {
      header('Location: listmovie.php?current=' . $current . '&pages=' . $pages);
    }
  } else {
    header('Location: editepisode.php');
  }
}

function editgenre($id)
{
  global $con;
  $nama    = ucfirst($_POST['name']);
  $info    = $_POST['info'];

  $sql = "UPDATE `genre` SET `nama`='" . $nama . "', `info`='" . $info . "'  WHERE `id` = '" . $id . "' ";
  if (mysqli_query($con, $sql)) {
    header('Location: ');
  } else {
    header('Location: ');
  }
}

function deletemovie($id, $current, $pages)
{
  global $con;
  $sql = mysqli_query($con, 'DELETE FROM `movies` WHERE `id` = "' . $id . '"');
  if ($sql) {
    header(header('Location: '));
  } else {
    die('gagal hapus');
  }
}

function delete($id, $current, $pages, $type)
{
  global $con;
  if ($type == 'episode') {
    $sql = mysqli_query($con, 'DELETE FROM `episode` WHERE `id` = "' . $id . '"');
  } else {
    $sql = mysqli_query($con, 'DELETE FROM `movies` WHERE `id` = "' . $id . '"');
  }
  if ($sql) {
    header(header('Location: '));
  } else {
    die('gagal hapus');
  }
}

function deletepisode($id, $current, $pages)
{
  global $con;
  $sql = mysqli_query($con, 'DELETE FROM `episode` WHERE `id` = "' . $id . '"');
  if ($sql) {
    header(header('Location: listmoviee.php?current=' . $current . '&pages=' . $pages));
  } else {
    die('gagal hapus');
  }
}

function deletegenre($id)
{
  global $con;
  $sql = mysqli_query($con, 'DELETE FROM `genre` WHERE `id` = "' . $id . '"');
  if ($sql) {
    header('Location: ');
  } else {
    die('gagal hapus');
  }
}

function upload()
{
  if (isset($_FILES['file'])) {
    $namaFile   = $_FILES['file']['name'];
    $namaFile   = str_replace(' ', '-', $namaFile);
    $ukuranFile = $_FILES['file']['size'];
    $tmpName    = $_FILES['file']['tmp_name'];

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

function deleteimg($nameimg)
{

  global $con;
  $path = "upload/" . $nameimg;
  $cek  = false;
  $sql  = mysqli_query($con, 'SELECT * FROM movies WHERE 1');
  while ($row = mysqli_fetch_array($sql)) {
    if ($nameimg == $row['gambar']) {
      $cek = true;
    }
  }
  if ($cek == false) {
    if (!unlink($path)) {
      echo "<script>alert('gambar tidak ditemukan')</script>";
    }
  }
}

function check($a, $b)
{
  if ($a == $b) {
    echo 'selected';
  }
}

function nameimg($name)
{
  $name = str_replace(' ', '-', $name);
  return $name;
}

function getData($id, $table)
{
  global $con;
  $result = mysqli_query($con, 'SELECT * FROM `movies` WHERE `id` = "' . $id . '"');
  return mysqli_fetch_array($result);
}

function getDataEpisode($id, $table)
{
  global $con;
  $result = mysqli_query($con, 'SELECT * FROM `episode` WHERE `id` = "' . $id . '"');
  return mysqli_fetch_array($result);
}

function getDataGenre($id, $table)
{
  global $con;
  $result = mysqli_query($con, 'SELECT * FROM `genre` WHERE `id` = "' . $id . '"');
  return mysqli_fetch_array($result);
}

function selectPage($number, $countquery, $limit)
{
  $arr = array();
  switch ($number) {
    case 1:
      array_push($arr, $number++, $number++, $number);
      return $arr;
      break;
    case $number == ceil($countquery / $limit):
      if ($number == 2) {
        array_push($arr, ($number - 1), $number);
      } else {
        array_push($arr, ($number - 2), ($number - 1), $number);
      }
      return $arr;
      break;
    default:
      array_push($arr, ($number - 1), $number, ($number + 1));
      return $arr;
      break;
  }
}

function limitSql($arr, $min, $max)
{
  $result = [];
  $i = 0;
  $min = ($min * $max) - $max + 1;
  foreach ($arr as $row) {
    $i++;
    if ($i >= $min && $i <= (($min + $max) - 1)) {
      array_push($result, $row);
    } else if ($i > $min + $max) {
      break;
    }
  }
  return $result;
}

function limitPage($page, $countquery, $limit, $key)
{
  if ($key == "right") {
    if ($page == ceil($countquery / $limit)) {
      return $page;
    }
    return $page + 1;
  }
  if ($page == 1) {
    return $page;
  }
  return $page - 1;
}

function Genre($query, $key)
{
  $arr = [];
  foreach ($query as $row) {
    $gen = explode(",", $row['genre']);
    foreach ($gen as $q) {
      if (trim($key) == trim($q)) {
        array_push($arr, $row);
      }
    }
  }
  return $arr;
}

function openPage($page, $now, $current)
{
  if ($page == $now)
    return $current;
}

function getEps($judul)
{
  global $con;
  $sql = 'SELECT * FROM `episode` WHERE `judul` = "' . $judul . '"';
  $sql = mysqli_query($con, $sql);
  return $sql;
}

function getStringBetween($string, $start, $end)
{
  $string = " " . $string;
  $ini = strpos($string, $start);
  if ($ini == 0) return "";
  $ini += strlen($start);
  $len = strpos($string, $end, $ini) - $ini;
  return substr($string, $ini, $len);
}

function getMAL($link)
{
  print_r($_REQUEST['test']);
  if (isset($link)) {
    return $_REQUEST['test'];
  }
  return $_REQUEST['test'];
  $link = file_get_contents($link);
  $judul = getStringBetween($link, 'English:</span>', '</div>');
  $episode = getStringBetween($link, 'Episodes:</span>', '</div>');
  $durasi = getStringBetween($link, 'Duration:</span>', '</div>');
  $status = getStringBetween($link, 'Status:</span>', '</div>');
  $tipe = getStringBetween($link, 'Type:</span>', '</div>');
  $tipe = getStringBetween($tipe, '>', '</a>');
  $studio = getStringBetween($link, 'Studios:</span>', '</div>');
  $studio = getStringBetween($studio, '>', '</a>');
  $rilis = getStringBetween($link, 'Aired:</span>', '</div>');
  $genre = getStringBetween($link, 'Genres:</span>', '</div>');
  $score = getStringBetween($link, 'score-label', '</div>');
  $score = getStringBetween($score, '>', '<');
  $sinopsis = getStringBetween($link, 'description">', '[Written by MAL Rewrite]');
  $gambar = getStringBetween($link, 'class="lazyload" data-src="', '"');

  $arr = array(
    "judul" => $judul,
    "episode" => $episode,
    "durasi" => $durasi,
    "status" => $status,
    "tipe" => $tipe,
    "studio" => $studio,
    "rilis" => $rilis,
    "genre" => $genre,
    "score" => $score,
    "sinopsis" => $sinopsis,
    "gambar" => $gambar
  );
  // die();
  return $arr;
}
