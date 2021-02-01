<?php
$source = file_get_contents('https://linuxize.com/post/create-a-file-in-linux/');

/* Menggunakan fungsi getStringBetween */
function getStringBetween($string, $start, $end) {
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

// Print_r($source);
// echo $getlink;

$judul = getStringBetween($source, 'English:</span>', '</div>');
$episode = getStringBetween($source, 'Episodes:</span>', '</div>');
$durasi = getStringBetween($source, 'Duration:</span>', '</div>');
$status = getStringBetween($source, 'Status:</span>', '</div>');
$tipe = getStringBetween($source, 'Type:</span>', '</div>');
$tipe = getStringBetween($tipe, '>', '</a>');
$studio = getStringBetween($source, 'Studios:</span>', '</div>');
$studio = getStringBetween($studio, '>', '</a>');
$rilis = getStringBetween($source, 'Aired:</span>', '</div>');
$genre = getStringBetween($source, 'Genres:</span>', '</div>');
$score = getStringBetween($source, 'score-label', '</div>');
$score = getStringBetween($score, '>', '<');
$sinopsis = getStringBetween($source, 'description">', '[Written by MAL Rewrite]');
$gambar = getStringBetween($source, 'class="lazyload" data-src="', '"');

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

function getMAL($link){
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
    
    return $arr;
}

$getinfo = getMAL('https://myanimelist.net/anime/16498/Shingeki_no_Kyojin');
echo $source;
// print_r($episode);
// print_r($durasi);
// print_r($status);
// print_r($tipe);
// print_r($studio);
// print_r($rilis);
// print_r($genre);
// print_r($score);
// print_r($sinopsis);
// print_r($arr['sinopsis']);
die();
$deskripsi = getStringBetween($source, 'name="description" content="', '" />');

/* Menggunakan Regular Expression */
preg_match('/name="title" content="(.*?) - IMDb/', $source, $matches1);
preg_match('/name="description" content="(.*?)" \/>/', $source, $matches2);
print_r($matches1);
$judul = $matches1[1];
$deskripsi = $matches2[1];

echo "Judul: $judul<br>";
echo "Deskripsi: $deskripsi";

?>

