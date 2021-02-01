<?php 
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
?>