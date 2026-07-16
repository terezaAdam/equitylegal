<?php
$pageTitle = 'Publikace – EQUITY LEGAL';
$pageDesc  = 'Odborné publikace, knihy a články advokátní kanceláře EQUITY LEGAL. Právní komentáře, casebooky a odborné texty.';

$publications = json_decode(file_get_contents(__DIR__ . '/data/publications.json'), true) ?? [];

$books    = array_filter($publications, fn($p) => $p['type'] === 'book');
$articles = array_filter($publications, fn($p) => $p['type'] === 'article');
usort($books, fn($a, $b) => strcmp($b['date'], $a['date']));
usort($articles, fn($a, $b) => strcmp($b['date'], $a['date']));

include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Odborné texty</p>
    <h1 class="page-hero__title">Publikace</h1>
    <div class="page-hero__desc">
      <p>Advokáti EQUITY LEGAL se aktivně podílejí na tvorbě odborné literatury a publikují v předních právních časopisech.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">

    <div class="publications-tabs">
      <button class="pub-tab active" data-panel="panel-books">Knižní publikace</button>
      <button class="pub-tab" data-panel="panel-articles">Odborné články</button>
    </div>

    <!-- Books panel -->
    <div id="panel-books" class="pub-panel active">
      <div class="publications-list">
        <?php foreach ($books as $p): ?>
          <div class="pub-item pub-item--book fade-in">
            <div class="pub-item__header">
              <div class="pub-item__type">Knižní publikace</div>
              <div class="pub-item__date"><?= date('Y', strtotime($p['date'])) ?></div>
            </div>
            <div class="pub-item__title"><?= htmlspecialchars($p['title']) ?></div>
            <div class="pub-item__row">
              <?php if (!empty($p['image'])): ?>
                <img class="pub-item__thumb" src="<?= htmlspecialchars($p['image']) ?>" alt="Obálka: <?= htmlspecialchars($p['title']) ?>" loading="lazy" data-lightbox="<?= htmlspecialchars($p['image']) ?>" data-title="<?= htmlspecialchars($p['title']) ?>" role="button" tabindex="0" aria-label="Zvětšit obálku: <?= htmlspecialchars($p['title']) ?>">
              <?php endif; ?>
              <div class="pub-item__content">
                <p class="pub-item__desc"><?= htmlspecialchars($p['description']) ?></p>
                <?php if (!empty($p['authors'])): ?>
                  <div class="pub-item__authors">
                    <?= htmlspecialchars(implode(', ', $p['authors'])) ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Articles panel -->
    <div id="panel-articles" class="pub-panel">
      <div class="publications-list">
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
            <div class="pub-item__date"><?= date('Y', strtotime($p['date'])) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ── Cover lightbox ── -->
<div class="img-lightbox" id="imgLightbox" role="dialog" aria-modal="true" aria-label="Zvětšená obálka">
  <button class="img-lightbox__close" id="imgLightboxClose" aria-label="Zavřít">×</button>
  <img id="imgLightboxImg" src="" alt="">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const lightbox    = document.getElementById('imgLightbox');
  const lightboxImg  = document.getElementById('imgLightboxImg');
  const lightboxClose = document.getElementById('imgLightboxClose');

  function openLightbox(src, alt) {
    lightboxImg.src = src;
    lightboxImg.alt = alt || '';
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.pub-item__thumb').forEach(thumb => {
    thumb.addEventListener('click', () => openLightbox(thumb.dataset.lightbox, thumb.dataset.title));
    thumb.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openLightbox(thumb.dataset.lightbox, thumb.dataset.title); }
    });
  });
  lightboxClose.addEventListener('click', closeLightbox);
  lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
});
</script>

<section class="cta-banner">
  <div class="container">
    <h2>Chcete vědět více?</h2>
    <p>Kontaktujte nás pro odbornou konzultaci.</p>
    <a href="/kontakty.php" class="btn btn--primary">Poslat poptávku</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
