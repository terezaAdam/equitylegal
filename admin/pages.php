<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
require_once __DIR__ . '/includes/rich-editor.php';
requireAuth();
require_once __DIR__ . '/../includes/data.php';

$validPages = ['home', 'sluzby', 'tym', 'ochrana'];
$pageNames  = ['home' => 'Domovská stránka', 'sluzby' => 'Právní služby', 'tym' => 'Náš tým', 'ochrana' => 'Ochrana osobních údajů'];
$current    = $_GET['page'] ?? 'home';
if (!in_array($current, $validPages, true)) $current = 'home';

// Base (Czech) field names per page — the _en/_de variants are derived from these.
$baseFields = [
  'home'   => ['hero_label', 'hero_title', 'hero_desc', 'hero_image', 'about_title', 'about_text1', 'about_text2', 'about_text3', 'about_image', 'cta_title', 'cta_text'],
  'sluzby' => ['hero_label', 'hero_title', 'hero_desc'],
  'tym'    => ['hero_label', 'hero_title', 'hero_desc'],
  'ochrana'=> ['hero_title', 'hero_desc', 'content'],
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
    if ($postedPage === 'home') {
      $record['reviews'] = [];
      foreach ((array)($_POST['reviews'] ?? []) as $r) {
        $review = [
          'name'    => trim($r['name'] ?? ''),
          'text'    => trim($r['text'] ?? ''),
          'text_en' => trim($r['text_en'] ?? ''),
          'text_de' => trim($r['text_de'] ?? ''),
        ];
        if (empty($r['delete']) && ($review['name'] !== '' || $review['text'] !== '')) {
          $record['reviews'][] = $review;
        }
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
    <?php if ($current !== 'ochrana'): ?>
      <?php langInput('hero_label', 'Krátký popisek nad nadpisem', $data); ?>
    <?php endif; ?>
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
      <div class="card__title">Recenze klientů</div>
      <p class="form-hint" style="margin:-.25rem 0 1rem;">Pro odebrání recenze zaškrtněte „Smazat“ a uložte. Novou recenzi přidáte vyplněním prázdného bloku na konci.</p>
      <?php
        $reviews   = array_values($data['reviews'] ?? []);
        $reviews[] = ['name' => '', 'text' => '', 'text_en' => '', 'text_de' => ''];
        foreach ($reviews as $i => $r):
          $isBlank = $i === count($reviews) - 1;
      ?>
        <div class="review-block">
          <div class="review-block__head">
            <strong><?= $isBlank ? 'Nová recenze' : 'Recenze ' . ($i + 1) ?></strong>
            <?php if (!$isBlank): ?>
              <label class="review-block__delete"><input type="checkbox" name="reviews[<?= $i ?>][delete]" value="1"> Smazat</label>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Jméno klienta</label>
            <input type="text" name="reviews[<?= $i ?>][name]" value="<?= htmlspecialchars($r['name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Text recenze</label>
            <?php foreach (EL_ADMIN_LOCALES as $code => $langLabel): $f = $code === 'cs' ? 'text' : 'text_' . $code; ?>
              <div class="lang-field" data-lang="<?= $code ?>"<?= $code !== 'cs' ? ' hidden' : '' ?>>
                <?php if ($code !== 'cs'): ?><span class="lang-field-label"><?= $langLabel ?></span><?php endif; ?>
                <textarea name="reviews[<?= $i ?>][<?= $f ?>]" rows="3"><?= htmlspecialchars($r[$f] ?? '') ?></textarea>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="card" style="margin-bottom:1.5rem;">
      <div class="card__title">Závěrečná výzva ke kontaktu</div>
      <?php langInput('cta_title', 'Nadpis', $data); ?>
      <?php langInput('cta_text', 'Text', $data); ?>
    </div>
  <?php endif; ?>

  <?php if ($current === 'ochrana'): ?>
    <div class="card" style="margin-bottom:1.5rem;">
      <div class="card__title">Text zásad</div>
      <?php langTextarea('content', 'Obsah stránky', $data, 30, 'Nadpisy, odrážky a odkazy nastavíte tlačítky v liště editoru. Nezapomeňte upravit i datum poslední aktualizace na konci textu.'); ?>
    </div>
  <?php endif; ?>

  <button type="submit" class="btn btn--primary">Uložit a publikovat</button>
</form>

<?php if ($current === 'ochrana') richEditor('content'); ?>

<?php adminFooter(); ?>
