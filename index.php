<?php

require 'config.php';

$redirectDestination = DEFAULT_URL . '/';

if (isset($_GET['slug'])) {

	$slug = preg_replace('/[^a-z0-9]/si', '', $_GET['slug']);
	if (is_numeric ($slug) && strlen ($slug) > 8) {
		$redirectDestination = 'http://twitter.com/' . TWITTER_USERNAME . '/status/' . $slug;

	} else {

		$db = new MySQLi(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DATABASE);
		$db->set_charset('utf8');

		$escapedSlug = $db->real_escape_string($slug);
		$redirectResult = $db->query('SELECT url FROM redirect WHERE slug = "' . $escapedSlug . '"');

		if ($redirectResult !== false && $redirectResult->num_rows != 0) {
			$db->query ('UPDATE redirect SET hits = hits + 1 WHERE slug = "' . $escapedSlug . '"');
			$redirectDestination = $redirectResult->fetch_object()->url;
		} else {
			$redirectDestination = DEFAULT_URL . $_SERVER['REQUEST_URI'];
		}

		$db->close();

	}
}

header('Location: ' . $redirectDestination, null, 301);

?>
<!DOCTYPE html>
<meta charset=utf-8>
<title>Redirecting…</title>
<meta http-equiv=refresh content="0; URL=<?php echo $redirectDestination; ?>">
<a href="<?php echo $redirectDestination; ?>">Click here to continue to <?php echo $redirectDestination; ?>…</a>
<script>
	try {
		document.location.href = '<?php echo $redirectDestination; ?>';
	} catch (e) {}
</script>