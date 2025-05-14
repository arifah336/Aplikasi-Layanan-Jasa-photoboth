<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Choose Layout - PhotoBooth by Aurami</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="min-h-screen flex flex-col" style="background-color: #faeee7;">

  <!-- Navbar -->
  <div class="w-full rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="home.blade.php" class="nav-link">Home</a></li>
        <li><a href="about.blade.php" class="nav-link">About</a></li>
        <li><a href="contact.blade.php" class="nav-link">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="min-h-[80vh] flex flex-col justify-center items-center px-4 flex-grow">
    <!-- Title -->
    <div class="text-center mb-10">
      <h1 class="text-2xl font-bold uppercase">choose your layout</h1>
      <p class="text-sm italic mt-2" style="color: #594a4e;">NOTE: you have 3 seconds for each shot</p>
    </div>

    <!-- Layout Cards -->
    <div class="flex flex-wrap justify-center gap-10 px-4 max-w-5xl">
      <div class="flex flex-wrap justify-center items-start gap-8">

        <!-- Layout A (2 photos) -->
        <a href="camera.blade.php?layout=a" class="flex flex-col items-center transform transition hover:scale-105">
          <div class="card bg-white shadow-md w-[150px] p-3">
            <img src="images/2.jpg" alt="Layout A" class="h-56 object-cover rounded"/>
            <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
          </div>
          <div class="mt-3 text-center">
            <p class="font-bold">layout A</p>
            <p class="text-sm" style="color: #594a4e;">2 pose</p>
          </div>
        </a>

        <!-- Layout B (3 photos) -->
        <a href="camera.blade.php?layout=b" class="flex flex-col items-center transform transition hover:scale-105">
          <div class="card bg-white shadow-md w-[150px] p-3">
            <img src="images/3.jpg" alt="Layout B" class="h-56 object-cover rounded"/>
            <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
          </div>
          <div class="mt-3 text-center">
            <p class="font-bold">layout B</p>
            <p class="text-sm" style="color: #594a4e;">3 pose</p>
          </div>
        </a>

        <!-- Layout C (4 photos) -->
        <a href="camera.blade.php?layout=c" class="flex flex-col items-center transform transition hover:scale-105">
          <div class="card bg-white shadow-md w-[150px] p-3">
            <img src="images/4.jpg" alt="Layout C" class="h-56 object-cover rounded"/>
            <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
          </div>
          <div class="mt-3 text-center">
            <p class="font-bold">layout C</p>
            <p class="text-sm" style="color: #594a4e;">4 pose</p>
          </div>
        </a>

        <!-- Layout D (6 photos) -->
        <a href="camera.blade.php?layout=d" class="flex flex-col items-center transform transition hover:scale-105">
          <div class="card bg-white shadow-md w-[150px] p-3">
            <img src="images/6.jpg" alt="Layout D" class="h-56 object-cover rounded"/>
            <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
          </div>
          <div class="mt-3 text-center">
            <p class="font-bold">layout D</p>
            <p class="text-sm" style="color: #594a4e;">6 pose</p>
          </div>
        </a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>
</body>
</html>