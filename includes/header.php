<?php
// ── includes/header.php ──
// $pageTitle, $pageDesc must be set before including
$pageTitle = $pageTitle ?? 'Advokátní kancelář EQUITY LEGAL';
$pageDesc  = $pageDesc  ?? 'Prémiové právní poradenství a zastupování. Praha, mezinárodní právo, více jak 15 let zkušeností.';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta name="robots" content="index,follow">
  <meta property="og:title"       content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta property="og:type"        content="website">
  <meta property="og:image"       content="/assets/img/og-image.jpg">
  <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>

<!-- ── Navigation ── -->
<header>
  <nav class="nav" role="navigation" aria-label="Hlavní menu">
    <div class="nav__inner">
      <a href="/index.php" class="nav__logo" aria-label="EQUITY LEGAL – úvodní stránka">
        <img src="/assets/img/logo-transparent.png" alt="EQUITY LEGAL – advokátní kancelář" class="nav__logo-img">
      </a>

      <ul class="nav__links" role="list">
        <li><a href="/sluzby.php"   class="nav__link">Právní služby</a></li>
        <li><a href="/pripady.php"  class="nav__link">Řešené případy</a></li>
        <li><a href="/tym.php"      class="nav__link">Náš tým</a></li>
        <li><a href="/publikace.php" class="nav__link">Publikace</a></li>
        <li><a href="/kontakty.php" class="nav__link">Kontakty</a></li>
      </ul>

      <div class="nav__controls">
        <button class="nav__theme-btn" id="themeToggle" aria-label="Přepnout tmavý/světlý režim" title="Přepnout motiv">☾</button>
        <button class="nav__hamburger" id="hamburger" aria-label="Otevřít menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </nav>

  <!-- Mobile nav -->
  <div class="nav__mobile" id="mobileNav" role="list">
    <a href="/sluzby.php"    class="nav__link" role="listitem">Právní služby</a>
    <a href="/pripady.php"   class="nav__link" role="listitem">Řešené případy</a>
    <a href="/tym.php"       class="nav__link" role="listitem">Náš tým</a>
    <a href="/publikace.php" class="nav__link" role="listitem">Publikace</a>
    <a href="/kontakty.php"  class="nav__link" role="listitem">Kontakty</a>
  </div>
</header>

<main>
