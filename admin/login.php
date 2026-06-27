<?php
require_once __DIR__ . '/includes/auth.php';

if (isLoggedIn()) {
  header('Location: /admin/index.php');
  exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pw = $_POST['password'] ?? '';
  if (login($pw)) {
    header('Location: /admin/index.php');
    exit;
  }
  $error = 'Nesprávné heslo. Zkuste to znovu.';
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Přihlášení – EQUITY LEGAL Admin</title>
  <meta name="robots" content="noindex,nofollow">
  <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body>
<div class="login-page">
  <div class="login-box">
    <div class="login-logo">EQUITY LEGAL</div>
    <div class="login-sub">Správa obsahu webu</div>

    <?php if ($error): ?>
      <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="form-group">
        <label for="pw">Heslo</label>
        <input type="password" id="pw" name="password" required autofocus autocomplete="current-password" placeholder="••••••••">
      </div>
      <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;margin-top:.5rem;">Přihlásit se</button>
    </form>

    <div style="margin-top:1.5rem;text-align:center;">
      <a href="/" style="font-size:.8rem;color:var(--muted);">← Zpět na web</a>
    </div>
  </div>
</div>
</body>
</html>
