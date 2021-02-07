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
$judul = getStringBetween($source, 'name="title" content="', ' - IMDb');
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

