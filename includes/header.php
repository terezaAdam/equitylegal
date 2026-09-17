<?php
// $pageTitle, $pageDesc must be set before including
require_once __DIR__ . '/i18n.php';
$locale = elLocale();
$pageTitle = $pageTitle ?? 'Advokátní kancelář EQUITY LEGAL';
$pageDesc  = $pageDesc  ?? 'Prémiové právní poradenství a zastupování. Praha, mezinárodní právo, více jak 15 let zkušeností.';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(t('html_lang')) ?>">
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
  <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>

<header>
  <nav class="nav" role="navigation" aria-label="<?= htmlspecialchars(t('nav_aria')) ?>">
    <div class="nav__inner">
      <a href="<?= lu('/index.php') ?>" class="nav__logo" aria-label="<?= htmlspecialchars(t('nav_logo_aria')) ?>">
        <img src="/assets/img/logo-transparent.png" alt="EQUITY LEGAL" class="nav__logo-img" style="height:46px;max-height:46px;width:auto;display:block;">
      </a>

      <ul class="nav__links" role="list">
        <li><a href="<?= lu('/sluzby.php') ?>"    class="nav__link"><?= htmlspecialchars(t('nav_services')) ?></a></li>
        <li><a href="<?= lu('/pripady.php') ?>"   class="nav__link"><?= htmlspecialchars(t('nav_blog')) ?></a></li>
        <li><a href="<?= lu('/tym.php') ?>"       class="nav__link"><?= htmlspecialchars(t('nav_team')) ?></a></li>
        <li><a href="<?= lu('/publikace.php') ?>" class="nav__link"><?= htmlspecialchars(t('nav_publications')) ?></a></li>
        <li><a href="<?= lu('/kontakty.php') ?>"  class="nav__link"><?= htmlspecialchars(t('nav_contacts')) ?></a></li>
      </ul>

      <div class="nav__controls">
        <div class="nav__lang" role="list" aria-label="<?= htmlspecialchars(t('nav_lang_switch')) ?>">
          <?php foreach (EL_LOCALES as $loc): ?>
            <a href="<?= luSwitchLocale($loc) ?>" class="nav__lang-link<?= $loc === $locale ? ' active' : '' ?>"><?= strtoupper($loc) ?></a>
          <?php endforeach; ?>
        </div>
        <button class="nav__hamburger" id="hamburger" aria-label="<?= htmlspecialchars(t('nav_open_menu')) ?>" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </nav>

  <!-- Mobile nav -->
  <div class="nav__mobile" id="mobileNav" role="list">
    <a href="<?= lu('/sluzby.php') ?>"    class="nav__link" role="listitem"><?= htmlspecialchars(t('nav_services')) ?></a>
    <a href="<?= lu('/pripady.php') ?>"   class="nav__link" role="listitem"><?= htmlspecialchars(t('nav_blog')) ?></a>
    <a href="<?= lu('/tym.php') ?>"       class="nav__link" role="listitem"><?= htmlspecialchars(t('nav_team')) ?></a>
    <a href="<?= lu('/publikace.php') ?>" class="nav__link" role="listitem"><?= htmlspecialchars(t('nav_publications')) ?></a>
    <a href="<?= lu('/kontakty.php') ?>"  class="nav__link" role="listitem"><?= htmlspecialchars(t('nav_contacts')) ?></a>
    <div class="nav__lang nav__lang--mobile" role="list" aria-label="<?= htmlspecialchars(t('nav_lang_switch')) ?>">
      <?php foreach (EL_LOCALES as $loc): ?>
        <a href="<?= luSwitchLocale($loc) ?>" class="nav__lang-link<?= $loc === $locale ? ' active' : '' ?>"><?= strtoupper($loc) ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</header>

<main>
