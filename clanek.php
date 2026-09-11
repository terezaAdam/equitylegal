<?php
$articles = json_decode(file_get_contents(__DIR__ . '/data/articles.json'), true) ?? [];

$slug = preg_replace('/[^a-z0-9\-]/', '', $_GET['slug'] ?? '');
$article = null;
foreach ($articles as $a) {
  if ($a['slug'] === $slug) { $article = $a; break; }
}

if (!$article) {
  http_response_code(404);
  header('Location: /index.php');
  exit;
}

require_once __DIR__ . '/includes/i18n.php';
$pageTitle = tf($article, 'title') . ' – EQUITY LEGAL';
$pageDesc  = tf($article, 'excerpt');
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label"><?= htmlspecialchars(t('blog_hero_label')) ?></p>
    <div class="breadcrumb" style="margin-bottom:.75rem;">
      <a href="<?= lu('/pripady.php') ?>"><?= htmlspecialchars(t('nav_blog')) ?></a>
      <span class="breadcrumb__sep">/</span>
      <a href="<?= lu('/pripady.php') ?>?kategorie=<?= urlencode($article['category']) ?>"><?= htmlspecialchars(catLabel($article['category'])) ?></a>
    </div>
    <h1 class="page-hero__title"><?= htmlspecialchars(tf($article, 'title')) ?></h1>
    <div class="page-hero__desc">
      <p><?= htmlspecialchars(tf($article, 'excerpt')) ?></p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="article-detail">

      <article class="article-content">
        <div style="display:flex;gap:1.5rem;align-items:center;margin-bottom:2rem;flex-wrap:wrap;">
          <span style="font-family:var(--font-h);font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fff;background:var(--burgundy);padding:.25rem .75rem;border-radius:var(--r);"><?= htmlspecialchars(catLabel($article['category'])) ?></span>
          <span style="font-size:.85rem;color:var(--text-muted);"><?= date('j. n. Y', strtotime($article['date'])) ?> · <?= htmlspecialchars($article['author']) ?></span>
        </div>
        <?php
        $content = tf($article, 'content');
        if (!empty($article['image'])) {
          $imgHtml = '<img src="' . htmlspecialchars($article['image']) . '" alt="' . htmlspecialchars(tf($article, 'title')) . '" style="max-width:280px;width:100%;height:auto;display:block;margin:1.5rem auto;object-fit:' . htmlspecialchars($article['imageFit'] ?? 'cover') . ';">';
          $pos = strpos($content, '</p>');
          if ($pos !== false) {
            $content = substr_replace($content, '</p>' . $imgHtml, $pos, 4);
          } else {
            $content = $imgHtml . $content;
          }
        }
        echo $content;
        ?>
        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--border);">
          <a href="<?= lu('/pripady.php') ?>" class="btn btn--outline"><?= htmlspecialchars(t('btn_back_articles')) ?></a>
        </div>
      </article>

      <aside class="article-sidebar">
        <div class="article-sidebar__card">
          <div class="article-sidebar__title"><?= htmlspecialchars(t('article_need_advice_title')) ?></div>
          <p style="font-size:.88rem;"><?= htmlspecialchars(t('article_need_advice_text')) ?></p>
          <a href="<?= lu('/kontakty.php') ?>" class="btn btn--primary btn--sm" style="margin-top:1rem;"><?= htmlspecialchars(t('btn_send_enquiry')) ?></a>
        </div>
        <div class="article-sidebar__card">
          <div class="article-sidebar__title"><?= htmlspecialchars(t('article_related_services')) ?></div>
          <ul style="display:flex;flex-direction:column;gap:.5rem;">
            <?php
            $allServices = require __DIR__ . '/includes/services-data.php';
            $selectedServices = $article['services'] ?? [];
            if (empty($selectedServices)): ?>
              <li><a href="<?= lu('/sluzby.php') ?>" style="font-size:.88rem;"><?= htmlspecialchars(t('nav_services')) ?></a></li>
            <?php else: foreach ($selectedServices as $sid):
              $svc = null;
              foreach ($allServices as $svcRow) { if ($svcRow['id'] === $sid) { $svc = $svcRow; break; } }
              if (!$svc) continue; ?>
              <li><a href="<?= lu('/sluzby.php') ?>#<?= htmlspecialchars($sid) ?>" style="font-size:.88rem;"><?= htmlspecialchars(tf($svc, 'label')) ?></a></li>
            <?php endforeach; endif; ?>
          </ul>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
