<?php
// ── includes/i18n.php ──
// Minimal i18n layer: locale is read from the URL prefix (/en/, /de/, else cs).

define('EL_LOCALES', ['cs', 'en', 'de']);

function elLocale(): string {
  static $locale = null;
  if ($locale !== null) return $locale;
  $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
  if (preg_match('#^/(en|de)(?:/|$)#', $path, $m)) {
    $locale = $m[1];
  } else {
    $locale = 'cs';
  }
  return $locale;
}

function elLocalePrefix(?string $locale = null): string {
  $locale = $locale ?? elLocale();
  return $locale === 'cs' ? '' : '/' . $locale;
}

// Build a localized link to a site-root-relative path, e.g. lu('/sluzby.php') -> /en/sluzby.php
// Preserves an optional query string passed separately.
function lu(string $path, ?string $locale = null): string {
  $path = '/' . ltrim($path, '/');
  return elLocalePrefix($locale) . $path;
}

// Locale-aware field reader: for a given data array and base field name,
// returns $arr[field_LOCALE] if present and non-empty, otherwise falls back to $arr[field] (Czech).
function tf(array $arr, string $field, ?string $locale = null): string {
  $locale = $locale ?? elLocale();
  if ($locale !== 'cs') {
    $key = $field . '_' . $locale;
    if (isset($arr[$key]) && $arr[$key] !== '') return (string)$arr[$key];
  }
  return (string)($arr[$field] ?? '');
}

// Same as tf() but for array-valued fields (e.g. specializations, projects lists).
function tfArr(array $arr, string $field, ?string $locale = null): array {
  $locale = $locale ?? elLocale();
  if ($locale !== 'cs') {
    $key = $field . '_' . $locale;
    if (!empty($arr[$key]) && is_array($arr[$key])) return $arr[$key];
  }
  return is_array($arr[$field] ?? null) ? $arr[$field] : [];
}

function elDict(): array {
  static $d = null;
  if ($d !== null) return $d;
  $d = [
    'html_lang' => ['cs' => 'cs', 'en' => 'en', 'de' => 'de'],

    // Navigation
    'nav_services'      => ['cs' => 'Právní služby',  'en' => 'Legal services',        'de' => 'Rechtsdienstleistungen'],
    'nav_blog'           => ['cs' => 'Blog',           'en' => 'Blog',                   'de' => 'Blog'],
    'nav_team'           => ['cs' => 'Náš tým',        'en' => 'Our team',               'de' => 'Unser Team'],
    'nav_publications'   => ['cs' => 'Publikace',      'en' => 'Publications',           'de' => 'Veröffentlichungen'],
    'nav_contacts'       => ['cs' => 'Kontakty',       'en' => 'Contacts',               'de' => 'Kontakt'],
    'nav_aria'           => ['cs' => 'Hlavní menu',    'en' => 'Main menu',              'de' => 'Hauptmenü'],
    'nav_logo_aria'      => ['cs' => 'EQUITY LEGAL – úvodní stránka', 'en' => 'EQUITY LEGAL – homepage', 'de' => 'EQUITY LEGAL – Startseite'],
    'nav_open_menu'      => ['cs' => 'Otevřít menu',   'en' => 'Open menu',              'de' => 'Menü öffnen'],
    'nav_lang_switch'     => ['cs' => 'Změnit jazyk',  'en' => 'Change language',        'de' => 'Sprache ändern'],

    // Buttons / CTAs
    'btn_send_enquiry'   => ['cs' => 'Poslat poptávku', 'en' => 'Send an enquiry',       'de' => 'Anfrage senden'],
    'btn_submit_enquiry' => ['cs' => 'Odeslat dotaz',   'en' => 'Submit enquiry',        'de' => 'Anfrage absenden'],
    'btn_more_info'      => ['cs' => 'Více informací',  'en' => 'More information',      'de' => 'Weitere Informationen'],
    'btn_all_services'   => ['cs' => 'Všechny právní služby', 'en' => 'All legal services', 'de' => 'Alle Rechtsdienstleistungen'],
    'btn_read_article'   => ['cs' => 'Číst celý článek', 'en' => 'Read the full article', 'de' => 'Den ganzen Artikel lesen'],
    'btn_all_articles'   => ['cs' => 'Všechny články',  'en' => 'All articles',          'de' => 'Alle Artikel'],
    'btn_back_articles'  => ['cs' => '← Zpět na všechny články', 'en' => '← Back to all articles', 'de' => '← Zurück zu allen Artikeln'],
    'btn_meet_team'      => ['cs' => 'Poznejte náš tým', 'en' => 'Meet our team',        'de' => 'Lernen Sie unser Team kennen'],
    'btn_all'            => ['cs' => 'Vše',              'en' => 'All',                   'de' => 'Alles'],
    'btn_download_read'  => ['cs' => 'Stáhnout / číst →','en' => 'Download / read →',    'de' => 'Herunterladen / lesen →'],
    'btn_close'          => ['cs' => 'Zavřít',           'en' => 'Close',                 'de' => 'Schließen'],

    // Footer
    'footer_law_firm'    => ['cs' => 'Advokátní kancelář', 'en' => 'Law firm',            'de' => 'Anwaltskanzlei'],
    'footer_nav'         => ['cs' => 'Navigace',         'en' => 'Navigation',            'de' => 'Navigation'],
    'footer_contact'     => ['cs' => 'Kontakt',          'en' => 'Contact',               'de' => 'Kontakt'],
    'footer_rights'      => ['cs' => 'Všechna práva vyhrazena.', 'en' => 'All rights reserved.', 'de' => 'Alle Rechte vorbehalten.'],
    'scroll_top'         => ['cs' => 'Zpět nahoru',      'en' => 'Back to top',           'de' => 'Nach oben'],

    // Homepage
    'why_us'             => ['cs' => 'Proč EQUITY LEGAL', 'en' => 'Why EQUITY LEGAL',     'de' => 'Warum EQUITY LEGAL'],
    'core_values'        => ['cs' => 'Naše základní hodnoty', 'en' => 'Our core values',  'de' => 'Unsere Grundwerte'],
    'value1_title'       => ['cs' => 'Byznysové myšlení místo pouhého „paragrafování“', 'en' => 'A business mindset rather than merely ‘quoting the law’', 'de' => 'Geschäftsorientiertes Denken statt bloßer „Paragraphenauslegung“'],
    'value1_text'        => ['cs' => 'Většina advokátních kanceláří vám řekne, co v zákoně stojí a proč něco nejde. EQUITY LEGAL naopak přemýšlí jako partner ve vašem podnikání.', 'en' => 'Most law firms will tell you what the law says and why something isn’t possible. EQUITY LEGAL, on the other hand, thinks like a partner in your business.', 'de' => 'Die meisten Anwaltskanzleien sagen Ihnen, was im Gesetz steht und warum etwas nicht möglich ist. EQUITY LEGAL denkt dagegen wie ein Partner in Ihrem Unternehmen.'],
    'value2_title'       => ['cs' => 'Neopouštíme vás v těžkých časech', 'en' => 'We don’t abandon you in difficult times', 'de' => 'Wir lassen Sie in schwierigen Zeiten nicht im Stich'],
    'value2_text'        => ['cs' => 'Pro řadu kanceláří je klient jen dalším spisem v pořadí. V EQUITY LEGAL si zakládáme na tom, že partnerství myslíme vážně. Své klienty neopouštíme v těžkých časech.', 'en' => 'For many firms, a client is just another case on the list. At EQUITY LEGAL, we pride ourselves on taking our partnership seriously. We don’t abandon our clients in difficult times.', 'de' => 'Für viele Kanzleien ist der Mandant nur ein weiterer Fall in der Reihe. Bei EQUITY LEGAL legen wir großen Wert darauf, dass wir Partnerschaft ernst nehmen. Wir lassen unsere Mandanten in schwierigen Zeiten nicht im Stich.'],
    'value3_title'       => ['cs' => 'Kombinace korporátního know-how a flexibility střední kanceláře', 'en' => 'A combination of corporate know-how and the flexibility of a mid‑sized firm', 'de' => 'Kombination aus Unternehmens-Know-how und der Flexibilität einer mittelgroßen Kanzlei'],
    'value3_text'        => ['cs' => 'Tým EQUITY LEGAL tvoří lidé, kteří prošli velkou mezinárodní či největší domácí advokacií a transakcemi za miliardy.', 'en' => 'The EQUITY LEGAL team consists of people who have worked at major international or leading domestic law firms and handled transactions worth billions.', 'de' => 'Das Team von EQUITY LEGAL besteht aus Menschen, die bei großen internationalen oder den größten heimischen Anwaltskanzleien gearbeitet und Transaktionen in Milliardenhöhe begleitet haben.'],
    'value4_title'       => ['cs' => 'Právo s lidskou tváří', 'en' => 'Law with a human touch', 'de' => 'Recht mit menschlichem Antlitz'],
    'value4_text'        => ['cs' => 'Jednou z největších bariér mezi advokátem a klientem bývá právnická hantýrka. EQUITY LEGAL sází na absolutní přímočarost a srozumitelnost.', 'en' => 'One of the biggest barriers between a solicitor and a client is often legal jargon. EQUITY LEGAL is committed to absolute clarity and comprehensibility.', 'de' => 'Eine der größten Barrieren zwischen Anwalt und Mandant ist oft die juristische Fachsprache. EQUITY LEGAL setzt auf absolute Geradlinigkeit und Verständlichkeit.'],

    'what_we_offer'      => ['cs' => 'Co nabízíme', 'en' => 'What we offer',            'de' => 'Was wir bieten'],
    'main_services'      => ['cs' => 'Hlavní oblasti právních služeb', 'en' => 'Main areas of legal services', 'de' => 'Hauptbereiche der Rechtsdienstleistungen'],
    'client_reviews_label' => ['cs' => 'Co říkají klienti', 'en' => 'What our clients say', 'de' => 'Was unsere Mandanten sagen'],
    'client_reviews'     => ['cs' => 'Recenze klientů', 'en' => 'Client reviews',        'de' => 'Mandantenbewertungen'],
    'about_us'           => ['cs' => 'O nás', 'en' => 'About us',                        'de' => 'Über uns'],
    'years_exp'          => ['cs' => 'let zkušeností', 'en' => 'years of experience',    'de' => 'Jahre Erfahrung'],
    'lang_advice'        => ['cs' => 'jazyků poradenství', 'en' => 'languages of advice','de' => 'Beratungssprachen'],
    'areas_of_law'       => ['cs' => 'oblastí práva', 'en' => 'areas of law',            'de' => 'Rechtsgebiete'],
    'personalised'       => ['cs' => 'individuální přístup', 'en' => 'personalised approach', 'de' => 'individueller Ansatz'],
    'news_label'         => ['cs' => 'Co je nového', 'en' => 'What’s new',              'de' => 'Aktuelles'],
    'news_title'         => ['cs' => 'Z aktualit', 'en' => 'From the news',              'de' => 'Aus den Neuigkeiten'],
    'cta_help_title'      => ['cs' => 'Potřebujete právní pomoc?', 'en' => 'Do you need legal assistance?', 'de' => 'Benötigen Sie rechtliche Hilfe?'],
    'cta_help_text'       => ['cs' => 'Kontaktujte nás pro konzultaci.', 'en' => 'Contact us for a consultation.', 'de' => 'Kontaktieren Sie uns für eine Beratung.'],

    // Services page
    'services_needadvice_title' => ['cs' => 'Potřebujete poradenství?', 'en' => 'Do you need advice?', 'de' => 'Benötigen Sie Beratung?'],
    'services_needadvice_text'  => ['cs' => 'Kontaktujte nás pro nezávaznou konzultaci. Naši advokáti jsou připraveni vám pomoci.', 'en' => 'Contact us for a no-obligation consultation. Our solicitors are ready to help you.', 'de' => 'Kontaktieren Sie uns für eine unverbindliche Beratung. Unsere Rechtsanwälte stehen bereit, Ihnen zu helfen.'],
    'services_nav_aria'  => ['cs' => 'Oblasti práva', 'en' => 'Areas of law',            'de' => 'Rechtsgebiete'],

    // Team page
    'team_collaboration_label' => ['cs' => 'Spolupráce', 'en' => 'Collaboration',        'de' => 'Zusammenarbeit'],
    'team_external_title' => ['cs' => 'Externí spolupracující osoby', 'en' => 'External collaborators', 'de' => 'Externe Mitarbeiter'],
    'team_external_intro' => ['cs' => 'Na vybraných zahraničních agendách spolupracujeme s prověřenými externími specialisty.', 'en' => 'We work with vetted external specialists on selected international matters.', 'de' => 'Wir arbeiten bei ausgewählten internationalen Angelegenheiten mit geprüften externen Spezialisten zusammen.'],
    'team_modal_bio'      => ['cs' => 'Bio', 'en' => 'Biography',                        'de' => 'Biografie'],
    'team_modal_spec'     => ['cs' => 'Specializace', 'en' => 'Specialisation',          'de' => 'Spezialisierung'],
    'team_modal_projects' => ['cs' => 'Referenční projekty', 'en' => 'Representative projects', 'de' => 'Referenzprojekte'],
    'team_modal_close'    => ['cs' => 'Zavřít', 'en' => 'Close',                          'de' => 'Schließen'],
    'team_cta_title'      => ['cs' => 'Chcete s námi spolupracovat?', 'en' => 'Would you like to work with us?', 'de' => 'Möchten Sie mit uns zusammenarbeiten?'],
    'team_cta_text'       => ['cs' => 'Kontaktujte konkrétního advokáta nebo nám napište na kancelář@equitylegal.cz.', 'en' => 'Please contact a specific solicitor or email us at kancelar@equitylegal.cz.', 'de' => 'Bitte kontaktieren Sie einen bestimmten Rechtsanwalt oder schreiben Sie uns an kancelar@equitylegal.cz.'],

    // Contact page
    'contact_hero_label' => ['cs' => 'Spojte se s námi', 'en' => 'Get in touch',         'de' => 'Kontaktieren Sie uns'],
    'contact_hero_text'  => ['cs' => 'Rádi odpovíme na vaše dotazy a připravíme konzultaci. Kontaktujte nás telefonicky, e-mailem nebo prostřednictvím formuláře.', 'en' => 'We’d be happy to answer your questions and arrange a consultation. Please contact us by phone, email or via the form.', 'de' => 'Wir beantworten gerne Ihre Fragen und vereinbaren eine Beratung. Kontaktieren Sie uns telefonisch, per E-Mail oder über das Formular.'],
    'contact_where_label'=> ['cs' => 'Kde nás najdete', 'en' => 'Where to find us',      'de' => 'Wo Sie uns finden'],
    'contact_address'    => ['cs' => 'Adresa', 'en' => 'Address',                        'de' => 'Adresse'],
    'contact_phone'      => ['cs' => 'Telefon', 'en' => 'Telephone',                     'de' => 'Telefon'],
    'contact_email'      => ['cs' => 'E-mail', 'en' => 'E-mail',                         'de' => 'E-Mail'],
    'contact_databox'    => ['cs' => 'ID datové schránky', 'en' => 'Data box ID',        'de' => 'Postfach-ID'],
    'contact_hours'      => ['cs' => 'Konzultační doba', 'en' => 'Consultation hours',   'de' => 'Beratungszeiten'],
    'contact_billing_title' => ['cs' => 'Fakturační údaje', 'en' => 'Billing details',   'de' => 'Rechnungsangaben'],
    'contact_billing_name'  => ['cs' => 'Název', 'en' => 'Name',                          'de' => 'Name'],
    'contact_billing_ico'   => ['cs' => 'IČO', 'en' => 'Company reg. no.',               'de' => 'Handelsregisternummer'],
    'contact_billing_dic'   => ['cs' => 'DIČ', 'en' => 'VAT no.',                         'de' => 'USt-IdNr.'],
    'contact_billing_seat'  => ['cs' => 'Sídlo', 'en' => 'Registered office',            'de' => 'Sitz'],
    'contact_billing_member'=> ['cs' => 'Člen', 'en' => 'Member',                         'de' => 'Mitglied'],
    'contact_form_title'  => ['cs' => 'Napište nám', 'en' => 'Write to us',              'de' => 'Schreiben Sie uns'],
    'contact_form_success'=> ['cs' => '✓ Váš dotaz byl odeslán. Ozveme se vám co nejdříve.', 'en' => '✓ Your enquiry has been submitted. We will get back to you as soon as possible.', 'de' => '✓ Ihre Anfrage wurde gesendet. Wir melden uns schnellstmöglich bei Ihnen.'],
    'form_name'           => ['cs' => 'Jméno', 'en' => 'Name',                            'de' => 'Name'],
    'form_email'          => ['cs' => 'E-mail', 'en' => 'E-mail',                         'de' => 'E-Mail'],
    'form_phone_optional' => ['cs' => 'Telefon', 'en' => 'Telephone',                     'de' => 'Telefon'],
    'form_optional'       => ['cs' => '(nepovinný)', 'en' => '(optional)',                'de' => '(optional)'],
    'form_service'        => ['cs' => 'Oblast práva', 'en' => 'Area of law',             'de' => 'Rechtsgebiet'],
    'form_service_select' => ['cs' => '— Vyberte oblast —', 'en' => '— Select an area —','de' => '— Bereich auswählen —'],
    'form_message'        => ['cs' => 'Váš dotaz', 'en' => 'Your enquiry',               'de' => 'Ihre Anfrage'],
    'form_message_ph'     => ['cs' => 'Popište váš právní dotaz nebo situaci…', 'en' => 'Please describe your legal enquiry or situation...', 'de' => 'Beschreiben Sie bitte Ihre rechtliche Anfrage oder Situation...'],
    'form_gdpr'           => ['cs' => 'Souhlasím se zpracováním osobních údajů za účelem zodpovězení mého dotazu dle zásad ochrany osobních údajů.', 'en' => 'I consent to the processing of my personal data for the purpose of responding to my enquiry in accordance with the privacy policy.', 'de' => 'Ich stimme der Verarbeitung meiner personenbezogenen Daten zur Beantwortung meiner Anfrage gemäß der Datenschutzrichtlinie zu.'],

    // Blog / articles
    'blog_hero_label'    => ['cs' => 'Aktuality a řešené případy', 'en' => 'News and cases handled', 'de' => 'Aktuelles und bearbeitete Fälle'],
    'blog_title'         => ['cs' => 'Blog', 'en' => 'Blog',                              'de' => 'Blog'],
    'blog_intro'         => ['cs' => 'Řešené případy z naší praxe i zajímavosti z právního oboru a dění v kanceláři EQUITY LEGAL.', 'en' => 'Cases we have handled, as well as interesting topics from the legal field and news from our office EQUITY LEGAL.', 'de' => 'Fallbeispiele aus unserer Praxis sowie interessante Themen aus dem Rechtsbereich und Neuigkeiten aus unserer Kanzlei EQUITY LEGAL.'],
    'blog_empty_cat'     => ['cs' => 'Žádné články v této kategorii.', 'en' => 'No articles in this category.', 'de' => 'Keine Artikel in dieser Kategorie.'],
    'article_need_advice_title' => ['cs' => 'Potřebujete poradit?', 'en' => 'Need advice?', 'de' => 'Benötigen Sie Beratung?'],
    'article_need_advice_text'  => ['cs' => 'Naši advokáti jsou připraveni vám pomoci.', 'en' => 'Our solicitors are ready to help you.', 'de' => 'Unsere Rechtsanwälte stehen bereit, Ihnen zu helfen.'],
    'article_related_services'  => ['cs' => 'Související služby', 'en' => 'Related services', 'de' => 'Verbundene Dienstleistungen'],
    'article_similar_case_title'=> ['cs' => 'Máte podobný případ?', 'en' => 'Do you have a similar case?', 'de' => 'Haben Sie einen ähnlichen Fall?'],
    'article_similar_case_text' => ['cs' => 'Kontaktujte nás pro nezávaznou konzultaci.', 'en' => 'Contact us for a no-obligation consultation.', 'de' => 'Kontaktieren Sie uns für eine unverbindliche Beratung.'],

    // Publications
    'pub_hero_label'     => ['cs' => 'Odborné texty', 'en' => 'Professional articles',    'de' => 'Fachtexte'],
    'pub_title'          => ['cs' => 'Publikace', 'en' => 'Publications',                'de' => 'Veröffentlichungen'],
    'pub_intro'          => ['cs' => 'Advokáti EQUITY LEGAL se aktivně podílejí na tvorbě odborné literatury a publikují v předních právních časopisech.', 'en' => 'EQUITY LEGAL’s solicitors are actively involved in producing professional literature and publish in leading legal journals.', 'de' => 'Die Rechtsanwälte von EQUITY LEGAL beteiligen sich aktiv an der Erstellung von Fachliteratur und veröffentlichen in führenden juristischen Fachzeitschriften.'],
    'pub_tab_books'      => ['cs' => 'Knižní publikace', 'en' => 'Book publications',    'de' => 'Buchpublikationen'],
    'pub_tab_articles'   => ['cs' => 'Odborné články', 'en' => 'Professional articles',  'de' => 'Fachartikel'],
    'pub_type_book'      => ['cs' => 'Knižní publikace', 'en' => 'Book publication',     'de' => 'Buchpublikation'],
    'pub_type_article'   => ['cs' => 'Odborný článek', 'en' => 'Professional article',   'de' => 'Fachartikel'],
    'pub_cta_title'      => ['cs' => 'Chcete vědět více?', 'en' => 'Would you like to know more?', 'de' => 'Möchten Sie mehr wissen?'],
    'pub_cta_text'       => ['cs' => 'Kontaktujte nás pro odbornou konzultaci.', 'en' => 'Contact us for a specialist consultation.', 'de' => 'Kontaktieren Sie uns für eine Fachberatung.'],
  ];
  return $d;
}

function elMetaDict(): array {
  static $m = null;
  if ($m !== null) return $m;
  $m = [
    'home_title' => [
      'cs' => 'Advokátní kancelář EQUITY LEGAL – Vaše právo, náš závazek',
      'en' => 'EQUITY LEGAL Law Firm – Your Rights, Our Commitment',
      'de' => 'Anwaltskanzlei EQUITY LEGAL – Ihr Recht, unser Engagement',
    ],
    'home_desc' => [
      'cs' => 'EQUITY LEGAL – prémiové právní poradenství s více jak 15letou zkušeností. Obchodní právo, nemovitosti, trestní právo, mezinárodní právo. Praha, Vinohrady.',
      'en' => 'EQUITY LEGAL – premium legal advice with over 15 years of experience. Commercial law, property, criminal law, international law. Prague, Vinohrady.',
      'de' => 'EQUITY LEGAL – erstklassige Rechtsberatung mit mehr als 15 Jahren Erfahrung. Handelsrecht, Immobilien, Strafrecht, internationales Recht. Prag, Vinohrady.',
    ],
    'sluzby_title' => [
      'cs' => 'Právní služby – EQUITY LEGAL',
      'en' => 'Legal Services – EQUITY LEGAL',
      'de' => 'Rechtsdienstleistungen – EQUITY LEGAL',
    ],
    'sluzby_desc' => [
      'cs' => 'Přehled všech právních služeb advokátní kanceláře EQUITY LEGAL: obchodní právo, pracovní právo, nemovitosti, sporná agenda, trestní právo, rodinné právo a další.',
      'en' => 'An overview of all legal services provided by the EQUITY LEGAL law firm: commercial law, employment law, property, litigation, criminal law, family law and more.',
      'de' => 'Übersicht aller Rechtsdienstleistungen der Anwaltskanzlei EQUITY LEGAL: Handelsrecht, Arbeitsrecht, Immobilien, Streitbeilegung, Strafrecht, Familienrecht und mehr.',
    ],
    'tym_title' => [
      'cs' => 'Náš tým – EQUITY LEGAL',
      'en' => 'Our Team – EQUITY LEGAL',
      'de' => 'Unser Team – EQUITY LEGAL',
    ],
    'tym_desc' => [
      'cs' => 'Tým advokátní kanceláře EQUITY LEGAL: zkušení advokáti s mezinárodní praxí poskytující poradenství v češtině, angličtině, němčině a dalších jazycích.',
      'en' => 'The team of the EQUITY LEGAL law firm: experienced solicitors with international practice, providing advice in Czech, English, German and other languages.',
      'de' => 'Das Team der Anwaltskanzlei EQUITY LEGAL: erfahrene Rechtsanwälte mit internationaler Praxis, die auf Tschechisch, Englisch, Deutsch und in weiteren Sprachen beraten.',
    ],
    'kontakty_title' => [
      'cs' => 'Kontakty – EQUITY LEGAL',
      'en' => 'Contacts – EQUITY LEGAL',
      'de' => 'Kontakt – EQUITY LEGAL',
    ],
    'kontakty_desc' => [
      'cs' => 'Kontaktujte advokátní kancelář EQUITY LEGAL.',
      'en' => 'Contact the EQUITY LEGAL law firm.',
      'de' => 'Kontaktieren Sie die Anwaltskanzlei EQUITY LEGAL.',
    ],
    'blog_title_meta' => [
      'cs' => 'Blog – EQUITY LEGAL',
      'en' => 'Blog – EQUITY LEGAL',
      'de' => 'Blog – EQUITY LEGAL',
    ],
    'blog_desc_meta' => [
      'cs' => 'Blog advokátní kanceláře EQUITY LEGAL: řešené případy z praxe i zajímavosti z právního oboru a dění v kanceláři.',
      'en' => 'The EQUITY LEGAL law firm blog: cases we have handled, as well as interesting topics from the legal field and news from our office.',
      'de' => 'Der Blog der Anwaltskanzlei EQUITY LEGAL: bearbeitete Fälle aus der Praxis sowie interessante Themen aus dem Rechtsbereich und Neuigkeiten aus der Kanzlei.',
    ],
    'pub_title_meta' => [
      'cs' => 'Publikace – EQUITY LEGAL',
      'en' => 'Publications – EQUITY LEGAL',
      'de' => 'Veröffentlichungen – EQUITY LEGAL',
    ],
    'pub_desc_meta' => [
      'cs' => 'Odborné publikace, knihy a články advokátní kanceláře EQUITY LEGAL. Právní komentáře, casebooky a odborné texty.',
      'en' => 'Professional publications, books and articles by the EQUITY LEGAL law firm. Legal commentaries, casebooks and professional texts.',
      'de' => 'Fachpublikationen, Bücher und Artikel der Anwaltskanzlei EQUITY LEGAL. Rechtskommentare, Fallsammlungen und Fachtexte.',
    ],
  ];
  return $m;
}

function tm(string $key): string {
  $m = elMetaDict();
  $locale = elLocale();
  return $m[$key][$locale] ?? $m[$key]['cs'] ?? $key;
}

function t(string $key): string {
  $d = elDict();
  $locale = elLocale();
  return $d[$key][$locale] ?? $d[$key]['cs'] ?? $key;
}

// Translates an article/blog category value (stored in Czech in the data files).
function catLabel(string $category): string {
  $map = [
    'Aktuality'        => ['en' => 'News',         'de' => 'Aktuelles'],
    'Řešené případy'   => ['en' => 'Case studies', 'de' => 'Fallstudien'],
  ];
  $locale = elLocale();
  return $map[$category][$locale] ?? $category;
}
