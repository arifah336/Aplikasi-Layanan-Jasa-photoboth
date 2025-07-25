<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Photo</title>
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
    .photo-container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 300px;
    }
    .photo-frame {
      aspect-ratio: 1/1;
      width: 100%;
      overflow: hidden;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 10px;
    }
    .photo-frame img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .brand-text {
      font-family: 'Arial', sans-serif;
      font-weight: bold;
      text-align: center;
      color: #33272a;
      margin-top: 15px;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col" style="background-color: #faeee7;">

  <!-- Navbar -->
  <div class="w-full rounded-2xl px-6 py-3 max-w-7xl mx-auto mt-4" style="background-color: #ffb0c2;">
    <div class="flex items-center justify-between">
      <div class="font-bold text-lg">Photobooth</div>
      <ul class="flex gap-6 text-sm">
        <li><a href="home.php" class="nav-link">Home</a></li>
        <li><a href="about.php" class="nav-link">About</a></li>
        <li><a href="contact.php" class="nav-link">Contact</a></li>
      </ul>
      <div class="font-bold text-lg">Aurami</div>
    </div>
  </div>

  <!-- Main Layout -->
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10 flex-grow">
    <!-- Left: Photo Strip -->
    <div class="flex justify-center">
      <div id="photoContainer" class="photo-container">
        <!-- Photos will be inserted here by JavaScript -->
      </div>
    </div>

    <!-- Right: Customization Panel -->
    <div class="space-y-6">
      <h2 class="text-lg font-semibold">Customize your photo</h2>

      <!-- Frame Colors -->
      <div>
        <p class="font-medium mb-2">Frame color:</p>
        <div id="colorOptions" class="flex flex-wrap gap-4">
          <button class="btn btn-circle w-12 h-12 bg-white" data-color="none">🚫</button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#dacccc;" data-color="#dacccc"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#e57d74;" data-color="#e57d74"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#f5c87a;" data-color="#f5c87a"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#8bc3dd;" data-color="#8bc3dd"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#f36b85;" data-color="#f36b85"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#b6d6c1;" data-color="#b6d6c1"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#847865;" data-color="#847865"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#f4efe7;" data-color="#f4efe7"></button>
          <button class="btn btn-circle w-12 h-12" style="background-color:#f5cdbf;" data-color="#f5cdbf"></button>
        </div>
      </div>

      <!-- Photo Shape -->
      <div>
        <p class="font-medium mb-2">Photo shape:</p>
        <div id="shapeOptions" class="flex flex-wrap gap-4">
          <button class="btn" style="background-color: #ff8ba7;" data-shape="square">Square</button>
          <button class="btn" style="background-color: #ff8ba7;" data-shape="rounded">Rounded</button>
          <button class="btn" style="background-color: #ff8ba7;" data-shape="circle">Circle</button>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex gap-6 pt-6">
        <button id="retakeBtn" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7;">RETAKE</button>
        <button id="downloadBtn" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7;">DOWNLOAD</button>
      </div>
    </div>
  </div>

  <!-- Modal QR -->
  <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 shadow-lg text-center max-w-xs w-full">
      <h3 class="text-lg font-bold mb-4">Terima Kasih 🎉</h3>
      <p class="text-sm mb-3">Dukung kami dengan donasi via QR di bawah ini:</p>
      <img src="images/qr_dana.jpg" alt="QR Code" class="mx-auto mb-4 w-40 h-40 object-contain">
      <button onclick="closeQrModal()" class="btn btn-sm btn-wide" style="background-color: #ff8ba7;">Tutup</button>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>

  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <script>
    console.log("Loaded photos:", JSON.parse(localStorage.getItem('capturedPhotos')));
    console.log("Selected layout:", localStorage.getItem('selectedLayout'));

    const capturedPhotos = JSON.parse(localStorage.getItem('capturedPhotos')) || [];
    const selectedLayout = localStorage.getItem('selectedLayout') || 'a';
    const photoContainer = document.getElementById('photoContainer');

    if (capturedPhotos.length === 0) {
      alert('Tidak ada foto yang ditemukan. Silahkan ambil foto terlebih dahulu.');
      window.location.href = 'layout.php';
    }

    function displayPhotos() {
      photoContainer.innerHTML = '';
      const photosContainer = document.createElement('div');

      if (selectedLayout === 'd') {
        photosContainer.className = 'grid grid-cols-2 gap-3 justify-center';
        capturedPhotos.slice(0, 6).forEach((photo, index) => {
          const frame = document.createElement('div');
          frame.className = 'photo-frame';
          const img = document.createElement('img');
          img.src = photo;
          img.alt = `Photo ${index + 1}`;
          frame.appendChild(img);
          photosContainer.appendChild(frame);
        });
      } else {
        photosContainer.className = 'flex flex-col gap-3';
        capturedPhotos.forEach((photo, index) => {
          const frame = document.createElement('div');
          frame.className = 'photo-frame';
          const img = document.createElement('img');
          img.src = photo;
          img.alt = `Photo ${index + 1}`;
          frame.appendChild(img);
          photosContainer.appendChild(frame);
        });
      }

      photoContainer.appendChild(photosContainer);

      const brandText = document.createElement('div');
      brandText.className = 'brand-text';
      brandText.innerHTML = `<div style="font-size: 24px; line-height: 1;">AURAMI</div>
                             <div style="font-size: 14px; line-height: 1;">Photobooth</div>`;
      photoContainer.appendChild(brandText);
    }

    displayPhotos();

    document.querySelectorAll('#colorOptions button').forEach(btn => {
      btn.addEventListener('click', () => {
        const selectedColor = btn.dataset.color;
        document.querySelectorAll('#colorOptions button').forEach(b => {
          b.classList.remove('ring', 'ring-[#ff8ba7]', 'ring-offset-2');
        });
        btn.classList.add('ring', 'ring-[#ff8ba7]', 'ring-offset-2');
        photoContainer.style.backgroundColor = selectedColor === "none" ? "white" : selectedColor;
      });
    });

    document.querySelectorAll('#shapeOptions button').forEach(btn => {
      btn.addEventListener('click', () => {
        const selectedShape = btn.dataset.shape;
        document.querySelectorAll('#shapeOptions button').forEach(b => {
          b.classList.remove('btn-active');
        });
        btn.classList.add('btn-active');
        const photoFrames = document.querySelectorAll('.photo-frame');
        photoFrames.forEach(frame => {
          frame.classList.remove('rounded-none', 'rounded-lg', 'rounded-full');
          switch(selectedShape) {
            case 'square': frame.classList.add('rounded-none'); break;
            case 'rounded': frame.classList.add('rounded-lg'); break;
            case 'circle': frame.classList.add('rounded-full'); break;
          }
        });
      });
    });

    document.getElementById('retakeBtn').addEventListener('click', () => {
      window.location.href = `camera.php?layout=${selectedLayout}`;
    });

    document.getElementById('downloadBtn').addEventListener('click', () => {
      const photoElement = document.getElementById('photoContainer');

      html2canvas(photoElement, {
        useCORS: true,
        allowTaint: true,
        backgroundColor: null,
        scale: 2,
        width: photoElement.offsetWidth,
        height: photoElement.offsetHeight
      }).then(canvas => {
        const link = document.createElement('a');
        link.download = `aurami_photobooth_${Date.now()}.png`;
        link.href = canvas.toDataURL('image/png');
        link.click();

        // Setelah download selesai, tampilkan QR modal
        setTimeout(() => {
          document.getElementById('qrModal').classList.remove('hidden');
        }, 500); // beri sedikit delay untuk memastikan download selesai
      }).catch(err => {
        console.error('Download failed:', err);
        alert('Gagal mengunduh gambar.');
      });
    });

    function closeQrModal() {
      document.getElementById('qrModal').classList.add('hidden');
    }

  </script>
</body>
</html>