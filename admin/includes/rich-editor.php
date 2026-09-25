<?php
// Visual (WYSIWYG) editor for long HTML content fields, so editors don't have
// to write HTML tags by hand. Turns the CS/EN/DE textareas of the given base
// field into TinyMCE editors. Without the CDN the plain textarea still works.
// Pass an empty $blockFormats to hide the paragraph/heading picker.

function richEditor(string $name, string $blockFormats = 'Odstavec=p; Nadpis=h2; Podnadpis=h3', int $height = 650): void {
  $toolbar = ($blockFormats !== '' ? 'blocks | ' : '') . 'bold italic | bullist numlist | link | undo redo | removeformat';
  $selectors = [];
  foreach (array_keys(EL_ADMIN_LOCALES) as $code) {
    $field = $code === 'cs' ? $name : $name . '_' . $code;
    $selectors[] = 'textarea[name="' . $field . '"]';
  }
  ?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.9.3/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce-i18n@26.9.21/langs7/cs.js"></script>
<script>
if (window.tinymce) {
  tinymce.init({
    selector: <?= json_encode(implode(', ', $selectors)) ?>,
    license_key: 'gpl',
    language: 'cs',
    height: <?= $height ?>,
    menubar: false,
    branding: false,
    promotion: false,
    plugins: 'lists link',
    toolbar: <?= json_encode($toolbar) ?>,
    block_formats: <?= json_encode($blockFormats ?: 'Odstavec=p') ?>,
    link_default_target: '_blank',
    // Store characters as-is (not &iacute; etc.) – plain-text excerpts are built from this HTML.
    entity_encoding: 'raw',
    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; font-size: 15px; line-height: 1.6; color: #222; max-width: 760px; margin: 1rem auto; padding: 0 1rem; } h2 { font-size: 1.25rem; margin: 1.5rem 0 .5rem; } h3 { font-size: 1.1rem; margin: 1.25rem 0 .4rem; } dt { font-weight: 600; margin-top: .5rem; } dd { margin: 0 0 .25rem 1rem; }',
    setup: function (editor) {
      // Let the admin's unsaved-changes warning notice edits made in the editor.
      editor.on('input change', function () {
        editor.getElement().dispatchEvent(new Event('input', { bubbles: true }));
      });
    }
  });
  document.querySelectorAll('form[method="POST"]').forEach(function (form) {
    form.addEventListener('submit', function () { tinymce.triggerSave(); });
  });
}
</script>
  <?php
}
