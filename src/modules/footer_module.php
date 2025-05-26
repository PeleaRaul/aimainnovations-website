<div style="background-color: var(--first-color); height: 3px; width: 100%;"></div>
<footer class="bg-white py-12 px-6 md:px-16 text-[var(--dark-color)] font-[var(--body-font)]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
        <div>
            <a href="https://aimainnovations.ro/" class="block"><img src="/assets/public/logos/logo.webp" alt="AIMA-INNOVATIONS" class="h-10 md:h-12" /></a>
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
  <a href="https://aimainnovations.ro/" target="_blank" rel="noopener noreferrer">AIMA INNOVATIONS SRL</a>. All rights reserved.<br>
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
  (function() {
    let clicks = 0;
    const maxClicks = 10;
    const footer = document.getElementById('footer-author');
    const message = "✨ You found the secret author credit! Website crafted by Pelea Raul-Daniel ✨";

    const popup = document.createElement('div');
    popup.id = 'author-popup';
    popup.textContent = message;
    document.body.appendChild(popup);

    let hideTimeout;

    footer.addEventListener('click', () => {
      clicks++;

      if (clicks === maxClicks) {
        popup.classList.add('show');

        clearTimeout(hideTimeout);
        hideTimeout = setTimeout(() => {
          popup.classList.remove('show');
        }, 5000);

        clicks = 0;
      }

      clearTimeout(window._footerClickTimeout);
      window._footerClickTimeout = setTimeout(() => {
        clicks = 0;
      }, 2000);
    });
  })();
</script>

</footer>
<script src="/assets/scripts/script.js"></script>
</html>