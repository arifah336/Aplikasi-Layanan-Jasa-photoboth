@extends('layouts.admin')

@section('title', 'Upload Template Layout')

@section('content')

<h1 class="text-3xl font-bold mb-6">Upload Template Layout</h1>

{{-- ✅ Notifikasi sukses --}}
@if(session('success'))
  <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

{{-- ✅ Form Upload --}}
<form action="{{ route('admin.custom_layout.store') }}" method="POST" enctype="multipart/form-data" class="mb-10 bg-white p-6 rounded shadow-md">
  @csrf

  <div class="form-control mb-4">
    <label class="label font-semibold">Nama Layout</label>
    <input type="text" name="layout_name" class="input input-bordered" required>
  </div>

  <div class="form-control mb-4">
    <label class="label font-semibold">Tipe</label>
    <select name="type" id="typeSelector" class="select select-bordered" required>
      <option value="">-- Pilih Tipe --</option>
      <option value="frame">Frame Colors</option>
      <option value="sticker">Stickers</option>
      <option value="shape">Shapes</option>
    </select>
  </div>

  {{-- HAPUS class="hidden" untuk debug sementara --}}
<div id="imageUploadContainer" class="form-control mb-4">
  <label class="label font-semibold">Upload Frame Colors</label>
  <input type="file" name="image" class="file-input file-input-bordered" accept="image/png">
</div>


  <div class="form-control">
    <button type="submit" class="btn bg-pink-500 text-white hover:bg-pink-600">Simpan</button>
  </div>
</form>

{{-- ✅ Tabel Template --}}
<h2 class="text-2xl font-semibold mb-4">Daftar Template</h2>
<div class="overflow-x-auto bg-white rounded shadow">
  <table class="table table-zebra w-full text-sm">
    <thead class="bg-[#ffb0c2] text-[#33272a]">
      <tr>
        <th>No</th>
        <th>Nama Layout</th>
        <th>Tipe</th>
        <th>Status</th>
        <th>Dibuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($templates as $i => $tpl)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $tpl->layout_name }}</td>
        <td>{{ ucfirst($tpl->type) }}</td>
        <td>
          <span class="badge {{ $tpl->is_active ? 'badge-success' : 'badge-error' }}">
            {{ $tpl->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td>{{ $tpl->created_at->format('d M Y') }}</td>
        <td class="flex gap-2">
          <a href="{{ route('admin.custom_layout.edit', $tpl->id) }}" class="btn btn-xs btn-warning">Edit</a>
          <form action="{{ route('admin.custom_layout.delete', $tpl->id) }}" method="POST" onsubmit="return confirm('Hapus template ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-xs btn-error text-white">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center text-gray-500 italic">Belum ada template.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- ✅ Script untuk menampilkan upload gambar saat pilih "frame" --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const typeSelector = document.getElementById('typeSelector');
    const imageUploadContainer = document.getElementById('imageUploadContainer');

    function toggleImageUpload() {
      if (typeSelector.value === 'frame') {
        imageUploadContainer.classList.remove('hidden');
      } else {
        imageUploadContainer.classList.add('hidden');
      }
    }

    // Aktifkan toggle saat halaman pertama kali dimuat
    toggleImageUpload();

    // Jalankan toggle saat tipe diganti
    typeSelector.addEventListener('change', toggleIm ageUpload);
  });
</script>

@endsection