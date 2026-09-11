<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/i18n.php';
$s = elSettings();
$pageTitle = tm('kontakty_title');
$pageDesc  = tm('kontakty_desc') . ' ' . $s['address_street'] . ', ' . $s['address_city'] . '.';
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label"><?= htmlspecialchars(t('contact_hero_label')) ?></p>
    <div class="page-hero__desc">
      <p><?= htmlspecialchars(t('contact_hero_text')) ?></p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-layout">

      <!-- Info column -->
      <div>
        <p class="section-label"><?= htmlspecialchars(t('contact_where_label')) ?></p>
        <h2 class="section-title" style="font-size:1.4rem;"><?= htmlspecialchars($s['company_name']) ?></h2>
        <div class="divider"></div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <div class="contact-info__label"><?= htmlspecialchars(t('contact_address')) ?></div>
            <address class="contact-info__value">
              <?= htmlspecialchars($s['address_street']) ?><br>
              <?= htmlspecialchars($s['address_city']) ?><br>
              <?= htmlspecialchars(tf($s, 'address_country')) ?>
            </address>
          </div>
        </div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.62 4.87 2 2 0 0 1 3.59 2.67h3a2 2 0 0 1 2 1.72c.13 1 .38 1.97.74 2.9a2 2 0 0 1-.45 2.11L7.91 10.4a16 16 0 0 0 6.09 6.09l1-1a2 2 0 0 1 2.11-.45c.93.36 1.9.61 2.9.74A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <div class="contact-info__label"><?= htmlspecialchars(t('contact_phone')) ?></div>
            <div class="contact-info__value">
              <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $s['phone'])) ?>"><?= htmlspecialchars($s['phone']) ?></a>
            </div>
          </div>
        </div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <div class="contact-info__label"><?= htmlspecialchars(t('contact_email')) ?></div>
            <div class="contact-info__value">
              <a href="mailto:<?= htmlspecialchars($s['email']) ?>"><?= htmlspecialchars($s['email']) ?></a>
            </div>
          </div>
        </div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          </div>
          <div>
            <div class="contact-info__label"><?= htmlspecialchars(t('contact_databox')) ?></div>
            <div class="contact-info__value"><?= htmlspecialchars($s['databox']) ?></div>
          </div>
        </div>

        <?php if ($s['hours']): ?>
        <div class="contact-info__item">
          <div class="contact-info__label"><?= htmlspecialchars(t('contact_hours')) ?></div>
          <div class="contact-info__value"><?= htmlspecialchars($s['hours']) ?></div>
        </div>
        <?php endif; ?>

        <!-- Billing -->
        <div class="billing-info">
          <h3><?= htmlspecialchars(t('contact_billing_title')) ?></h3>
          <dl>
            <dt><?= htmlspecialchars(t('contact_billing_name')) ?></dt>
            <dd><?= htmlspecialchars($s['company_name']) ?></dd>
            <dt><?= htmlspecialchars(t('contact_billing_ico')) ?></dt>
            <dd><?= htmlspecialchars($s['ico']) ?></dd>
            <?php if ($s['dic']): ?><dt><?= htmlspecialchars(t('contact_billing_dic')) ?></dt><dd><?= htmlspecialchars($s['dic']) ?></dd><?php endif; ?>
            <dt><?= htmlspecialchars(t('contact_billing_seat')) ?></dt>
            <dd><?= htmlspecialchars($s['address_street']) ?>, <?= htmlspecialchars($s['address_city']) ?></dd>
            <dt><?= htmlspecialchars(t('contact_billing_member')) ?></dt>
            <dd><?= htmlspecialchars(tf($s, 'bar_membership')) ?></dd>
          </dl>
        </div>
      </div>

      <!-- Form column -->
      <div>
        <div class="contact-form">
          <h2 style="font-size:1.3rem;margin-bottom:.5rem;"><?= htmlspecialchars(t('contact_form_title')) ?></h2>

          <div class="form-success" id="formSuccess">
            <?= htmlspecialchars(t('contact_form_success')) ?>
          </div>

          <form id="contactForm" novalidate>
            <div class="form-row">
              <div class="form-group">
                <label for="fname"><?= htmlspecialchars(t('form_name')) ?></label>
                <input type="text" id="fname" name="name" required placeholder="Jan Novák" autocomplete="name">
              </div>
              <div class="form-group">
                <label for="femail"><?= htmlspecialchars(t('form_email')) ?></label>
                <input type="email" id="femail" name="email" required placeholder="jan@firma.cz" autocomplete="email">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="fphone"><?= htmlspecialchars(t('form_phone_optional')) ?> <span style="font-weight:400;text-transform:none;font-size:.85em;"><?= htmlspecialchars(t('form_optional')) ?></span></label>
                <input type="tel" id="fphone" name="phone" placeholder="+420 xxx xxx xxx" autocomplete="tel">
              </div>
              <div class="form-group">
                <label for="fservice"><?= htmlspecialchars(t('form_service')) ?></label>
                <select id="fservice" name="service">
                  <option value=""><?= htmlspecialchars(t('form_service_select')) ?></option>
                  <?php
                  $formServices = require __DIR__ . '/includes/services-data.php';
                  foreach ($formServices as $fs): ?>
                    <option><?= htmlspecialchars(tf($fs, 'label')) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="fmsg"><?= htmlspecialchars(t('form_message')) ?></label>
              <textarea id="fmsg" name="message" required placeholder="<?= htmlspecialchars(t('form_message_ph')) ?>"></textarea>
            </div>
            <div class="form-group" style="display:flex;align-items:flex-start;gap:.75rem;">
              <input type="checkbox" id="fgdpr" name="gdpr" required style="width:auto;margin-top:.2rem;flex-shrink:0;">
              <label for="fgdpr" style="font-family:var(--font-b);font-size:.8rem;text-transform:none;letter-spacing:0;color:var(--text-muted);">
                <?= htmlspecialchars(t('form_gdpr')) ?>
              </label>
            </div>
            <button type="submit" class="btn btn--primary"><?= htmlspecialchars(t('btn_submit_enquiry')) ?></button>
          </form>
        </div>
      </div>

    </div>


  </div>
</section>

<?php include 'includes/footer.php'; ?>
