<?php
/*
 * Go Link - shortcode redirector for blogs
 *
 * See README.md for installation and usage instructions.
 *
 * Brian Cantoni <brian AT cantoni.org>
 * https://github.com/bcantoni/golink
 */

define ('INI_FILE', 'links.ini');
define ('REDIRECT_CODE', 302);
ini_set ('display_errors', 0);

// only allow GET or HEAD requests
$method = strtoupper ($_SERVER['REQUEST_METHOD']);
if ($method != 'HEAD' && $method != 'GET') {
    header ("HTTP/1.1 405 Method Not Allowed", true, 405);
    exit (0);
}

// redirect home if no shortcut code provided
if (!isset($_REQUEST['code'])) {
    header ("Location: /", true, REDIRECT_CODE);
    exit (0);
}
$code = $_REQUEST['code'];

// load link configuration; redirect to home if a problem found
try {
    $ini = parse_ini_file (INI_FILE, true);
} catch (Exception $e) {
    header ("Location: /", true, REDIRECT_CODE);
    exit (0);
}

// if valid code, go there; otherwise show 404 message
if (isset($ini['links'][$code])) {
    $url = trim ($ini['links'][$code]);
    header ("Location: $url", true, REDIRECT_CODE);
    exit (0);
} else {
    header ("HTTP/1.1 404 Not Found", true, 405);
    print <<<EOT
<!DOCTYPE HTML>
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
</body></html>
EOT;
}
