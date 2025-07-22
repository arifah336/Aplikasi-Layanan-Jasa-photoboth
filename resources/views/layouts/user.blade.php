<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'PhotoBooth by Aurami')</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes shineText {
      0% {
        background-position: 200% center;
      }
      100% {
        background-position: -200% center;
      }
    }
    .animate-shineText {
      animation: shineText 3.5s linear infinite;
    }
    .nav-link {
      color: #33272a;
      font-weight: 600;
      transition: color 0.3s;
    }
    .nav-link:hover {
      color: #c3f0ca;
    }
    .nav-link.active {
      color: #c3f0ca;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col justify-between" style="background-color: #faeee7; color: #33272a;">
  
  <!-- ✅ Navbar -->
  <div class="w-full rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- ✅ Content -->
  <main class="flex-grow">
    @yield('content')
  </main>

  <!-- ✅ Footer -->
  <footer class="py-3 mt-6" style="background-color: #c3f0ca;">
    <div class="max-w-4xl mx-auto text-center">
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </div>
  </footer>

</body>
</html>