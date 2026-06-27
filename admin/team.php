<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';
requireAuth();

$team = readJson('team.json');

// ── DELETE ──
if (isset($_GET['delete'])) {
  $delId = $_GET['delete'];
  $team = array_values(array_filter($team, fn($m) => $m['id'] !== $delId));
  writeJson('team.json', $team);
  flash('Člen týmu byl smazán.');
  header('Location: /admin/team.php');
  exit;
}

// ── SAVE ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $origId = trim($_POST['orig_id'] ?? '');
  $id     = trim($_POST['id']      ?? '') ?: slugify($_POST['name'] ?? '');
  $name   = trim($_POST['name']    ?? '');
  $pos    = trim($_POST['position'] ?? '');
  $photo  = trim($_POST['photo']   ?? '');
  $email  = trim($_POST['email']   ?? '');
  $phone  = trim($_POST['phone']   ?? '');
  $bio    = trim($_POST['bio']     ?? '');
  $langs  = array_filter(array_map('trim', explode(',', $_POST['languages'] ?? '')));
  $specs  = array_filter(array_map('trim', explode("\n", $_POST['specializations'] ?? '')));
  $projs  = array_filter(array_map('trim', explode("\n", $_POST['projects'] ?? '')));

  $record = [
    'id'              => $id,
    'name'            => $name,
    'position'        => $pos,
    'photo'           => $photo,
    'email'           => $email,
    'phone'           => $phone,
    'languages'       => array_values(array_map('strtoupper', $langs)),
    'bio'             => $bio,
    'specializations' => array_values($specs),
    'projects'        => array_values($projs),
  ];

  $found = false;
  foreach ($team as &$m) {
    if ($m['id'] === $origId) { $m = $record; $found = true; break; }
  }
  unset($m);

  if (!$found) {
    $team[] = $record;
    flash('Člen týmu byl přidán.');
  } else {
    flash('Člen týmu byl uložen.');
  }

  writeJson('team.json', array_values($team));
  header('Location: /admin/team.php');
  exit;
}

$editing = null;
if (isset($_GET['edit'])) {
  foreach ($team as $m) {
    if ($m['id'] === $_GET['edit']) { $editing = $m; break; }
  }
}
$isNew = isset($_GET['new']);

adminHeader('Náš tým', 'team');
?>

<?php if ($editing || $isNew): ?>
<div style="margin-bottom:1rem;">
  <a href="/admin/team.php" class="btn btn--outline btn--sm">← Zpět</a>
</div>
<div class="card">
  <div class="card__title"><?= $editing ? 'Upravit člena týmu' : 'Přidat člena týmu' ?></div>
  <form method="POST">
    <input type="hidden" name="orig_id" value="<?= htmlspecialchars($editing['id'] ?? '') ?>">

    <div class="form-grid">
      <div class="form-group form-full">
        <label>Celé jméno (včetně titulů) *</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($editing['name'] ?? '') ?>" placeholder="JUDr. Jan Novák, LL.M.">
      </div>
      <div class="form-group">
        <label>ID / Slug</label>
        <input type="text" name="id" value="<?= htmlspecialchars($editing['id'] ?? '') ?>" placeholder="jan-novak (generuje se z jména)">
        <div class="form-hint">Unikátní identifikátor. Ponechte prázdné pro automatické generování.</div>
      </div>
      <div class="form-group">
        <label>Pozice / Titul</label>
        <input type="text" name="position" value="<?= htmlspecialchars($editing['position'] ?? '') ?>" placeholder="Advokát · Partner">
      </div>
      <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" value="<?= htmlspecialchars($editing['email'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label>Telefon</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($editing['phone'] ?? '') ?>" placeholder="+420 xxx xxx xxx">
      </div>
      <div class="form-group form-full">
        <label>Fotografie (URL nebo cesta)</label>
        <input type="text" name="photo" value="<?= htmlspecialchars($editing['photo'] ?? '') ?>" placeholder="/assets/img/team/jan-novak.jpg">
        <div class="form-hint">Doporučená velikost: 400×530 px (poměr 3:4). Ponechte prázdné pro zobrazení iniciál.</div>
      </div>
      <div class="form-group">
        <label>Jazyky (zkratky oddělené čárkou)</label>
        <input type="text" name="languages" value="<?= htmlspecialchars(implode(', ', $editing['languages'] ?? [])) ?>" placeholder="CS, EN, DE">
      </div>
      <div class="form-group form-full">
        <label>Bio</label>
        <div class="rich-hint">Podporuje HTML: <code>&lt;p&gt;</code> <code>&lt;strong&gt;</code> <code>&lt;em&gt;</code></div>
        <textarea name="bio" rows="6"><?= htmlspecialchars($editing['bio'] ?? '') ?></textarea>
      </div>
      <div class="form-group form-full">
        <label>Specializace (jedna na řádek)</label>
        <textarea name="specializations" rows="6"><?= htmlspecialchars(implode("\n", $editing['specializations'] ?? [])) ?></textarea>
      </div>
      <div class="form-group form-full">
        <label>Referenční projekty (jeden na řádek)</label>
        <textarea name="projects" rows="8"><?= htmlspecialchars(implode("\n", $editing['projects'] ?? [])) ?></textarea>
      </div>
    </div>

    <div style="display:flex;gap:.75rem;margin-top:.5rem;">
      <button type="submit" class="btn btn--primary">Uložit</button>
      <a href="/admin/team.php" class="btn btn--outline">Zrušit</a>
    </div>
  </form>
</div>

<?php else: ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
  <p style="color:var(--muted);font-size:.88rem;">Celkem <?= count($team) ?> členů týmu</p>
  <a href="/admin/team.php?new=1" class="btn btn--primary">+ Přidat člena</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Jméno</th><th>Pozice</th><th>E-mail</th><th>Jazyky</th><th></th></tr>
      </thead>
      <tbody>
        <?php if (empty($team)): ?>
          <tr><td colspan="5" style="text-align:center;padding:2rem;color:var(--muted);">Žádní členové týmu.</td></tr>
        <?php endif; ?>
        <?php foreach ($team as $m): ?>
          <tr>
            <td style="font-weight:600;"><?= htmlspecialchars($m['name']) ?></td>
            <td style="font-size:.82rem;color:var(--muted);"><?= htmlspecialchars($m['position']) ?></td>
            <td style="font-size:.82rem;"><a href="mailto:<?= htmlspecialchars($m['email']) ?>"><?= htmlspecialchars($m['email']) ?></a></td>
            <td style="font-size:.78rem;color:var(--muted);"><?= htmlspecialchars(implode(', ', $m['languages'] ?? [])) ?></td>
            <td style="white-space:nowrap;text-align:right;">
              <a href="/admin/team.php?edit=<?= urlencode($m['id']) ?>" class="btn btn--sm btn--outline">Upravit</a>
              <a href="/admin/team.php?delete=<?= urlencode($m['id']) ?>" class="btn btn--sm btn--danger" onclick="return confirm('Opravdu smazat?')">Smazat</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="card" style="background:rgba(144,78,85,.04);border-color:rgba(144,78,85,.2);">
  <p style="font-size:.85rem;color:var(--muted);">
    <strong>Tip:</strong> Pořadí členů týmu odpovídá pořadí v JSON souboru. Přetáhněte záznamy v souboru nebo použijte editor k úpravě pořadí.
  </p>
</div>
<?php endif; ?>

<?php adminFooter(); ?>
