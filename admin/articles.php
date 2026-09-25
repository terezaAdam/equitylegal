<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
require_once __DIR__ . '/includes/image-picker.php';
require_once __DIR__ . '/includes/rich-editor.php';
requireAuth();

$articles = readJson('articles.json');
$allServices = elServices();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  requireCsrf();
  $delId = (int)$_POST['delete_id'];
  $articles = array_values(array_filter($articles, fn($a) => $a['id'] !== $delId));
  writeJson('articles.json', $articles);
  flash('Článek byl smazán.');
  header('Location: /admin/articles.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();
  $id       = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
  $title    = trim($_POST['title']    ?? '');
  $slug     = trim($_POST['slug']     ?? '') ?: slugify($title);
  $category = trim($_POST['category'] ?? '');
  $date     = trim($_POST['date']     ?? date('Y-m-d'));
  $author   = trim($_POST['author']   ?? '');
  $services = array_values((array)($_POST['services'] ?? []));
  $imageFit = ($_POST['imageFit'] ?? '') === 'contain' ? 'contain' : 'cover';

  ['image' => $image, 'error' => $uploadError] = imagePickerPost($title);

  $record = array_merge(
    compact('slug', 'category', 'date', 'author', 'services', 'image', 'imageFit'),
    langPostScalar('title'),
    langPostScalar('excerpt'),
    langPostScalar('content')
  );

  if ($id !== null) {
    // Update
    foreach ($articles as &$a) {
      if ($a['id'] === $id) {
        $a = array_merge($a, $record);
        break;
      }
    }
    unset($a);
    $msg = 'Článek byl uložen.';
  } else {
    // Create
    $record['id'] = nextId($articles);
    $articles[] = $record;
    $msg = 'Článek byl vytvořen.';
  }

  writeJson('articles.json', array_values($articles));
  if ($uploadError) {
    flash($msg . ' Obrázek se ale nepodařilo nahrát: ' . $uploadError, 'error');
  } else {
    flash($msg);
  }
  header('Location: /admin/articles.php');
  exit;
}

$editing = null;
if (isset($_GET['edit'])) {
  foreach ($articles as $a) {
    if ((string)$a['id'] === $_GET['edit']) { $editing = $a; break; }
  }
}
$isNew = isset($_GET['new']);

$categories = ['Řešené případy', 'Aktuality'];

adminHeader('Blog / Články', 'articles');
?>

<?php if ($editing || $isNew): ?>
<div style="margin-bottom:1rem;">
  <a href="/admin/articles.php" class="btn btn--outline btn--sm">← Zpět na seznam</a>
</div>
<div class="card">
  <div class="card__title"><?= $editing ? 'Upravit článek' : 'Nový článek' ?></div>
  <form method="POST" enctype="multipart/form-data">
    <?= csrfField() ?>
    <?php if ($editing): ?>
      <input type="hidden" name="id" value="<?= $editing['id'] ?>">
    <?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label>URL slug</label>
        <input type="text" name="slug" value="<?= htmlspecialchars($editing['slug'] ?? '') ?>" placeholder="generuje-se-automaticky">
        <div class="form-hint">Ponechte prázdné pro automatické generování z názvu. Stejný pro všechny jazykové mutace.</div>
      </div>
      <div class="form-group">
        <label>Kategorie *</label>
        <select name="category">
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat ?>" <?= ($editing['category'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Datum</label>
        <input type="date" name="date" value="<?= htmlspecialchars($editing['date'] ?? date('Y-m-d')) ?>">
      </div>
      <div class="form-group">
        <label>Autor</label>
        <input type="text" name="author" value="<?= htmlspecialchars($editing['author'] ?? '') ?>" placeholder="Jméno autora">
      </div>
      <?php imagePicker('Náhledový obrázek', $editing['image'] ?? '', $editing['imageFit'] ?? 'cover'); ?>
      <div class="form-group form-full">
        <label>Související služby</label>
        <div class="form-hint">Zobrazí se jako prolinky v postranním panelu u článku. Nevyberete-li nic, zobrazí se obecný odkaz na Právní služby.</div>
        <div class="check-grid">
          <?php $editingServices = $editing['services'] ?? []; ?>
          <?php foreach ($allServices as $svc): ?>
            <label class="check-item">
              <input type="checkbox" name="services[]" value="<?= htmlspecialchars($svc['id']) ?>" <?= in_array($svc['id'], $editingServices, true) ? 'checked' : '' ?>>
              <?= htmlspecialchars($svc['label']) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <?php langSwitch(); ?>

    <div class="form-grid">
      <?php langInput('title', 'Název článku *', $editing ?? [], 'Název případu nebo článku'); ?>
      <?php langTextarea('excerpt', 'Perex (krátký popis)', $editing ?? [], 3, 'Krátký popis článku zobrazovaný v přehledu.'); ?>
      <?php langTextarea('content', 'Obsah článku', $editing ?? [], 20, 'Nadpisy, tučné písmo, odrážky a odkazy nastavíte tlačítky v liště editoru.'); ?>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:.5rem;">
      <button type="submit" class="btn btn--primary">Uložit článek</button>
      <a href="/admin/articles.php" class="btn btn--outline">Zrušit</a>
      <?php if ($editing): ?>
        <a href="/pripady.php?clanek=<?= urlencode($editing['slug']) ?>" target="_blank" class="btn btn--outline">Náhled na webu →</a>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php richEditor('content', 'Odstavec=p; Nadpis=h3'); ?>

<?php else: ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
  <p style="color:var(--muted);font-size:.88rem;">Celkem <?= count($articles) ?> článků / případů</p>
  <a href="/admin/articles.php?new=1" class="btn btn--primary">+ Nový článek</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Název</th>
          <th>Kategorie</th>
          <th>Autor</th>
          <th>Datum</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($articles)): ?>
          <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--muted);">
            Žádné články. <a href="/admin/articles.php?new=1">Vytvořte první</a>.
          </td></tr>
        <?php endif; ?>
        <?php foreach (array_reverse($articles) as $a): ?>
          <tr>
            <td style="color:var(--muted);"><?= $a['id'] ?></td>
            <td>
              <a href="/admin/articles.php?edit=<?= $a['id'] ?>" style="font-weight:600;"><?= htmlspecialchars($a['title']) ?></a>
              <?php if (!empty($a['slug'])): ?>
                <div style="font-size:.75rem;color:var(--muted);">/<?= htmlspecialchars($a['slug']) ?></div>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($a['category']) ?></td>
            <td style="font-size:.82rem;color:var(--muted);"><?= htmlspecialchars($a['author'] ?? '—') ?></td>
            <td style="white-space:nowrap;"><?= date('j.n.Y', strtotime($a['date'])) ?></td>
            <td style="white-space:nowrap;text-align:right;">
              <a href="/admin/articles.php?edit=<?= $a['id'] ?>" class="btn btn--sm btn--outline">Upravit</a>
              <a href="/pripady.php?clanek=<?= urlencode($a['slug']) ?>" target="_blank" class="btn btn--sm btn--outline">↗</a>
              <form method="POST" style="display:inline;" onsubmit="return confirm('Opravdu smazat?');">
                <?= csrfField() ?>
                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($a['id']) ?>">
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
