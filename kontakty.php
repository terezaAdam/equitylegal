<?php
$pageTitle = 'Kontakty – EQUITY LEGAL';
$pageDesc  = 'Kontaktujte advokátní kancelář EQUITY LEGAL. Adresa: Chrudimská 1418/2, Praha 3 – Vinohrady. Bezplatné parkování pro klienty.';
include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label">Spojte se s námi</p>
    <h1 class="page-hero__title">Kontakty</h1>
    <div class="page-hero__desc">
      <p>Rádi odpovíme na vaše dotazy a připravíme nezávaznou konzultaci. Kontaktujte nás telefonicky, e-mailem nebo prostřednictvím formuláře.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-layout">

      <!-- Info column -->
      <div>
        <p class="section-label">Kde nás najdete</p>
        <h2 class="section-title" style="font-size:1.4rem;">EQUITY LEGAL s.r.o.</h2>
        <div class="divider"></div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <div class="contact-info__label">Adresa</div>
            <address class="contact-info__value">
              Chrudimská 1418/2<br>
              130 00 Praha 3, Vinohrady<br>
              Česká republika
            </address>
            <p style="font-size:.82rem;margin-top:.5rem;">Bezplatné parkování pro klienty na soukromém zabezpečeném parkovišti přímo u budovy.</p>
          </div>
        </div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.62 4.87 2 2 0 0 1 3.59 2.67h3a2 2 0 0 1 2 1.72c.13 1 .38 1.97.74 2.9a2 2 0 0 1-.45 2.11L7.91 10.4a16 16 0 0 0 6.09 6.09l1-1a2 2 0 0 1 2.11-.45c.93.36 1.9.61 2.9.74A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <div class="contact-info__label">Telefon</div>
            <div class="contact-info__value">
              <a href="tel:+420734551413">+420 734 551 413</a> <span style="font-size:.8rem;color:var(--text-muted);">(JUDr. Vít Hrnčiřík)</span><br>
              <a href="tel:+420732230529">+420 732 230 529</a> <span style="font-size:.8rem;color:var(--text-muted);">(Mgr. Kryštof Kobeda)</span><br>
              <a href="tel:+420603516887">+420 603 516 887</a> <span style="font-size:.8rem;color:var(--text-muted);">(Mgr. Táňa Olivová)</span>
            </div>
          </div>
        </div>

        <div class="contact-info__item">
          <div class="contact-info__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <div class="contact-info__label">E-mail</div>
            <div class="contact-info__value">
              <a href="mailto:kancelar@equitylegal.cz">kancelar@equitylegal.cz</a><br>
              <a href="mailto:vit.hrncirik@equitylegal.cz">vit.hrncirik@equitylegal.cz</a><br>
              <a href="mailto:krystof.kobeda@equitylegal.cz">krystof.kobeda@equitylegal.cz</a>
            </div>
          </div>
        </div>

        <!-- Billing -->
        <div class="billing-info">
          <h3>Fakturační údaje</h3>
          <dl>
            <dt>Název</dt>
            <dd>EQUITY LEGAL s.r.o.</dd>
            <dt>IČO</dt>
            <dd>03562795</dd>
            <dt>Sídlo</dt>
            <dd>Chrudimská 1418/2, 130 00 Praha 3</dd>
            <dt>Člen</dt>
            <dd>Česká advokátní komora</dd>
          </dl>
        </div>
      </div>

      <!-- Form column -->
      <div>
        <div class="contact-form">
          <h2 style="font-size:1.3rem;margin-bottom:.5rem;">Napište nám</h2>
          <p style="margin-bottom:1.75rem;">Odpovíme do 24 hodin.</p>

          <div class="form-success" id="formSuccess">
            ✓ Váš dotaz byl odeslán. Ozveme se vám co nejdříve.
          </div>

          <form id="contactForm" novalidate>
            <div class="form-row">
              <div class="form-group">
                <label for="fname">Jméno</label>
                <input type="text" id="fname" name="name" required placeholder="Jan Novák" autocomplete="name">
              </div>
              <div class="form-group">
                <label for="femail">E-mail</label>
                <input type="email" id="femail" name="email" required placeholder="jan@firma.cz" autocomplete="email">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="fphone">Telefon <span style="font-weight:400;text-transform:none;font-size:.85em;">(nepovinný)</span></label>
                <input type="tel" id="fphone" name="phone" placeholder="+420 xxx xxx xxx" autocomplete="tel">
              </div>
              <div class="form-group">
                <label for="fservice">Oblast práva</label>
                <select id="fservice" name="service">
                  <option value="">— Vyberte oblast —</option>
                  <option>Právo obchodních korporací / M&A</option>
                  <option>Nemovitosti a stavební právo</option>
                  <option>Trestní právo</option>
                  <option>Pracovní právo</option>
                  <option>Zbrojní průmysl & Bezpečnost</option>
                  <option>Veřejné zakázky</option>
                  <option>Duševní vlastnictví</option>
                  <option>Informační technologie</option>
                  <option>Bankovnictví a financování</option>
                  <option>Daňové a celní právo</option>
                  <option>Vymáhání pohledávek</option>
                  <option>Rodinné právo</option>
                  <option>Insolvenční právo</option>
                  <option>Jiné</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="fmsg">Váš dotaz</label>
              <textarea id="fmsg" name="message" required placeholder="Popište váš právní dotaz nebo situaci…"></textarea>
            </div>
            <div class="form-group" style="display:flex;align-items:flex-start;gap:.75rem;">
              <input type="checkbox" id="fgdpr" name="gdpr" required style="width:auto;margin-top:.2rem;flex-shrink:0;">
              <label for="fgdpr" style="font-family:var(--font-b);font-size:.8rem;text-transform:none;letter-spacing:0;color:var(--text-muted);">
                Souhlasím se zpracováním osobních údajů za účelem zodpovězení mého dotazu dle <a href="#" style="color:var(--burgundy);">zásad ochrany osobních údajů</a>.
              </label>
            </div>
            <button type="submit" class="btn btn--primary">Odeslat dotaz</button>
          </form>
        </div>
      </div>

    </div>

    <!-- Map -->
    <div class="map-wrap">
      <iframe
        src="https://maps.google.com/maps?width=1200&height=400&hl=cs&q=Chrudimsk%C3%A1+1418%2F2%2C+Praha&t=&z=15&ie=UTF8&iwloc=B&output=embed"
        title="Mapa – sídlo EQUITY LEGAL"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
