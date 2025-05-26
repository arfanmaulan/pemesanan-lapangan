<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="relative bg-gray-100 dark:bg-gray-900">
    <!-- Background Image & Overlay -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/hero-bg.jpg');"></div>
    <div class="absolute inset-0 bg-black opacity-40"></div>

    <div class="min-h-screen flex flex-col items-center justify-center relative z-10 px-4">
        <div class="mb-8 text-center">
            
            <h2 class="mt-4 text-3xl font-bold text-white">
                Log in to Your Account
            </h2>
        </div>

        {{ $slot }}
    </div>
  </body>
</html>
