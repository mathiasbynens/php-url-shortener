# Simple PHP URL shortener

## Installation

1. Download the source code as located within this repository, and upload it to your web server.
2. Use `database.sql` to create the `redirect` table in a database of choice.
3. Edit `config.php` and enter your database credentials, and configure other information for the application.

## Features

* Redirect to Twitter when given a numerical slug, e.g. `http://mths.be/8065633451249664` → `http://twitter.com/mathias/status/8065633451249664`.
* Redirect to your Twitter account when `@` is used as a slug, e.g. `http://mths.be/@` → `http://twitter.com/mathias`.
* Redirect to your Google Plus account when `+` is used as a slug, e.g. `http://mths.be/+` → `https://plus.google.com/u/0/116553353277057965424/posts`.
* Redirect to your main website when no slug is entered, e.g. `http://mths.be/` → `http://mathiasbynens.be/`.
* Redirect to a specific page on your main website when an unknown slug (not in the database) is used, e.g. `http://mths.be/demo/jquery-size` → `http://mathiasbynens.be/demo/jquery-size`.
* Ignores weird trailing characters (`!`, `"`, `#`, `$`, `%`, `&`, `'`, `(`, `)`, `*`, `+`, `,`, `-`, `.`, `/`, `@`, `:`, `;`, `<`, `=`, `>`, `[`, `\`, `]`, `^`, `_`, `{`, `|`, `}`, `~`) in slugs — useful when your short URL is run through a crappy link parser, e.g. `http://mths.be/aaa)` → same effect as visiting `http://mths.be/aaa`.
* Generates short, easy-to-type URLs using only `[a-z]` characters.
* Doesn’t create multiple short URLs when you try to shorten the same URL. In this case, the script will simply return the existing short URL for that long URL.
* DRY, minimal code.
* Correct, semantic use of the available HTTP status codes.
* Can be used with Twitter for iPhone. Just go to _Settings_ › _Services_ › _URL Shortening_ › _Custom…_ and enter `http://yourshortener.ext/shorten?url=%@`.

## Favelets / Bookmarklets

### Prompt

``` js
javascript:(function(){var%20q=prompt('URL:');if(q){document.location='http://yourshortener.ext/shorten?url='+encodeURIComponent(q)}}());
```

### Shorten this URL

``` js
javascript:(function(){document.location='http://yourshortener.ext/shorten?url='+encodeURIComponent(location.href)}());
````

## Author

* [Mathias Bynens](http://mathiasbynens.be/)

## Contributors

* [Peter Beverloo](http://peter.sh/)
* [Tomislav Biscan](https://github.com/B-Scan)
* [Jonathan Libby](http://www.thelibbster.com)(http://github.com/TheLibbster)