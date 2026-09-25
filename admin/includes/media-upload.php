<?php
// Shared image upload used by the media library and by forms that accept
// an image directly (e.g. article thumbnail). Every upload lands in
// assets/uploads/ and is registered in media.json.

define('UPLOAD_DIR', __DIR__ . '/../../assets/uploads/');
define('UPLOAD_URL', '/assets/uploads/');
define('MAX_UPLOAD_BYTES', 5 * 1024 * 1024); // 5 MB
const ALLOWED_MIME = [
  'image/jpeg' => 'jpg',
  'image/png'  => 'png',
  'image/webp' => 'webp',
  'image/gif'  => 'gif',
];

// Validates and stores one uploaded image. Returns ['url' => …] on success,
// ['error' => …] on failure.
function saveUploadedImage(array $file, string $alt = ''): array {
  if ($file['error'] !== UPLOAD_ERR_OK) {
    return ['error' => 'Nahrání souboru se nezdařilo.'];
  }
  if ($file['size'] > MAX_UPLOAD_BYTES) {
    return ['error' => 'Soubor je příliš velký (max 5 MB).'];
  }

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $file['tmp_name']);
  finfo_close($finfo);

  if (!isset(ALLOWED_MIME[$mime])) {
    return ['error' => 'Nepovolený typ souboru. Povoleny jsou JPG, PNG, WebP a GIF.'];
  }
  if (!@getimagesize($file['tmp_name'])) {
    return ['error' => 'Soubor není platný obrázek.'];
  }

  if (!is_dir(UPLOAD_DIR)) @mkdir(UPLOAD_DIR, 0755, true);

  $ext  = ALLOWED_MIME[$mime];
  $base = slugify(pathinfo($file['name'], PATHINFO_FILENAME)) ?: 'obrazek';
  do {
    $name = $base . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
  } while (file_exists(UPLOAD_DIR . $name));

  if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $name)) {
    return ['error' => 'Soubor se nepodařilo uložit na server.'];
  }

  $media   = readJson('media.json');
  $media[] = [
    'id'       => nextId($media),
    'file'     => $name,
    'url'      => UPLOAD_URL . $name,
    'alt'      => trim($alt),
    'caption'  => '',
    'uploaded' => date('c'),
  ];
  writeJson('media.json', $media);

  return ['url' => UPLOAD_URL . $name];
}
