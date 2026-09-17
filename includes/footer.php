</main>

<?php
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/i18n.php';
$fSettings = elSettings();
?>
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <div class="footer__brand-name">EQUITY LEGAL</div>
        <div class="footer__brand-sub"><?= htmlspecialchars(t('footer_law_firm')) ?></div>
        <p class="footer__desc"><?= htmlspecialchars(tf($fSettings, 'footer_text')) ?></p>
      </div>
      <div>
        <div class="footer__col-title"><?= htmlspecialchars(t('footer_nav')) ?></div>
        <ul class="footer__links">
          <li><a href="<?= lu('/sluzby.php') ?>"><?= htmlspecialchars(t('nav_services')) ?></a></li>
          <li><a href="<?= lu('/pripady.php') ?>"><?= htmlspecialchars(t('nav_blog')) ?></a></li>
          <li><a href="<?= lu('/tym.php') ?>"><?= htmlspecialchars(t('nav_team')) ?></a></li>
          <li><a href="<?= lu('/publikace.php') ?>"><?= htmlspecialchars(t('nav_publications')) ?></a></li>
          <li><a href="<?= lu('/kontakty.php') ?>"><?= htmlspecialchars(t('nav_contacts')) ?></a></li>
          <li><a href="<?= lu('/ochrana-osobnich-udaju.php') ?>"><?= htmlspecialchars(t('nav_privacy')) ?></a></li>
        </ul>
      </div>
      <div>
        <div class="footer__col-title"><?= htmlspecialchars(t('footer_contact')) ?></div>
        <ul class="footer__links">
          <?php if ($fSettings['email']): ?><li><a href="mailto:<?= htmlspecialchars($fSettings['email']) ?>"><?= htmlspecialchars($fSettings['email']) ?></a></li><?php endif; ?>
          <?php if ($fSettings['phone']): ?><li><a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $fSettings['phone'])) ?>"><?= htmlspecialchars($fSettings['phone']) ?></a></li><?php endif; ?>
          <?php if ($fSettings['address_street']): ?>
            <li><a href="<?= lu('/kontakty.php') ?>"><?= htmlspecialchars($fSettings['address_street']) ?><br><?= htmlspecialchars($fSettings['address_city']) ?></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <div class="footer__bottom">
      <span class="footer__copy">© <?= date('Y') ?> <?= htmlspecialchars($fSettings['company_name']) ?> <?= htmlspecialchars(t('footer_rights')) ?></span>
      <div style="display:flex;align-items:center;gap:1rem;">
        <?php if ($fSettings['social_youtube']): ?>
        <a href="<?= htmlspecialchars($fSettings['social_youtube']) ?>" target="_blank" rel="noopener" aria-label="YouTube" style="color:rgba(255,255,255,.35);transition:color var(--tr);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
        </a>
        <?php endif; ?>
        <span class="footer__member"><?= htmlspecialchars(tf($fSettings, 'bar_membership')) ?></span>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to top -->
<button class="scroll-top" id="scrollTop" aria-label="<?= htmlspecialchars(t('scroll_top')) ?>">↑</button>

<script src="/assets/js/main.js?v=<?= filemtime(__DIR__ . '/../assets/js/main.js') ?>"></script>
<?php if (!empty($pageScripts)) echo $pageScripts; ?>
</body>
</html>
