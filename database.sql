CREATE TABLE `redirect` (
  `slug` varchar(14) collate utf8_unicode_ci NOT NULL,
  `url` varchar(620) collate utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `hits` bigint(20) NOT NULL default '0',
  PRIMARY KEY (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Used for the URL shortener';

INSERT INTO `redirect` VALUES ('a', 'https://github.com/mathiasbynens/php-url-shortener', NOW(), 1);