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
      <span class="footer__member">Člen České advokátní komory</span>
    </div>
  </div>
</footer>

<!-- Scroll to top -->
<button class="scroll-top" id="scrollTop" aria-label="Zpět nahoru">↑</button>

<script src="/assets/js/main.js"></script>
<?php if (!empty($pageScripts)) echo $pageScripts; ?>
</body>
</html>
