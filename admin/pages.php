<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();
require_once __DIR__ . '/../includes/data.php';

$validPages = ['home', 'sluzby', 'tym'];
$pageNames  = ['home' => 'Domovská stránka', 'sluzby' => 'Právní služby', 'tym' => 'Náš tým'];
$current    = $_GET['page'] ?? 'home';
if (!in_array($current, $validPages, true)) $current = 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();
  $postedPage = $_POST['page'] ?? '';
  if (in_array($postedPage, $validPages, true)) {
    $all = readJson('pages.json');
    $fields = array_keys(elPage($postedPage));
    $record = [];
    foreach ($fields as $f) {
      $record[$f] = trim($_POST[$f] ?? '');
    }
    $all[$postedPage] = $record;
    writeJson('pages.json', $all);
    flash('Stránka „' . $pageNames[$postedPage] . '“ byla uložena a je ihned vidět na webu.');
  }
  header('Location: /admin/pages.php?page=' . urlencode($postedPage));
  exit;
}

$data  = elPage($current);
$media = readJson('media.json');

adminHeader('Stránky', 'pages');
?>

<div style="display:flex;gap:.5rem;margin-bottom:1.5rem;flex-wrap:wrap;">
  <?php foreach ($pageNames as $key => $label): ?>
    <a href="/admin/pages.php?page=<?= $key ?>" class="btn btn--sm <?= $current === $key ? 'btn--primary' : 'btn--outline' ?>"><?= htmlspecialchars($label) ?></a>
  <?php endforeach; ?>
</div>

<form method="POST">
  <?= csrfField() ?>
  <input type="hidden" name="page" value="<?= htmlspecialchars($current) ?>">

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Úvodní sekce</div>
    <div class="form-group">
      <label for="hero_label">Krátký popisek nad nadpisem</label>
      <input type="text" id="hero_label" name="hero_label" value="<?= htmlspecialchars($data['hero_label']) ?>">
    </div>
    <div class="form-group">
      <label for="hero_title">Hlavní nadpis</label>
      <input type="text" id="hero_title" name="hero_title" value="<?= htmlspecialchars($data['hero_title']) ?>">
      <?php if ($current === 'home'): ?>
        <p style="font-size:.78rem;color:var(--muted);margin-top:.3rem;">Část textu lze zvýraznit značkami &lt;em&gt;…&lt;/em&gt;, stejně jako je tomu teď.</p>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <label for="hero_desc">Úvodní text</label>
      <textarea id="hero_desc" name="hero_desc" rows="3"><?= htmlspecialchars($data['hero_desc']) ?></textarea>
    </div>
    <?php if ($current === 'home'): ?>
      <div class="form-group">
        <label for="hero_image">Hlavní obrázek</label>
        <select id="hero_image" name="hero_image">
          <?php $found = false; foreach ($media as $m): $val = ltrim($m['url'], '/'); if ($val === $data['hero_image']) $found = true; ?>
            <option value="<?= htmlspecialchars($val) ?>" <?= $val === $data['hero_image'] ? 'selected' : '' ?>><?= htmlspecialchars($m['file']) ?></option>
          <?php endforeach; ?>
          <?php if (!$found): ?>
            <option value="<?= htmlspecialchars($data['hero_image']) ?>" selected><?= htmlspecialchars($data['hero_image']) ?> (aktuální)</option>
          <?php endif; ?>
        </select>
        <p style="font-size:.78rem;color:var(--muted);margin-top:.3rem;">Nový obrázek nejdřív nahrajte v sekci <a href="/admin/media.php">Média</a>.</p>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($current === 'home'): ?>
    <div class="card" style="margin-bottom:1.5rem;">
      <div class="card__title">Sekce „O nás“</div>
      <div class="form-group">
        <label for="about_title">Nadpis</label>
        <input type="text" id="about_title" name="about_title" value="<?= htmlspecialchars($data['about_title']) ?>">
      </div>
      <div class="form-group">
        <label for="about_text1">Text – odstavec 1</label>
        <textarea id="about_text1" name="about_text1" rows="3"><?= htmlspecialchars($data['about_text1']) ?></textarea>
      </div>
      <div class="form-group">
        <label for="about_text2">Text – odstavec 2</label>
        <textarea id="about_text2" name="about_text2" rows="3"><?= htmlspecialchars($data['about_text2']) ?></textarea>
      </div>
      <div class="form-group">
        <label for="about_text3">Text – odstavec 3</label>
        <textarea id="about_text3" name="about_text3" rows="2"><?= htmlspecialchars($data['about_text3']) ?></textarea>
      </div>
      <div class="form-group">
        <label for="about_image">Obrázek kanceláře</label>
        <select id="about_image" name="about_image">
          <?php $found = false; foreach ($media as $m): $val = ltrim($m['url'], '/'); if ($val === $data['about_image']) $found = true; ?>
            <option value="<?= htmlspecialchars($val) ?>" <?= $val === $data['about_image'] ? 'selected' : '' ?>><?= htmlspecialchars($m['file']) ?></option>
          <?php endforeach; ?>
          <?php if (!$found): ?>
            <option value="<?= htmlspecialchars($data['about_image']) ?>" selected><?= htmlspecialchars($data['about_image']) ?> (aktuální)</option>
          <?php endif; ?>
        </select>
      </div>
    </div>

    <div class="card" style="margin-bottom:1.5rem;">
      <div class="card__title">Závěrečná výzva ke kontaktu</div>
      <div class="form-group">
        <label for="cta_title">Nadpis</label>
        <input type="text" id="cta_title" name="cta_title" value="<?= htmlspecialchars($data['cta_title']) ?>">
      </div>
      <div class="form-group">
        <label for="cta_text">Text</label>
        <input type="text" id="cta_text" name="cta_text" value="<?= htmlspecialchars($data['cta_text']) ?>">
      </div>
    </div>
  <?php endif; ?>

  <button type="submit" class="btn btn--primary">Uložit a publikovat</button>
</form>

<?php adminFooter(); ?>
