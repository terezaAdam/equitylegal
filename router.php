<?php
// Dev-only router for `php -S`, mirroring the rewrite rules in .htaccess.
// Not used in production (Apache handles it via .htaccess there).
require_once __DIR__ . '/includes/i18n.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve real files/assets as-is.
if ($path !== '/' && file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
  return false;
}

// Locale root: /, /en/, /de/
if (preg_match('#^/(en|de)/?$#', $path) || $path === '/') {
  require __DIR__ . '/index.php';
  return true;
}

// Translated clean slugs: /sluzby, /en/services, /de/leistungen, ...
if (preg_match('#^/(?:(en|de)/)?([a-zA-Z0-9_-]+)/?$#', $path, $m)) {
  $locale = $m[1] ?: 'cs';
  $slug   = $m[2];
  $file   = elSlugToFile($locale, $slug);
  if ($file) {
    require __DIR__ . '/' . $file . '.php';
    return true;
  }
}

// Legacy fallback: /en/clanek.php, /de/tym.php, etc.
if (preg_match('#^/(en|de)/([a-zA-Z0-9_-]+)\.php$#', $path, $m)) {
  $target = __DIR__ . '/' . $m[2] . '.php';
  if (is_file($target)) {
    require $target;
    return true;
  }
}

return false;
