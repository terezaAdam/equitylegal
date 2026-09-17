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
  $all = elReadJson('pages.json');
  return array_merge($defaults[$page] ?? [], $all[$page] ?? []);
}
