<div id="faqModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl shadow-2xl w-[90%] max-w-3xl p-8 relative transform transition-transform duration-300 scale-95 opacity-0 pointer-events-none" 
       style="will-change: transform, opacity;">
    <!-- Close button -->
    <button id="closeFaqModal" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-3xl font-bold focus:outline-none" aria-label="Close FAQ Modal">
      &times;
    </button>

    <h2 class="text-3xl font-extrabold text-blue-700 mb-8 border-b-2 border-blue-600 pb-2">Întrebări frecvente (FAQ)</h2>

    <div class="space-y-4">
      <div class="faq-item border-b border-gray-200 pb-4 cursor-pointer">
        <h3 class="text-xl font-semibold text-gray-900 flex justify-between items-center">
          Ce servicii oferă AIMA INNOVATIONS?
          <span class="transition-transform duration-300 transform faq-icon">+</span>
        </h3>
        <p class="text-gray-700 mt-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out">
          Consultanță tehnică, CAD, SCADA, ERP, hidro, automatizări și R&D.
        </p>
      </div>
      <div class="faq-item border-b border-gray-200 pb-4 cursor-pointer">
        <h3 class="text-xl font-semibold text-gray-900 flex justify-between items-center">
          Cum pot solicita o ofertă?
          <span class="transition-transform duration-300 transform faq-icon">+</span>
        </h3>
        <p class="text-gray-700 mt-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out">
          Prin formular, email: contact@aimainnovations.ro sau telefonic: +40 731 657 460.
        </p>
      </div>
      <div class="faq-item border-b border-gray-200 pb-4 cursor-pointer">
        <h3 class="text-xl font-semibold text-gray-900 flex justify-between items-center">
          Datele mele sunt în siguranță?
          <span class="transition-transform duration-300 transform faq-icon">+</span>
        </h3>
        <p class="text-gray-700 mt-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out">
          Da. Respectăm GDPR și protejăm datele clienților. Citeste <a href="/page/legal/privacy.php" style="color: blue;">politica de confidentialitate</a> si <a href="/page/legal/cookies.php" style="color: blue;">politica cookies</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById('openFaqModal');
    const closeBtn = document.getElementById('closeFaqModal');
    const faqModal = document.getElementById('faqModal');
    const modalContent = faqModal.querySelector('div');

    function openModal() {
      faqModal.classList.remove('hidden');
      setTimeout(() => {
        modalContent.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
        modalContent.classList.add('opacity-100', 'scale-100');
      }, 10);
    }

    function closeModal() {
      modalContent.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
      modalContent.classList.remove('opacity-100', 'scale-100');
      setTimeout(() => {
        faqModal.classList.add('hidden');
      }, 300);
    }

    openBtn.addEventListener('click', e => {
      e.preventDefault();
      openModal();
    });

    closeBtn.addEventListener('click', closeModal);

    faqModal.addEventListener('click', e => {
      if (e.target === faqModal) {
        closeModal();
      }
    });

    // FAQ toggle
    document.querySelectorAll('.faq-item').forEach(item => {
      const question = item.querySelector('h3');
      const answer = item.querySelector('p');
      const icon = item.querySelector('.faq-icon');

      question.addEventListener('click', () => {
        const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';

        if (isOpen) {
          answer.style.maxHeight = '0';
          icon.textContent = '+';
          icon.classList.remove('rotate-45');
        } else {
          answer.style.maxHeight = answer.scrollHeight + 'px';
          icon.textContent = '−';
          icon.classList.add('rotate-45');
        }
      });
    });
  });
</script>