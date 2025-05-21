const navToggle = document.getElementById('nav-toggle');
const navMenuMobile = document.getElementById('nav-menu-mobile');

navToggle.addEventListener('click', () => {
  navMenuMobile.classList.toggle('open');
});

// Simple carousel auto-slide
  const carousel = document.getElementById('carousel');
  const totalSlides = carousel.children.length;
  let index = 0;

  setInterval(() => {
    index = (index + 1) % totalSlides;
    carousel.style.transform = `translateX(-${index * 100}vw)`;
  }, 5000); // change every 5 seconds

document.querySelectorAll('img').forEach(img => {
    img.addEventListener('dragstart', e => e.preventDefault());
  });

document.addEventListener('keydown', function(e) {
  if (e.ctrlKey) {
    const blockedKeys = ['s', 'p', 'i', 'u', 'c'];  // add keys to block (lowercase)
    const key = e.key.toLowerCase();

    if (blockedKeys.includes(key)) {
      e.preventDefault();
    }
    
    if (e.shiftKey && key === 'i') {  // block Ctrl+Shift+I (Dev Tools)
      e.preventDefault();
    }
  }
});

document.addEventListener('contextmenu', event => event.preventDefault());