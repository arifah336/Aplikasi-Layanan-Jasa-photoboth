<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PhotoBooth by Aurami</title>
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
<body class="min-h-screen flex flex-col justify-between" style="background-color: #faeee7; color: #33272a;">

  <!-- Navbar -->
  <div class="w-full rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="home.blade.php" class="nav-link">Home</a></li>
        <li><a href="about.blade.php" class="nav-link">About</a></li>
        <li><a href="contact.blade.php" class="nav-link active">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- Contact Section -->
  <section id="contact" class="py-24 px-6" style="background-color: #faeee7;">
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-12">
      <div class="flex-1">
        <h2 class="text-4xl font-bold mb-4">Contact Us</h2>
        <p class="mb-4" style="color: #594a4e;">We'd love to hear from you! Whether it's a question, suggestion, or issue, feel free to reach out—your feedback helps us improve.</p>
        <p class="mb-4" style="color: #594a4e;">For commercial inquiries or collaborations, send us a message—we'd be happy to discuss!</p>
        <p class="font-bold flex items-center">✉ <span class="ml-2">aurami_photobooth@gmail.com</span></p>
      </div>
      <div class="flex-1 card bg-white shadow-xl p-8">
        <form class="space-y-4">
          <div>
            <label for="name" class="block text-lg font-bold">Name</label>
            <input type="text" id="name" placeholder="Enter your name" class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;" />
          </div>
          <div>
            <label for="email" class="block text-lg font-bold">Email</label>
            <input type="email" id="email" placeholder="Enter your email address" class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;" />
          </div>
          <div>
            <label for="message" class="block text-lg font-bold">Message</label>
            <textarea id="message" rows="5" placeholder="Type your message..." class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;"></textarea>
          </div>
          <button type="submit" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7; color: #33272a;">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>
</body>
</html>