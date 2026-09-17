<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/i18n.php';
$locale = elLocale();
$pageTitle = t('nav_privacy') . ' – EQUITY LEGAL';
$pageDesc  = t('privacy_hero_label') . ' – EQUITY LEGAL.';
include 'includes/header.php';

$updated = [
  'cs' => 'září 2026',
  'en' => 'September 2026',
  'de' => 'September 2026',
];
?>

<section class="page-hero">
  <div class="container">
    <p class="page-hero__label"><?= htmlspecialchars(t('privacy_hero_label')) ?></p>
    <?php if ($locale === 'en'): ?>
      <h1 class="page-hero__title">Privacy Policy</h1>
      <div class="page-hero__desc"><p>Information on the processing of personal data pursuant to Article 13 of the GDPR.</p></div>
    <?php elseif ($locale === 'de'): ?>
      <h1 class="page-hero__title">Datenschutzbestimmungen</h1>
      <div class="page-hero__desc"><p>Informationen zur Verarbeitung personenbezogener Daten gemäß Art. 13 DSGVO.</p></div>
    <?php else: ?>
      <h1 class="page-hero__title">Zásady ochrany osobních údajů</h1>
      <div class="page-hero__desc"><p>Informace o zpracování osobních údajů podle čl. 13 nařízení GDPR.</p></div>
    <?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="article-detail">
      <article class="article-content">

        <?php if ($locale === 'en'): ?>

          <h2>1. Data controller</h2>
          <p>The controller of your personal data is Equity Legal s.r.o., ID No. (IČO): 07410441, with its registered seat at Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady, Czech Republic ("the firm" or "we").</p>
          <p>You can contact us regarding the processing of your personal data:</p>
          <ul>
            <li>by e-mail: <a href="mailto:kancelar@equitylegal.cz">kancelar@equitylegal.cz</a></li>
            <li>in writing at: Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady</li>
          </ul>

          <h2>2. What personal data we process</h2>
          <p>We process personal data that you provide to us yourself, in particular through the contact form on our website, by e-mail, by telephone, or in connection with the provision of legal services.</p>
          <p>This may in particular include:</p>
          <ul>
            <li>identification data, in particular your name and surname;</li>
            <li>contact details, in particular your e-mail address and telephone number;</li>
            <li>data provided in the contact form, in particular the area of law you selected and the content of your message;</li>
            <li>any further information you provide to us as part of your enquiry or subsequent communication;</li>
            <li>where cooperation is established, further identification, contact and case-related data necessary for the provision of legal services;</li>
            <li>technical data related to the use of the website and the contact form, in particular your IP address, the date and time of the request, and other standard technical operational data.</li>
          </ul>
          <p>Given the nature of legal services, the content of communication may in individual cases also include more sensitive information. We process such data only to the extent necessary to handle your enquiry, assess the case, or provide legal services, and in accordance with applicable legal regulations.</p>

          <h2>3. Purposes of processing</h2>
          <p>We process your personal data in particular for the purposes of:</p>
          <ul>
            <li>receiving, handling and responding to your enquiry;</li>
            <li>communicating with you;</li>
            <li>assessing whether we can provide legal services;</li>
            <li>negotiating the conclusion of a contract for the provision of legal services;</li>
            <li>concluding and performing a contract for the provision of legal services;</li>
            <li>complying with our legal and professional (Bar Association) obligations;</li>
            <li>maintaining accounting, tax and other mandatory records;</li>
            <li>protecting and asserting our rights and legal claims;</li>
            <li>ensuring the proper, secure and reliable operation of our website and contact form.</li>
          </ul>

          <h2>4. Legal basis for processing</h2>
          <p>Depending on the specific situation, we process your personal data in particular on the basis of:</p>
          <ul>
            <li>the performance of measures taken at your request prior to entering into a contract, and the performance of the contract, pursuant to Art. 6(1)(b) GDPR, in particular where you contact us with a request for legal services or where we are already providing legal services to you;</li>
            <li>compliance with legal obligations pursuant to Art. 6(1)(c) GDPR, in particular obligations arising from legal regulations governing the practice of law, accounting, taxes, or measures against the legalisation of proceeds of crime;</li>
            <li>our legitimate interests pursuant to Art. 6(1)(f) GDPR, in particular the interest in handling routine enquiries, protecting and asserting our legal claims, and ensuring the security and proper operation of the website.</li>
          </ul>
          <p>If, in a specific case, processing were to be based on your consent, you will be informed of this separately in advance, and you will be able to withdraw your consent at any time.</p>

          <h2>5. Retention period</h2>
          <p>Personal data provided through the contact form or in the course of routine communication is retained only for the time necessary to handle your enquiry and any subsequent communication, generally for no longer than 12 months from the last communication, unless a contractual relationship arises in connection with your enquiry or another reason exists for its further retention.</p>
          <p>If a contract for the provision of legal services is concluded, we retain personal data for the duration of the provision of legal services and thereafter for the period required by applicable legal regulations and the professional rules of the Czech Bar Association, or for the period necessary to protect and assert our legal claims.</p>
          <p>Accounting and tax documents are retained for the period stipulated by applicable legal regulations.</p>
          <p>Technical operational data is retained only for the time necessary to ensure the security and proper operation of the website.</p>

          <h2>6. Recipients of personal data</h2>
          <p>Your personal data may, to the necessary extent, be accessed in particular by:</p>
          <ul>
            <li>our attorneys, trainee attorneys, employees and other cooperating persons bound by an obligation of confidentiality;</li>
            <li>providers of IT, hosting, e-mail and other technical services;</li>
            <li>the provider of the contact form's technical solution, Web3Forms (Web3Creative);</li>
            <li>accountants, tax advisors, auditors and other professional advisors, where necessary;</li>
            <li>public authorities, courts or other persons, where we are required by law to provide personal data to them, or where doing so is necessary to protect our rights.</li>
          </ul>
          <p>We do not sell personal data to third parties and do not use it for unrelated marketing purposes.</p>

          <h2>7. Contact form and the Web3Forms service</h2>
          <p>For the technical processing and delivery of messages sent via the contact form, we use the Web3Forms service, operated by Web3Creative.</p>
          <p>When the contact form is submitted, the data entered in the form is transmitted to Web3Forms for the purpose of processing and delivering it to the firm.</p>
          <p>According to the provider's current terms, Web3Forms may, in connection with providing its service, process in particular:</p>
          <ul>
            <li>data entered in the individual form fields;</li>
            <li>the content of the message;</li>
            <li>the sender's contact details;</li>
            <li>the IP address, time of submission and other technical metadata.</li>
          </ul>
          <p>Web3Forms acts as a personal data processor with respect to data from the contact form.</p>
          <p>According to the provider's currently published terms, data from form submissions may be retained for the period set out in the settings and terms of the relevant service, but no longer than the period stated by the provider in its current terms.</p>

          <h2>8. Transfers of personal data outside the EU/EEA</h2>
          <p>In connection with the use of the Web3Forms service, personal data may be processed and transferred outside the European Union and the European Economic Area, in particular to the United States of America and India.</p>
          <p>The operator of Web3Forms states that, when transferring personal data from the European Economic Area to third countries, it uses appropriate legal mechanisms, including standard contractual clauses approved by the European Commission (SCCs).</p>
          <p>In providing its service, Web3Forms also uses other technical infrastructure providers and sub-processors.</p>
          <p>Other than in connection with the use of such technical services, we do not routinely transfer personal data outside the EU/EEA.</p>

          <h2>9. Obligation to provide personal data</h2>
          <p>Providing personal data through the contact form is voluntary.</p>
          <p>However, we need the data marked as mandatory in the form in order to accept your enquiry, identify its basic subject matter and respond to it. Without providing this data, it may not be possible to submit the form or to handle your enquiry.</p>
          <p>The telephone number is optional, unless expressly stated otherwise in the form.</p>
          <p>If you enter into a contract for the provision of legal services with us, providing certain personal data may be necessary for the conclusion or performance of the contract, or for compliance with our legal obligations.</p>

          <h2>10. Your rights</h2>
          <p>In connection with the processing of your personal data, subject to the conditions laid down by applicable law, you have in particular the right to:</p>
          <ul>
            <li>request access to your personal data pursuant to Art. 15 GDPR;</li>
            <li>request the rectification of inaccurate or the completion of incomplete personal data pursuant to Art. 16 GDPR;</li>
            <li>request the erasure of personal data pursuant to Art. 17 GDPR;</li>
            <li>request the restriction of processing pursuant to Art. 18 GDPR;</li>
            <li>data portability pursuant to Art. 20 GDPR, where the statutory conditions are met;</li>
            <li>object to processing based on our legitimate interest pursuant to Art. 21 GDPR;</li>
            <li>withdraw your consent, where certain processing is based on your consent, without affecting the lawfulness of processing carried out before its withdrawal.</li>
          </ul>
          <p>You can exercise your rights using the contact details listed in Section 1.</p>
          <p>If you believe that the processing of your personal data infringes applicable law, you also have the right to lodge a complaint with the supervisory authority:</p>
          <p>Office for Personal Data Protection (Úřad pro ochranu osobních údajů)<br>
          Pplk. Sochora 27<br>
          170 00 Praha 7<br>
          <a href="https://uoou.gov.cz/" target="_blank" rel="noopener">uoou.gov.cz</a></p>

          <h2>11. Automated decision-making</h2>
          <p>We do not carry out automated individual decision-making or profiling that would have legal or similarly significant effects on you as part of our processing of personal data.</p>

          <h2>12. Cookies and technical data</h2>
          <p>Our website currently does not use analytical or marketing cookies.</p>
          <p>Only technically necessary cookies and similar technical means may be used, where needed for the correct and secure functioning of the website.</p>
          <p>When visiting the website, standard technical operational data may also be automatically processed, in particular the IP address, device or browser type, the time of the request, and information necessary to ensure the security and proper functioning of the website.</p>

          <h2>13. Changes to this policy</h2>
          <p>We may update this policy in the event of changes to the way we process personal data, the technologies used, or applicable legal regulations.</p>
          <p>The current version is always published on this website.</p>
          <p style="color:var(--text-muted);font-size:.85rem;">Last updated: <?= htmlspecialchars($updated['en']) ?></p>

        <?php elseif ($locale === 'de'): ?>

          <h2>1. Verantwortlicher</h2>
          <p>Verantwortlicher für die Verarbeitung Ihrer personenbezogenen Daten ist Equity Legal s.r.o., IČO: 07410441, mit Sitz in Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady, Tschechische Republik („die Kanzlei" bzw. „wir").</p>
          <p>Sie können uns bezüglich der Verarbeitung Ihrer personenbezogenen Daten wie folgt kontaktieren:</p>
          <ul>
            <li>per E-Mail: <a href="mailto:kancelar@equitylegal.cz">kancelar@equitylegal.cz</a></li>
            <li>schriftlich unter der Anschrift: Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady</li>
          </ul>

          <h2>2. Welche personenbezogenen Daten wir verarbeiten</h2>
          <p>Wir verarbeiten personenbezogene Daten, die Sie uns selbst zur Verfügung stellen, insbesondere über das Kontaktformular auf unserer Website, per E-Mail, telefonisch oder im Zusammenhang mit der Erbringung von Rechtsdienstleistungen.</p>
          <p>Dabei kann es sich insbesondere handeln um:</p>
          <ul>
            <li>Identifikationsdaten, insbesondere Vor- und Nachname;</li>
            <li>Kontaktdaten, insbesondere E-Mail-Adresse und Telefonnummer;</li>
            <li>im Kontaktformular angegebene Daten, insbesondere das von Ihnen ausgewählte Rechtsgebiet und den Inhalt Ihrer Nachricht;</li>
            <li>weitere Angaben, die Sie uns im Rahmen Ihrer Anfrage oder der anschließenden Kommunikation mitteilen;</li>
            <li>bei Aufnahme einer Zusammenarbeit weitere Identifikations-, Kontakt- und fallbezogene Daten, die für die Erbringung von Rechtsdienstleistungen erforderlich sind;</li>
            <li>technische Daten im Zusammenhang mit der Nutzung der Website und des Kontaktformulars, insbesondere IP-Adresse, Datum und Uhrzeit der Anfrage sowie weitere übliche technische Betriebsdaten.</li>
          </ul>
          <p>Aufgrund der Natur von Rechtsdienstleistungen kann der Inhalt der Kommunikation im Einzelfall auch sensiblere Informationen umfassen. Solche Daten verarbeiten wir nur in dem Umfang, der zur Bearbeitung der Anfrage, zur Beurteilung des Falls oder zur Erbringung von Rechtsdienstleistungen erforderlich ist, und im Einklang mit den einschlägigen Rechtsvorschriften.</p>

          <h2>3. Zwecke der Verarbeitung</h2>
          <p>Wir verarbeiten Ihre personenbezogenen Daten insbesondere zu folgenden Zwecken:</p>
          <ul>
            <li>Entgegennahme, Bearbeitung und Beantwortung Ihrer Anfrage;</li>
            <li>Kommunikation mit Ihnen;</li>
            <li>Prüfung der Möglichkeit der Erbringung von Rechtsdienstleistungen;</li>
            <li>Verhandlungen über den Abschluss eines Mandatsvertrags;</li>
            <li>Abschluss und Erfüllung eines Mandatsvertrags;</li>
            <li>Erfüllung unserer gesetzlichen und standesrechtlichen Pflichten;</li>
            <li>Führung der Buchhaltungs-, Steuer- und sonstigen Pflichtaufzeichnungen;</li>
            <li>Schutz und Geltendmachung unserer Rechte und Rechtsansprüche;</li>
            <li>Gewährleistung eines ordnungsgemäßen, sicheren und zuverlässigen Betriebs unserer Website und des Kontaktformulars.</li>
          </ul>

          <h2>4. Rechtsgrundlage der Verarbeitung</h2>
          <p>Je nach konkreter Situation verarbeiten wir Ihre personenbezogenen Daten insbesondere auf Grundlage von:</p>
          <ul>
            <li>der Durchführung von Maßnahmen auf Ihre Anfrage vor Vertragsabschluss sowie der Vertragserfüllung gemäß Art. 6 Abs. 1 lit. b DSGVO, insbesondere wenn Sie uns mit einer Anfrage nach Rechtsdienstleistungen kontaktieren oder wenn wir Ihnen bereits Rechtsdienstleistungen erbringen;</li>
            <li>der Erfüllung gesetzlicher Pflichten gemäß Art. 6 Abs. 1 lit. c DSGVO, insbesondere Pflichten, die sich aus Rechtsvorschriften über die Ausübung der Rechtsanwaltschaft, das Rechnungswesen, Steuern oder Maßnahmen gegen die Geldwäsche ergeben;</li>
            <li>unseren berechtigten Interessen gemäß Art. 6 Abs. 1 lit. f DSGVO, insbesondere dem Interesse an der Bearbeitung gewöhnlicher Anfragen, dem Schutz und der Geltendmachung unserer Rechtsansprüche sowie der Gewährleistung der Sicherheit und des ordnungsgemäßen Betriebs der Website.</li>
          </ul>
          <p>Sollte die Verarbeitung im Einzelfall auf Ihrer Einwilligung beruhen, werden Sie hierüber vorab gesondert informiert und können Ihre Einwilligung jederzeit widerrufen.</p>

          <h2>5. Speicherdauer</h2>
          <p>Über das Kontaktformular oder im Rahmen der gewöhnlichen Kommunikation bereitgestellte personenbezogene Daten speichern wir nur so lange, wie es zur Bearbeitung Ihrer Anfrage und der anschließenden Kommunikation erforderlich ist, in der Regel höchstens 12 Monate ab der letzten Kommunikation, sofern im Zusammenhang mit Ihrer Anfrage kein Vertragsverhältnis entsteht oder kein anderer Grund für eine weitere Speicherung besteht.</p>
          <p>Kommt es zum Abschluss eines Mandatsvertrags, speichern wir personenbezogene Daten für die Dauer der Erbringung der Rechtsdienstleistungen und danach für den nach den geltenden Rechtsvorschriften und der Standesordnung der Tschechischen Anwaltskammer erforderlichen Zeitraum bzw. für den zum Schutz und zur Geltendmachung unserer Rechtsansprüche erforderlichen Zeitraum.</p>
          <p>Buchhaltungs- und Steuerunterlagen werden für den in den geltenden Rechtsvorschriften festgelegten Zeitraum aufbewahrt.</p>
          <p>Technische Betriebsdaten werden nur so lange gespeichert, wie es zur Gewährleistung der Sicherheit und des ordnungsgemäßen Betriebs der Website erforderlich ist.</p>

          <h2>6. Empfänger personenbezogener Daten</h2>
          <p>Zugang zu Ihren personenbezogenen Daten können im erforderlichen Umfang insbesondere haben:</p>
          <ul>
            <li>unsere Rechtsanwälte, Rechtsreferendare, Mitarbeiter und weitere kooperierende Personen, die einer Verschwiegenheitspflicht unterliegen;</li>
            <li>Anbieter von IT-, Hosting-, E-Mail- und sonstigen technischen Dienstleistungen;</li>
            <li>der Anbieter der technischen Lösung des Kontaktformulars, Web3Forms (Web3Creative);</li>
            <li>Buchhalter, Steuerberater, Wirtschaftsprüfer und andere Fachberater, soweit erforderlich;</li>
            <li>Behörden, Gerichte oder andere Personen, sofern wir gesetzlich verpflichtet sind, ihnen personenbezogene Daten zur Verfügung zu stellen, oder sofern dies zum Schutz unserer Rechte erforderlich ist.</li>
          </ul>
          <p>Wir verkaufen personenbezogene Daten nicht an Dritte und nutzen sie nicht für sachfremde Marketingzwecke.</p>

          <h2>7. Kontaktformular und der Dienst Web3Forms</h2>
          <p>Für die technische Verarbeitung und Zustellung der über das Kontaktformular gesendeten Nachrichten nutzen wir den von Web3Creative betriebenen Dienst Web3Forms.</p>
          <p>Beim Absenden des Kontaktformulars werden die im Formular angegebenen Daten an Web3Forms übermittelt, um sie zu verarbeiten und an die Kanzlei zuzustellen.</p>
          <p>Nach den aktuellen Bedingungen des Anbieters kann Web3Forms im Zusammenhang mit der Erbringung seines Dienstes insbesondere Folgendes verarbeiten:</p>
          <ul>
            <li>in den einzelnen Feldern des Formulars angegebene Daten;</li>
            <li>den Inhalt der Nachricht;</li>
            <li>die Kontaktdaten des Absenders;</li>
            <li>die IP-Adresse, den Zeitpunkt der Übermittlung und weitere technische Metadaten.</li>
          </ul>
          <p>Web3Forms tritt bei der Verarbeitung der Daten aus dem Kontaktformular als Auftragsverarbeiter auf.</p>
          <p>Nach den aktuell veröffentlichten Bedingungen des Anbieters können Daten aus Formularübermittlungen für den in den Einstellungen und Bedingungen des jeweiligen Dienstes festgelegten Zeitraum gespeichert werden, höchstens jedoch für den vom Anbieter in seinen aktuellen Bedingungen genannten Zeitraum.</p>

          <h2>8. Übermittlung personenbezogener Daten außerhalb der EU/des EWR</h2>
          <p>Im Zusammenhang mit der Nutzung des Dienstes Web3Forms kann es zur Verarbeitung und Übermittlung personenbezogener Daten außerhalb der Europäischen Union und des Europäischen Wirtschaftsraums kommen, insbesondere in die Vereinigten Staaten von Amerika und nach Indien.</p>
          <p>Der Betreiber von Web3Forms gibt an, bei der Übermittlung personenbezogener Daten aus dem Europäischen Wirtschaftsraum in Drittländer geeignete rechtliche Mechanismen zu verwenden, einschließlich der von der Europäischen Kommission genehmigten Standardvertragsklauseln (SCC).</p>
          <p>Web3Forms nutzt bei der Erbringung seines Dienstes auch weitere Anbieter technischer Infrastruktur und weitere Auftragsverarbeiter.</p>
          <p>Außer im Zusammenhang mit der Nutzung solcher technischer Dienste übermitteln wir personenbezogene Daten grundsätzlich nicht außerhalb der EU/des EWR.</p>

          <h2>9. Pflicht zur Bereitstellung personenbezogener Daten</h2>
          <p>Die Bereitstellung personenbezogener Daten über das Kontaktformular erfolgt freiwillig.</p>
          <p>Die im Formular als Pflichtfelder gekennzeichneten Daten benötigen wir jedoch, um Ihre Anfrage entgegennehmen, deren grundlegenden Gegenstand erkennen und beantworten zu können. Ohne deren Angabe ist es unter Umständen nicht möglich, das Formular abzusenden oder Ihre Anfrage zu bearbeiten.</p>
          <p>Die Telefonnummer ist optional, sofern im Formular nicht ausdrücklich etwas anderes angegeben ist.</p>
          <p>Schließen Sie mit uns einen Mandatsvertrag ab, kann die Angabe bestimmter personenbezogener Daten für den Abschluss oder die Erfüllung des Vertrags oder zur Erfüllung unserer gesetzlichen Pflichten erforderlich sein.</p>

          <h2>10. Ihre Rechte</h2>
          <p>Im Zusammenhang mit der Verarbeitung Ihrer personenbezogenen Daten haben Sie unter den gesetzlich vorgesehenen Voraussetzungen insbesondere das Recht:</p>
          <ul>
            <li>Auskunft über Ihre personenbezogenen Daten gemäß Art. 15 DSGVO zu verlangen;</li>
            <li>die Berichtigung unrichtiger oder die Vervollständigung unvollständiger personenbezogener Daten gemäß Art. 16 DSGVO zu verlangen;</li>
            <li>die Löschung personenbezogener Daten gemäß Art. 17 DSGVO zu verlangen;</li>
            <li>die Einschränkung der Verarbeitung gemäß Art. 18 DSGVO zu verlangen;</li>
            <li>auf Datenübertragbarkeit gemäß Art. 20 DSGVO, sofern die gesetzlichen Voraussetzungen erfüllt sind;</li>
            <li>Widerspruch gegen eine auf berechtigtem Interesse beruhende Verarbeitung gemäß Art. 21 DSGVO einzulegen;</li>
            <li>eine erteilte Einwilligung zu widerrufen, sofern eine bestimmte Verarbeitung auf Ihrer Einwilligung beruht, ohne dass die Rechtmäßigkeit der bis zum Widerruf erfolgten Verarbeitung berührt wird.</li>
          </ul>
          <p>Sie können Ihre Rechte über die in Abschnitt 1 genannten Kontaktdaten geltend machen.</p>
          <p>Sollten Sie der Ansicht sein, dass bei der Verarbeitung Ihrer personenbezogenen Daten gegen Rechtsvorschriften verstoßen wird, haben Sie zudem das Recht, eine Beschwerde bei der Aufsichtsbehörde einzureichen:</p>
          <p>Amt für den Schutz personenbezogener Daten (Úřad pro ochranu osobních údajů)<br>
          Pplk. Sochora 27<br>
          170 00 Praha 7<br>
          <a href="https://uoou.gov.cz/" target="_blank" rel="noopener">uoou.gov.cz</a></p>

          <h2>11. Automatisierte Entscheidungsfindung</h2>
          <p>Bei der Verarbeitung personenbezogener Daten führen wir keine automatisierte Einzelfallentscheidung und kein Profiling durch, die für Sie rechtliche oder ähnlich bedeutsame Auswirkungen hätten.</p>

          <h2>12. Cookies und technische Daten</h2>
          <p>Unsere Website verwendet derzeit keine analytischen oder Marketing-Cookies.</p>
          <p>Es können lediglich technisch notwendige Cookies und ähnliche technische Mittel eingesetzt werden, sofern sie für das ordnungsgemäße und sichere Funktionieren der Website erforderlich sind.</p>
          <p>Beim Besuch der Website können außerdem automatisch übliche technische Betriebsdaten verarbeitet werden, insbesondere die IP-Adresse, der Geräte- oder Browsertyp, der Zeitpunkt der Anfrage sowie Informationen, die zur Sicherheit und zum ordnungsgemäßen Funktionieren der Website erforderlich sind.</p>

          <h2>13. Änderungen dieser Bestimmungen</h2>
          <p>Wir können diese Bestimmungen bei Änderungen der Art und Weise der Verarbeitung personenbezogener Daten, der eingesetzten Technologien oder der Rechtsvorschriften aktualisieren.</p>
          <p>Die jeweils aktuelle Fassung wird stets auf dieser Website veröffentlicht.</p>
          <p style="color:var(--text-muted);font-size:.85rem;">Letzte Aktualisierung: <?= htmlspecialchars($updated['de']) ?></p>

        <?php else: ?>

          <h2>1. Správce osobních údajů</h2>
          <p>Správcem vašich osobních údajů je Equity Legal s.r.o., IČO: 07410441, se sídlem Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady, Česká republika („kancelář" nebo „my").</p>
          <p>Ve věci zpracování osobních údajů nás můžete kontaktovat:</p>
          <ul>
            <li>e-mailem: <a href="mailto:kancelar@equitylegal.cz">kancelar@equitylegal.cz</a></li>
            <li>písemně na adrese: Chrudimská 1418/2, 130 00 Praha 3 – Vinohrady</li>
          </ul>

          <h2>2. Jaké osobní údaje zpracováváme</h2>
          <p>Zpracováváme osobní údaje, které nám sami poskytnete, zejména prostřednictvím kontaktního formuláře na našich webových stránkách, e-mailem, telefonicky nebo v souvislosti s poskytováním právních služeb.</p>
          <p>Může se jednat zejména o:</p>
          <ul>
            <li>identifikační údaje, zejména jméno a příjmení;</li>
            <li>kontaktní údaje, zejména e-mailovou adresu a telefonní číslo;</li>
            <li>údaje uvedené v kontaktním formuláři, zejména vámi zvolenou oblast práva a obsah zprávy;</li>
            <li>další údaje, které nám sami v rámci svého dotazu nebo následné komunikace sdělíte;</li>
            <li>v případě navázání spolupráce další identifikační, kontaktní a případové údaje nezbytné pro poskytování právních služeb;</li>
            <li>technické údaje související s používáním webových stránek a kontaktního formuláře, zejména IP adresu, datum a čas požadavku a další běžné technické provozní údaje.</li>
          </ul>
          <p>Vzhledem k povaze právních služeb může obsah komunikace v jednotlivých případech zahrnovat také citlivější informace. Takové údaje zpracováváme pouze v rozsahu nezbytném pro vyřízení dotazu, posouzení případu nebo poskytování právních služeb a v souladu s příslušnými právními předpisy.</p>

          <h2>3. Účely zpracování osobních údajů</h2>
          <p>Vaše osobní údaje zpracováváme zejména za účelem:</p>
          <ul>
            <li>přijetí, vyřízení a zodpovězení vašeho dotazu;</li>
            <li>komunikace s vámi;</li>
            <li>posouzení možnosti poskytnutí právních služeb;</li>
            <li>jednání o uzavření smlouvy o poskytování právních služeb;</li>
            <li>uzavření a plnění smlouvy o poskytování právních služeb;</li>
            <li>plnění našich zákonných a stavovských povinností;</li>
            <li>vedení účetní, daňové a další povinné evidence;</li>
            <li>ochrany a uplatňování našich práv a právních nároků;</li>
            <li>zajištění řádného, bezpečného a spolehlivého provozu našich webových stránek a kontaktního formuláře.</li>
          </ul>

          <h2>4. Právní základ zpracování</h2>
          <p>Vaše osobní údaje zpracováváme podle konkrétní situace zejména na základě:</p>
          <ul>
            <li>provedení opatření na vaši žádost před uzavřením smlouvy a plnění smlouvy podle čl. 6 odst. 1 písm. b) GDPR, zejména pokud nás kontaktujete s poptávkou právních služeb nebo pokud vám již právní služby poskytujeme;</li>
            <li>plnění právních povinností podle čl. 6 odst. 1 písm. c) GDPR, zejména povinností vyplývajících z právních předpisů upravujících výkon advokacie, účetnictví, daně nebo opatření proti legalizaci výnosů z trestné činnosti;</li>
            <li>našich oprávněných zájmů podle čl. 6 odst. 1 písm. f) GDPR, zejména zájmu na vyřizování běžných dotazů, ochraně a uplatňování našich právních nároků a zajištění bezpečnosti a řádného provozu webových stránek.</li>
          </ul>
          <p>Pokud by bylo v konkrétním případě zpracování založeno na vašem souhlasu, budete o tom předem samostatně informováni a souhlas budete moci kdykoli odvolat.</p>

          <h2>5. Doba uchování osobních údajů</h2>
          <p>Osobní údaje poskytnuté prostřednictvím kontaktního formuláře nebo při běžné komunikaci uchováváme pouze po dobu nezbytnou k vyřízení vašeho dotazu a následné komunikace, zpravidla nejdéle 12 měsíců od poslední komunikace, pokud v návaznosti na váš dotaz nevznikne smluvní vztah nebo neexistuje jiný důvod pro jejich další uchování.</p>
          <p>Pokud dojde k uzavření smlouvy o poskytování právních služeb, uchováváme osobní údaje po dobu poskytování právních služeb a následně po dobu vyžadovanou příslušnými právními předpisy a stavovskými předpisy České advokátní komory, případně po dobu nezbytnou k ochraně a uplatňování našich právních nároků.</p>
          <p>Účetní a daňové doklady uchováváme po dobu stanovenou příslušnými právními předpisy.</p>
          <p>Technické provozní údaje jsou uchovávány pouze po dobu nezbytnou pro zajištění bezpečnosti a řádného provozu webových stránek.</p>

          <h2>6. Příjemci osobních údajů</h2>
          <p>K vašim osobním údajům mohou mít v nezbytném rozsahu přístup zejména:</p>
          <ul>
            <li>naši advokáti, advokátní koncipienti, zaměstnanci a další spolupracující osoby vázané povinností mlčenlivosti;</li>
            <li>poskytovatelé IT, hostingových, e-mailových a dalších technických služeb;</li>
            <li>poskytovatel technického řešení kontaktního formuláře Web3Forms (Web3Creative);</li>
            <li>účetní, daňoví poradci, auditoři a další odborní poradci, je-li to nezbytné;</li>
            <li>orgány veřejné moci, soudy nebo jiné osoby, pokud nám povinnost osobní údaje poskytnout ukládá právní předpis nebo je jejich poskytnutí nezbytné pro ochranu našich práv.</li>
          </ul>
          <p>Osobní údaje neprodáváme třetím stranám a nepoužíváme je k nesouvisejícím marketingovým účelům.</p>

          <h2>7. Kontaktní formulář a služba Web3Forms</h2>
          <p>Pro technické zpracování a doručení zpráv odeslaných prostřednictvím kontaktního formuláře využíváme službu Web3Forms, provozovanou společností Web3Creative.</p>
          <p>Při odeslání kontaktního formuláře jsou údaje uvedené ve formuláři předány službě Web3Forms za účelem jejich zpracování a doručení kanceláři.</p>
          <p>Podle aktuálních podmínek poskytovatele může Web3Forms v souvislosti se zajištěním služby zpracovávat zejména:</p>
          <ul>
            <li>údaje uvedené v jednotlivých polích formuláře;</li>
            <li>obsah zprávy;</li>
            <li>kontaktní údaje odesílatele;</li>
            <li>IP adresu, čas odeslání a další technická metadata.</li>
          </ul>
          <p>Web3Forms vystupuje při zpracování údajů z kontaktního formuláře jako zpracovatel osobních údajů.</p>
          <p>Podle aktuálně zveřejněných podmínek poskytovatele mohou být údaje z formulářových podání uchovávány po dobu stanovenou nastavením a podmínkami příslušné služby, nejdéle však po dobu uvedenou poskytovatelem v jeho aktuálních podmínkách.</p>

          <h2>8. Předávání osobních údajů mimo EU/EHP</h2>
          <p>V souvislosti s využíváním služby Web3Forms může docházet ke zpracování a předávání osobních údajů mimo Evropskou unii a Evropský hospodářský prostor, zejména do Spojených států amerických a Indie.</p>
          <p>Provozovatel Web3Forms uvádí, že při předávání osobních údajů z Evropského hospodářského prostoru do třetích zemí používá odpovídající právní mechanismy, včetně standardních smluvních doložek schválených Evropskou komisí (SCC).</p>
          <p>Web3Forms při poskytování služby využívá rovněž další poskytovatele technické infrastruktury a dílčí zpracovatele.</p>
          <p>Mimo případy související s využíváním takových technických služeb osobní údaje mimo EU/EHP standardně nepředáváme.</p>

          <h2>9. Povinnost poskytnout osobní údaje</h2>
          <p>Poskytnutí osobních údajů prostřednictvím kontaktního formuláře je dobrovolné.</p>
          <p>Údaje označené ve formuláři jako povinné však potřebujeme k tomu, abychom mohli váš dotaz přijmout, identifikovat základní předmět vašeho požadavku a odpovědět na něj. Bez jejich poskytnutí nemusí být možné formulář odeslat nebo váš dotaz vyřídit.</p>
          <p>Telefonní číslo je nepovinné, pokud není ve formuláři výslovně uvedeno jinak.</p>
          <p>Pokud s námi uzavřete smlouvu o poskytování právních služeb, může být poskytnutí některých osobních údajů nezbytné pro uzavření nebo plnění smlouvy nebo pro splnění našich zákonných povinností.</p>

          <h2>10. Vaše práva</h2>
          <p>V souvislosti se zpracováním vašich osobních údajů máte za podmínek stanovených právními předpisy zejména právo:</p>
          <ul>
            <li>požadovat přístup ke svým osobním údajům podle čl. 15 GDPR;</li>
            <li>požadovat opravu nepřesných nebo doplnění neúplných osobních údajů podle čl. 16 GDPR;</li>
            <li>požadovat výmaz osobních údajů podle čl. 17 GDPR;</li>
            <li>požadovat omezení zpracování podle čl. 18 GDPR;</li>
            <li>na přenositelnost osobních údajů podle čl. 20 GDPR, jsou-li splněny zákonné podmínky;</li>
            <li>vznést námitku proti zpracování založenému na oprávněném zájmu podle čl. 21 GDPR;</li>
            <li>odvolat souhlas, pokud je určité zpracování založeno na vašem souhlasu, aniž by tím byla dotčena zákonnost zpracování provedeného před jeho odvoláním.</li>
          </ul>
          <p>Svá práva můžete uplatnit prostřednictvím kontaktních údajů uvedených v bodě 1.</p>
          <p>Pokud se domníváte, že při zpracování vašich osobních údajů dochází k porušování právních předpisů, máte rovněž právo podat stížnost u dozorového úřadu:</p>
          <p>Úřad pro ochranu osobních údajů<br>
          Pplk. Sochora 27<br>
          170 00 Praha 7<br>
          <a href="https://uoou.gov.cz/" target="_blank" rel="noopener">uoou.gov.cz</a></p>

          <h2>11. Automatizované rozhodování</h2>
          <p>Při zpracování osobních údajů neprovádíme automatizované individuální rozhodování ani profilování, které by pro vás mělo právní nebo obdobně významné účinky.</p>

          <h2>12. Cookies a technické údaje</h2>
          <p>Naše webové stránky v současné době nevyužívají analytické ani marketingové cookies.</p>
          <p>Mohou být využívány pouze technicky nezbytné cookies a obdobné technické prostředky, pokud jsou potřebné pro správné a bezpečné fungování webových stránek.</p>
          <p>Při návštěvě webových stránek mohou být rovněž automaticky zpracovávány běžné technické provozní údaje, zejména IP adresa, typ zařízení nebo prohlížeče, čas požadavku a informace nezbytné k zabezpečení a správnému fungování webových stránek.</p>

          <h2>13. Změny těchto zásad</h2>
          <p>Tyto zásady můžeme v případě změny způsobu zpracování osobních údajů, používaných technologií nebo právních předpisů aktualizovat.</p>
          <p>Aktuální znění je vždy zveřejněno na těchto webových stránkách.</p>
          <p style="color:var(--text-muted);font-size:.85rem;">Poslední aktualizace: <?= htmlspecialchars($updated['cs']) ?></p>

        <?php endif; ?>

      </article>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
