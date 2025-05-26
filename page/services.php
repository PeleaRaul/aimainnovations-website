<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/header_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/loading_screen.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/cookies_module.php'?>

<!-- Body Landing-Page -->
<body>
<main class="bg-white text-gray-900">
  <!-- Title Section -->
  <section class="max-w-7xl mx-auto px-4 py-12 text-center">
    <h1 class="text-4xl font-bold mb-4">Our Engineering Services</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
      AIMA Innovations delivers precision engineering solutions — from consultancy and CAD design to automation systems and R&D.
    </p>
  </section>

  <!-- Services Grid -->
  <section class="max-w-9xl mx-auto px-7 pb-16 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
    <?php
      $services = [
        'Technical Consultancy',
        'Automation System Design',
        'Small Hydro Power Design',
        'Water Pumping Systems',
        'CAD Design & Simulation',
        'R&D & Prototyping',
        'ERP & CRM Implementation',
        'SCADA System Development'
      ];

      $descriptions = [
        'Tailored engineering insights to support your project goals and operational strategies.',
        'From PLC programming to smart automation frameworks for industrial efficiency.',
        'Innovative micro-hydro systems for sustainable and localized power solutions.',
        'Design and optimization of efficient water distribution and control systems.',
        'Professional 2D/3D CAD drawings, models, and simulations using industry tools.',
        'We help transform your ideas into viable products with real-world testing.',
        'Streamline your business processes with customized ERP/CRM system integrations.',
        'Monitor and control industrial systems with scalable SCADA architecture.'
      ];

      foreach ($services as $index => $title):
        $imgUrl = "https://picsum.photos/seed/service" . ($index + 1) . "/600/400";
    ?>
      <div class="bg-white border rounded-2xl shadow hover:shadow-lg overflow-hidden transition">
        <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($title) ?>" class="w-full h-48 object-cover">
        <div class="p-6">
          <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($title) ?></h3>
          <p class="text-gray-600 text-sm"><?= htmlspecialchars($descriptions[$index]) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </section>

  <!-- CTA Section -->
  <section class="bg-[var(--first-color)] text-white text-center py-12">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-3xl font-bold mb-4">Let’s build something great together</h2>
      <p class="mb-6">Contact us today for a custom proposal and let's start engineering your success.</p>
      <a href="/page/support/contact.php" class="inline-block bg-white text-[var(--first-color)] font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">
        Get in Touch
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