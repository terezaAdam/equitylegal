<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

$pubs = readJson('publications.json');

// ── DELETE ──
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $delId = (int)$_GET['delete'];
  $pubs = array_values(array_filter($pubs, fn($p) => $p['id'] !== $delId));
  writeJson('publications.json', $pubs);
  flash('Publikace byla smazána.');
  header('Location: /admin/publications.php');
  exit;
}

// ── SAVE ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id      = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
  $type    = in_array($_POST['type'] ?? '', ['book','article']) ? $_POST['type'] : 'article';
  $title   = trim($_POST['title']       ?? '');
  $desc    = trim($_POST['description'] ?? '');
  $date    = trim($_POST['date']        ?? date('Y-m-d'));
  $link    = trim($_POST['link']        ?? '');
  $authors = array_filter(array_map('trim', explode("\n", $_POST['authors'] ?? '')));

  $record = compact('type','title','description','date','link') + ['description' => $desc, 'authors' => array_values($authors)];

  if ($id !== null) {
    foreach ($pubs as &$p) {
      if ($p['id'] === $id) { $p = array_merge($p, $record); break; }
    }
    unset($p);
    flash('Publikace byla uložena.');
  } else {
    $record['id'] = nextId($pubs);
    $pubs[] = $record;
    flash('Publikace byla vytvořena.');
  }

  writeJson('publications.json', array_values($pubs));
  header('Location: /admin/publications.php');
  exit;
}

$editing = null;
if (isset($_GET['edit'])) {
  foreach ($pubs as $p) {
    if ((string)$p['id'] === $_GET['edit']) { $editing = $p; break; }
  }
}
$isNew = isset($_GET['new']);

adminHeader('Publikace', 'publications');
?>

<?php if ($editing || $isNew): ?>
<div style="margin-bottom:1rem;">
  <a href="/admin/publications.php" class="btn btn--outline btn--sm">← Zpět</a>
</div>
<div class="card">
  <div class="card__title"><?= $editing ? 'Upravit publikaci' : 'Nová publikace' ?></div>
  <form method="POST">
    <?php if ($editing): ?><input type="hidden" name="id" value="<?= $editing['id'] ?>"><?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label>Typ *</label>
        <select name="type">
          <option value="article" <?= ($editing['type'] ?? 'article') === 'article' ? 'selected' : '' ?>>Odborný článek</option>
          <option value="book"    <?= ($editing['type'] ?? '') === 'book' ? 'selected' : '' ?>>Kniha</option>
        </select>
      </div>
      <div class="form-group">
        <label>Datum vydání</label>
        <input type="date" name="date" value="<?= htmlspecialchars($editing['date'] ?? date('Y-m-d')) ?>">
      </div>
      <div class="form-group form-full">
        <label>Název *</label>
        <input type="text" name="title" required value="<?= htmlspecialchars($editing['title'] ?? '') ?>" placeholder="Název publikace">
      </div>
      <div class="form-group form-full">
        <label>Popis</label>
        <textarea name="description" rows="4"><?= htmlspecialchars($editing['description'] ?? '') ?></textarea>
      </div>
      <div class="form-group">
        <label>Odkaz (URL nebo cesta)</label>
        <input type="text" name="link" value="<?= htmlspecialchars($editing['link'] ?? '') ?>" placeholder="https://... nebo /download/soubor.pdf">
      </div>
      <div class="form-group">
        <label>Autoři (jeden na řádek)</label>
        <textarea name="authors" rows="4"><?= htmlspecialchars(implode("\n", $editing['authors'] ?? [])) ?></textarea>
      </div>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:.5rem;">
      <button type="submit" class="btn btn--primary">Uložit</button>
      <a href="/admin/publications.php" class="btn btn--outline">Zrušit</a>
    </div>
  </form>
</div>

<?php else: ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
  <p style="color:var(--muted);font-size:.88rem;">Celkem <?= count($pubs) ?> publikací</p>
  <a href="/admin/publications.php?new=1" class="btn btn--primary">+ Nová publikace</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>#</th><th>Název</th><th>Typ</th><th>Autoři</th><th>Datum</th><th></th></tr>
      </thead>
      <tbody>
        <?php if (empty($pubs)): ?>
          <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--muted);">Žádné publikace.</td></tr>
        <?php endif; ?>
        <?php foreach (array_reverse($pubs) as $p): ?>
          <tr>
            <td style="color:var(--muted);"><?= $p['id'] ?></td>
            <td>
              <a href="/admin/publications.php?edit=<?= $p['id'] ?>" style="font-weight:600;"><?= htmlspecialchars($p['title']) ?></a>
            </td>
            <td>
              <span class="badge badge--<?= $p['type'] === 'book' ? 'book' : 'article' ?>">
                <?= $p['type'] === 'book' ? 'Kniha' : 'Článek' ?>
              </span>
            </td>
            <td style="font-size:.82rem;color:var(--muted);"><?= htmlspecialchars(implode(', ', array_slice($p['authors'] ?? [], 0, 2))) ?></td>
            <td><?= date('j.n.Y', strtotime($p['date'])) ?></td>
            <td style="white-space:nowrap;text-align:right;">
              <a href="/admin/publications.php?edit=<?= $p['id'] ?>" class="btn btn--sm btn--outline">Upravit</a>
              <a href="/admin/publications.php?delete=<?= $p['id'] ?>" class="btn btn--sm btn--danger" onclick="return confirm('Opravdu smazat?')">Smazat</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php adminFooter(); ?>
