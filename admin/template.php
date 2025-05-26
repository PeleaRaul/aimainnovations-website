<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CMS Admin Panel</title>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <!-- Boxicons CDN -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <style>
    /* Custom scrollbar for sidebar */
    .sidebar-scroll::-webkit-scrollbar {
      width: 8px;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
      background-color: #3b82f6; /* blue-500 */
      border-radius: 10px;
    }
    /* Fix body overflow for mobile when sidebar open */
    body.sidebar-open {
      overflow: hidden;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans flex flex-col min-h-screen">

  <!-- Mobile Header -->
  <header class="md:hidden bg-white border-b px-5 py-3 flex items-center justify-between shadow sticky top-0 z-50">
    <h1 class="text-xl font-extrabold text-blue-700 tracking-wide select-none">CMS Panel</h1>
    <button id="mobileMenuBtn" aria-label="Open sidebar menu" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
      <i class="bx bx-menu text-3xl"></i>
    </button>
  </header>

  <div class="flex flex-1 overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar-scroll fixed md:static top-0 left-0 z-50 h-full w-64 bg-white border-r shadow-xl flex flex-col transform md:translate-x-0 transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
      <div class="flex items-center justify-between px-6 py-5 border-b">
        <h1 class="text-2xl font-extrabold text-blue-700 select-none tracking-wide">CMS Panel</h1>
        <button id="sidebarCloseBtn" aria-label="Close sidebar menu" class="md:hidden text-gray-600 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
          <i class="bx bx-x text-3xl"></i>
        </button>
      </div>
      <nav class="flex-grow p-4 space-y-3 text-gray-700 overflow-y-auto">
        <a href="dashboard.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-home mr-4 text-lg"></i> Dashboard
        </a>
        <a href="config.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-cog mr-4 text-lg"></i> Configuration
        </a>
        <a href="projects.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-image mr-4 text-lg"></i> Projects
        </a>
        <a href="offers.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-briefcase mr-4 text-lg"></i> Offers
        </a>
        <a href="email.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-envelope mr-4 text-lg"></i> Email
        </a>
        <a href="users.php" class="flex items-center px-5 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors font-semibold">
          <i class="bx bx-user mr-4 text-lg"></i> Users
        </a>
      </nav>
    </aside>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"></div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col p-6 md:p-8 bg-gray-50 overflow-auto min-h-[calc(100vh-4rem)] md:ml-30">
      <?php
        if (!isset($content) || !file_exists($content)) {
          echo '<div class="text-red-600 font-semibold text-center py-6">Content not found.</div>';
        } else {
          include($content);
        }
      ?>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-white border-t text-center text-gray-600 text-sm py-4 select-none shadow-inner">
    CMS Admin crafted by
    <a href="https://www.linkedin.com/in/pelearauldaniel/" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
      Pelea Raul-Daniel
    </a>.
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      const openBtn = document.getElementById('mobileMenuBtn');
      const closeBtn = document.getElementById('sidebarCloseBtn');

      if (openBtn && sidebar && overlay && closeBtn) {
        openBtn.addEventListener('click', () => {
          sidebar.classList.remove('-translate-x-full');
          overlay.classList.remove('hidden');
          document.body.classList.add('sidebar-open');
        });

        closeBtn.addEventListener('click', () => {
          sidebar.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.classList.remove('sidebar-open');
        });

        overlay.addEventListener('click', () => {
          sidebar.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.classList.remove('sidebar-open');
        });
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
