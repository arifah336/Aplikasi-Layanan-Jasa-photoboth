@extends('layouts.admin')

@section('title', 'Edit Template')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Template Layout</h1>

<form action="{{ route('admin.custom_layout.update', $template->id) }}" method="POST" class="bg-white p-6 rounded shadow">
  @csrf
  @method('PUT')

  <div class="form-control mb-4">
    <label class="label font-semibold">Nama Layout</label>
    <input type="text" name="layout_name" class="input input-bordered" value="{{ $template->layout_name }}" required>
  </div>

  <div class="form-control mb-4">
    <label class="label font-semibold">Tipe</label>
    <select name="type" class="select select-bordered" required>
      <option value="frame" @selected($template->type == 'frame')>Frame</option>
      <option value="sticker" @selected($template->type == 'sticker')>Sticker</option>
      <option value="shape" @selected($template->type == 'shape')>Shape</option>
    </select>
  </div>

  <button type="submit" class="btn bg-green-600 text-white hover:bg-green-700">Update</button>
</form>
@endsection