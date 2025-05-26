<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/header_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/loading_screen.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/cookies_module.php'?>
<?php
function findOfferImage($basePath, $baseUrl, $offerName) {
    $extensions = ['webp', 'png', 'jpg', 'jpeg', 'gif'];
    foreach ($extensions as $ext) {
        $filePath = $basePath . $offerName . '.' . $ext;
        if (file_exists($filePath)) {
            $version = filemtime($filePath); // cache busting based on file modification time
            return $baseUrl . $offerName . '.' . $ext . '?v=' . $version;
        }
    }
    // fallback image or empty string if no file found
    return '';
}
?>
<body>
<main class="bg-white text-gray-900">

  <section class="text-center mb-12 mt-5">
    <h1 class="text-5xl font-bold mb-4">Our Service Offers</h1>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
      Explore tailored service solutions crafted for impact. Designed for startups, enterprises, and forward-thinkers.
    </p>
  </section>

  <?php
  $basePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/public/img/';
  $baseUrl = '/assets/public/img/';

  $offers = [
      [
          'title' => 'Engineering Essentials for Startups',
          'text' => "Whether you're building your first product or refining your MVP, we provide design, prototyping, and consultation support that adapts to your pace. It’s everything you need to launch smart and scale fast — no unnecessary extras.",
          'img' => findOfferImage($basePath, $baseUrl, 'offer1'),
      ],
      [
          'title' => 'Automation & Optimization Package',
          'text' => "Streamline your operations with expert-led automation and SCADA solutions. We analyze, architect, and guide implementation so you can boost efficiency and minimize downtime — from control systems to real-time monitoring.",
          'img' => findOfferImage($basePath, $baseUrl, 'offer2'),
      ],
      [
          'title' => 'The Full Innovation Suite',
          'text' => "For complex challenges or ambitious goals, we offer a comprehensive engineering partnership: CAD, automation, prototyping, ERP/CRM implementation, and technical consulting — all in one streamlined package.",
          'img' => findOfferImage($basePath, $baseUrl, 'offer3'),
      ],
  ];

  foreach ($offers as $index => $offer) :
    // Alternate image position: even = left, odd = right
    $isLeft = $index % 2 === 0;
  ?>

  <section class="flex flex-col md:flex-row items-center md:items-start mb-16 mt-5 gap-4 px-4 md:px-20 lg:px-72">
    <?php if ($isLeft) : ?>
      <img src="<?= htmlspecialchars($offer['img']) ?>" alt="<?= htmlspecialchars($offer['title']) ?>" class="w-full md:w-1/3 rounded-lg shadow-lg object-cover" />
      <div class="md:w-2/3 text-gray-800 px-2">
        <h2 class="text-3xl font-semibold text-[var(--first-color)] mb-3"><?= htmlspecialchars($offer['title']) ?></h2>
        <p class="leading-relaxed text-lg"><?= htmlspecialchars($offer['text']) ?></p>
        <a href="/contact.php" 
           class="mt-5 inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-full 
                  shadow-md hover:bg-white hover:text-blue-600 border-2 border-blue-600 
                  transition duration-300 ease-in-out">
          Brochure
        </a>
      </div>
    <?php else : ?>
      <div class="md:w-2/3 text-gray-800 text-right px-2">
        <h2 class="text-3xl font-semibold text-[var(--first-color)] mb-3"><?= htmlspecialchars($offer['title']) ?></h2>
        <p class="leading-relaxed text-lg"><?= htmlspecialchars($offer['text']) ?></p>
        <a href="/contact.php" 
           class="mt-5 inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-full 
                  shadow-md hover:bg-white hover:text-blue-600 border-2 border-blue-600 
                  transition duration-300 ease-in-out">
          Brochure
        </a>
      </div>
      <img src="<?= htmlspecialchars($offer['img']) ?>" alt="<?= htmlspecialchars($offer['title']) ?>" class="w-full md:w-1/3 rounded-lg shadow-lg object-cover" />
    <?php endif; ?>
  </section>

  <?php endforeach; ?>

  <!-- Call to Action -->
  <section class="bg-[var(--first-color)] text-white py-12 text-center">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-3xl font-bold mb-4">Need a Custom Offer?</h2>
      <p class="mb-6">We're happy to tailor a package that fits your project’s scope, size, and budget.</p>
      <a href="/contact.php" class="inline-block bg-white text-[var(--first-color)] font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">
        Request a Custom Offer
      </a>
    </div>
  </section>

</main>
</body>

<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/back_to_top_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/faq_modal_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/footer_module.php'?>
</html>
