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
      <a href="/kontakty.php" class="btn btn--primary">Poslat poptávku</a>
      <a href="/sluzby.php"   class="btn btn--outline-white">Právní služby</a>
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
          <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        </div>
        <div class="value-card__title">Byznysové myšlení místo pouhého „paragrafování“</div>
        <p>Většina advokátních kanceláří vám řekne, co v zákoně stojí a proč něco nejde. EQUITY LEGAL naopak přemýšlí jako partner ve vašem podnikání.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="value-card__title">Neopouštíme vás v těžkých časech</div>
        <p>Pro řadu kanceláří je klient jen dalším spisem v pořadí. V EQUITY LEGAL si zakládáme na tom, že partnerství myslíme vážně. Své klienty neopouštíme v těžkých časech.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <div class="value-card__title">Kombinace korporátního know-how a flexibility střední kanceláře</div>
        <p>Tým EQUITY LEGAL tvoří lidé, kteří prošli velkou mezinárodní či největší domácí advokacií a transakcemi za miliardy.</p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        </div>
        <div class="value-card__title">Právo s lidskou tváří</div>
        <p>Jednou z největších bariér mezi advokátem a klientem bývá právnická hantýrka. EQUITY LEGAL sází na absolutní přímočarost a srozumitelnost.</p>
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
      foreach (array_slice($services, 0, 6) as $s): ?>
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
        <p>EQUITY LEGAL poskytuje právní poradenství a zastupování klientů s důrazem na odbornost a praktické výsledky. Název EQUITY vyjadřuje naši schopnost hledat spravedlivá a efektivní řešení i ve složitých právních situacích. LEGAL představuje hlubokou znalost práva, preciznost a odborné dovednosti, o které se naši klienti mohou opřít.</p>

<p>Aktivně pracujeme s moderními technologiemi a orientujeme se v oblasti ICT práva, startupů, ochrany dat i duševního vlastnictví. Díky tomu dokážeme poskytovat efektivní a aktuální právní řešení.
Jsme partnerem pro růst i oporou v náročných situacích.</p>

  <p>Naši kancelář najdete v Praze 3 na Vinohradech.</p>
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
        <div style="margin-top:2.5rem;margin-bottom:2.5rem;">
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

<!-- ── Aktuality ── -->
<section class="section" aria-labelledby="news-heading">
  <div class="container">
    <p class="section-label">Co je nového</p>
    <h2 class="section-title" id="news-heading">Z aktualit</h2>
    <div class="divider"></div>
    <div class="articles-grid">
      <?php
      function firstSentence(string $html): string {
        $text = trim(preg_replace('/\s+/u', ' ', strip_tags($html)));
        if (preg_match('/^.*?[.!?](?=\s|$)/u', $text, $m)) return trim($m[0]);
        return $text;
      }
      $newsArticles = json_decode(file_get_contents(__DIR__ . '/data/articles.json'), true) ?? [];
      $newsArticles = array_filter($newsArticles, fn($a) => empty($a['hidden']) && ($a['category'] ?? '') === 'Aktuality');
      usort($newsArticles, fn($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
      $newsArticles = array_slice($newsArticles, 0, 3);
      foreach ($newsArticles as $a): ?>
        <article class="article-card fade-in">
          <div class="article-card__image">
            <?php if (!empty($a['image'])): ?>
              <img src="<?= htmlspecialchars($a['image']) ?>" alt="<?= htmlspecialchars($a['title']) ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
            <?php else: ?>
              <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy) 0%,#263452 100%);display:flex;align-items:center;justify-content:center;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.15)" stroke-width="1" style="width:64px;height:64px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
              </div>
            <?php endif; ?>
            <span class="article-card__cat"><?= htmlspecialchars($a['category']) ?></span>
          </div>
          <div class="article-card__body">
            <h2 class="article-card__title"><?= htmlspecialchars($a['title']) ?></h2>
            <p class="article-card__excerpt"><?= htmlspecialchars(firstSentence($a['content'] ?? $a['excerpt'])) ?></p>
            <a href="/clanek.php?slug=<?= urlencode($a['slug']) ?>" class="article-card__link">Číst celý článek</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:2.5rem;">
      <a href="/pripady.php" class="btn btn--outline">Všechny články</a>
    </div>
  </div>
</section>

<!-- ── CTA Banner ── -->
<section class="cta-banner" aria-label="Kontaktujte nás">
  <div class="container">
    <h2>Potřebujete právní pomoc?</h2>
    <p>Kontaktujte nás pro konzultaci.</p>
    <a href="/kontakty.php" class="btn btn--primary">Poslat poptávku</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
