<?php
// Renders a CS/EN/DE language switcher and multi-language form fields.
// Convention: the Czech value lives under the bare field name, EN/DE under
// `{field}_en` / `{field}_de` — matching includes/i18n.php's tf()/tfArr().

const EL_ADMIN_LOCALES = ['cs' => 'CS', 'en' => 'EN', 'de' => 'DE'];

// Render once per <form> that contains language fields.
function langSwitch(): void {
  ?>
  <div class="lang-switch" role="tablist">
    <?php foreach (EL_ADMIN_LOCALES as $code => $label): ?>
      <button type="button" class="lang-switch__btn<?= $code === 'cs' ? ' active' : '' ?>" data-lang="<?= $code ?>"><?= $label ?></button>
    <?php endforeach; ?>
  </div>
  <?php
}

// A single-line text field, translatable.
function langInput(string $name, string $label, array $data, string $placeholder = '', string $hint = ''): void {
  ?>
  <div class="form-group">
    <label><?= htmlspecialchars($label) ?></label>
    <?php foreach (EL_ADMIN_LOCALES as $code => $langLabel):
      $field = $code === 'cs' ? $name : $name . '_' . $code;
      $value = $data[$field] ?? '';
    ?>
      <div class="lang-field" data-lang="<?= $code ?>"<?= $code !== 'cs' ? ' hidden' : '' ?>>
        <?php if ($code !== 'cs'): ?><span class="lang-field-label"><?= $langLabel ?></span><?php endif; ?>
        <input type="text" name="<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($value) ?>" placeholder="<?= htmlspecialchars($placeholder) ?>">
      </div>
    <?php endforeach; ?>
    <?php if ($hint): ?><p class="form-hint"><?= $hint ?></p><?php endif; ?>
  </div>
  <?php
}

// A multi-line text field, translatable.
function langTextarea(string $name, string $label, array $data, int $rows = 3, string $hint = ''): void {
  ?>
  <div class="form-group form-full">
    <label><?= htmlspecialchars($label) ?></label>
    <?php foreach (EL_ADMIN_LOCALES as $code => $langLabel):
      $field = $code === 'cs' ? $name : $name . '_' . $code;
      $value = $data[$field] ?? '';
    ?>
      <div class="lang-field" data-lang="<?= $code ?>"<?= $code !== 'cs' ? ' hidden' : '' ?>>
        <?php if ($code !== 'cs'): ?><span class="lang-field-label"><?= $langLabel ?></span><?php endif; ?>
        <textarea name="<?= htmlspecialchars($field) ?>" rows="<?= $rows ?>"><?= htmlspecialchars($value) ?></textarea>
      </div>
    <?php endforeach; ?>
    <?php if ($hint): ?><p class="form-hint"><?= $hint ?></p><?php endif; ?>
  </div>
  <?php
}

// A "one item per line" list field (specializations, projects…), translatable.
function langListTextarea(string $name, string $label, array $data, int $rows = 6, string $hint = ''): void {
  ?>
  <div class="form-group form-full">
    <label><?= htmlspecialchars($label) ?></label>
    <?php foreach (EL_ADMIN_LOCALES as $code => $langLabel):
      $field = $code === 'cs' ? $name : $name . '_' . $code;
      $value = implode("\n", $data[$field] ?? []);
    ?>
      <div class="lang-field" data-lang="<?= $code ?>"<?= $code !== 'cs' ? ' hidden' : '' ?>>
        <?php if ($code !== 'cs'): ?><span class="lang-field-label"><?= $langLabel ?></span><?php endif; ?>
        <textarea name="<?= htmlspecialchars($field) ?>" rows="<?= $rows ?>"><?= htmlspecialchars($value) ?></textarea>
      </div>
    <?php endforeach; ?>
    <?php if ($hint): ?><p class="form-hint"><?= $hint ?></p><?php endif; ?>
  </div>
  <?php
}

// Reads back all three locale variants of a scalar field from $_POST.
function langPostScalar(string $name): array {
  $out = [];
  foreach (EL_ADMIN_LOCALES as $code => $_) {
    $field = $code === 'cs' ? $name : $name . '_' . $code;
    $out[$field] = trim($_POST[$field] ?? '');
  }
  return $out;
}

// Reads back all three locale variants of a "one item per line" list field from $_POST.
function langPostList(string $name): array {
  $out = [];
  foreach (EL_ADMIN_LOCALES as $code => $_) {
    $field = $code === 'cs' ? $name : $name . '_' . $code;
    $lines = array_filter(array_map('trim', explode("\n", $_POST[$field] ?? '')));
    $out[$field] = array_values($lines);
  }
  return $out;
}
