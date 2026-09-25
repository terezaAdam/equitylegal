<?php
// Shared JSON data-store helpers, used by both the public site and the admin.

require_once __DIR__ . '/i18n.php';

define('EL_DATA_DIR', __DIR__ . '/../data/');

function elReadJson(string $file): array {
  $path = EL_DATA_DIR . basename($file);
  if (!file_exists($path)) return [];
  $data = json_decode(file_get_contents($path), true);
  return is_array($data) ? $data : [];
}

function elWriteJson(string $file, array $data): bool {
  $path = EL_DATA_DIR . basename($file);
  $tmp  = $path . '.tmp';
  if (file_put_contents($tmp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) === false) {
    return false;
  }
  return rename($tmp, $path);
}

// Site-wide settings (contact info, footer text, social links, …) with safe defaults
// so the public site never breaks if a field is missing.
function elSettings(): array {
  static $defaults = [
    'company_name'   => 'EQUITY LEGAL s.r.o.',
    'address_street' => 'Chrudimská 1418/2',
    'address_city'   => '130 00 Praha 3, Vinohrady',
    'address_country'=> 'Česká republika',
    'ico'            => '03562795',
    'dic'            => '',
    'databox'        => '2fr4sth',
    'phone'          => '+420 799 901 699',
    'email'          => 'kancelar@equitylegal.cz',
    'hours'          => '',
    'map_url'        => '',
    'map_lat'        => '',
    'map_lng'        => '',
    'social_youtube' => 'https://www.youtube.com/@EquityLegal-z1r',
    'social_linkedin'=> '',
    'social_facebook'=> '',
    'footer_text'    => 'Prémiové právní poradenství a zastupování s více jak 15letou zkušeností. Individuální přístup ke každému klientovi.',
    'bar_membership' => 'Člen České advokátní komory',
  ];
  $saved = elReadJson('settings.json');
  return array_merge($defaults, $saved);
}

// Editable text/image blocks for the main pages, with safe defaults matching
// the site's original hardcoded copy so nothing breaks if a field is empty.
function elPage(string $page): array {
  static $defaults = [
    'home' => [
      'hero_label'    => 'Advokátní kancelář · Praha',
      'hero_title'    => 'Naše poslání je <em>váš úspěch</em>',
      'hero_desc'     => 'EQUITY LEGAL kombinuje hlubokou znalost práva s kreativním přístupem k řešení složitých právních případů. Poskytujeme poradenství v češtině, angličtině, němčině a dalších jazycích.',
      'hero_image'    => 'assets/img/hero-bg.jpg',
      'about_title'   => 'Právní kancelář, která hledá řešení',
      'about_text1'   => 'EQUITY LEGAL poskytuje právní poradenství a zastupování klientů s důrazem na odbornost a praktické výsledky. Název EQUITY vyjadřuje naši schopnost hledat spravedlivá a efektivní řešení i ve složitých právních situacích. LEGAL představuje hlubokou znalost práva, preciznost a odborné dovednosti, o které se naši klienti mohou opřít.',
      'about_text2'   => 'Aktivně pracujeme s moderními technologiemi a orientujeme se v oblasti ICT práva, startupů, ochrany dat i duševního vlastnictví. Díky tomu dokážeme poskytovat efektivní a aktuální právní řešení. Jsme partnerem pro růst i oporou v náročných situacích.',
      'about_text3'   => 'Naši kancelář najdete v Praze 3 na Vinohradech.',
      'about_image'   => 'assets/img/office.jpg',
      'cta_title'     => 'Potřebujete právní pomoc?',
      'cta_text'      => 'Kontaktujte nás pro konzultaci.',
      'reviews'       => [
        [
          'name'    => 'Lukáš Topinka',
          'text'    => 'Společnost Equity Legal jsem požádal o pomoc při řešení problému s koupí nemovitosti. Spolupráce byla perfektní a velmi profesionální. Mohu jedině doporučit!',
          'text_en' => 'I asked Equity Legal for help resolving an issue with a property purchase. The cooperation was perfect and highly professional. I can only recommend them!',
          'text_de' => 'Ich habe Equity Legal um Hilfe bei einem Problem mit einem Immobilienkauf gebeten. Die Zusammenarbeit war perfekt und sehr professionell. Ich kann sie nur empfehlen!',
        ],
        [
          'name'    => 'Maxim Vrána',
          'text'    => 'Potřeboval jsem profi poradenství a zastupování při řešení nemovitosti a musím říct, že jsem byl maximálně spokojen. Rychlé, efektivní, super komunikace. Proste děkuji 👍',
          'text_en' => 'I needed professional advice and representation in dealing with a property matter, and I have to say I was extremely satisfied. Fast, efficient, great communication. Simply, thank you 👍',
          'text_de' => 'Ich brauchte professionelle Beratung und Vertretung bei einer Immobilienangelegenheit und muss sagen, dass ich äußerst zufrieden war. Schnell, effizient, super Kommunikation. Einfach danke 👍',
        ],
        [
          'name'    => 'Pervushyn Andrij',
          'text'    => 'S potěšením doporučuji Equity Legal a děkuji jejich týmu za úspěšné vyřešení mé záležitosti s mým bývalým zaměstnavatelem.',
          'text_en' => 'I am delighted to recommend Equity Legal and would like to thank their team for successfully resolving my matter with my former employer.',
          'text_de' => 'Ich empfehle Equity Legal gerne weiter und danke dem Team für die erfolgreiche Lösung meiner Angelegenheit mit meinem ehemaligen Arbeitgeber.',
        ],
      ],
    ],
    'sluzby' => [
      'hero_label' => 'Co nabízíme',
      'hero_title' => 'Právní služby',
      'hero_desc'  => 'Poskytujeme komplexní právní poradenství a zastupování v 13 specializovaných oblastech práva. Každé řešení přizpůsobujeme individuálním potřebám klienta.',
    ],
    'tym' => [
      'hero_label' => 'Lidé kanceláře',
      'hero_title' => 'Náš tým',
      'hero_desc'  => 'Tým EQUITY LEGAL tvoří zkušení advokáti a specialisté s českou i mezinárodní praxí.',
    ],
  ];
  $base = $page === 'ochrana' ? require __DIR__ . '/privacy-default.php' : ($defaults[$page] ?? []);
  $all  = elReadJson('pages.json');
  return array_merge($base, $all[$page] ?? []);
}

// The legal service areas (label, short description, bullet points in CS/EN/DE).
// Edited in the admin and stored in data/services.json; falls back to the
// original copy in services-data.php until then.
function elServices(): array {
  static $services = null;
  if ($services !== null) return $services;
  $saved = elReadJson('services.json');
  $isFull = !empty($saved) && isset($saved[0]['desc']);
  $services = $isFull ? $saved : require __DIR__ . '/services-data.php';
  return $services;
}
