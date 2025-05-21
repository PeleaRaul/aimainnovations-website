<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/settings/config.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/header_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/loading_screen.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/cookies_module.php'?>

<!-- Body Landing-Page -->
<body>
<main class="bg-white text-gray-900">
  <!-- Title Section -->
  <section class="max-w-6xl mx-auto px-4 py-12 text-center">
    <h1 class="text-4xl font-bold mb-2">Our Projects</h1>
    <p class="text-lg text-gray-600">Discover our innovative engineering work – from design to delivery.</p>
  </section>

  <!-- Gallery -->
  <section class="max-w-7xl mx-auto px-4 pb-16 grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    <?php
      $demoImages = [
        'https://picsum.photos/id/1011/800/600',
        'https://picsum.photos/id/1015/800/600',
        'https://picsum.photos/id/1016/800/600',
        'https://picsum.photos/id/1018/800/600',
        'https://picsum.photos/id/1020/800/600',
        'https://picsum.photos/id/1021/800/600',
        'https://picsum.photos/id/1024/800/600',
        'https://picsum.photos/id/1025/800/600',
        'https://picsum.photos/id/1018/800/600',
        'https://picsum.photos/id/1020/800/600',
        'https://picsum.photos/id/1021/800/600',
        'https://picsum.photos/id/1024/800/600',
        'https://picsum.photos/id/1025/800/600',
        'https://picsum.photos/id/1018/800/600',
        'https://picsum.photos/id/1020/800/600',
        'https://picsum.photos/id/1021/800/600',
        'https://picsum.photos/id/1024/800/600',
        'https://picsum.photos/id/1025/800/600'
      ];
      foreach ($demoImages as $img): ?>
        <div class="cursor-pointer group relative overflow-hidden rounded-xl shadow hover:shadow-xl transition" onclick="openModal('<?= $img ?>')">
          <div class="aspect-video bg-gray-200">
            <img src="<?= $img ?>" alt="Project" class="w-full h-full object-cover object-center transition duration-300 group-hover:scale-105">
          </div>
        </div>
    <?php endforeach; ?>
  </section>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden" onclick="closeModal()">
    <img id="modalImg" src="" alt="Full project image" class="max-h-[90vh] max-w-[90vw] rounded-xl shadow-2xl">
  </div>
</main>

<script>
  function openModal(imgSrc) {
    document.getElementById('modalImg').src = imgSrc;
    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.getElementById('modalImg').src = '';
  }

  // Close with ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });
</script>
</body>

<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/back_to_top_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/faq_modal_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/footer_module.php'?>
</html>