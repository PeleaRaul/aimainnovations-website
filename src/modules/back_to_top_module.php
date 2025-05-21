<button id="backToTop" 
        class="fixed bottom-12 left-6 p-3 rounded-full bg-blue-600 text-white opacity-0 pointer-events-none transition-opacity duration-300"
        style="z-index: 1000; box-shadow: 0 15px 15px rgba(0, 0, 0, 0.3); box-sizing: border-box;"
        aria-label="Back to top">
  <!-- Up Arrow SVG -->
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
  </svg>
</button>
<script>
const btn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
    if (scrolled / totalHeight > 0.5) {
        btn.classList.remove('opacity-0', 'pointer-events-none');
        btn.classList.add('opacity-100');
    } else {
        btn.classList.add('opacity-0', 'pointer-events-none');
        btn.classList.remove('opacity-100');
    }
    });

    btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>