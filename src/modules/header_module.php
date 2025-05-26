<?php
// Get current page filename
$page = basename($_SERVER['PHP_SELF']);

// Titles array
$titles = [
  'index.php' => 'Home - [Your Company]',
  'cookies.php' => 'Cookies Policy - [Your Company]',
  'privacy.php' => 'Privacy Policy - [Your Company]',
  'terms.php' => 'Terms & Conditions - [Your Company]',
  'about.php' => 'About Us - [Your Company]',
  'contact.php' => 'Contact Us - [Your Company]',
  'offers.php' => 'Our Offers - [Your Company]',
  'projects.php' => 'Projects - [Your Company]',
  'services.php' => 'Services - [Your Company]'
];

// Descriptions array
$descriptions = [
  'index.php'    => '[Your Company] offers cutting-edge engineering services: technical consultation, automation design, CAD, prototyping, ERP/CRM implementation, and SCADA systems.',
  'cookies.php'  => 'Read [Your Company]\' Cookies Policy. Learn how we use essential, functional, marketing, and third-party cookies to improve your browsing experience and protect your privacy.',
  'privacy.php'  => '[Your Company] Privacy Policy: Understand how we collect, use, and protect your personal data in compliance with GDPR and Romanian regulations.',
  'terms.php'    => 'Terms and Conditions for using [Your Company] website and services. Review your rights and obligations when engaging with our engineering solutions.',
  'about.php'    => 'Learn more about [Your Company], our mission, expert team, and commitment to delivering innovative engineering projects and tailored technical consultancy.',
  'contact.php'  => 'Get in touch with [Your Company]. Contact us for consultations, project inquiries, or support regarding our engineering and automation services.',
  'offers.php'   => 'Explore [Your Company]’ service offerings including custom technical consultancy, CAD designs, automation, small hydro projects, prototyping, and more.',
  'projects.php' => 'Discover [Your Company]’ portfolio showcasing our completed engineering projects in automation, hydro design, SCADA systems, and advanced prototyping.',
  'services.php' => 'Detailed overview of engineering services provided by [Your Company] including automation design, ERP/CRM implementation, technical consultancy, and CAD solutions.'
];

// Keywords array
$keywords = [
  'index.php'    => 'engineering, technical consultancy, automation design, CAD, prototyping, ERP, CRM, SCADA systems, small hydro design, water pumping',
  'cookies.php'  => 'cookies policy, GDPR, privacy, data protection, website cookies, tracking cookies, third-party cookies',
  'privacy.php'  => 'privacy policy, personal data, GDPR, data protection, user privacy, [Your Company]',
  'terms.php'    => 'terms and conditions, user agreement, website terms, legal, policies, [Your Company]',
  'about.php'    => 'about us, company info, [Your Company], engineering team, mission, vision',
  'contact.php'  => 'contact, support, inquiries, [Your Company], phone, email, consultation',
  'offers.php'   => 'services, engineering offers, consultancy, CAD design, automation, R&D, prototyping',
  'projects.php' => 'projects, portfolio, engineering projects, automation systems, hydro design, SCADA',
  'services.php' => 'engineering services, automation, ERP, CRM, technical consultancy, CAD, prototyping'
];

// Default fallback values
$defaultTitle = '[Your Company]';
$defaultDescription = 'Welcome to [Your Company] – your trusted partner for engineering solutions including automation, CAD design, small hydro and water pumping design, R&D, and SCADA systems.';
$defaultKeywords = 'engineering, technical consultancy, automation, CAD, R&D, SCADA, ERP, CRM, small hydro, water pumping';

// Base URL and current page URL for canonical and og:url
$baseUrl = 'https://[yoururl]';
$currentUrl = $baseUrl . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Open Graph images - map to pages or use default
$og_images = [
  'index.php' => $baseUrl . '/assets/public/img/og/og-index.jpg',
  'cookies.php' => $baseUrl . '/assets/public/img/og/og-cookies.jpg',
  'privacy.php' => $baseUrl . '/assets/public/img/og/og-privacy.jpg',
  'terms.php' => $baseUrl . '/assets/public/img/og/og-terms.jpg',
  'about.php' => $baseUrl . '/assets/public/img/og/og-about.jpg',
  'contact.php' => $baseUrl . '/assets/public/img/og/og-contact.jpg',
  'offers.php' => $baseUrl . '/assets/public/img/og/og-offers.jpg',
  'projects.php' => $baseUrl . '/assets/public/img/og/og-projects.jpg',
  'services.php' => $baseUrl . '/assets/public/img/og/og-services.jpg',
];
$defaultOgImage = $baseUrl . '/assets/public/img/og/og-default.jpg';
<?php
$A=['YWltYWlubm92YXRpb25zLnJv','d3d3LmFpbWFpbm5vdmF0aW9ucy5ybw=='];
$D=array_map('base64_decode',$A);
$H=strtolower($_SERVER['HTTP_HOST']??'');
if(!in_array($H,$D,true)){
    $L=base64_decode('L3BhZ2UvZXJyb3IvbGljZW5zZV9lcnJvci5waHA=');
    header('Location: '.$L);
    exit;
}
?>

// Get values or defaults
$pageTitle = $titles[$page] ?? $defaultTitle;
$metaDescription = $descriptions[$page] ?? $defaultDescription;
$metaKeywords = $keywords[$page] ?? $defaultKeywords;
$ogImage = $og_images[$page] ?? $defaultOgImage;
?>
<?php
function getBackgroundUrl($baseName) {
    $extensions = ['webp', 'png', 'jpg', 'jpeg', 'svg'];
    foreach ($extensions as $ext) {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/public/img/{$baseName}.{$ext}";
        if (file_exists($path)) {
            return "/assets/public/img/{$baseName}.{$ext}";
        }
    }
    return ''; // fallback if none found
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Created by Pelea Raul-Daniel | linkedin.com/in/pelearauldaniel -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($metaKeywords) ?>">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="<?= htmlspecialchars($currentUrl) ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($currentUrl) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
    <meta name="author" content="[Your Company] SRL & Pelea Raul-Daniel">
    <meta name="theme-color" content="#0ea5e9">
    <link rel="stylesheet" href="/assets/scripts/style.css?v0.5">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<nav class="bg-white py-6 px-6 md:px-16 text-[var(--dark-color)] font-[var(--body-font)] shadow-sm">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="https://[yoururl]/" class="flex items-center"><img src="/assets/public/logos/logo.webp" alt="[Your Company]" class="h-10 md:h-12 block" /></a>
    <button id="nav-toggle" class="md:hidden text-gray-600 focus:outline-none" aria-label="Toggle menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
    <div id="nav-menu" class="hidden md:flex space-x-10 items-center">
      <a href="/index.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">Home</a>
      <a href="/page/about.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">About Us</a>
      <a href="/page/services.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">Services</a>
      <a href="/page/offers.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">Offers</a>
      <a href="/page/projects.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">Projects</a>
      <a href="/page/support/contact.php" class="animated-underline text-gray-600 hover:text-[var(--first-color)] transition text-lg">Contact</a>
    </div>
  </div>
  <div id="nav-menu-mobile" class="md:hidden mt-2 px-4 py-0 space-y-4">
  <a href="/index.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-lg font-medium rounded px-3 py-2 select-none">Home</a>
  <a href="/page/about.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-xlg font-medium rounded px-3 py-2 select-none">About Us</a>
  <a href="/page/services.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-lg font-medium rounded px-3 py-2 select-none">Services</a>
  <a href="/page/offers.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-lg font-medium rounded px-3 py-2 select-none">Offers</a>
  <a href="/page/projects.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-lg font-medium rounded px-3 py-2 select-none">Projects</a>
  <a href="/page/support/contact.php" class="block animated-underline text-gray-700 hover:text-[var(--first-color)] transition text-lg font-medium rounded px-3 py-2 select-none">Contact</a>
</div>
</nav>
<div style="background-color: var(--first-color); height: 3px; width: 100%;"></div>