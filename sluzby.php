<?php
require_once __DIR__ . '/includes/data.php';
$p = elPage('sluzby');
$pageTitle = tm('sluzby_title');
$pageDesc  = tm('sluzby_desc');
$services = require __DIR__ . '/includes/services-data.php';
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label"><?= htmlspecialchars(tf($p, 'hero_label')) ?></p>
    <h1 class="page-hero__title"><?= htmlspecialchars(tf($p, 'hero_title')) ?></h1>
    <div class="page-hero__desc">
      <p><?= htmlspecialchars(tf($p, 'hero_desc')) ?></p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">

    <!-- Mobile tab navigation (only on mobile) -->
    <div class="services-mobile-tabs">
      <div class="services-mobile-tabs__scroll">
        <?php foreach ($services as $i => $s): ?>
          <button class="smt-btn<?= $i === 0 ? ' active' : '' ?>" data-target="<?= htmlspecialchars($s['id']) ?>"><?= htmlspecialchars(tf($s, 'label')) ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="services-layout">

      <!-- Sidebar nav -->
      <nav class="services-nav" aria-label="<?= htmlspecialchars(t('services_nav_aria')) ?>">
        <ul>
          <?php foreach ($services as $s): ?>
            <li><a href="#<?= htmlspecialchars($s['id']) ?>"><?= htmlspecialchars(tf($s, 'label')) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <!-- Content -->
      <div>
        <?php foreach ($services as $s): ?>
          <div id="<?= htmlspecialchars($s['id']) ?>" class="service-section">
            <h2><?= htmlspecialchars(tf($s, 'label')) ?></h2>
            <p><?= htmlspecialchars(tf($s, 'desc')) ?></p>
            <ul>
              <?php foreach (tfArr($s, 'bullets') as $b): ?>
                <li><?= htmlspecialchars($b) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container">
    <h2><?= htmlspecialchars(t('services_needadvice_title')) ?></h2>
    <p><?= htmlspecialchars(t('services_needadvice_text')) ?></p>
    <a href="<?= lu('/kontakty.php') ?>" class="btn btn--primary"><?= htmlspecialchars(t('btn_send_enquiry')) ?></a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
