@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
<section class="flex flex-col justify-center items-center text-center px-4 min-h-[80vh]">
  <div>
    <h1 class="text-5xl font-bold tracking-widest animate-shineText" style="background: linear-gradient(to right, white, #ffb0c2, white); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent;">
      PHOTOBOOTH
    </h1>
    <p class="mt-2" style="color: #6b7280;">by AURAMI</p>
    <a href="{{ route('user.layout') }}">
      <button class="mt-12 px-10 py-4 rounded-full text-lg font-bold uppercase tracking-wider hover:shadow transition" style="background-color: #ff8ba7; color: #33272a;">Start Photo</button>
    </a>
  </div>
</section>
@endsection