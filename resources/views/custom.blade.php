@extends('layouts.user')

@section('title', 'Customize Photo')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10 flex-grow">
  <!-- 🖼️ Preview -->
  <div class="flex justify-center">
    <div id="photoContainer" class="photo-container"></div>
    <canvas id="downloadCanvas" class="hidden"></canvas>
  </div>

  <!-- 🎨 Panel Kustom -->
  <div class="space-y-6">
    <h2 class="text-lg font-semibold">Customize your photo</h2>

    <!-- Frame Colors -->
    <div>
      <p class="font-medium mb-2">Frame color:</p>
      <div id="colorOptions" class="flex gap-3 flex-wrap">
        @foreach ($frames as $frame)
          <button
            class="w-10 h-10 border rounded-full overflow-hidden"
            data-color="{{ asset('storage/' . $frame->image_path) }}"
            style="background-image: url('{{ asset('storage/' . $frame->image_path) }}'); background-size: cover; background-position: center;"
          >
          </button>
        @endforeach
      </div>
    </div>

    <!-- Shape Selector -->
    <div>
      <p class="font-medium mb-2">Photo shape:</p>
      <div id="shapeOptions" class="flex flex-wrap gap-4">
        <button class="btn bg-[#ff8ba7]" data-shape="square">Square</button>
        <button class="btn bg-[#ff8ba7]" data-shape="rounded">Rounded</button>
        <button class="btn bg-[#ff8ba7]" data-shape="circle">Circle</button>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-6 pt-6">
      <button id="retakeBtn" class="btn bg-[#ff8ba7] text-white">RETAKE</button>
      <button id="downloadBtn" class="btn bg-[#ff8ba7] text-white">DOWNLOAD</button>
    </div>

    <!-- Modal Donasi QR -->
    <div id="donationModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
      <div class="bg-white rounded-lg p-6 max-w-md w-full text-center">
        <h2 class="text-xl font-bold mb-4">Terima Kasih 🙏</h2>
        <p class="mb-4">Dukung layanan ini dengan donasi seikhlasnya!</p>
        <img src="{{ asset('images/qr_aurami.png') }}" alt="QR Donasi" class="mx-auto mb-4 w-40">
        <button onclick="closeDonationModal()" class="btn btn-primary">Tutup</button>
      </div>
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const capturedPhotos = JSON.parse(localStorage.getItem('capturedPhotos')) || [];
    const selectedLayout = localStorage.getItem('selectedLayout') || 'a';
    const photoContainer = document.getElementById('photoContainer');

    if (capturedPhotos.length === 0) {
      alert('Tidak ada foto ditemukan. Silakan ambil foto terlebih dahulu.');
      window.location.href = '{{ url("/layout") }}';
      return;
    }

    function displayPhotos() {
      photoContainer.innerHTML = '';
      const wrapper = document.createElement('div');

      if (selectedLayout === 'd') {
        wrapper.className = 'grid grid-cols-2 gap-3 justify-center';
        capturedPhotos.slice(0, 6).forEach((photo, i) => {
          const frame = document.createElement('div');
          frame.className = 'photo-frame';
          frame.innerHTML = `<img src="${photo}" alt="Photo ${i + 1}">`;
          wrapper.appendChild(frame);
        });
      } else {
        wrapper.className = 'flex flex-col gap-3';
        capturedPhotos.forEach((photo, i) => {
          const frame = document.createElement('div');
          frame.className = 'photo-frame';
          frame.innerHTML = `<img src="${photo}" alt="Photo ${i + 1}">`;
          wrapper.appendChild(frame);
        });
      }

      photoContainer.appendChild(wrapper);

      const brand = document.createElement('div');
      brand.className = 'brand-text';
      brand.innerHTML = `<div style="font-size: 24px;">AURAMI</div><div style="font-size: 14px;">Photobooth</div>`;
      photoContainer.appendChild(brand);
    }

    function attachFrameListeners() {
      document.querySelectorAll('#colorOptions button').forEach(btn => {
        btn.addEventListener('click', () => {
          const imageUrl = btn.dataset.color;

          document.querySelectorAll('#colorOptions button').forEach(b => {
            b.classList.remove('ring', 'ring-[#ff8ba7]', 'ring-offset-2');
          });
          btn.classList.add('ring', 'ring-[#ff8ba7]', 'ring-offset-2');

          const frames = document.querySelectorAll('.photo-frame');
          frames.forEach(frame => {
            frame.style.backgroundImage = `url('${imageUrl}')`;
            frame.style.backgroundSize = 'cover';
            frame.style.backgroundPosition = 'center';
            frame.style.backgroundRepeat = 'no-repeat';
          });
        });
      });
    }

    displayPhotos();
    attachFrameListeners();

    // Shape Selector
    document.querySelectorAll('#shapeOptions button').forEach(btn => {
      btn.addEventListener('click', () => {
        const shape = btn.dataset.shape;
        document.querySelectorAll('#shapeOptions button').forEach(b => b.classList.remove('btn-active'));
        btn.classList.add('btn-active');

        document.querySelectorAll('.photo-frame').forEach(frame => {
          frame.classList.remove('rounded-none', 'rounded-lg', 'rounded-full');
          if (shape === 'square') frame.classList.add('rounded-none');
          if (shape === 'rounded') frame.classList.add('rounded-lg');
          if (shape === 'circle') frame.classList.add('rounded-full');
        });
      });
    });

    // Retake
    document.getElementById('retakeBtn').addEventListener('click', () => {
      window.location.href = `/camera?layout=${selectedLayout}`;
    });

    // Download
    document.getElementById('downloadBtn').addEventListener('click', async () => {
      const photoFrames = document.querySelectorAll('.photo-frame img');
      const frameStyle = window.getComputedStyle(document.querySelector('.photo-frame'));
      const bgUrl = frameStyle.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');

      if (photoFrames.length === 0) {
        alert("No photo available to download.");
        return;
      }

      const canvas = document.getElementById('downloadCanvas');
      const ctx = canvas.getContext('2d');

      const imgSize = 300;
      const padding = 20;
      const totalHeight = (imgSize + padding) * photoFrames.length;

      canvas.width = imgSize;
      canvas.height = totalHeight;

      for (let i = 0; i < photoFrames.length; i++) {
        const frameImg = new Image();
        const userImg = new Image();
        frameImg.crossOrigin = "anonymous";
        userImg.crossOrigin = "anonymous";

        frameImg.src = bgUrl;
        userImg.src = photoFrames[i].src;

        await Promise.all([
          new Promise(resolve => userImg.onload = resolve),
          new Promise(resolve => frameImg.onload = resolve)
        ]);

        ctx.drawImage(userImg, 0, i * (imgSize + padding), imgSize, imgSize);
        if (bgUrl && bgUrl !== 'none') {
          ctx.drawImage(frameImg, 0, i * (imgSize + padding), imgSize, imgSize);
        }
      }

      const link = document.createElement('a');
      link.download = 'aurami_photobooth.png';
      link.href = canvas.toDataURL('image/png');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      setTimeout(() => {
        if (!sessionStorage.getItem('qrShown')) {
          document.getElementById('donationModal').classList.remove('hidden');
          sessionStorage.setItem('qrShown', 'yes');
        }
      }, 1000);
    });

    window.closeDonationModal = function () {
      document.getElementById('donationModal').classList.add('hidden');
    };
  });
</script>

<style>
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
    background-color: transparent;
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
@endsection
