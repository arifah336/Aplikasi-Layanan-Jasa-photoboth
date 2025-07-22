@extends('layouts.user')

@section('title', 'Camera Session')

@section('content')
<main class="flex flex-col items-center justify-center text-center px-4 mt-12">
  <!-- Flash Effect -->
  <div id="flash" class="fixed inset-0 bg-white opacity-0 pointer-events-none transition-opacity duration-300 z-50"></div>

  <div class="flex gap-6 items-start mb-8">
    <!-- Kamera -->
    <div class="relative rounded-2xl border border-black w-[700px] h-[600px] overflow-hidden bg-[#F5F1EB]">
      <video id="camera" autoplay playsinline class="w-full h-full object-cover"></video>
      <canvas id="canvas" class="hidden"></canvas>
      <div id="countdown" class="countdown hidden text-white font-bold text-6xl absolute inset-0 flex items-center justify-center">3</div>
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
    <button data-filter="none" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">No</button>
    <button data-filter="vintage" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">Vintage</button>
    <button data-filter="vivid" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">Vivid</button>
    <button data-filter="soft" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">Soft</button>
    <button data-filter="bw" class="filter-btn w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">B&W</button>
    <button id="invertBtn" class="w-14 h-14 bg-[#F5F1EB] rounded-full border border-black">↔</button>
  </div>
</main>

<script>
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
  let totalShots = layout === 'a' ? 2 : layout === 'b' ? 3 : layout === 'c' ? 4 : layout === 'd' ? 6 : 1;

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
      } else {
        clearInterval(interval);
        countdownEl.classList.add('hidden');
        flash.classList.remove('opacity-0');
        flash.classList.add('opacity-100');
        setTimeout(() => flash.classList.replace('opacity-100', 'opacity-0'), 150);

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
      case 'soft': return 'blur(0px) brightness(1.2)';
      case 'bw': return 'grayscale(1)';
      default: return 'none';
    }
  }

  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('filter-selected'));
      btn.classList.add('filter-selected');
      currentFilter = btn.dataset.filter;
      video.style.filter = getCanvasFilter(currentFilter);
    });
  });

  document.getElementById('invertBtn').addEventListener('click', () => {
    isMirrored = !isMirrored;
    video.style.transform = `scaleX(${isMirrored ? -1 : 1})`;
  });

  startBtn.addEventListener('click', () => {
    if (!isAutoCapturing && capturedPhotos.length === 0) {
      autoCapture(totalShots);
    } else if (capturedPhotos.length > 0 && confirm('Retake photos?')) {
      photoStrip.innerHTML = '';
      capturedPhotos = [];
      autoCapture(totalShots);
    }
  });

  retakeBtn.addEventListener('click', () => {
    if (capturedPhotos.length > 0 && confirm('Retake all photos?')) {
      photoStrip.innerHTML = '';
      capturedPhotos = [];
    }
  });

  nextBtn.addEventListener('click', () => {
    const expected = totalShots;
    if (capturedPhotos.length === expected) {
      localStorage.setItem('capturedPhotos', JSON.stringify(capturedPhotos));
      localStorage.setItem('selectedLayout', layout || 'a');
      window.location.href = "{{ route('user.custom') }}";
    } else {
      alert(`Please take ${expected} photos first!`);
    }
  });

  // window.onload = () => {
  //   if (layout && !isAutoCapturing) setTimeout(() => autoCapture(totalShots), 1000);
  // };
</script>
@endsection