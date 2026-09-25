<?php
require_once __DIR__ . '/includes/data.php';
$p = elPage('home');
$pageTitle = tm('home_title');
$pageDesc  = tm('home_desc');
include 'includes/header.php';
?>

<section class="hero" aria-label="<?= htmlspecialchars(t('aria_intro')) ?>">
  <div class="hero__image-side">
    <img src="/<?= htmlspecialchars(ltrim($p['hero_image'], '/')) ?>" alt="EQUITY LEGAL" loading="eager">
    <div class="hero__overlay"></div>
  </div>
  <div class="hero__content-side">
    <p class="hero__label"><?= htmlspecialchars(tf($p, 'hero_label')) ?></p>
    <h1 class="hero__title">
      <?= strip_tags(tf($p, 'hero_title'), '<em><strong>') ?>
    </h1>
    <div class="hero__desc">
      <p><?= htmlspecialchars(tf($p, 'hero_desc')) ?></p>
    </div>
    <div class="hero__cta">
      <a href="<?= lu('/kontakty.php') ?>" class="btn btn--primary"><?= htmlspecialchars(t('btn_send_enquiry')) ?></a>
      <a href="<?= lu('/sluzby.php') ?>"   class="btn btn--outline-white"><?= htmlspecialchars(t('nav_services')) ?></a>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="values-heading">
  <div class="container">
    <p class="section-label"><?= htmlspecialchars(t('why_us')) ?></p>
    <h2 class="section-title" id="values-heading"><?= htmlspecialchars(t('core_values')) ?></h2>
    <div class="divider"></div>
    <div class="values__grid">

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        </div>
        <div class="value-card__title"><?= htmlspecialchars(t('value1_title')) ?></div>
        <p><?= htmlspecialchars(t('value1_text')) ?></p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="value-card__title"><?= htmlspecialchars(t('value2_title')) ?></div>
        <p><?= htmlspecialchars(t('value2_text')) ?></p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <div class="value-card__title"><?= htmlspecialchars(t('value3_title')) ?></div>
        <p><?= htmlspecialchars(t('value3_text')) ?></p>
      </div>

      <div class="value-card fade-in">
        <div class="value-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        </div>
        <div class="value-card__title"><?= htmlspecialchars(t('value4_title')) ?></div>
        <p><?= htmlspecialchars(t('value4_text')) ?></p>
      </div>

    </div>
  </div>
</section>

<section class="section section--alt" aria-labelledby="services-heading">
  <div class="container">
    <p class="section-label"><?= htmlspecialchars(t('what_we_offer')) ?></p>
    <h2 class="section-title" id="services-heading"><?= htmlspecialchars(t('main_services')) ?></h2>
    <div class="divider"></div>
    <div class="services-grid">

      <?php
      $services = elServices();
      foreach (array_slice($services, 0, 6) as $s): ?>
        <div class="service-card fade-in">
          <div class="service-card__title"><?= htmlspecialchars(tf($s, 'label')) ?></div>
          <p><?= htmlspecialchars(tf($s, 'desc')) ?></p>
          <a href="<?= lu('/sluzby.php') ?>#<?= htmlspecialchars($s['id']) ?>" class="service-card__link"><?= htmlspecialchars(t('btn_more_info')) ?></a>
        </div>
      <?php endforeach; ?>

    </div>
    <div style="text-align:center;margin-top:3rem;">
      <a href="<?= lu('/sluzby.php') ?>" class="btn btn--outline"><?= htmlspecialchars(t('btn_all_services')) ?></a>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="reviews-heading">
  <div class="container">
    <p class="section-label"><?= htmlspecialchars(t('client_reviews_label')) ?></p>
    <h2 class="section-title" id="reviews-heading"><?= htmlspecialchars(t('client_reviews')) ?></h2>
    <div class="divider"></div>

    <?php $reviews = array_filter($p['reviews'] ?? [], fn($r) => trim($r['name'] ?? '') !== '' || trim($r['text'] ?? '') !== ''); ?>

    <div class="reviews-carousel" data-reviews-carousel>
      <div class="reviews-carousel__track">
        <?php foreach ($reviews as $r): ?>
          <div class="review-card__slide">
            <div class="review-card">
              <div class="review-card__stars" aria-label="<?= htmlspecialchars(t('aria_rating')) ?>">★★★★★</div>
              <p class="review-card__text">„<?= htmlspecialchars(tf($r, 'text')) ?>“</p>
              <div class="review-card__author"><?= htmlspecialchars($r['name'] ?? '') ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="reviews-carousel__controls">
        <button type="button" class="reviews-carousel__btn" data-reviews-prev aria-label="<?= htmlspecialchars(t('aria_prev_review')) ?>">←</button>
        <div class="reviews-carousel__dots" data-reviews-dots></div>
        <button type="button" class="reviews-carousel__btn" data-reviews-next aria-label="<?= htmlspecialchars(t('aria_next_review')) ?>">→</button>
      </div>
    </div>

  </div>
</section>

<section class="section" aria-labelledby="about-heading">
  <div class="container">
    <div class="about__grid">
      <div>
        <p class="section-label"><?= htmlspecialchars(t('about_us')) ?></p>
        <h2 class="section-title" id="about-heading"><?= htmlspecialchars(tf($p, 'about_title')) ?></h2>
        <div class="divider"></div>
        <p><?= htmlspecialchars(tf($p, 'about_text1')) ?></p>

<p><?= htmlspecialchars(tf($p, 'about_text2')) ?></p>

  <p><?= htmlspecialchars(tf($p, 'about_text3')) ?></p>
        <div class="about__stats">
          <div>
            <div class="about__stat-num"><?= htmlspecialchars(t('stat_years_num')) ?></div>
            <div class="about__stat-label"><?= htmlspecialchars(t('years_exp')) ?></div>
          </div>
          <div>
            <div class="about__stat-num"><?= htmlspecialchars(t('stat_langs_num')) ?></div>
            <div class="about__stat-label"><?= htmlspecialchars(t('lang_advice')) ?></div>
          </div>
          <div>
            <div class="about__stat-num"><?= htmlspecialchars(t('stat_areas_num')) ?></div>
            <div class="about__stat-label"><?= htmlspecialchars(t('areas_of_law')) ?></div>
          </div>
          <div>
            <div class="about__stat-num"><?= htmlspecialchars(t('stat_personal_num')) ?></div>
            <div class="about__stat-label"><?= htmlspecialchars(t('personalised')) ?></div>
          </div>
        </div>
        <div style="margin-top:2.5rem;margin-bottom:2.5rem;">
          <a href="<?= lu('/tym.php') ?>" class="btn btn--primary"><?= htmlspecialchars(t('btn_meet_team')) ?></a>
        </div>
      </div>
      <div class="about__image fade-in">
        <img src="/<?= htmlspecialchars(ltrim($p['about_image'], '/')) ?>" alt="EQUITY LEGAL">
        <div class="about__accent"></div>
      </div>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="news-heading">
  <div class="container">
    <p class="section-label"><?= htmlspecialchars(t('news_label')) ?></p>
    <h2 class="section-title" id="news-heading"><?= htmlspecialchars(t('news_title')) ?></h2>
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
          <div class="article-card__image"<?= ($a['imageFit'] ?? 'cover') === 'contain' ? ' style="background:#fff;"' : '' ?>>
            <?php if (!empty($a['image'])): ?>
              <img src="<?= htmlspecialchars($a['image']) ?>" alt="<?= htmlspecialchars(tf($a, 'title')) ?>" style="width:100%;height:100%;object-fit:<?= htmlspecialchars($a['imageFit'] ?? 'cover') ?>;object-position:<?= htmlspecialchars($a['imagePosition'] ?? 'center') ?>;display:block;">
            <?php else: ?>
              <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy) 0%,#263452 100%);display:flex;align-items:center;justify-content:center;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.15)" stroke-width="1" style="width:64px;height:64px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
              </div>
            <?php endif; ?>
            <span class="article-card__cat"><?= htmlspecialchars(catLabel($a['category'])) ?></span>
          </div>
          <div class="article-card__body">
            <h2 class="article-card__title"><?= htmlspecialchars(tf($a, 'title')) ?></h2>
            <p class="article-card__excerpt"><?= htmlspecialchars(firstSentence(tf($a, 'content') ?: tf($a, 'excerpt'))) ?></p>
            <a href="<?= lu('/clanek.php') ?>?slug=<?= urlencode($a['slug']) ?>" class="article-card__link"><?= htmlspecialchars(t('btn_read_article')) ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:2.5rem;">
      <a href="<?= lu('/pripady.php') ?>" class="btn btn--outline"><?= htmlspecialchars(t('btn_all_articles')) ?></a>
    </div>
  </div>
</section>

<section class="cta-banner" aria-label="<?= htmlspecialchars(t('aria_contact_us')) ?>">
  <div class="container">
    <h2><?= htmlspecialchars(tf($p, 'cta_title')) ?></h2>
    <p><?= htmlspecialchars(tf($p, 'cta_text')) ?></p>
    <a href="<?= lu('/kontakty.php') ?>" class="btn btn--primary"><?= htmlspecialchars(t('btn_send_enquiry')) ?></a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
