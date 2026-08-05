<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  requireCsrf();

  $email = trim($_POST['email'] ?? '');
  if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'E-mail nemá platný formát.';
  }

  if (empty($errors)) {
    $settings = [
      'company_name'    => trim($_POST['company_name'] ?? ''),
      'address_street'  => trim($_POST['address_street'] ?? ''),
      'address_city'    => trim($_POST['address_city'] ?? ''),
      'address_country' => trim($_POST['address_country'] ?? ''),
      'ico'             => trim($_POST['ico'] ?? ''),
      'dic'             => trim($_POST['dic'] ?? ''),
      'databox'         => trim($_POST['databox'] ?? ''),
      'phone'           => trim($_POST['phone'] ?? ''),
      'email'           => $email,
      'hours'           => trim($_POST['hours'] ?? ''),
      'map_url'         => trim($_POST['map_url'] ?? ''),
      'map_lat'         => trim($_POST['map_lat'] ?? ''),
      'map_lng'         => trim($_POST['map_lng'] ?? ''),
      'social_youtube'  => trim($_POST['social_youtube'] ?? ''),
      'social_linkedin' => trim($_POST['social_linkedin'] ?? ''),
      'social_facebook' => trim($_POST['social_facebook'] ?? ''),
      'footer_text'     => trim($_POST['footer_text'] ?? ''),
      'bar_membership'  => trim($_POST['bar_membership'] ?? ''),
    ];
    writeJson('settings.json', $settings);
    flash('Nastavení bylo uloženo a projeví se ihned na webu.');
    header('Location: /admin/settings.php');
    exit;
  }
}

$s = elSettings();
adminHeader('Kontakty a nastavení', 'settings');
?>

<?php if (!empty($errors)): ?>
  <div class="alert alert--error"><?= htmlspecialchars(implode(' ', $errors)) ?></div>
<?php endif; ?>

<form method="POST">
  <?= csrfField() ?>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Základní údaje</div>
    <div class="form-group">
      <label for="company_name">Název kanceláře</label>
      <input type="text" id="company_name" name="company_name" value="<?= htmlspecialchars($s['company_name']) ?>">
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="address_street">Ulice a číslo</label>
        <input type="text" id="address_street" name="address_street" value="<?= htmlspecialchars($s['address_street']) ?>">
      </div>
      <div class="form-group">
        <label for="address_city">Město a PSČ</label>
        <input type="text" id="address_city" name="address_city" value="<?= htmlspecialchars($s['address_city']) ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="address_country">Země</label>
      <input type="text" id="address_country" name="address_country" value="<?= htmlspecialchars($s['address_country']) ?>">
    </div>
  </div>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Fakturační údaje</div>
    <div class="form-row">
      <div class="form-group">
        <label for="ico">IČO</label>
        <input type="text" id="ico" name="ico" value="<?= htmlspecialchars($s['ico']) ?>">
      </div>
      <div class="form-group">
        <label for="dic">DIČ <span style="font-weight:400;">(nepovinné)</span></label>
        <input type="text" id="dic" name="dic" value="<?= htmlspecialchars($s['dic']) ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="databox">ID datové schránky</label>
      <input type="text" id="databox" name="databox" value="<?= htmlspecialchars($s['databox']) ?>">
    </div>
    <div class="form-group">
      <label for="bar_membership">Členství (např. Česká advokátní komora)</label>
      <input type="text" id="bar_membership" name="bar_membership" value="<?= htmlspecialchars($s['bar_membership']) ?>">
    </div>
  </div>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Kontakt</div>
    <div class="form-row">
      <div class="form-group">
        <label for="phone">Telefon</label>
        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($s['phone']) ?>">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($s['email']) ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="hours">Konzultační / otevírací doba <span style="font-weight:400;">(nepovinné)</span></label>
      <input type="text" id="hours" name="hours" value="<?= htmlspecialchars($s['hours']) ?>" placeholder="Po–Pá 9:00–17:00">
    </div>
  </div>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Mapa</div>
    <div class="form-group">
      <label for="map_url">Odkaz na mapu (Google Maps apod.)</label>
      <input type="url" id="map_url" name="map_url" value="<?= htmlspecialchars($s['map_url']) ?>">
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="map_lat">Zeměpisná šířka</label>
        <input type="text" id="map_lat" name="map_lat" value="<?= htmlspecialchars($s['map_lat']) ?>">
      </div>
      <div class="form-group">
        <label for="map_lng">Zeměpisná délka</label>
        <input type="text" id="map_lng" name="map_lng" value="<?= htmlspecialchars($s['map_lng']) ?>">
      </div>
    </div>
  </div>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Sociální sítě</div>
    <div class="form-group">
      <label for="social_youtube">YouTube</label>
      <input type="url" id="social_youtube" name="social_youtube" value="<?= htmlspecialchars($s['social_youtube']) ?>">
    </div>
    <div class="form-group">
      <label for="social_linkedin">LinkedIn</label>
      <input type="url" id="social_linkedin" name="social_linkedin" value="<?= htmlspecialchars($s['social_linkedin']) ?>">
    </div>
    <div class="form-group">
      <label for="social_facebook">Facebook</label>
      <input type="url" id="social_facebook" name="social_facebook" value="<?= htmlspecialchars($s['social_facebook']) ?>">
    </div>
  </div>

  <div class="card" style="margin-bottom:1.5rem;">
    <div class="card__title">Text v patičce</div>
    <div class="form-group">
      <label for="footer_text">Krátký popis kanceláře v patičce webu</label>
      <textarea id="footer_text" name="footer_text" rows="3"><?= htmlspecialchars($s['footer_text']) ?></textarea>
    </div>
  </div>

  <button type="submit" class="btn btn--primary">Uložit a publikovat</button>
</form>

<?php adminFooter(); ?>
