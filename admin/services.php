<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

// Legal service areas shown on the Services page, the homepage teaser grid
// (first 6), the contact form and as related services under articles.

$services = elServices();

function saveServices(array $services): void {
  writeJson('services.json', array_values($services));
}

function serviceIndex(array $services, string $id): ?int {
  foreach ($services as $i => $s) {
    if ($s['id'] === $id) return $i;
  }
  return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();
  $action = $_POST['action'] ?? 'save';
  $id     = $_POST['id'] ?? '';
  $idx    = serviceIndex($services, $id);

  if ($action === 'delete' && $idx !== null) {
    array_splice($services, $idx, 1);
    saveServices($services);
    flash('Služba byla smazána.');
  } elseif (($action === 'up' || $action === 'down') && $idx !== null) {
    $to = $action === 'up' ? $idx - 1 : $idx + 1;
    if ($to >= 0 && $to < count($services)) {
      [$services[$idx], $services[$to]] = [$services[$to], $services[$idx]];
      saveServices($services);
    }
  } elseif ($action === 'save') {
    $record = array_merge(
      langPostScalar('label'),
      langPostScalar('desc'),
      langPostList('bullets')
    );
    if ($record['label'] === '') {
      flash('Název služby je povinný.', 'error');
      header('Location: /admin/services.php?' . ($idx !== null ? 'edit=' . urlencode($id) : 'new=1'));
      exit;
    }
    if ($idx !== null) {
      $services[$idx] = ['id' => $id] + $record;
      flash('Služba byla uložena.');
    } else {
      $newId = slugify($record['label']) ?: 'sluzba';
      $base  = $newId;
      for ($n = 2; serviceIndex($services, $newId) !== null; $n++) $newId = $base . '-' . $n;
      $services[] = ['id' => $newId] + $record;
      flash('Služba byla přidána.');
    }
    saveServices($services);
  }
  header('Location: /admin/services.php');
  exit;
}

$editing = null;
if (isset($_GET['edit'])) {
  $i = serviceIndex($services, (string)$_GET['edit']);
  if ($i !== null) $editing = $services[$i];
}
$isNew = isset($_GET['new']);

adminHeader('Právní služby', 'services');
?>

<?php if ($editing || $isNew): ?>
<div style="margin-bottom:1rem;">
  <a href="/admin/services.php" class="btn btn--outline btn--sm">← Zpět na seznam</a>
</div>
<div class="card">
  <div class="card__title"><?= $editing ? 'Upravit službu' : 'Nová služba' ?></div>
  <form method="POST">
    <?= csrfField() ?>
    <input type="hidden" name="action" value="save">
    <?php if ($editing): ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($editing['id']) ?>">
      <p class="form-hint" style="margin:-.25rem 0 1rem;">Odkaz na službu: <code>/sluzby#<?= htmlspecialchars($editing['id']) ?></code></p>
    <?php endif; ?>

    <?php langSwitch(); ?>

    <?php langInput('label', 'Název služby *', $editing ?? []); ?>
    <?php langTextarea('desc', 'Krátký popis', $editing ?? [], 3, 'Zobrazuje se na stránce Právní služby a v dlaždici na úvodní stránce.'); ?>
    <?php langListTextarea('bullets', 'Co zahrnuje (jedna položka na řádek)', $editing ?? [], 6); ?>

    <div style="display:flex;gap:.75rem;margin-top:.5rem;">
      <button type="submit" class="btn btn--primary">Uložit službu</button>
      <a href="/admin/services.php" class="btn btn--outline">Zrušit</a>
    </div>
  </form>
</div>

<?php else: ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;gap:1rem;flex-wrap:wrap;">
  <p style="color:var(--muted);font-size:.88rem;">Celkem <?= count($services) ?> služeb. Prvních 6 se zobrazuje na úvodní stránce.</p>
  <a href="/admin/services.php?new=1" class="btn btn--primary">+ Nová služba</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>#</th><th>Název</th><th>Překlady</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($services as $i => $s): ?>
          <tr>
            <td style="color:var(--muted);"><?= $i + 1 ?></td>
            <td>
              <a href="/admin/services.php?edit=<?= urlencode($s['id']) ?>" style="font-weight:600;"><?= htmlspecialchars($s['label']) ?></a>
              <?php if ($i < 6): ?><span class="badge badge--article" style="margin-left:.4rem;">úvodní stránka</span><?php endif; ?>
            </td>
            <td style="font-size:.78rem;color:var(--muted);white-space:nowrap;">
              EN <?= !empty($s['label_en']) ? '✓' : '—' ?> · DE <?= !empty($s['label_de']) ? '✓' : '—' ?>
            </td>
            <td style="white-space:nowrap;text-align:right;">
              <form method="POST" style="display:inline;">
                <?= csrfField() ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($s['id']) ?>">
                <button type="submit" name="action" value="up" class="btn btn--sm btn--outline" <?= $i === 0 ? 'disabled' : '' ?> aria-label="Posunout nahoru">↑</button>
                <button type="submit" name="action" value="down" class="btn btn--sm btn--outline" <?= $i === count($services) - 1 ? 'disabled' : '' ?> aria-label="Posunout dolů">↓</button>
              </form>
              <a href="/admin/services.php?edit=<?= urlencode($s['id']) ?>" class="btn btn--sm btn--outline">Upravit</a>
              <form method="POST" style="display:inline;" onsubmit="return confirm('Opravdu smazat tuto službu?');">
                <?= csrfField() ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($s['id']) ?>">
                <button type="submit" name="action" value="delete" class="btn btn--sm btn--danger">Smazat</button>
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
