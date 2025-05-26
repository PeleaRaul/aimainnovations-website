<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/header_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/loading_screen.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/cookies_module.php'?>

<!-- Body Landing-Page -->
<body>
<main class="font-sans text-gray-800">
<section class="bg-gray-50 py-20 px-6">
  <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center gap-12">
    <!-- Image or Illustration -->
    <div class="lg:w-1/2">
      <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80" alt="Engineering Team" class="rounded-lg shadow-lg" />
    </div>
    <!-- Text content -->
    <div class="lg:w-1/2">
      <h2 class="text-4xl font-bold text-blue-700 mb-6">About AIMA Innovations</h2>
      <p class="text-gray-700 mb-4 leading-relaxed">
        At AIMA Innovations, we specialize in delivering cutting-edge engineering solutions tailored to your needs. From automation design and small hydro projects to SCADA systems and advanced prototyping, our experienced team is committed to precision, innovation, and confidentiality.
      </p>
      <p class="text-gray-700 mb-6 leading-relaxed">
        Founded in 2022 and based in Cluj, Romania, we combine technical expertise with a passion for research and development, ensuring every project meets the highest standards of quality and client satisfaction.
      </p>
      <a href="support/contact.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded shadow-lg transition">
        Contact Us
      </a>
    </div>
  </div>
</section>
<section class="bg-gray-50 py-20">
  <!-- <div class="container mx-auto px-6 max-w-6xl">
    <h2 class="text-4xl font-bold text-blue-700 mb-12 text-center">User Reviews</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
        <div class="w-24 h-24 bg-blue-200 rounded-full mb-4 flex items-center justify-center text-3xl font-bold text-blue-700">AB</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">Ana Bălan</h3>
        <div class="flex mb-4">
          <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
        </div>
        <p class="text-gray-600">“The consultancy helped us find the perfect solution for our automation needs. Great experience!”</p>
      </div>
      <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
        <div class="w-24 h-24 bg-blue-200 rounded-full mb-4 flex items-center justify-center text-3xl font-bold text-blue-700">MG</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">Mihai Georgescu</h3>
        <div class="flex mb-4">
          <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
          <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
<svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg></div>
<p class="text-gray-600">“Not satisfied with the delivery time. The service was ok but could improve.”</p>
</div>
  <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
    <div class="w-24 h-24 bg-blue-200 rounded-full mb-4 flex items-center justify-center text-3xl font-bold text-blue-700">CR</div>
    <h3 class="text-xl font-semibold text-blue-700 mb-2">Cristina Radu</h3>
    <div class="flex mb-4">
      <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
      <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
      <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
      <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
      <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.153c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.54-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.034 9.384c-.783-.57-.38-1.81.588-1.81h4.153a1 1 0 00.95-.69l1.286-3.957z" /></svg>
    </div>
    <p class="text-gray-600">“Absolutely fantastic service and support. Highly recommend to anyone needing CAD design and consultancy.”</p>
  </div> -->

</div>
</div>
<div class="mt-5 bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center max-w-xl mx-auto">
  <h3 class="text-2xl font-semibold text-green-600 mb-2">Check us out on Trustpilot</h3>
  <p class="text-gray-700 mb-4">Read real user reviews or leave your own feedback on our Trustpilot page.</p>
  <a href="https://www.trustpilot.com/review/yourdomain.com" target="_blank" rel="noopener noreferrer" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded transition">Visit Trustpilot</a>
</div>
</div> </section>
<!-- Values Section -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/values_section_module.php'?>

<!-- Contact -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/contact_section_module.php'?>
</main>
</body>

<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/back_to_top_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/faq_modal_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/footer_module.php'?>
</html>