<?php

require('config.php');

header('Content-Type: text/plain;charset=UTF-8');

$db = new mysqli(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DATABASE);
$db->query('SET NAMES "utf8"');

$url = $db->real_escape_string(urldecode(trim($_GET['url'])));

if (in_array($url, array('', 'about:blank', 'undefined', 'http://localhost/'))) {
 die('Enter a URL');
}

function nextLetter(&$str) {
 $str = ('z' === $str ? 'a' : ++$str);
}

function getNextShortURL($s) {
 $a = str_split($s);
 $c = count($a);
 if (preg_match('/^z*$/', $s)) { // string consists entirely of `z`
  return str_repeat('a', $c + 1);
 }
 while ('z' === $a[--$c]) {
  nextLetter($a[$c]);
 }
 nextLetter($a[$c]);
 return implode($a);
}

$result = $db->query('SELECT `slug` FROM `redirect` WHERE `url` = "' . $url . '" LIMIT 1');
if ($result && $result->num_rows > 0) { // If there’s already a short URL for this URL
 $item = $result->fetch_object();
 echo SHORT_URL . $item->slug;
 die();
} else {
 $result = $db->query('SELECT `slug`, `url` FROM `redirect` ORDER BY `date` DESC LIMIT 1');
 if ($result && $result->num_rows > 0) {
  while ($item = $result->fetch_object()) {
   $slug = getNextShortURL($item->slug);
   if ($url !== $item->url && $db->query('INSERT INTO `redirect` (`slug`, `url`, `date`, `hits`) VALUES ("' . $slug . '", "' . $url . '", NOW(), 0)')) {
    header('HTTP/1.1 201 Created');
    echo SHORT_URL . $slug;
    $db->query('OPTIMIZE TABLE `redirect`');
   }
  }
 }
}

?>