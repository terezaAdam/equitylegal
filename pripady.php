<?php
$pageTitle = 'Blog – EQUITY LEGAL';
$pageDesc  = 'Blog advokátní kanceláře EQUITY LEGAL: řešené případy z praxe i zajímavosti z právního oboru a dění v kanceláři.';

// Load articles from JSON
$articles = array_filter(
  json_decode(file_get_contents(__DIR__ . '/data/articles.json'), true) ?? [],
  fn($a) => empty($a['hidden'])
);

// Filter by category if set
$filterCat = $_GET['kategorie'] ?? '';
if ($filterCat) {
  $articles = array_filter($articles, fn($a) => $a['category'] === $filterCat);
}

// Get all categories
$allCats = array_unique(array_column($articles, 'category'));

// Single article view
$slug = $_GET['clanek'] ?? '';
$article = null;
if ($slug) {
  foreach ($articles as $a) {
    if ($a['slug'] === $slug) { $article = $a; break; }
  }
  if (!$article) {
    // Try without filter
    $all = json_decode(file_get_contents(__DIR__ . '/data/articles.json'), true) ?? [];
    foreach ($all as $a) {
      if ($a['slug'] === $slug) { $article = $a; break; }
    }
  }
  if ($article) {
    $pageTitle = $article['title'] . ' – EQUITY LEGAL';
    $pageDesc  = strip_tags($article['excerpt']);
  }
}

include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Aktuality a řešené případy</p>
    <?php if ($article): ?>
      <div class="breadcrumb" style="margin-bottom:.75rem;">
        <a href="/pripady.php">Blog</a>
        <span class="breadcrumb__sep">/</span>
        <a href="/pripady.php?kategorie=<?= urlencode($article['category']) ?>"><?= htmlspecialchars($article['category']) ?></a>
      </div>
      <h1 class="page-hero__title"><?= htmlspecialchars($article['title']) ?></h1>
      <div class="page-hero__desc">
        <p><?= htmlspecialchars($article['excerpt']) ?></p>
      </div>
    <?php else: ?>
      <h1 class="page-hero__title">Blog</h1>
      <div class="page-hero__desc">
        <p>Řešené případy z naší praxe i zajímavosti z právního oboru a dění v kanceláři EQUITY LEGAL.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($article): ?>
<!-- ── Article detail ── -->
<section class="section">
  <div class="container">
    <div class="article-detail">
      <article class="article-content">
        <div style="display:flex;gap:1.5rem;align-items:center;margin-bottom:2rem;flex-wrap:wrap;">
          <span style="font-family:var(--font-h);font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fff;background:var(--burgundy);padding:.25rem .75rem;border-radius:var(--r);"><?= htmlspecialchars($article['category']) ?></span>
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

<?php else: ?>
<!-- ── Article listing ── -->
<section class="section">
  <div class="container">

    <!-- Category filter -->
    <?php
    $allArticles = array_filter(
      json_decode(file_get_contents(__DIR__ . '/data/articles.json'), true) ?? [],
      fn($a) => empty($a['hidden'])
    );
    $allCats2 = array_unique(array_column($allArticles, 'category'));
    ?>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:3rem;">
      <a href="/pripady.php" class="btn btn--sm <?= !$filterCat ? 'btn--primary' : 'btn--outline' ?>">Vše</a>
      <?php foreach ($allCats2 as $cat): ?>
        <a href="/pripady.php?kategorie=<?= urlencode($cat) ?>" class="btn btn--sm <?= $filterCat === $cat ? 'btn--primary' : 'btn--outline' ?>"><?= htmlspecialchars($cat) ?></a>
      <?php endforeach; ?>
    </div>

    <div class="articles-grid">
      <?php
      $displayArticles = $filterCat ? $articles : $allArticles;
      foreach ($displayArticles as $a): ?>
        <article class="article-card fade-in">
          <div class="article-card__image"<?= ($a['imageFit'] ?? 'cover') === 'contain' ? ' style="background:var(--navy);"' : '' ?>>
            <?php if (!empty($a['image'])): ?>
              <img src="<?= htmlspecialchars($a['image']) ?>" alt="<?= htmlspecialchars($a['title']) ?>" style="width:100%;height:100%;object-fit:<?= htmlspecialchars($a['imageFit'] ?? 'cover') ?>;object-position:<?= htmlspecialchars($a['imagePosition'] ?? 'center') ?>;display:block;">
            <?php else: ?>
              <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy) 0%,#263452 100%);display:flex;align-items:center;justify-content:center;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.15)" stroke-width="1" style="width:64px;height:64px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
              </div>
            <?php endif; ?>
            <span class="article-card__cat"><?= htmlspecialchars($a['category']) ?></span>
          </div>
          <div class="article-card__body">
            <h2 class="article-card__title"><?= htmlspecialchars($a['title']) ?></h2>
            <p class="article-card__excerpt"><?= htmlspecialchars($a['excerpt']) ?></p>
            <a href="/pripady.php?clanek=<?= urlencode($a['slug']) ?>" class="article-card__link">Číst celý článek</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (empty($displayArticles)): ?>
      <p style="text-align:center;color:var(--text-muted);padding:3rem 0;">Žádné články v této kategorii.</p>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<section class="cta-banner">
  <div class="container">
    <h2>Máte podobný případ?</h2>
    <p>Kontaktujte nás pro nezávaznou konzultaci.</p>
    <a href="/kontakty.php" class="btn btn--primary">Poslat poptávku</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
