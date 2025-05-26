<div style="background-color: var(--first-color); height: 3px; width: 100%;"></div>
<footer class="bg-white py-12 px-6 md:px-16 text-[var(--dark-color)] font-[var(--body-font)]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
        <div>
            <a href="[Your Url]" class="block"><img src="/assets/public/logos/logo.webp" alt="{Your Company}" class="h-10 md:h-12" /></a>
            <p class="mb-6 text-gray-600 max-w-xs">Empowering your projects with modern, reliable solutions.</p>
            <div class="flex space-x-6 text-gray-400 text-xl">
                <a href="/page/redirect/instagram.html" aria-label="Instagram" class="hover:text-[var(--first-color)] transition duration-300"><i class='bx bxl-instagram'></i></a>
                <a href="/page/redirect/linkedin.html" aria-label="LinkedIn" class="hover:text-[var(--first-color)] transition duration-300"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
        <div>
            <h3 class="uppercase font-semibold tracking-widest mb-6 text-gray-700 text-sm">Company</h3>
            <ul class="space-y-4">
                <li><a href="/page/about.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">About Us</a></li>
                <li><a href="/page/services.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Services</a></li>
                <li><a href="/page/offers.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Offers</a></li>
            </ul>
        </div>
        <div>
            <h3 class="uppercase font-semibold tracking-widest mb-6 text-gray-700 text-sm">Support</h3>
            <ul class="space-y-4">
                <li><a href="/page/support/Brochure.pdf" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Brochure</a></li>
                <li><a href="/page/support/contact.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Contact Us</a></li>
                <li>
  <a href="#" id="openFaqModal" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">
    FAQs
  </a>
</li>
            </ul>
        </div>
        <div>
            <h3 class="uppercase font-semibold tracking-widest mb-6 text-gray-700 text-sm">Legal</h3>
            <ul class="space-y-4">
                <li><a href="/page/legal/privacy.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Privacy Policy</a></li>
                <li><a href="/page/legal/terms.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Terms of Service</a></li>
                <li><a href="/page/legal/cookies.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition">Cookie Policy</a></li>
            </ul>
        </div>
    </div>
<div id="footer-author" style="margin-bottom: -30px; margin-top: 3rem; text-align: center; color: gray; font-size: 12px; user-select: none; letter-spacing: 1px;">
  &copy; <?php echo date('Y'); ?> 
  <a href="[Your Url]" target="_blank" rel="noopener noreferrer">[YOUR COMPANY LTD/SRL]</a>. All rights reserved.<br>
  Website crafted by <a href="https://www.linkedin.com/in/pelearauldaniel/" target="_blank" rel="noopener noreferrer">Pelea Raul-Daniel</a>.
  <!-- Do not remove author line -->
</div>

<style>
  #author-popup {
    position: fixed;
    left: 50%;
    bottom: -100px; /* Start off screen */
    transform: translateX(-50%);
    background: #333;
    color: #fff;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    font-family: Arial, sans-serif;
    font-size: 14px;
    opacity: 0;
    pointer-events: none;
    z-index: 9999;
    transition: bottom 0.7s ease, opacity 0.7s ease;
  }

  #author-popup.show {
    bottom: 10%;
    opacity: 1;
    pointer-events: auto;
    animation: floatUpDown 3s ease-in-out infinite;
  }

  @keyframes floatUpDown {
    0%, 100% {
      transform: translate(-50%, 0);
    }
    50% {
      transform: translate(-50%, -5%);
    }
  }
</style>

<script>
  (function () {
  let _0x1a2b = 0;
  const _0x4f5c = 10;
  const _0x8a7d = document.getElementById(atob('Zm9vdGVyLWF1dGhvcg=='));
  const _0x29d0 = atob('4piOIFlvdSBmb3VuZCB0aGUgc2VjcmV0IGF1dGhvciBjcmVkaXQhIFdlYnNpdGUgY3JhZnRlZCBieSBQZWxlYSBSYXVsLURhbmllbCDimI4=');

  const _0x59ac = document.createElement('div');
  _0x59ac.id = atob('YXV0aG9yLXBvcHVw');
  _0x59ac.textContent = _0x29d0;
  document.body.appendChild(_0x59ac);

  let _0x3ac8;

  _0x8a7d.addEventListener('click', () => {
    _0x1a2b++;

    if (_0x1a2b === _0x4f5c) {
      _0x59ac.classList.add('show');

      clearTimeout(_0x3ac8);
      _0x3ac8 = setTimeout(() => {
        _0x59ac.classList.remove('show');
      }, 5000);

      _0x1a2b = 0;
    }

    clearTimeout(window['_footerClickTimeout']);
    window['_footerClickTimeout'] = setTimeout(() => {
      _0x1a2b = 0;
    }, 2000);
  });
})();
</script>

</footer>
<script src="/assets/scripts/script.js"></script>
</html>