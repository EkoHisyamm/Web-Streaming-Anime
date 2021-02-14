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
  $date       = date('Y-m-d H:i:s');
  $gambar     = $_POST['gambar'];
  $sql = 'INSERT INTO `movies` ( `judul`, `gambar`, `sinopsis`, `status`, `studio`, `rilis`, `rate`, `genre`, `durasi`, `type`, `episode`, `views`, `time`) 
                              VALUES ( "' . $judul . '", "' . $gambar . '", "' . $sinopsis . '", "' . $status . '", "' . $studio . '", "' . $rilis . '", "' . $rate . '",  "' . $genre . '", "' . $durasi . '", "' . $type . '","' . $episode . '", ' . $views . ',"' . $date . '")';
  if (mysqli_query($con, $sql)) {
    header('Location: listmovie.php?current=movie');
  } else {
    header('Location: ?');
  }
}

function checkJudul($judul, $judul_p)
{
  global $con;
  if ($judul != $judul_p) {
    if (mysqli_num_rows(mysqli_query($con, 'SELECT `judul`FROM `movies` WHERE `judul` = "' . $judul . '"')) > 0) {
      return false;
    }
  }
  return true;
}

function addepisode()
{
  global $con;
  $judul    = $_POST['judul'];
  $episode  = $_POST['episode'];
  $link     = $_POST['link'];
  $date     = date('Y-m-d H:i:s');
  $sql      = 'INSERT INTO `episode` (`judul`,`episode`, `link`) 
                                 VALUES ("' . $judul . '", "' . $episode . '", "' . $link . '")';
  mysqli_query($con, 'UPDATE `movies` SET `time` = "' . $date . '" WHERE `judul` = "' . $judul . '"');
  if (mysqli_query($con, $sql)) {
    header('Location: listmovie.php?current=episode');
  } else {
    header('Location: ');
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
  $gambar   = $_POST['gambar'];

  $sql = mysqli_query($con, 'UPDATE `movies` SET
`judul`     = "' . $judul . '",
`gambar`    = "' . $gambar . '",
`episode`   = "' . $episode . '",
`status`    = "' . $status . '",
`studio`    = "' . $studio . '",
`rilis`     = "' . $rilis . '",
`rate`      = "' . $rate . '",
`genre`     = "' . $genre . '",
`durasi`    = "' . $durasi . '",
`type`      = "' . $type . '",
`sinopsis`  = "' . $sinopsis . '"
 WHERE `id` = "' . $id . '"');
  if ($sql) {
    if (!empty($q)) {
      header('Location: listmovieq.php?current=' . $current . '&pages=' . $pages . '&q=' . $q);
    } else {
      header('Location: listmovie.php?current=' . $current . '&pages=' . $pages);
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

function delete($id, $type)
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
  $sql  = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`,
  `rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM movies WHERE 1');
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
  $result = mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` WHERE `id` = "' . $id . '"');
  if ($table == 'movies') {
    $result = mysqli_query($con, 'SELECT `durasi`,`episode`,`gambar`,`genre`,`id`,`judul`,`rate`,
    `rilis`, `sinopsis`, `status`, `studio`,`type`,`views`,`time` FROM `movies` WHERE `id` = "' . $id . '"');
  }
  return mysqli_fetch_array($result);
}

function getDataEpisode($id, $table)
{
  global $con;
  $result = mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` WHERE `id` = "' . $id . '"');
  return mysqli_fetch_array($result);
}

function getDataGenre($id, $table)
{
  global $con;
  $result = mysqli_query($con, 'SELECT `nama`, `info`,`id` FROM `genre` WHERE `id` = "' . $id . '"');
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
        break;
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

function checkEpisode($judul, $episode, $eps)
{
  global $con;
  if ($episode != $eps) {
    if (mysqli_num_rows(mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` WHERE `judul` = "' . $judul . '" AND `episode` = "' . $episode . '"')) > 0) {
      return false;
    }
  }
  return true;
}

function getEps($judul)
{
  global $con;
  $sql = 'SELECT `judul`,`id`,`episode`,`link` FROM `episode` WHERE `judul` = "' . $judul . '" ORDER BY `episode` ASC';
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

function getAnime($link, $judul_p, $eps)
{
  $link = file_get_contents($link);
  $title = getStringBetween($link, 'class="title">', '</h1>');
  $title = explode("Episode", $title);
  $judul = trim($title[0]);
  $episode = substr_replace($title[1], "", strlen($title[1]) - strlen('Subtitle Indonesia'));
  $anime = getStringBetween($link, '<div class="servers">', '</div>');

  $cekjudul = checkJudul(trim($judul), $judul_p);
  $cekepisode = checkEpisode(trim($judul), trim($episode), $eps);

  $arr = array(
    "judul" => trim($judul),
    "episode" => trim($episode),
    "anime" => trim($anime),
    "cekjudul" => $cekjudul,
    "cekepisode" => $cekepisode
  );
  return $arr;
}

function getMAL($link, $judul_p)
{
  $link = file_get_contents($link);
  $judul = getStringBetween($link, 'h1_bold_none"><strong>', '</strong>');
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
  $sinopsis = getStringBetween($link, 'description">', '</p>');
  $gambar = getStringBetween($link, 'class="lazyload" data-src="', '"');
  $sinopsis = str_replace('&quot;', ' ', $sinopsis);

  $judul = trim($judul);
  $cek = checkJudul($judul, $judul_p);
  $sinopsis = str_replace('[Written by MAL Rewrite]', "", $sinopsis);
  if (trim($episode) == "") {
    $episode = 0;
  }

  $arr = array(
    "judul" => $judul,
    "episode" => trim($episode),
    "durasi" => trim($durasi),
    "status" => trim($status),
    "tipe" => trim($tipe),
    "studio" => trim($studio),
    "rilis" => trim($rilis),
    "genre" => trim($genre),
    "score" => trim($score),
    "sinopsis" => trim($sinopsis),
    "gambar" => trim($gambar),
    "cek" => $cek
  );
  return $arr;
}

function anime($anime)
{
  global $con;
  $arr = [];
  $episode = mysqli_query($con, 'SELECT `judul`,`id`,`episode`,`link` FROM `episode`');
  foreach ($anime as $a) {
    $d = 0;
    foreach ($episode as $b) {
      if ($a['judul'] == $b['judul']) {
        $d += 1;
      }
    }
    array_push($a, $d);
    array_push($arr, $a);
  }
  return $arr;
}

function shortAnime($arr)
{
  for ($a = 0; $a < count($arr); $a++) {
    if ($arr[$a][1] > $arr[0][1]) {
      $b = $arr[0];
      $arr[0] = $arr[$a];
      $arr[$a] = $b;
    }
  }
  return $arr;
}

function allanime($key, $sql)
{
  $e = 0;
  foreach ($key as $a) {
    $e++;
    foreach ($sql as $b) {
      if (substr($b['judul'], 0, 1) == $a) {
        $d[$a][] = $a;
        array_push($d[$a], $b);
      }
    }
  }
  return $d;
}


function comment($nama, $msg, $id_eps)
{
  global $con;

  $sql        = mysqli_query($con, 'INSERT INTO `comment` (`name`,`msg`,`episode_id`)
                            VALUES ("' . $nama . '","' . $msg . '",' . $id_eps . ')');
  if ($sql) {
    return true;
  }
  return false;
}

function checkBookmark($listBookmark, $id)
{
  $listBookmark = explode(',', $listBookmark);
  foreach ($listBookmark as $a) {
    if ($a == $id) {
      return 'fas';
    }
  }
  return 'far';
}

function viewBookmark($dataAnime, $listBookmark)
{
  $listBookmark = explode(',', $listBookmark);
  $a = [];
  foreach ($dataAnime as $b) {
    foreach ($listBookmark as $c) {
      if ($b['id'] == $c) {
        array_push($a, $b);
      }
    }
  }
  return $a;
}

function recentWatch($newWatch)
{
  $listWatch = $_COOKIE['recentWatch'];
  $arr       = [];
  $listWatch = explode(',', $listWatch);
  foreach ($listWatch as $value) {
    if (!empty($value)) {
      array_push($arr, $value);
    }
    if ($value == $newWatch) {
      return false;
    }
  }

  if (count($listWatch) > 4) {
    array_shift($arr);
  }
  array_push($arr, $newWatch);

  $recentWatch = '';
  foreach ($arr as $value) {
    if (!empty($value)) {
      $recentWatch = $recentWatch . $value . ',';
    }
  }
  setcookie('recentWatch', $recentWatch);
}

function getRecentWatch($recentWatch)
{
  global $con;
  $movies = mysqli_query($con, 'SELECT * FROM `movies`');

  $recentWatch = explode(',', $recentWatch);
  $tampung     = [];
  foreach ($recentWatch as $value) {
    foreach ($movies as $value2) {
      if ($value == $value2['id']) {
        array_push($tampung, $value2);
      }
    }
  }
  return $tampung;
}

function lastWatch($judul,$episode){
  $last = $_COOKIE['last'][$judul];
  if(empty($last)){
    setcookie("last[$judul]", "$episode,");
  }else {
    $get = explode(',',$last);
    $cek = false;
    foreach ($get as $value) {
      if ($value == $episode) {
        $cek = true;
      }
    }
    if ($cek == false) {
      $set = $last.$episode.',';
      setcookie("last[$judul]", "$set");
    }
  }
}

function cekLastWatch($judul,$episode){
  $last = $_COOKIE['last'][$judul];
  $last = explode(',',$last);
  foreach ($last as $value) {
    if($value == $episode){
      return 'text-primary';
    }
  }
  return;
}
