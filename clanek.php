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
    <p class="page-hero__label"><?= htmlspecialchars($article['category']) ?></p>
    <h1 class="page-hero__title"><?= htmlspecialchars($article['title']) ?></h1>
    <div class="page-hero__desc">
      <p><?= date('j. n. Y', strtotime($article['date'])) ?> · <?= htmlspecialchars($article['author']) ?></p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">

    <nav class="breadcrumb" aria-label="Drobečková navigace">
      <a href="/index.php">Úvod</a>
      <span class="breadcrumb__sep">›</span>
      <span><?= htmlspecialchars($article['category']) ?></span>
      <span class="breadcrumb__sep">›</span>
      <span><?= htmlspecialchars($article['title']) ?></span>
    </nav>

    <div class="article-detail">

      <article class="article-content">
        <?= $article['content'] ?>
      </article>

      <aside class="article-sidebar">
        <div class="article-sidebar__card">
          <div class="article-sidebar__title">Autor</div>
          <p style="font-size:.9rem;color:var(--text);margin-bottom:.25rem;"><?= htmlspecialchars($article['author']) ?></p>
          <p style="font-size:.82rem;">EQUITY LEGAL</p>
        </div>
        <div class="article-sidebar__card">
          <div class="article-sidebar__title">Kategorie</div>
          <p style="font-size:.9rem;color:var(--text);"><?= htmlspecialchars($article['category']) ?></p>
        </div>
        <div class="article-sidebar__card" style="background:var(--navy);border-color:var(--navy);">
          <div class="article-sidebar__title" style="color:rgba(255,255,255,.5);">Potřebujete poradenství?</div>
          <p style="color:rgba(255,255,255,.7);font-size:.88rem;margin-bottom:1.25rem;">Kontaktujte nás pro nezávaznou konzultaci.</p>
          <a href="/kontakty.php" class="btn btn--primary" style="width:100%;justify-content:center;">Poslat poptávku</a>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
