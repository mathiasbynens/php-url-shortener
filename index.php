<?php

require('config.php');

function redirect($url) {
 header('Location: ' . $url, null, 301);
 die();
}

if (isset($_GET['slug'])) {
 $slug = rtrim($_GET['slug'], '!"#$%&\'()*+,-./@:;<=>[\\]^_`{|}~');
 if (is_numeric($slug) && strlen($slug) > 3) {
  redirect('http://twitter.com/' . TWITTER_USERNAME . '/status' . $_SERVER['REQUEST_URI']);
 }
 $db = new mysqli(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DATABASE);
 $db->query('SET NAMES "utf8"');
 $slug = $db->real_escape_string($slug);
 $result = $db->query('SELECT `url` FROM `redirect` WHERE `slug` = "' . $db->real_escape_string($slug) . '"');
 if ($result && $result->num_rows > 0 && $db->query('UPDATE `redirect` SET `hits` = `hits` + 1 WHERE `slug` = "' . $db->real_escape_string($slug) . '"')) {
  redirect($result->fetch_object()->url);
 } else {
  redirect(DEFAULT_URL . $_SERVER['REQUEST_URI']);
 }
} else {
 redirect(DEFAULT_URL . '/');
}

?>