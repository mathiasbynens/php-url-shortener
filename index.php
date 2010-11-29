<?php

require('config.php');

function redirect($url) {
 header('Location: ' . $url, null, 301);
 die();
}

if (isset($_SERVER['REDIRECT_QUERY_STRING'])) {
 $slug = $db->real_escape_string(rtrim($_SERVER['REDIRECT_QUERY_STRING'], '!"#$%&\'()*+,-./@:;<=>[\\]^_`{|}~'));
 if (is_numeric($slug) && strlen($slug) > 3) {
  redirect('http://twitter.com/' . TWITTER_USERNAME . '/status' . $_SERVER['REQUEST_URI']);
 }
 $db = new mysqli(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DATABASE);
 $db->query('SET NAMES "utf8"');
 $result = $db->query('SELECT `url` FROM `redirect` WHERE `slug` = "' . $slug . '"');
 if ($result && $result->num_rows > 0) {
  while ($item = $result->fetch_object()) {
   if ($db->query('UPDATE `redirect` SET `hits` = `hits` + 1 WHERE `slug` = "' . $slug . '"')) {
    redirect($item->url);
   }
  }
 } else {
  redirect(DEFAULT_URL . $_SERVER['REQUEST_URI']);
 }
} else {
 redirect(DEFAULT_URL . '/');
}

?>