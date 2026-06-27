/* ============================================================
   EQUITY LEGAL – Main JS
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ── Dark / Light mode ── */
  const body    = document.body;
  const themeBtn = document.getElementById('themeToggle');
  const saved   = localStorage.getItem('el-theme');
  const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  function setTheme(dark) {
    body.dataset.theme = dark ? 'dark' : 'light';
    if (themeBtn) themeBtn.textContent = dark ? '☀' : '☾';
    localStorage.setItem('el-theme', dark ? 'dark' : 'light');
  }

  setTheme(saved ? saved === 'dark' : sysDark);
  if (themeBtn) themeBtn.addEventListener('click', () => {
    setTheme(body.dataset.theme !== 'dark');
  });

  /* ── Sticky nav ── */
  const nav = document.querySelector('.nav');
  window.addEventListener('scroll', () => {
    nav?.classList.toggle('scrolled', window.scrollY > 40);
  }, { passive: true });

  /* ── Mobile hamburger ── */
  const burger    = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobileNav');
  burger?.addEventListener('click', () => {
    const open = mobileNav.classList.toggle('open');
    burger.setAttribute('aria-expanded', open);
  });

  /* ── Active nav link ── */
  const page = location.pathname.split('/').filter(Boolean).pop() || 'index.php';
  document.querySelectorAll('.nav__link').forEach(a => {
    const href = a.getAttribute('href')?.split('/').filter(Boolean).pop() || 'index.php';
    if (href === page) a.classList.add('active');
  });

  /* ── Scroll to top ── */
  const scrollTopBtn = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => {
    scrollTopBtn?.classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });
  scrollTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ── Fade-in on scroll ── */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

  /* ── Services sidebar active ── */
  const serviceSections = document.querySelectorAll('.service-section[id]');
  const sidebarLinks    = document.querySelectorAll('.services-nav a');
  if (serviceSections.length) {
    const secObserver = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          const id = e.target.id;
          sidebarLinks.forEach(a => {
            a.classList.toggle('active', a.getAttribute('href') === '#' + id);
          });
        }
      });
    }, { rootMargin: '-30% 0px -60% 0px' });
    serviceSections.forEach(s => secObserver.observe(s));
  }

  /* ── Publications tabs ── */
  document.querySelectorAll('.pub-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.pub-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.pub-panel').forEach(p => p.classList.remove('active'));
      tab.classList.add('active');
      document.getElementById(tab.dataset.panel)?.classList.add('active');
    });
  });

  /* ── Team modals ── */
  const overlay = document.getElementById('teamModal');
  document.querySelectorAll('.team-card[data-member]').forEach(card => {
    card.addEventListener('click', (e) => {
      e.preventDefault();
      const id = card.dataset.member;
      openTeamModal(id);
    });
  });
  overlay?.addEventListener('click', (e) => {
    if (e.target === overlay) closeTeamModal();
  });
  document.getElementById('modalClose')?.addEventListener('click', closeTeamModal);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeTeamModal();
  });

  function openTeamModal(id) {
    if (!overlay) return;
    const data = teamData[id];
    if (!data) return;

    overlay.querySelector('#mName').textContent      = data.name || '';
    overlay.querySelector('#mPosition').textContent  = data.position || '';
    overlay.querySelector('#mBio').innerHTML         = data.bio || '';
    overlay.querySelector('#mProjects').innerHTML    = (data.projects || []).map(p => `<li>${p}</li>`).join('');
    overlay.querySelector('#mSpecializations').innerHTML = (data.specializations || []).map(s => `<li>${s}</li>`).join('');

    const emailEl = overlay.querySelector('#mEmail');
    const phoneEl = overlay.querySelector('#mPhone');
    if (emailEl) {
      emailEl.href = 'mailto:' + (data.email || '');
      emailEl.textContent = data.email || '';
    }
    if (phoneEl) {
      phoneEl.href = 'tel:' + (data.phone || '').replace(/\s/g,'');
      phoneEl.textContent = data.phone || '';
      phoneEl.parentElement.style.display = data.phone ? 'flex' : 'none';
    }

    const photoEl = overlay.querySelector('#mPhoto');
    const placeholderEl = overlay.querySelector('#mPhotoPlaceholder');
    if (data.photo) {
      photoEl.src = data.photo;
      photoEl.style.display = 'block';
      if (placeholderEl) placeholderEl.style.display = 'none';
    } else {
      if (photoEl) photoEl.style.display = 'none';
      if (placeholderEl) {
        placeholderEl.style.display = 'flex';
        placeholderEl.textContent = getInitials(data.name);
      }
    }

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeTeamModal() {
    overlay?.classList.remove('open');
    document.body.style.overflow = '';
  }

  function getInitials(name) {
    if (!name) return '??';
    const parts = name.replace(/[^a-zA-ZáčďéěíňóřšťůúýžÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ\s]/g, '').trim().split(/\s+/);
    return parts.slice(0, 2).map(p => p[0]).join('').toUpperCase();
  }

  /* ── Contact form ── */
  const form = document.getElementById('contactForm');
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = form.querySelector('[type=submit]');
    const successMsg = document.getElementById('formSuccess');
    btn.disabled = true;
    btn.textContent = 'Odesílání…';

    try {
      const res = await fetch('send-contact.php', {
        method: 'POST',
        body: new FormData(form),
      });
      const json = await res.json();
      if (json.ok) {
        form.reset();
        if (successMsg) successMsg.classList.add('visible');
        btn.textContent = 'Odesláno ✓';
      } else {
        btn.textContent = 'Chyba – zkuste znovu';
        btn.disabled = false;
      }
    } catch {
      btn.textContent = 'Chyba – zkuste znovu';
      btn.disabled = false;
    }
  });

});
