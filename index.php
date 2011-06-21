<?php
require 'config.php';

$redirectDestination = DEFAULT_URL . '/';
if (isset ($_GET ['slug']))
{
    $slug = preg_replace ('/[^a-z0-9]/si', '', $_GET ['slug']);
    if (is_numeric ($slug) && strlen ($slug) > 8)
    {
        $redirectDestination = 'http://twitter.com/' . TWITTER_USERNAME . '/status/' . $slug;
    }
    else
    {
        $database = new MySQLi (MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DATABASE);
        $database -> set_charset ('utf8');
        
        $escapedSlug = $database -> real_escape_string ($slug);
        $redirectResult = $database -> query ('SELECT url FROM redirect WHERE slug="' . $escapedSlug . '"');
        
        if ($redirectResult !== false && $redirectResult -> num_rows != 0)
        {
            $database -> query ('UPDATE redirect SET hits=hits+1 WHERE slug="' . $escapedSlug . '"');
            $redirectDestination = $redirectResult -> fetch_object () -> url;
        }
        else
        {
            $redirectDestination = DEFAULT_URL . $_SERVER ['REQUEST_URI'];
        }
        
        $database -> close ();
    }
}

Header ('Location: ' . $redirectDestination, null, 301);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Redirecting…</title>
    <meta http-equiv="refresh" content="0; URL=<?php echo $redirectDestination; ?>" />
    <script>
      try {
        document.location.href = "<?php echo $redirectDestination; ?>";
      } catch (ex) {}
    </script>
  </head>
  <body>
    <a href="<?php echo $redirectDestination; ?>">Click here to continue…</a>
  </body>
</html>