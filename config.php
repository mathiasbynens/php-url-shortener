<?php

/* Sample configuration file - LAST UPDATE: September 18, 2012 by Jonathan Libby ( libbystudios@gmail.com ), "TheLibbster" on GitHub
*  This is a sample configuration file for the application. Feel free to use it
*  as the actual configuration file.
*  *IMPORTANT - should you decide to make your own configuration file, it must be named "config.php" and placed in this directory*
*  Change these values to suit your needs - keep the exact same syntax, only change the values,
*  or you might break the application.
*/


/* DATABASE CONFIGURATION
*  These variables are used to define the properties of your
*  database connection - host, username, password, database name, etc.
*  Change these values to work with your database connection.
*/

$db_host = 'localhost'; // This defines the host which the data server (mysql, for example) is being hosted on. For local testing, use either "localhost", or "127.0.0.1"
$db_user = 'user'; // This defines the username to be used when connecting to your data server.
$db_pass = 'password'; // This defines the password to be used with the username above, when connecting to your data server.
$db_name = 'my_database'; // This defines the name of the database which you will be using for your site.



/* SHORTENING CONFIGURATION
*  These variables are used to define certain aspects of your shortener, such as the base
*  URL, short and long. Change these values to suit your needs.
*/

$short_url = 'http://mths.be/'; // The base URL for your shortened links. *IMPORTANT - KEEP THE TRAILING SLASH*
$full_url = 'http://mathiasbynens.be'; // The full URL of your site. *IMPORTANT - OMIT THE TRAILING SLASH*


/* MISCELLANEOUS CONFIGURATION
*  These variables contain other configuration settings for the application. Change them to suit your needs.
*/

$twitter_name = 'mathias'; // The twitter username to be used with the application. *IMPORTANT - OMIT THE "@" SYMBOL!*
$google_plus_id = '106697091536876736486'; // The Google+ ID to be used witht the application.








/* These are the constants, which are actually used throughout the application - they are
*  defined using the values of the variables above - the only reason we do this is because
*  the variable declaration is much less cluttered, and much more user friendly - much less
*  overwhelming, making the configuration seem easier.
*/
define('MYSQL_HOST', $db_host);
define('MYSQL_USER', $db_user);
define('MYSQL_PASSWORD', $db_pass);
define('MYSQL_DATABASE', $db_name);
define('TWITTER_USERNAME', $twitter_name);
define('GOOGLE_PLUS_ID', $google_plus_id);
define('SHORT_URL', $short_url);
define('DEFAULT_URL', $full_url);

?>