<?php
// Image field shared by admin forms (article thumbnail, book cover):
// live preview, upload a new file, pick one from the media library, or remove.
// The surrounding <form> must use enctype="multipart/form-data".

require_once __DIR__ . '/media-upload.php';

// Renders the picker. $fit: current fit ('cover'/'contain') to show the fit
// selector, or null to hide it. $portrait: tall preview (book covers).
function imagePicker(string $label, string $current, ?string $fit = null, bool $portrait = false, string $hint = ''): void {
  $media = readJson('media.json');
  $previewClass = 'image-picker__preview'
    . ($portrait ? ' is-portrait' : '')
    . ($fit === 'contain' ? ' is-contain' : '');
  ?>
  <div class="form-group form-full">
    <label><?= htmlspecialchars($label) ?></label>
    <div class="image-picker">
      <div class="<?= $previewClass ?>" id="imgPreview">
        <?php if ($current): ?>
          <img src="<?= htmlspecialchars($current) ?>" alt="">
        <?php else: ?>
          <span>Bez obrázku</span>
        <?php endif; ?>
      </div>
      <div class="image-picker__fields">
        <div class="form-group">
          <label for="image_file">Nahrát nový obrázek</label>
          <input type="file" id="image_file" name="image_file" accept="image/jpeg,image/png,image/webp,image/gif">
          <div class="form-hint">JPG, PNG, WebP nebo GIF, max 5 MB. Obrázek se uloží i do sekce Média.<?= $hint ? ' ' . $hint : '' ?></div>
        </div>
        <div class="form-group">
          <label for="image">…nebo vybrat z Médií</label>
          <select id="image" name="image">
            <option value="">— bez obrázku —</option>
            <?php $found = $current === ''; foreach (array_reverse($media) as $m): if ($m['url'] === $current) $found = true; ?>
              <option value="<?= htmlspecialchars($m['url']) ?>" <?= $m['url'] === $current ? 'selected' : '' ?>><?= htmlspecialchars($m['file']) ?></option>
            <?php endforeach; ?>
            <?php if (!$found): ?>
              <option value="<?= htmlspecialchars($current) ?>" selected><?= htmlspecialchars(basename($current)) ?> (aktuální)</option>
            <?php endif; ?>
          </select>
        </div>
        <?php if ($fit !== null): ?>
          <div class="form-group">
            <label for="imageFit">Zobrazení v náhledu</label>
            <select id="imageFit" name="imageFit">
              <option value="cover" <?= $fit === 'cover' ? 'selected' : '' ?>>Vyplnit rámeček (fotografie)</option>
              <option value="contain" <?= $fit === 'contain' ? 'selected' : '' ?>>Zobrazit celý obrázek (loga, grafika)</option>
            </select>
          </div>
        <?php endif; ?>
        <?php if ($current): ?>
          <label class="image-picker__remove"><input type="checkbox" name="remove_image" value="1" id="removeImage"> Odebrat obrázek</label>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script>
  (function () {
    var preview = document.getElementById('imgPreview');
    var fileIn  = document.getElementById('image_file');
    var select  = document.getElementById('image');
    var fit     = document.getElementById('imageFit');
    var remove  = document.getElementById('removeImage');

    function show(src) {
      preview.innerHTML = '';
      if (src) {
        var img = document.createElement('img');
        img.src = src;
        img.alt = '';
        preview.appendChild(img);
      } else {
        var span = document.createElement('span');
        span.textContent = 'Bez obrázku';
        preview.appendChild(span);
      }
    }
    function refresh() {
      if (remove && remove.checked) return show('');
      if (fileIn.files && fileIn.files[0]) return show(URL.createObjectURL(fileIn.files[0]));
      show(select.value);
    }

    fileIn.addEventListener('change', refresh);
    select.addEventListener('change', function () { fileIn.value = ''; refresh(); });
    if (remove) remove.addEventListener('change', refresh);
    if (fit) fit.addEventListener('change', function () { preview.classList.toggle('is-contain', fit.value === 'contain'); });
  })();
  </script>
  <?php
}

// Reads the picker back from the request. Removal wins, then a fresh upload,
// then a pick from the media library. Returns ['image' => url|'' , 'error' => ?string].
function imagePickerPost(string $alt = ''): array {
  $image = trim($_POST['image'] ?? '');
  if (strpos($image, '/assets/') !== 0) $image = '';
  $error = null;
  if (!empty($_POST['remove_image'])) {
    $image = '';
  } elseif (($_FILES['image_file']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    $result = saveUploadedImage($_FILES['image_file'], $alt);
    if (isset($result['url'])) {
      $image = $result['url'];
    } else {
      $error = $result['error'];
    }
  }
  return ['image' => $image, 'error' => $error];
}
