<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Panel')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" />
  <style>
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
  @stack('styles')
</head>
<body class="bg-[#faeee7] text-[#33272a] min-h-screen relative">

  <!-- ✅ Navbar -->
  <div class="w-full rounded-2xl px-10 py-3 max-w-7xl mx-auto" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Admin</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="{{ url('/admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ url('/admin/transactions') }}" class="nav-link {{ request()->is('admin/transactions') ? 'active' : '' }}">Transactions</a></li>
        <li><a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">Users</a></li>
        <li><a href="{{ url('/admin/custom-layout') }}" class="nav-link {{ request()->is('admin/custom-layout') ? 'active' : '' }}">Customs</a></li>
        <li><a href="{{ url('/admin/settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">Settings</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- ✅ Logout Button -->
  <div class="absolute top-6 right-6 z-50">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="btn btn-sm btn-outline btn-error">Logout</button>
    </form>
  </div>

  <!-- ✅ Main Content -->
  <div class="max-w-7xl mx-auto px-6 mt-8">
    @yield('content')
  </div>

  @stack('scripts')
</body>
</html>