@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<!-- Profile Settings -->
<div class="bg-white shadow-md p-6 rounded-lg">
  <h2 class="text-2xl font-bold mb-4">Profile Settings</h2>
  <form method="POST" action="{{ route('admin.profile.update') }}">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium">Username</label>
        <input type="text" name="username" class="input input-bordered w-full mt-1" value="{{ old('username', auth()->user()->username) }}" required>
      </div>
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" class="input input-bordered w-full mt-1" value="{{ old('email', auth()->user()->email) }}" required>
      </div>
    </div>
    <button class="mt-6 btn bg-blue-600 text-white hover:bg-blue-700">Simpan Perubahan</button>
  </form>
</div>


@endsection