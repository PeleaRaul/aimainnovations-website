<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>License Error</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Simple bounce animation */
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-15px); }
    }
    .bounce {
      animation: bounce 2s infinite;
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-red-500 via-red-700 to-red-900 min-h-screen flex flex-col justify-center items-center text-white px-4">

  <div class="max-w-xl text-center mt-[20vh]">
    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-20 w-20 mb-6 text-white bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-12.728 12.728m0-12.728l12.728 12.728" />
    </svg>

    <h1 class="text-5xl font-extrabold mb-4 tracking-wide drop-shadow-lg">License Error</h1>
    <p class="text-lg mb-8 leading-relaxed drop-shadow">
      Sorry, this website license is not valid for this domain.<br />
      If you believe this is a mistake, please contact the site administrator for access.
    </p>
    
    <a href="/" class="inline-block bg-white text-red-700 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-red-100 transition">
      Return Home
    </a>
  </div>

  <footer class="mt-auto py-6 w-full text-center text-sm text-red-300 select-none">
    &copy; <?= date('Y') ?> Pelea Raul-Daniel. All rights reserved.
  </footer>

</body>
</html>
