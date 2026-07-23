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

$pageTitle = htmlspecialchars($article['title']) . ' – EQUITY LEGAL';
$pageDesc  = htmlspecialchars($article['excerpt']);
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Aktuality a řešené případy</p>
    <div class="breadcrumb" style="margin-bottom:.75rem;">
      <a href="/pripady.php">Blog</a>
      <span class="breadcrumb__sep">/</span>
      <a href="/pripady.php?kategorie=<?= urlencode($article['category']) ?>"><?= htmlspecialchars($article['category']) ?></a>
    </div>
    <h1 class="page-hero__title"><?= htmlspecialchars($article['title']) ?></h1>
    <div class="page-hero__desc">
      <p><?= htmlspecialchars($article['excerpt']) ?></p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="article-detail">

      <article class="article-content">
        <div style="display:flex;gap:1.5rem;align-items:center;margin-bottom:2rem;flex-wrap:wrap;">
          <span style="font-family:var(--font-h);font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fff;background:var(--burgundy);padding:.25rem .75rem;border-radius:var(--r);"><?= htmlspecialchars($article['category']) ?></span>
          <span style="font-size:.85rem;color:var(--text-muted);"><?= date('j. n. Y', strtotime($article['date'])) ?> · <?= htmlspecialchars($article['author']) ?></span>
        </div>
        <?= $article['content'] ?>
        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--border);">
          <a href="/pripady.php" class="btn btn--outline">← Zpět na všechny články</a>
        </div>
      </article>

      <aside class="article-sidebar">
        <div class="article-sidebar__card">
          <div class="article-sidebar__title">Potřebujete pomoc?</div>
          <p style="font-size:.88rem;">Naši advokáti jsou připraveni vám pomoci.</p>
          <a href="/kontakty.php" class="btn btn--primary btn--sm" style="margin-top:1rem;">Poslat poptávku</a>
        </div>
        <div class="article-sidebar__card">
          <div class="article-sidebar__title">Související služby</div>
          <ul style="display:flex;flex-direction:column;gap:.5rem;">
            <?php
            $allServices = json_decode(file_get_contents(__DIR__ . '/data/services.json'), true) ?? [];
            $serviceLabels = array_column($allServices, 'label', 'id');
            $selectedServices = $article['services'] ?? [];
            if (empty($selectedServices)): ?>
              <li><a href="/sluzby.php" style="font-size:.88rem;">Právní služby</a></li>
            <?php else: foreach ($selectedServices as $sid):
              if (empty($serviceLabels[$sid])) continue; ?>
              <li><a href="/sluzby.php#<?= htmlspecialchars($sid) ?>" style="font-size:.88rem;"><?= htmlspecialchars($serviceLabels[$sid]) ?></a></li>
            <?php endforeach; endif; ?>
          </ul>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
