<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Photobooth Session</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .countdown {
      font-size: 5rem;
      font-weight: bold;
      color: white;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation: fadeInOut 1s linear;
    }

    @keyframes fadeInOut {
      0% { opacity: 0; transform: translate(-50%, -50%) scale(0.5); }
      50% { opacity: 1; transform: translate(-50%, -50%) scale(1.2); }
      100% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
    }

    .filter-selected {
      outline: 3px solid #6ABFFF;
    }

    video {
      transition: filter 0.3s ease;
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
<body class="min-h-screen flex flex-col" style="background-color: #faeee7;">

  <!-- Navbar -->
  <div class="navbar rounded-b-2xl shadow-md px-6 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex-1">
      <a class="text-lg font-bold">Photobooth</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li><a href="home.php" class="nav-link">Home</a></li>
        <li><a href="about.php" class="nav-link">About</a></li>
        <li><a href="contact.php" class="nav-link">Contact</a></li>
      </ul>
    </div>
    <div class="flex-1 justify-end hidden sm:flex">
      <span class="text-lg font-bold">Aurami</span>
    </div>
  </div>

  <!-- Flash Effect -->
  <div id="flash" class="fixed inset-0 bg-white opacity-0 pointer-events-none transition-opacity duration-300 z-50"></div>

  <!-- Main Layout -->
  <main class="flex flex-col items-center justify-center text-center px-4 mt-12 flex-grow">
    <div class="flex gap-6 items-start mb-8">
      <!-- Kamera -->
      <div class="relative rounded-2xl border border-black w-[700px] h-[600px] overflow-hidden bg-[#F5F1EB]">
        <video id="camera" autoplay playsinline class="w-full h-full object-cover"></video>
        <canvas id="canvas" class="hidden"></canvas>
        <div id="countdown" class="countdown hidden">3</div>
      </div>

      <!-- Photo Strip -->
      <div id="photoStrip" class="flex flex-col gap-2">
        <!-- Foto akan ditampilkan di sini -->
      </div>
    </div>

    <!-- Tombol Kontrol -->
    <div class="flex gap-6 mb-6">
      <button id="retakeBtn" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7;">RETAKE</button>
      <button id="startBtn" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7;">PHOTO</button>
      <button id="nextBtn" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7;">NEXT</button>
    </div>

    <p class="text-lg font-medium mb-4">Choose a filter for your photos!</p>

    <!-- Filter -->
    <div class="flex gap-4 mb-6">
      <button data-filter="none" class="filter-btn btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">No Filter</button>
      <button data-filter="vintage" class="filter-btn btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">Vintage</button>
      <button data-filter="vivid" class="filter-btn btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">ViVid</button>
      <button data-filter="soft" class="filter-btn btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">Soft</button>
      <button data-filter="bw" class="filter-btn btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">B&W</button>
      <button id="invertBtn" class="btn btn-circle w-14 h-14" style="background-color: #F5F1EB;">↔</button>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>

<script>
window.onload = function () {
  const video = document.getElementById('camera');
  const canvas = document.getElementById('canvas');
  const countdownEl = document.getElementById('countdown');
  const photoStrip = document.getElementById('photoStrip');
  const flash = document.getElementById('flash');
  const startBtn = document.getElementById('startBtn');
  const retakeBtn = document.getElementById('retakeBtn');
  const nextBtn = document.getElementById('nextBtn');
  let currentFilter = 'none';
  let isMirrored = false;
  let isCapturing = false;
  let photosTaken = 0;
  let capturedPhotos = [];

  // Get layout from URL
  const urlParams = new URLSearchParams(window.location.search);
  const layout = urlParams.get('layout');

  // Determine number of shots based on layout
  let totalShots = 1;
  if (layout === 'a') totalShots = 2;
  else if (layout === 'b') totalShots = 3;
  else if (layout === 'c') totalShots = 4;
  else if (layout === 'd') totalShots = 6;

  // Access camera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(error => {
      alert('Could not access camera.');
      console.error(error);
    });

  // Start capture sequence
  function startCapture() {
    if (isCapturing) return;
    isCapturing = true;
    photosTaken = 0;
    capturedPhotos = [];
    photoStrip.innerHTML = '';
    captureNextPhoto();
  }

  // Capture next photo in sequence
  function captureNextPhoto() {
    if (photosTaken >= totalShots) {
      isCapturing = false;
      return;
    }

    let count = 3;
    countdownEl.textContent = count;
    countdownEl.classList.remove('hidden');

    const interval = setInterval(() => {
      count--;
      if (count > 0) {
        countdownEl.textContent = count;
        countdownEl.style.animation = 'none';
        countdownEl.offsetHeight;
        countdownEl.style.animation = 'fadeInOut 1s linear';
      } else {
        clearInterval(interval);
        countdownEl.classList.add('hidden');
        takePhoto();
      }
    }, 1000);
  }

  // Take photo and add to strip
  function takePhoto() {
    flash.classList.remove('opacity-0');
    flash.classList.add('opacity-100');
    setTimeout(() => {
      flash.classList.remove('opacity-100');
      flash.classList.add('opacity-0');
    }, 150);

    const ctx = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.save();

    ctx.filter = getCanvasFilter(currentFilter);

    if (isMirrored) {
      ctx.translate(canvas.width, 0);
      ctx.scale(-1, 1);
    }

    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    ctx.restore();

    const dataURL = canvas.toDataURL('image/png');
    capturedPhotos.push(dataURL);
    
    const imgThumb = document.createElement('img');
    imgThumb.src = dataURL;
    imgThumb.className = 'w-100 h-32 object-cover rounded border border-black';
    photoStrip.appendChild(imgThumb);

    photosTaken++;
    
    if (photosTaken < totalShots) {
      setTimeout(captureNextPhoto, 1000);
    } else {
      isCapturing = false;
    }
  }

  // Get filter CSS for canvas
  function getCanvasFilter(filter) {
    switch (filter) {
      case 'vintage': return 'sepia(0.8) contrast(1.2)';
      case 'vivid': return 'saturate(2) contrast(1.2)';
      case 'soft': return 'blur(2px) brightness(1.2)';
      case 'bw': return 'grayscale(1)';
      default: return 'none';
    }
  }

  // Event listeners
  startBtn.addEventListener('click', startCapture);

  retakeBtn.addEventListener('click', () => {
    photoStrip.innerHTML = '';
    capturedPhotos = [];
    photosTaken = 0;
  });

  nextBtn.addEventListener('click', () => {
    if (capturedPhotos.length === totalShots) {
      localStorage.setItem('capturedPhotos', JSON.stringify(capturedPhotos));
      localStorage.setItem('selectedLayout', layout);
      window.location.href = 'custom.php';
    } else {
      alert(Please take ${totalShots} photos first!);
    }
  });

  // Filter buttons
  const filterButtons = document.querySelectorAll('.filter-btn');
  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      filterButtons.forEach(b => b.classList.remove('ring', 'ring-[#ff8ba7]', 'ring-offset-2'));
      btn.classList.add('ring', 'ring-[#ff8ba7]', 'ring-offset-2');

      currentFilter = btn.getAttribute('data-filter');

      switch (currentFilter) {
        case 'vintage':
          video.style.filter = 'sepia(0.8) contrast(1.2)';
          break;
        case 'vivid':
          video.style.filter = 'saturate(2) contrast(1.2)';
          break;
        case 'soft':
          video.style.filter = 'blur(2px) brightness(1.2)';
          break;
        case 'bw':
          video.style.filter = 'grayscale(1)';
          break;
        default:
          video.style.filter = 'none';
      }
    });
  });

  // Mirror button
  const invertBtn = document.getElementById('invertBtn');
  invertBtn.addEventListener('click', () => {
    isMirrored = !isMirrored;
    video.style.transform = scaleX(${isMirrored ? -1 : 1});
  });
};
</script>
</body>
</html>