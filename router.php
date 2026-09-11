<?php
// Dev-only router for `php -S`, mirroring the /en/ /de/ rewrite rules in .htaccess.
// Not used in production (Apache handles it via .htaccess there).
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (preg_match('#^/(en|de)/?$#', $path)) {
  require __DIR__ . '/index.php';
  return true;
}
if (preg_match('#^/(en|de)/([a-zA-Z0-9_-]+)\.php$#', $path, $m)) {
  $target = __DIR__ . '/' . $m[2] . '.php';
  if (is_file($target)) {
    require $target;
    return true;
  }
}
return false;
