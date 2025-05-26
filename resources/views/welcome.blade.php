<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <style>
        /*! Tailwind CSS fallback styles if needed */
      </style>
    @endif
  </head>
  <body class="relative bg-gray-100 dark:bg-gray-900">
    <!-- Header -->
    <header class="absolute top-0 left-0 w-full p-6 flex justify-end z-20">
      @if (Route::has('login'))
        <nav class="flex items-center gap-4">
          @auth
            <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded">
              Dashboard
            </a>
          @else
            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded">
              Log in
            </a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded">
                Register
              </a>
            @endif
          @endauth
        </nav>
      @endif
    </header>

    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-screen text-center">
      <!-- Background image -->
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/hero-bg.jpg');"></div>
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <!-- Content -->
      <div class="relative z-10 px-4">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fadeInDown">
          Welcome to Our App
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 mb-8 animate-fadeInUp">
          Booking your sports field has never been easier.
        </p>
        <a href="{{ route('lapangan.index') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300 shadow-lg animate-bounce">
          Book Now
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="absolute bottom-0 left-0 w-full p-4 text-center text-gray-300 z-20">
      &copy; {{ date('Y') }} Your Company. All rights reserved.
    </footer>

    <!-- Optional: Tailwind CSS Animations (if belum disertakan, kamu bisa tambahkan custom keyframes di app.css) -->
    <style>
      @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .animate-fadeInDown {
        animation: fadeInDown 1s ease-out;
      }
      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .animate-fadeInUp {
        animation: fadeInUp 1s ease-out;
      }
      @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
      }
      .animate-bounce {
        animation: bounce 2s infinite;
      }
    </style>
  </body>
</html>
