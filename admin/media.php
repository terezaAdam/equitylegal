<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
require_once __DIR__ . '/includes/media-upload.php';
requireAuth();

$media = readJson('media.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
  requireCsrf();
  $result = saveUploadedImage($_FILES['image'], $_POST['alt'] ?? '');
  if (isset($result['error'])) {
    flash($result['error'], 'error');
  } else {
    flash('Obrázek byl nahrán.');
  }
  header('Location: /admin/media.php');
  exit;
}

if (isset($_POST['delete_id'])) {
  requireCsrf();
  $delId = (int)$_POST['delete_id'];
  $item = null;
  foreach ($media as $m) { if ($m['id'] === $delId) { $item = $m; break; } }
  if ($item) {
    $path = UPLOAD_DIR . basename($item['file']);
    if (is_file($path)) @unlink($path);
    $media = array_values(array_filter($media, fn($m) => $m['id'] !== $delId));
    writeJson('media.json', $media);
    flash('Obrázek byl smazán.');
  }
  header('Location: /admin/media.php');
  exit;
}

adminHeader('Média', 'media');
?>

<div class="card" style="margin-bottom:1.5rem;">
  <div class="card__title">Nahrát nový obrázek</div>
  <form method="POST" enctype="multipart/form-data">
    <?= csrfField() ?>
    <div class="form-row">
      <div class="form-group">
        <label for="image">Soubor (JPG, PNG, WebP, GIF, max 5 MB)</label>
        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/gif" required>
      </div>
      <div class="form-group">
        <label for="alt">Alternativní text</label>
        <input type="text" id="alt" name="alt" placeholder="Popis obrázku pro přístupnost a SEO">
      </div>
    </div>
    <button type="submit" class="btn btn--primary">Nahrát</button>
  </form>
</div>

<div class="card">
  <div class="card__title">Knihovna médií (<?= count($media) ?>)</div>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;">
    <?php foreach (array_reverse($media) as $m): ?>
      <div style="border:1px solid var(--border);border-radius:8px;overflow:hidden;">
        <img src="<?= htmlspecialchars($m['url']) ?>" alt="<?= htmlspecialchars($m['alt']) ?>" style="width:100%;height:110px;object-fit:cover;display:block;">
        <div style="padding:.5rem;font-size:.75rem;">
          <div style="word-break:break-all;color:var(--muted);margin-bottom:.4rem;"><?= htmlspecialchars($m['file']) ?></div>
          <div style="display:flex;gap:.4rem;">
            <button type="button" class="btn btn--outline btn--sm" style="flex:1;" onclick="navigator.clipboard.writeText('<?= htmlspecialchars($m['url'], ENT_QUOTES) ?>')">Kopírovat cestu</button>
          </div>
          <form method="POST" onsubmit="return confirm('Opravdu smazat tento obrázek? Tuto akci nelze vrátit zpět.');" style="margin-top:.4rem;">
            <?= csrfField() ?>
            <input type="hidden" name="delete_id" value="<?= $m['id'] ?>">
            <button type="submit" class="btn btn--sm" style="width:100%;color:#b02a37;border:1px solid #b02a37;background:#fff;">Smazat</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (empty($media)): ?>
      <p style="color:var(--muted);">Zatím nebyly nahrány žádné obrázky.</p>
    <?php endif; ?>
  </div>
</div>

<?php adminFooter(); ?>
