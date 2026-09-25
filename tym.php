<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/i18n.php';
$locale = elLocale();
$p = elPage('tym');
$pageTitle = tm('tym_title');
$pageDesc  = tm('tym_desc');

$team = json_decode(file_get_contents(__DIR__ . '/data/team.json'), true) ?? [];
$coreTeam     = array_filter($team, fn($m) => empty($m['external']));
$externalTeam = array_filter($team, fn($m) => !empty($m['external']));

$leaderIds = ['vit-hrncirik', 'krystof-kobeda'];
$leaders   = array_filter($coreTeam, fn($m) => in_array($m['id'], $leaderIds, true));
usort($leaders, fn($a, $b) => array_search($a['id'], $leaderIds) <=> array_search($b['id'], $leaderIds));

$titleWords = ['JUDr', 'Mgr', 'Ing', 'MUDr', 'MBA', 'Ph.D', 'LL.M', 'PhDr', 'Bc'];
function teamSurname(string $name, array $titleWords): string {
  $base = trim(explode(',', $name)[0]);
  $words = array_filter(explode(' ', $base), function ($w) use ($titleWords) {
    $clean = rtrim($w, '.');
    return $clean !== '' && !in_array($clean, $titleWords, true);
  });
  return $words ? array_values($words)[count($words) - 1] : $name;
}

function teamRoleRank(string $position): int {
  if (stripos($position, 'koncipient') !== false) return 1;
  if (stripos($position, 'advokát') !== false) return 0;
  return 2;
}

$restTeam  = array_filter($coreTeam, fn($m) => !in_array($m['id'], $leaderIds, true));
usort($restTeam, function ($a, $b) use ($titleWords) {
  $roleCmp = teamRoleRank($a['position']) <=> teamRoleRank($b['position']);
  if ($roleCmp !== 0) return $roleCmp;
  return strcoll(teamSurname($a['name'], $titleWords), teamSurname($b['name'], $titleWords));
});

// Build JS team data for modal
$teamJs = [];
foreach ($team as $m) {
  $teamJs[$m['id']] = [
    'name'            => $m['name'],
    'position'        => tf($m, 'position'),
    'photo'           => $m['photo'] ?? '',
    'email'           => $m['email'],
    'phone'           => $m['phone'] ?? '',
    'bio'             => tf($m, 'bio'),
    'specializations' => tfArr($m, 'specializations'),
    'projects'        => tfArr($m, 'projects'),
  ];
}

$pageScripts = '<script>const teamData = ' . json_encode($teamJs, JSON_UNESCAPED_UNICODE) . ';</script>';
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
    <div class="team-grid team-grid--compact team-grid--leaders">
      <?php foreach ($leaders as $m):
        $initials = '';
        $nameParts = preg_replace('/[^a-zA-ZáčďéěíňóřšťůúýžÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ\s]/', '', $m['name']);
        $nameParts = array_filter(explode(' ', $nameParts));
        $nameParts = array_slice($nameParts, 0, 2);
        $initials = implode('', array_map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)), $nameParts));
      ?>
        <div class="team-card team-card--compact fade-in" data-member="<?= htmlspecialchars($m['id']) ?>" role="button" tabindex="0" aria-label="Detail: <?= htmlspecialchars($m['name']) ?>">
          <div class="team-card__avatar">
            <span class="team-card__initials"><?= htmlspecialchars($initials) ?></span>
          </div>
          <div class="team-card__body">
            <div class="team-card__name"><?= htmlspecialchars($m['name']) ?></div>
            <div class="team-card__title"><?= htmlspecialchars(tf($m, 'position')) ?></div>
            <div class="team-card__langs">
              <?php foreach (($m['languages'] ?? []) as $lang): ?>
                <span class="lang-tag"><?= htmlspecialchars($lang) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="team-grid team-grid--compact" style="margin-top:1rem;">
      <?php foreach ($restTeam as $m):
        $initials = '';
        $nameParts = preg_replace('/[^a-zA-ZáčďéěíňóřšťůúýžÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ\s]/', '', $m['name']);
        $nameParts = array_filter(explode(' ', $nameParts));
        $nameParts = array_slice($nameParts, 0, 2);
        $initials = implode('', array_map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)), $nameParts));
      ?>
        <div class="team-card team-card--compact fade-in" data-member="<?= htmlspecialchars($m['id']) ?>" role="button" tabindex="0" aria-label="Detail: <?= htmlspecialchars($m['name']) ?>">
          <div class="team-card__avatar">
            <span class="team-card__initials"><?= htmlspecialchars($initials) ?></span>
          </div>
          <div class="team-card__body">
            <div class="team-card__name"><?= htmlspecialchars($m['name']) ?></div>
            <div class="team-card__title"><?= htmlspecialchars(tf($m, 'position')) ?></div>
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

<?php if (!empty($externalTeam)): ?>
<section class="section section--alt">
  <div class="container">
    <p class="section-label"><?= htmlspecialchars(t('team_collaboration_label')) ?></p>
    <h2><?= htmlspecialchars(t('team_external_title')) ?></h2>
    <p class="external-intro"><?= htmlspecialchars(t('team_external_intro')) ?></p>
    <div class="team-grid team-grid--compact">
      <?php foreach ($externalTeam as $m):
        $initials = '';
        $nameParts = preg_replace('/[^a-zA-ZáčďéěíňóřšťůúýžÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ\s]/', '', $m['name']);
        $nameParts = array_filter(explode(' ', $nameParts));
        $nameParts = array_slice($nameParts, 0, 2);
        $initials = implode('', array_map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)), $nameParts));
      ?>
        <div class="team-card team-card--compact fade-in" data-member="<?= htmlspecialchars($m['id']) ?>" role="button" tabindex="0" aria-label="Detail: <?= htmlspecialchars($m['name']) ?>">
          <div class="team-card__avatar">
            <span class="team-card__initials"><?= htmlspecialchars($initials) ?></span>
          </div>
          <div class="team-card__body">
            <div class="team-card__name"><?= htmlspecialchars($m['name']) ?></div>
            <div class="team-card__title"><?= htmlspecialchars(tf($m, 'position')) ?></div>
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
<?php endif; ?>

<div class="modal-overlay" id="teamModal" role="dialog" aria-modal="true" aria-label="<?= htmlspecialchars(t('aria_team_detail')) ?>">
  <div class="modal">
    <button class="modal__close" id="modalClose" aria-label="<?= htmlspecialchars(t('btn_close')) ?>">×</button>
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
        <div class="modal__section-title"><?= htmlspecialchars(t('team_modal_bio')) ?></div>
        <div id="mBio"></div>
      </div>
      <div class="modal__section">
        <div class="modal__section-title"><?= htmlspecialchars(t('team_modal_spec')) ?></div>
        <ul id="mSpecializations" style="list-style:none;display:flex;flex-direction:column;gap:.4rem;"></ul>
      </div>
      <div class="modal__section">
        <div class="modal__section-title"><?= htmlspecialchars(t('team_modal_projects')) ?></div>
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
    <h2><?= htmlspecialchars(t('team_cta_title')) ?></h2>
    <p><?= htmlspecialchars(t('team_cta_text')) ?></p>
    <a href="<?= lu('/kontakty.php') ?>" class="btn btn--primary"><?= htmlspecialchars(t('btn_send_enquiry')) ?></a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
