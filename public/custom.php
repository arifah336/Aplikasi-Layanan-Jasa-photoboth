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
    .photo-strip {
      background: white;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      gap: 5px;
    }
    .photo-frame {
      border: 2px solid #33272a;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    .brand-text {
      font-family: 'Arial', sans-serif;
      font-weight: bold;
      text-align: center;
      color: #33272a;
      margin-top: 5px;
    }
    .photo-row {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 10px;
    }
    .photo-row:last-child {
      margin-bottom: 0;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col" style="background-color: #faeee7;">

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

  <!-- Main Layout -->
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10 flex-grow">
    <!-- Left: Photo Strip -->
    <div class="flex justify-center">
      <div id="photoContainer" class="bg-white p-4 rounded-xl shadow-md flex flex-col items-center space-y-4">
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

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>

  <script>
    // Get photos from localStorage
    const capturedPhotos = JSON.parse(localStorage.getItem('capturedPhotos')) || [];
    const selectedLayout = localStorage.getItem('selectedLayout') || 'd'; // Default to layout D for this example
    const photoContainer = document.getElementById('photoContainer');
    const colorButtons = document.querySelectorAll('#colorOptions button');
    const shapeButtons = document.querySelectorAll('#shapeOptions button');
    const retakeBtn = document.getElementById('retakeBtn');
    const downloadBtn = document.getElementById('downloadBtn');

    // Display photos based on layout
    function displayPhotos() {
      photoContainer.innerHTML = '';
      
      // For layout D (6 photos) - 2 top, 2 middle, 2 bottom
      if (selectedLayout === 'd') {
        const photosToShow = capturedPhotos.slice(0, 6);
        
        // Create rows for the photos
        const topRow = document.createElement('div');
        topRow.className = 'photo-row';
        
        const middleRow = document.createElement('div');
        middleRow.className = 'photo-row';
        
        const bottomRow = document.createElement('div');
        bottomRow.className = 'photo-row';
        
        // Add photos to rows (2 each)
        for (let i = 0; i < 6; i++) {
          const frame = document.createElement('div');
          frame.className = 'photo-frame w-40 h-40'; // Fixed size for each photo
          
          const img = document.createElement('img');
          img.src = photosToShow[i] || ''; // Fallback to empty if photo doesn't exist
          img.className = 'w-full h-full object-cover';
          frame.appendChild(img);
          
          if (i < 2) {
            topRow.appendChild(frame);
          } else if (i < 4) {
            middleRow.appendChild(frame);
          } else {
            bottomRow.appendChild(frame);
          }
        }
        
        photoContainer.appendChild(topRow);
        photoContainer.appendChild(middleRow);
        photoContainer.appendChild(bottomRow);
      }
      
      // Add brand text exactly as in the image
      const brandText = document.createElement('div');
      brandText.className = 'brand-text';
      brandText.innerHTML = `
        <div style="font-size: 24px; line-height: 1;">AURAMI</div>
        <div style="font-size: 14px; line-height: 1;">Photobooth</div>
      `;
      photoContainer.appendChild(brandText);
    }

    // Initialize
    displayPhotos();

    // Frame color change
    colorButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const selectedColor = btn.dataset.color;
        colorButtons.forEach(b => b.classList.remove('ring', 'ring-[#ff8ba7]', 'ring-offset-2'));
        btn.classList.add('ring', 'ring-[#ff8ba7]', 'ring-offset-2');
        
        if (selectedColor === "none") {
          photoContainer.style.backgroundColor = "white";
        } else {
          photoContainer.style.backgroundColor = selectedColor;
        }
      });
    });

    // Photo shape change
    shapeButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const selectedShape = btn.dataset.shape;
        shapeButtons.forEach(b => b.classList.remove('btn-active'));
        btn.classList.add('btn-active');

        const photoFrames = document.querySelectorAll('.photo-frame');
        photoFrames.forEach(frame => {
          frame.classList.remove('rounded-none', 'rounded-lg', 'rounded-full');
          
          switch(selectedShape) {
            case 'square':
              frame.classList.add('rounded-none');
              break;
            case 'rounded':
              frame.classList.add('rounded-lg');
              break;
            case 'circle':
              frame.classList.add('rounded-full');
              break;
          }
        });
      });
    });

    // Retake button - go back to camera
    retakeBtn.addEventListener('click', () => {
      window.location.href = camera.blade.php?layout=${selectedLayout};
    });

    // Download button
    downloadBtn.addEventListener('click', () => {
      // In a real implementation, you would create a download link for the photo strip
      alert('Your customized photo strip has been downloaded!');
    });
  </script>
</body>
</html>
custom