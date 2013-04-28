# Go Link

Shortcut redirector for blogs/websites.

This simple PHP script implements local shortcut codes which redirect to other webpages
on your site, or other sites. Could be useful for affiliate or other marketing links.

## Installation

Installation is simple and only requires PHP to be available. In these steps we'll
assume the website is at http://example.com and the shortcuts will be available under
the `go` subdirectory.

1. Create a `go` subdirectory at the root of the web site (usually `public_html` or
similar).

2. Copy `links.ini` and `index.php` into the `go` subdirectory

3. Add a new file `.htaccess` in the `go` subdirectory to set up the rewrite rules:

```
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteRule ^([a-zA-Z0-9_-]+)$ index.php?code=$1 [QSA]
</IfModule>
```

## Author

Brian Cantoni <brian AT cantoni.org>

https://github.com/bcantoni/golink
