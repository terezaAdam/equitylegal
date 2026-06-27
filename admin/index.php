<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

$articles     = readJson('articles.json');
$team         = readJson('team.json');
$publications = readJson('publications.json');

adminHeader('Dashboard', 'dashboard');
?>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-card__num"><?= count($articles) ?></div>
    <div class="stat-card__label">Řešené případy / články</div>
  </div>
  <div class="stat-card">
    <div class="stat-card__num"><?= count($team) ?></div>
    <div class="stat-card__label">Členové týmu</div>
  </div>
  <div class="stat-card">
    <div class="stat-card__num"><?= count($publications) ?></div>
    <div class="stat-card__label">Publikace</div>
  </div>
  <div class="stat-card">
    <div class="stat-card__num"><?= count(array_filter($publications, fn($p) => $p['type'] === 'book')) ?></div>
    <div class="stat-card__label">Knihy</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

  <!-- Recent articles -->
  <div class="card">
    <div class="card__title">
      Poslední případy / články
      <a href="/admin/articles.php" class="btn btn--sm btn--outline">Spravovat</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Název</th><th>Kategorie</th><th>Datum</th></tr></thead>
        <tbody>
          <?php
          $recent = array_slice(array_reverse($articles), 0, 5);
          foreach ($recent as $a): ?>
            <tr>
              <td><a href="/admin/articles.php?edit=<?= $a['id'] ?>"><?= htmlspecialchars(mb_substr($a['title'], 0, 50)) ?>…</a></td>
              <td><?= htmlspecialchars($a['category']) ?></td>
              <td><?= date('j.n.Y', strtotime($a['date'])) ?></td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($recent)): ?>
            <tr><td colspan="3" style="color:var(--muted);text-align:center;padding:1rem;">Žádné články</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Team overview -->
  <div class="card">
    <div class="card__title">
      Tým
      <a href="/admin/team.php" class="btn btn--sm btn--outline">Spravovat</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Jméno</th><th>Pozice</th></tr></thead>
        <tbody>
          <?php foreach (array_slice($team, 0, 6) as $m): ?>
            <tr>
              <td><a href="/admin/team.php?edit=<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></a></td>
              <td style="color:var(--muted);font-size:.82rem;"><?= htmlspecialchars(mb_substr($m['position'], 0, 40)) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- Quick links -->
<div class="card" style="margin-top:1.5rem;">
  <div class="card__title">Rychlé akce</div>
  <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
    <a href="/admin/articles.php?new=1" class="btn btn--primary">+ Nový článek</a>
    <a href="/admin/publications.php?new=1" class="btn btn--navy">+ Nová publikace</a>
    <a href="/admin/team.php?new=1" class="btn btn--outline">+ Nový člen týmu</a>
    <a href="/" target="_blank" class="btn btn--outline">Zobrazit web →</a>
  </div>
</div>

<?php adminFooter(); ?>
