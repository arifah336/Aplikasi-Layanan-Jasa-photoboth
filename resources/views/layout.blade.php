@extends('layouts.user')

@section('title', 'Choose Layout')

@section('content')
<main class="min-h-[80vh] flex flex-col justify-center items-center px-4 flex-grow">
  <!-- Title -->
  <div class="text-center mb-10">
    <h1 class="text-2xl font-bold uppercase">choose your layout</h1>
    <p class="text-sm italic mt-2 text-[#594a4e]">NOTE: you have 3 seconds for each shot</p>
  </div>

  <!-- Layout Cards -->
  <div class="flex flex-wrap justify-center gap-10 px-4 max-w-5xl">
    <div class="flex flex-wrap justify-center items-start gap-8">

      <!-- Layout A (2 photos) -->
      <a href="{{ route('user.camera') }}?layout=a" class="flex flex-col items-center transform transition hover:scale-105">
        <div class="card bg-white shadow-md w-[150px] p-3">
          <img src="{{ asset('images/2.jpg') }}" alt="Layout A" class="h-56 object-cover rounded"/>
          <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
        </div>
        <div class="mt-3 text-center">
          <p class="font-bold">layout A</p>
          <p class="text-sm text-[#594a4e]">2 pose</p>
        </div>
      </a>

      <!-- Layout B (3 photos) -->
      <a href="{{ route('user.camera') }}?layout=b" class="flex flex-col items-center transform transition hover:scale-105">
        <div class="card bg-white shadow-md w-[150px] p-3">
          <img src="{{ asset('images/3.jpg') }}" alt="Layout B" class="h-56 object-cover rounded"/>
          <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
        </div>
        <div class="mt-3 text-center">
          <p class="font-bold">layout B</p>
          <p class="text-sm text-[#594a4e]">3 pose</p>
        </div>
      </a>

      <!-- Layout C (4 photos) -->
      <a href="{{ route('user.camera') }}?layout=c" class="flex flex-col items-center transform transition hover:scale-105">
        <div class="card bg-white shadow-md w-[150px] p-3">
          <img src="{{ asset('images/4.jpg') }}" alt="Layout C" class="h-56 object-cover rounded"/>
          <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
        </div>
        <div class="mt-3 text-center">
          <p class="font-bold">layout C</p>
          <p class="text-sm text-[#594a4e]">4 pose</p>
        </div>
      </a>

      <!-- Layout D (6 photos) -->
      <a href="{{ route('user.camera') }}?layout=d" class="flex flex-col items-center transform transition hover:scale-105">
        <div class="card bg-white shadow-md w-[150px] p-3">
          <img src="{{ asset('images/6.jpg') }}" alt="Layout D" class="h-56 object-cover rounded"/>
          <div class="text-center mt-2 font-bold text-sm">AURAMI</div>
        </div>
        <div class="mt-3 text-center">
          <p class="font-bold">layout D</p>
          <p class="text-sm text-[#594a4e]">6 pose</p>
        </div>
      </a>
    </div>
  </div>
</main>
@endsection