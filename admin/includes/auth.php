<?php
// ── admin/includes/auth.php ──
session_start();

// !! ZMĚŇTE heslo před nasazením !!
define('ADMIN_PASSWORD_HASH', password_hash('EquityLegal2025!', PASSWORD_DEFAULT));
// Tip: vygenerujte vlastní hash: echo password_hash('VaseHeslo', PASSWORD_DEFAULT);

define('DATA_DIR', __DIR__ . '/../../data/');

function requireAuth(): void {
  if (empty($_SESSION['el_admin'])) {
    header('Location: /admin/login.php');
    exit;
  }
}

function isLoggedIn(): bool {
  return !empty($_SESSION['el_admin']);
}

function login(string $password): bool {
  if (password_verify($password, ADMIN_PASSWORD_HASH)) {
    $_SESSION['el_admin'] = true;
    session_regenerate_id(true);
    return true;
  }
  return false;
}

function logout(): void {
  $_SESSION = [];
  session_destroy();
}

function readJson(string $file): array {
  $path = DATA_DIR . $file;
  if (!file_exists($path)) return [];
  return json_decode(file_get_contents($path), true) ?? [];
}

function writeJson(string $file, array $data): bool {
  $path = DATA_DIR . $file;
  return file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) !== false;
}

function nextId(array $items): int {
  if (empty($items)) return 1;
  return max(array_column($items, 'id')) + 1;
}

function slugify(string $text): string {
  $text = mb_strtolower($text, 'UTF-8');
  $cs = ['á'=>'a','č'=>'c','ď'=>'d','é'=>'e','ě'=>'e','í'=>'i','ň'=>'n','ó'=>'o','ř'=>'r','š'=>'s','ť'=>'t','ů'=>'u','ú'=>'u','ý'=>'y','ž'=>'z'];
  $text = strtr($text, $cs);
  $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
  $text = preg_replace('/[\s-]+/', '-', trim($text));
  return substr($text, 0, 80);
}

function flash(string $msg, string $type = 'success'): void {
  $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function getFlash(): ?array {
  if (!empty($_SESSION['flash'])) {
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $f;
  }
  return null;
}
