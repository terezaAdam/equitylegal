<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();
require_once __DIR__ . '/../includes/data.php';

$validPages = ['home', 'sluzby', 'tym'];
$pageNames  = ['home' => 'Domovská stránka', 'sluzby' => 'Právní služby', 'tym' => 'Náš tým'];
$current    = $_GET['page'] ?? 'home';
if (!in_array($current, $validPages, true)) $current = 'home';

// Base (Czech) field names per page — the _en/_de variants are derived from these.
$baseFields = [
  'home'   => ['hero_label', 'hero_title', 'hero_desc', 'hero_image', 'about_title', 'about_text1', 'about_text2', 'about_text3', 'about_image', 'cta_title', 'cta_text'],
  'sluzby' => ['hero_label', 'hero_title', 'hero_desc'],
  'tym'    => ['hero_label', 'hero_title', 'hero_desc'],
];
$nonTranslatable = ['hero_image', 'about_image'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();
  $postedPage = $_POST['page'] ?? '';
  if (in_array($postedPage, $validPages, true)) {
    $all = readJson('pages.json');
    $record = [];
    foreach ($baseFields[$postedPage] as $f) {
      if (in_array($f, $nonTranslatable, true)) {
        $record[$f] = trim($_POST[$f] ?? '');
      } else {
        $record += langPostScalar($f);
      }
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

  <?php langSwitch(); ?>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Úvodní sekce</div>
    <?php langInput('hero_label', 'Krátký popisek nad nadpisem', $data); ?>
    <?php langInput('hero_title', 'Hlavní nadpis', $data, '', $current === 'home' ? 'Část textu lze zvýraznit značkami &lt;em&gt;…&lt;/em&gt;, stejně jako je tomu teď.' : ''); ?>
    <?php langTextarea('hero_desc', 'Úvodní text', $data, 3); ?>
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
      <?php langInput('about_title', 'Nadpis', $data); ?>
      <?php langTextarea('about_text1', 'Text – odstavec 1', $data, 3); ?>
      <?php langTextarea('about_text2', 'Text – odstavec 2', $data, 3); ?>
      <?php langTextarea('about_text3', 'Text – odstavec 3', $data, 2); ?>
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
      <?php langInput('cta_title', 'Nadpis', $data); ?>
      <?php langInput('cta_text', 'Text', $data); ?>
    </div>
  <?php endif; ?>

  <button type="submit" class="btn btn--primary">Uložit a publikovat</button>
</form>

<?php adminFooter(); ?>
