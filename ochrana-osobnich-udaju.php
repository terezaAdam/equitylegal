<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/i18n.php';
$p = elPage('ochrana');
$pageTitle = t('nav_privacy') . ' – EQUITY LEGAL';
$pageDesc  = t('privacy_hero_label') . ' – EQUITY LEGAL.';
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label"><?= htmlspecialchars(t('privacy_hero_label')) ?></p>
    <h1 class="page-hero__title"><?= htmlspecialchars(tf($p, 'hero_title')) ?></h1>
    <div class="page-hero__desc"><p><?= htmlspecialchars(tf($p, 'hero_desc')) ?></p></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="article-detail">
      <article class="article-content">

<?= tf($p, 'content') ?>

      </article>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
