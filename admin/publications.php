<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

$pubs = readJson('publications.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  requireCsrf();
  $delId = (int)$_POST['delete_id'];
  $pubs = array_values(array_filter($pubs, fn($p) => $p['id'] !== $delId));
  writeJson('publications.json', $pubs);
  flash('Publikace byla smazána.');
  header('Location: /admin/publications.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();
  $id      = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
  $type    = in_array($_POST['type'] ?? '', ['book','article']) ? $_POST['type'] : 'article';
  $date    = trim($_POST['date']        ?? date('Y-m-d'));
  $link    = trim($_POST['link']        ?? '');
  $authors = array_filter(array_map('trim', explode("\n", $_POST['authors'] ?? '')));

  $record = array_merge(
    ['type' => $type, 'date' => $date, 'link' => $link, 'authors' => array_values($authors)],
    langPostScalar('title'),
    langPostScalar('description')
  );

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
    <?= csrfField() ?>
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
      <div class="form-group">
        <label>Odkaz (URL nebo cesta)</label>
        <input type="text" name="link" value="<?= htmlspecialchars($editing['link'] ?? '') ?>" placeholder="https://... nebo /download/soubor.pdf">
      </div>
      <div class="form-group form-full">
        <label>Autoři (jeden na řádek)</label>
        <div class="form-hint">Jména autorů se nepřekládají, jsou stejná pro všechny jazykové mutace.</div>
        <textarea name="authors" rows="4"><?= htmlspecialchars(implode("\n", $editing['authors'] ?? [])) ?></textarea>
      </div>
    </div>

    <?php langSwitch(); ?>

    <div class="form-grid">
      <?php langInput('title', 'Název *', $editing ?? [], 'Název publikace'); ?>
      <?php langTextarea('description', 'Popis', $editing ?? [], 4); ?>
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
              <form method="POST" style="display:inline;" onsubmit="return confirm('Opravdu smazat?');">
                <?= csrfField() ?>
                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($p['id']) ?>">
                <button type="submit" class="btn btn--sm btn--danger">Smazat</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php adminFooter(); ?>
