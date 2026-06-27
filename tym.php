<?php
$pageTitle = 'Náš tým – EQUITY LEGAL';
$pageDesc  = 'Tým advokátní kanceláře EQUITY LEGAL: zkušení advokáti s mezinárodní praxí poskytující poradenství v češtině, angličtině, němčině a dalších jazycích.';

$team = json_decode(file_get_contents(__DIR__ . '/data/team.json'), true) ?? [];

// Build JS team data for modal
$teamJs = [];
foreach ($team as $m) {
  $teamJs[$m['id']] = [
    'name'            => $m['name'],
    'position'        => $m['position'],
    'photo'           => $m['photo'] ?? '',
    'email'           => $m['email'],
    'phone'           => $m['phone'] ?? '',
    'bio'             => $m['bio'],
    'specializations' => $m['specializations'] ?? [],
    'projects'        => $m['projects'] ?? [],
  ];
}

$pageScripts = '<script>const teamData = ' . json_encode($teamJs, JSON_UNESCAPED_UNICODE) . ';</script>';
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Lidé kanceláře</p>
    <h1 class="page-hero__title">Náš tým</h1>
    <div class="page-hero__desc">
      <p>Tým EQUITY LEGAL tvoří zkušení advokáti a specialisté s českou i mezinárodní praxí. Společně poskytujeme poradenství v 9 jazycích a ve 13 oblastech práva.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="team-grid">
      <?php foreach ($team as $m):
        $initials = '';
        $nameParts = preg_replace('/[^a-zA-ZáčďéěíňóřšťůúýžÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ\s]/', '', $m['name']);
        $nameParts = array_filter(explode(' ', $nameParts));
        $nameParts = array_slice($nameParts, 0, 2);
        $initials = implode('', array_map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)), $nameParts));
      ?>
        <div class="team-card fade-in" data-member="<?= htmlspecialchars($m['id']) ?>" role="button" tabindex="0" aria-label="Detail: <?= htmlspecialchars($m['name']) ?>">
          <div class="team-card__photo">
            <?php if (!empty($m['photo'])): ?>
              <img src="<?= htmlspecialchars($m['photo']) ?>" alt="Fotografie <?= htmlspecialchars($m['name']) ?>" loading="lazy">
            <?php else: ?>
              <div class="team-card__photo-placeholder">
                <span class="team-card__initials"><?= htmlspecialchars($initials) ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="team-card__body">
            <div class="team-card__name"><?= htmlspecialchars($m['name']) ?></div>
            <div class="team-card__title"><?= htmlspecialchars($m['position']) ?></div>
            <div class="team-card__langs">
              <?php foreach (($m['languages'] ?? []) as $lang): ?>
                <span class="lang-tag"><?= htmlspecialchars($lang) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Team Modal ── -->
<div class="modal-overlay" id="teamModal" role="dialog" aria-modal="true" aria-label="Detail člena týmu">
  <div class="modal">
    <button class="modal__close" id="modalClose" aria-label="Zavřít">×</button>
    <div class="modal__header">
      <div>
        <img id="mPhoto" src="" alt="" class="modal__photo" style="display:none;">
        <div id="mPhotoPlaceholder" class="modal__photo-placeholder" style="display:none;"></div>
      </div>
      <div>
        <h2 class="modal__name" id="mName"></h2>
        <div class="modal__position" id="mPosition"></div>
        <div class="modal__contacts">
          <a href="#" id="mEmail">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span></span>
          </a>
          <a href="#" id="mPhone">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.62 4.87 2 2 0 0 1 3.59 2.67h3a2 2 0 0 1 2 1.72c.13 1 .38 1.97.74 2.9a2 2 0 0 1-.45 2.11L7.91 10.4a16 16 0 0 0 6.09 6.09l1-1a2 2 0 0 1 2.11-.45c.93.36 1.9.61 2.9.74A2 2 0 0 1 22 16.92z"/></svg>
            <span></span>
          </a>
        </div>
      </div>
    </div>
    <div class="modal__body">
      <div class="modal__section">
        <div class="modal__section-title">Bio</div>
        <div id="mBio"></div>
      </div>
      <div class="modal__section">
        <div class="modal__section-title">Specializace</div>
        <ul id="mSpecializations" style="list-style:none;display:flex;flex-direction:column;gap:.4rem;"></ul>
      </div>
      <div class="modal__section">
        <div class="modal__section-title">Referenční projekty</div>
        <ul id="mProjects" style="list-style:none;display:flex;flex-direction:column;gap:.5rem;"></ul>
      </div>
    </div>
  </div>
</div>

<style>
.modal__section ul li {
  font-size:.9rem;
  color:var(--text-muted);
  padding-left:1.25rem;
  position:relative;
}
.modal__section ul li::before {
  content:'';
  position:absolute;
  left:0;top:.65em;
  width:5px;height:5px;
  background:var(--burgundy);
  border-radius:50%;
}
#mEmail span, #mPhone span {
  pointer-events: none;
}
</style>

<section class="cta-banner">
  <div class="container">
    <h2>Chcete s námi spolupracovat?</h2>
    <p>Kontaktujte konkrétního advokáta nebo nás napište na kancelář@equitylegal.cz.</p>
    <a href="/kontakty.php" class="btn btn--primary">Kontaktujte nás</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
