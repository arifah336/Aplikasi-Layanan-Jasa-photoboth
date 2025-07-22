@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#faeee7] text-[#33272a]">
  <div class="card w-full max-w-xl shadow-md bg-white">
    <form method="POST" action="{{ route('admin.login') }}" class="card-body">
      @csrf
      <h2 class="text-2xl font-bold text-center mb-4">Admin Login</h2>

      @if($errors->any())
      <div class="alert alert-error mb-4">
        {{ $errors->first() }}
      </div>
      @endif

      <div class="form-control mb-4">
        <label class="label"><span class="label-text">Username</span></label>
        <input type="text" name="username" class="input input-bordered bg-[#faeee7] text-[#33272a]" required>
      </div>

      <div class="form-control mb-4">
        <label class="label"><span class="label-text">Email</span></label>
        <input type="email" name="email" class="input input-bordered bg-[#faeee7] text-[#33272a]" required>
      </div>

      <div class="form-control mt-6">
        <button type="submit" class="btn bg-[#ff8ba7] text-white hover:bg-[#ec6c8c] w-full">Login</button>
      </div>
    </form>
  </div>
</div>
@endsection