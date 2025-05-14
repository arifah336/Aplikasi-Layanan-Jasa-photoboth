<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Photobooth Session</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #faeee7;
      font-family: 'Arial', sans-serif;
    }

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
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="w-full bg-[#ffb0c2] shadow rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="home.blade.php" class="text-[#33272a] font-semibold hover:text-[#c3f0ca] transition">Home</a></li>
        <li><a href="about.blade.php" class="text-[#33272a] font-semibold hover:text-[#c3f0ca] transition">About</a></li>
        <li><a href="contact.blade.php" class="text-[#33272a] font-semibold hover:text-[#c3f0ca] transition">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- Flash Effect -->
  <div id="flash" class="fixed inset-0 bg-white opacity-0 pointer-events-none transition-opacity duration-300 z-50"></div>

  <!-- Main Layout -->
  <main class="flex flex-col items-center justify-center text-center px-4 mt-12">
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
      <button id="retakeBtn" class="bg-[#ff8ba7] text-black font-medium px-8 py-3 rounded-full shadow hover:scale-105 transition">RETAKE</button>
      <button id="startBtn" class="bg-[#ff8ba7] border font-medium px-8 py-3 rounded-lg shadow flex items-center gap-2 hover:scale-105 transition">PHOTO</button>
      <button id="nextBtn" class="bg-[#ff8ba7] text-black font-medium px-8 py-3 rounded-full shadow hover:scale-105 transition">NEXT</button>
    </div>

    <p class="text-lg font-medium mb-4">Choose a filter for your photos!</p>

    <!-- Filter -->
    <div class="flex gap-4 mb-6">
      <button data-filter="none" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">No Filter</button>
      <button data-filter="vintage" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">Vintage</button>
      <button data-filter="vivid" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">ViVid</button>
      <button data-filter="soft" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">Soft</button>
      <button data-filter="bw" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">B&W</button>
      <button id="invertBtn" class="w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">↔</button>
    </div>
  </main>

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
  let capturedPhotos = [];
  let isAutoCapturing = false;

  const urlParams = new URLSearchParams(window.location.search);
  const layout = urlParams.get('layout');

  // Tentukan jumlah pose otomatis dari layout
  let totalShots = 1;
  if (layout === 'a') totalShots = 2;
  else if (layout === 'b') totalShots = 3;
  else if (layout === 'c') totalShots = 4;
  else if (layout === 'd') totalShots = 6;

  // Auto-start capturing if layout is specified
if (layout && !isAutoCapturing) {
  setTimeout(() => autoCapture(totalShots), 1000);
}

  // Akses kamera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(error => {
      alert('Kamera gagal diakses.');
      console.error(error);
    });

  function autoCapture(remaining) {
    if (remaining <= 0) {
      isAutoCapturing = false;
      return;
    }
    
    isAutoCapturing = true;
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

        setTimeout(() => autoCapture(remaining - 1), 1000);
      }
    }, 1000);
  }

  function getCanvasFilter(filter) {
    switch (filter) {
      case 'vintage': return 'sepia(0.8) contrast(1.2)';
      case 'vivid': return 'saturate(2) contrast(1.2)';
      case 'soft': return 'blur(2px) brightness(1.2)';
      case 'bw': return 'grayscale(1)';
      default: return 'none';
    }
  }

  const filterButtons = document.querySelectorAll('.filter-btn');
  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      filterButtons.forEach(b => b.classList.remove('filter-selected'));
      btn.classList.add('filter-selected');

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

  const invertBtn = document.getElementById('invertBtn');
  invertBtn.addEventListener('click', () => {
    isMirrored = !isMirrored;
    video.style.transform = scaleX(${isMirrored ? -1 : 1});
  });

  startBtn.addEventListener('click', () => {
  if (!isAutoCapturing && capturedPhotos.length === 0) {
    autoCapture(totalShots);
  } else if (capturedPhotos.length > 0) {
    // If photos exist but user wants to retake
    if (confirm('Retake photos? This will delete current photos.')) {
      photoStrip.innerHTML = '';
      capturedPhotos = [];
      autoCapture(totalShots);
    }
  }
});

retakeBtn.addEventListener('click', () => {
  if (capturedPhotos.length > 0) {
    if (confirm('Are you sure you want to retake all photos?')) {
      photoStrip.innerHTML = '';
      capturedPhotos = [];
    }
  } else {
    alert('No photos to retake!');
  }
});

nextBtn.addEventListener('click', () => {
  const expectedPhotos = 
    layout === 'a' ? 2 :
    layout === 'b' ? 3 :
    layout === 'c' ? 4 :
    layout === 'd' ? 6 : 1;
  
  if (capturedPhotos.length === expectedPhotos) {
    localStorage.setItem('capturedPhotos', JSON.stringify(capturedPhotos));
    localStorage.setItem('selectedLayout', layout || 'a');
    window.location.href = 'custom.blade.php';
  } else {
    alert(Please take ${expectedPhotos} photos first!);
  }
});
</script>

  <!-- Footer -->
  <footer class="bg-[#c3f0ca] text-base-content py-3">
    <div class="max-w-4xl mx-auto text-center">
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </div>
  </footer>
</body>
</html>