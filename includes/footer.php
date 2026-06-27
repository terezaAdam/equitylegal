<!-- ── Footer ── -->
</main>

<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <div class="footer__brand-name">EQUITY LEGAL</div>
        <div class="footer__brand-sub">Advokátní kancelář</div>
        <p class="footer__desc">Prémiové právní poradenství a zastupování s více jak 15letou zkušeností. Individuální přístup ke každému klientovi.</p>
      </div>
      <div>
        <div class="footer__col-title">Navigace</div>
        <ul class="footer__links">
          <li><a href="/sluzby.php">Právní služby</a></li>
          <li><a href="/pripady.php">Řešené případy</a></li>
          <li><a href="/tym.php">Náš tým</a></li>
          <li><a href="/publikace.php">Publikace</a></li>
          <li><a href="/kontakty.php">Kontakty</a></li>
        </ul>
      </div>
      <div>
        <div class="footer__col-title">Kontakt</div>
        <ul class="footer__links">
          <li><a href="mailto:kancelar@equitylegal.cz">kancelar@equitylegal.cz</a></li>
          <li><a href="tel:+420734551413">+420 734 551 413</a></li>
          <li><a href="/kontakty.php">Chrudimská 1418/2<br>130 00 Praha 3, Vinohrady</a></li>
        </ul>
      </div>
    </div>
    <div class="footer__bottom">
      <span class="footer__copy">© <?= date('Y') ?> EQUITY LEGAL s.r.o. Všechna práva vyhrazena.</span>
      <div style="display:flex;align-items:center;gap:1rem;">
        <a href="https://www.youtube.com/@EquityLegal-z1r" target="_blank" rel="noopener" aria-label="YouTube" style="color:rgba(255,255,255,.35);transition:color var(--tr);" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
        </a>
        <span class="footer__member">Člen České advokátní komory</span>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to top -->
<button class="scroll-top" id="scrollTop" aria-label="Zpět nahoru">↑</button>

<script src="/assets/js/main.js"></script>
<?php if (!empty($pageScripts)) echo $pageScripts; ?>
</body>
</html>
