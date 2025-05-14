<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PhotoBooth by Aurami</title>
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

  <!-- Navbar -->
  <div class="w-full rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="home.blade.php" class="nav-link active">Home</a></li>
        <li><a href="about.blade.php" class="nav-link">About</a></li>
        <li><a href="contact.blade.php" class="nav-link">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="flex flex-col justify-center items-center text-center px-4 min-h-[80vh]">
    <div>
      <h1 class="text-5xl font-bold tracking-widest animate-shineText" style="background: linear-gradient(to right, white, #ffb0c2, white); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent;">
        PHOTOBOOTH
      </h1>
      <p class="mt-2" style="color: #6b7280;">by AURAMI</p>
      <a href="layout.blade.php">
        <button class="mt-12 px-10 py-4 rounded-full text-lg font-bold uppercase tracking-wider hover:shadow transition" style="background-color: #ff8ba7; color: #33272a;">Start Photo</button>
      </a>
    </div>
  </section>



  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const welcomeSection = document.querySelector('.welcome-section');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
          }
        });
      }, { threshold: 0.1 });
      observer.observe(welcomeSection);
    });
  </script>

  <!-- Footer -->
  <footer class="py-3" style="background-color: #c3f0ca;">
    <div class="max-w-4xl mx-auto text-center">
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </div>
  </footer>
</body>
</html>