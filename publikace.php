<?php
$pageTitle = 'Publikace – EQUITY LEGAL';
$pageDesc  = 'Odborné publikace, knihy a články advokátní kanceláře EQUITY LEGAL. Právní komentáře, casebooky a odborné texty.';

$publications = json_decode(file_get_contents(__DIR__ . '/data/publications.json'), true) ?? [];

$books    = array_filter($publications, fn($p) => $p['type'] === 'book');
$articles = array_filter($publications, fn($p) => $p['type'] === 'article');

include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Odborné texty</p>
    <h1 class="page-hero__title">Publikace</h1>
    <div class="page-hero__desc">
      <p>Advokáti EQUITY LEGAL se aktivně podílejí na tvorbě odborné literatury a publikují komentáře k aktuálnímu právnímu dění.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">

    <div class="publications-tabs">
      <button class="pub-tab active" data-panel="panel-articles">Odborné články</button>
      <button class="pub-tab" data-panel="panel-books">Knihy</button>
    </div>

    <!-- Articles panel -->
    <div id="panel-articles" class="pub-panel active">
      <div class="publications-list">
        <?php if (empty($articles)): ?>
          <p style="color:var(--text-muted);">Žádné odborné články zatím nejsou přidány.</p>
        <?php endif; ?>
        <?php foreach ($articles as $p): ?>
          <div class="pub-item fade-in">
            <div>
              <div class="pub-item__type">Odborný článek</div>
              <div class="pub-item__title"><?= htmlspecialchars($p['title']) ?></div>
              <p class="pub-item__desc"><?= htmlspecialchars($p['description']) ?></p>
              <?php if (!empty($p['authors'])): ?>
                <div style="margin-top:.5rem;font-size:.8rem;color:var(--text-muted);font-family:var(--font-h);">
                  <?= htmlspecialchars(implode(', ', $p['authors'])) ?>
                </div>
              <?php endif; ?>
              <?php if (!empty($p['link'])): ?>
                <div style="margin-top:.75rem;">
                  <a href="<?= htmlspecialchars($p['link']) ?>" class="btn btn--sm btn--outline" target="_blank" rel="noopener">Stáhnout / číst →</a>
                </div>
              <?php endif; ?>
            </div>
            <div class="pub-item__date"><?= date('j. n. Y', strtotime($p['date'])) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Books panel -->
    <div id="panel-books" class="pub-panel">
      <div class="publications-list">
        <?php if (empty($books)): ?>
          <p style="color:var(--text-muted);">Žádné knihy zatím nejsou přidány.</p>
        <?php endif; ?>
        <?php foreach ($books as $p): ?>
          <div class="pub-item fade-in">
            <div>
              <div class="pub-item__type">Kniha</div>
              <div class="pub-item__title"><?= htmlspecialchars($p['title']) ?></div>
              <p class="pub-item__desc"><?= htmlspecialchars($p['description']) ?></p>
              <?php if (!empty($p['authors'])): ?>
                <div style="margin-top:.5rem;font-size:.8rem;color:var(--text-muted);font-family:var(--font-h);">
                  <?= htmlspecialchars(implode(', ', $p['authors'])) ?>
                </div>
              <?php endif; ?>
              <?php if (!empty($p['link'])): ?>
                <div style="margin-top:.75rem;">
                  <a href="<?= htmlspecialchars($p['link']) ?>" class="btn btn--sm btn--outline" target="_blank" rel="noopener">Koupit / číst →</a>
                </div>
              <?php endif; ?>
            </div>
            <div class="pub-item__date"><?= date('j. n. Y', strtotime($p['date'])) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<section class="cta-banner">
  <div class="container">
    <h2>Chcete vědět více?</h2>
    <p>Kontaktujte nás pro odbornou konzultaci.</p>
    <a href="/kontakty.php" class="btn btn--primary">Napište nám</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
