<?php
$pageTitle = 'Advokátní kancelář EQUITY LEGAL – Vaše právo, náš závazek';
$pageDesc  = 'EQUITY LEGAL – prémiové právní poradenství s více jak 15letou zkušeností. Obchodní právo, nemovitosti, trestní právo, mezinárodní právo. Praha, Vinohrady.';
include 'includes/header.php';
?>

<!-- ── Hero ── -->
<section class="hero" aria-label="Úvod">
  <div class="hero__image-side">
    <img src="assets/img/hero-bg.jpg" alt="Advokátní kancelář EQUITY LEGAL" loading="eager">
    <div class="hero__overlay"></div>
  </div>
  <div class="hero__content-side">
    <p class="hero__label">Advokátní kancelář · Praha</p>
    <h1 class="hero__title">
      Naše poslání<br>je <em>váš úspěch</em>
    </h1>
    <div class="hero__desc">
      <p>EQUITY LEGAL kombinuje hlubokou znalost práva s kreativním přístupem k řešení složitých právních případů. Poskytujeme poradenství v češtině, angličtině, němčině a dalších jazycích.</p>
    </div>
    <div class="hero__cta">
      <a href="/kontakty.php" class="btn btn--primary">Nezávazná konzultace</a>
      <a href="/sluzby.php"   class="btn btn--outline-white">Právní služby</a>
    </div>
    <div class="hero__scroll" aria-hidden="true">
      <span>Scroll</span>
      <div class="hero__scroll-line"></div>
    </div>
  </div>
</section>

<!-- ── Hodnoty ── -->
<section class="section" aria-labelledby="values-heading">
  <div class="container">
    <p class="section-label">Proč EQUITY LEGAL</p>
    <h2 class="section-title" id="values-heading">Naše základní hodnoty</h2>
    <div class="divider"></div>
    <div class="values__grid">

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <div class="value-card__title">Odbornost</div>
        <p>Více jak 15 let zkušeností v ryze českých i mezinárodních advokátních kancelářích. Znalosti práva na nejvyšší úrovni.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <div class="value-card__title">Individuální přístup</div>
        <p>Každý případ je jedinečný. Právní řešení přizpůsobujeme konkrétním potřebám a cílům každého klienta.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="value-card__title">Mezinárodní síť</div>
        <p>Zahraniční spolupráce a poradenství v anglickém, německém, polském, rumunském, ukrajinském a dalších jazycích.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <div class="value-card__title">Kreativní řešení</div>
        <p>Zkoumáme právní problémy ze všech perspektiv a přicházíme s cílenými řešeními šitými na míru.</p>
      </div>

    </div>
  </div>
</section>

<!-- ── Přehled služeb ── -->
<section class="section section--alt" aria-labelledby="services-heading">
  <div class="container">
    <p class="section-label">Co nabízíme</p>
    <h2 class="section-title" id="services-heading">Hlavní oblasti právních služeb</h2>
    <div class="divider"></div>
    <div class="services-grid">

      <?php
      $services = [
        ['Právo obchodních korporací', 'Zakládání a likvidace společností, fúze, akvizice, due diligence, compliance a corporate governance.', '#pravo-obchodnich-korporaci-a-obchodni-pravo'],
        ['Nemovitosti a stavební právo', 'Převody nemovitostí, advokátní úschova, stavební řízení, bytová práva, development.', '#pravo-nemovitosti-a-stavebni-pravo'],
        ['Trestní právo', 'Obhajoba ve všech fázích trestního řízení, white-collar crime, dopravní delikty.', '#trestni-pravo'],
        ['Pracovní právo', 'Pracovní smlouvy, spory zaměstnanec–zaměstnavatel, GDPR, BOZP, hromadné propouštění.', '#pracovni-pravo'],
        ['Zbrojní průmysl & Bezpečnost', 'Poradenství subjektům v oblasti obrany a bezpečnostního průmyslu, veřejné zakázky na vojenský materiál.', '#zbrojni-prumysl-obrana-a-bezpecnost'],
        ['Veřejné zakázky', 'Zadávání zakázek, kontrola nabídek, zastupování před ÚOHS, ochrana před porušováním pravidel.', '#verejne-zakazky'],
        ['Duševní vlastnictví', 'Ochranné známky, patenty, autorská práva, licenční smlouvy, doménové spory.', '#pravo-dusevniho-vlastnictvi'],
        ['Informační technologie', 'Software, e-commerce, outsourcing, ochrana osobních údajů, IT spory.', '#pravo-informacnich-technologii'],
        ['Bankovnictví a financování', 'Úvěrové smlouvy, akvizice, pojišťovací právo, hypotéky, finanční restrukturalizace.', '#bankovnictvi-a-financovani'],
        ['Daňové a celní právo', 'Zastupování před finančními úřady, daňové audity, spory se správcem daně.', '#danove-a-celni-pravo'],
        ['Vymáhání pohledávek', 'Mimosoudní i soudní vymáhání, insolvence, exekuce, zahraniční pohledávky.', '#vymahani-a-sprava-pohledavek'],
        ['Rodinné právo', 'Rozvody, péče o děti, výživné, majetkové právo manželů, mezinárodní rodinné spory.', '#rodinne-pravo'],
      ];
      foreach ($services as $s): ?>
        <div class="service-card fade-in">
          <div class="service-card__title"><?= $s[0] ?></div>
          <p><?= $s[1] ?></p>
          <a href="/sluzby.php<?= $s[2] ?>" class="service-card__link">Více informací</a>
        </div>
      <?php endforeach; ?>

    </div>
    <div style="text-align:center;margin-top:3rem;">
      <a href="/sluzby.php" class="btn btn--outline">Všechny právní služby</a>
    </div>
  </div>
</section>

<!-- ── O kanceláři ── -->
<section class="section" aria-labelledby="about-heading">
  <div class="container">
    <div class="about__grid">
      <div>
        <p class="section-label">O nás</p>
        <h2 class="section-title" id="about-heading">Právní kancelář, která hledá řešení</h2>
        <div class="divider"></div>
        <p>EQUITY LEGAL si zakládá na nejlepším právním poradenství a zastupování klientů. Zatímco EQUITY vyjadřuje schopnost nalézt a dodat nejlepší řešení obtížných právních případů, LEGAL spojuje prvotřídní znalosti práva a odborné dovednosti.</p>
        <p>Naše kancelář nabízí poradenství na dlouhodobé bázi s detailní znalostí konkrétní problematiky a na míru obchodním a jiným zájmům klientů. Sídlíme na Praze 3 – Vinohrady s bezplatným parkováním pro klienty.</p>
        <div class="about__stats">
          <div>
            <div class="about__stat-num">15+</div>
            <div class="about__stat-label">let zkušeností</div>
          </div>
          <div>
            <div class="about__stat-num">9</div>
            <div class="about__stat-label">jazyků poradenství</div>
          </div>
          <div>
            <div class="about__stat-num">13</div>
            <div class="about__stat-label">oblastí práva</div>
          </div>
          <div>
            <div class="about__stat-num">100%</div>
            <div class="about__stat-label">individuální přístup</div>
          </div>
        </div>
        <div style="margin-top:2.5rem;">
          <a href="/tym.php" class="btn btn--primary">Poznejte náš tým</a>
        </div>
      </div>
      <div class="about__image fade-in">
        <img src="assets/img/office.jpg" alt="Kancelář EQUITY LEGAL">
        <div class="about__accent"></div>
      </div>
    </div>
  </div>
</section>

<!-- ── Reference ── -->
<section class="section section--alt" aria-labelledby="ref-heading">
  <div class="container">
    <p class="section-label">Reference</p>
    <h2 class="section-title" id="ref-heading">Vybrané zkušenosti</h2>
    <div class="divider"></div>
    <div class="references__grid">

      <div class="reference-card fade-in">
        <p class="reference-card__text">V ojediněle krátkém čase – méně než během jednoho dne – se EQUITY LEGAL podařilo klienty zadržené na pražském letišti dostat z cely, vyjednat podmínky skončení trestního stíhání a bez záznamu v rejstříku trestů je dostat na svobodu.</p>
        <div class="reference-card__author">Trestní právo</div>
        <div class="reference-card__role">Mezinárodní případ · 2018</div>
      </div>

      <div class="reference-card fade-in">
        <p class="reference-card__text">Naše kancelář se umístila v anketě „Právnická firma roku" jako Velmi doporučovaná v kategorii Zdravotnické právo a Doporučovaná v kategoriích Veřejné zakázky, Duševní vlastnictví, Daňové právo a dalších.</p>
        <div class="reference-card__author">Ocenění kanceláře</div>
        <div class="reference-card__role">Právnická firma roku · 2021</div>
      </div>

      <div class="reference-card fade-in">
        <p class="reference-card__text">Kancelář byla vybrána pro psaní odborných textů pro portál o bydlení provozovaný Státním fondem rozvoje bydlení – ocenění za dlouhodobou aktivitu a zkušenosti v oblasti nemovitostí a bytového práva.</p>
        <div class="reference-card__author">Nemovitosti a bytové právo</div>
        <div class="reference-card__role">Státní fond rozvoje bydlení · 2018</div>
      </div>

    </div>
    <div style="text-align:center;margin-top:3rem;">
      <a href="/pripady.php" class="btn btn--outline">Všechny případy</a>
    </div>
  </div>
</section>

<!-- ── CTA Banner ── -->
<section class="cta-banner" aria-label="Kontaktujte nás">
  <div class="container">
    <h2>Potřebujete právní pomoc?</h2>
    <p>Kontaktujte nás pro nezávaznou konzultaci. Odpovíme do 24 hodin.</p>
    <a href="/kontakty.php" class="btn btn--primary">Napište nám</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
