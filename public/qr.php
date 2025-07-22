<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download Foto</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
</head>
<body class="bg-base-200 p-6" x-data="{ showQR: false }">
  <h1 class="text-3xl font-bold mb-6">Foto Kamu Sudah Siap 🎉</h1>

  <div class="card w-full md:w-1/2 bg-base-100 shadow-xl mb-6">
    <figure><img src="{{ asset($photo->photo_path) }}" alt="Hasil Foto"></figure>
    <div class="card-body">
      <h2 class="card-title">Download & Share</h2>
      <p>Jangan lupa kasih tip ya biar makin semangat 🧃</p>
      <div class="card-actions justify-end">
        <a :href="'{{ asset($photo->photo_path) }}'" download class="btn btn-primary" @click="showQR = true">Download</a>
      </div>
    </div>
  </div>

  <!-- Pop-up QR Code -->
  <div x-show="showQR" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-80 text-center shadow-lg">
      <h2 class="text-xl font-bold mb-2">Makasih udah pake Photobooth 🙏</h2>
      <p class="mb-4">Yuk kasih tipnya biar makin semangat 🐻‍❄️</p>
      <img src="{{ asset('storage/qrcode-aurami.png') }}" alt="QR Code" class="mx-auto mb-2 w-48">
      <p class="text-sm text-gray-600">Scan pakai e-wallet kamu ya 👆</p>
      <button class="btn btn-outline mt-4" @click="showQR = false">Tutup</button>
    </div>
  </div>
</body>
</html>