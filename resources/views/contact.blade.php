@extends('layouts.user')

@section('title', 'Contact')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-start">
  <!-- Left Info -->
  <div>
    <h1 class="text-4xl font-bold mb-6">Contact Us</h1>
    <p class="mb-4 text-[#594a4e]">
      We'd love to hear from you! Whether it's a question, suggestion, or issue, feel free to reach out—your feedback helps us improve.
    </p>
    <p class="mb-6 text-[#594a4e]">
      For commercial inquiries or collaborations, send us a message—we'd be happy to discuss!
    </p>
    <span>📧 aurami_photobooth@gmail.com</span>
    <p class="flex items-center gap-2 font-bold text-[#33272a]">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#594a4e]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      </svg>
    </p>
  </div>

  <!-- Contact Form -->
  <div class="bg-white p-8 rounded-2xl shadow-md w-full">
    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="space-y-4">
      @csrf
      <div>
        <label class="block font-bold mb-1">Name</label>
        <input type="text" name="name" placeholder="Enter your name"
               class="input input-bordered w-full bg-[#faeee7] text-[#33272a]" required>
      </div>

      <div>
        <label class="block font-bold mb-1">Email</label>
        <input type="email" name="email" placeholder="Enter your email address"
               class="input input-bordered w-full bg-[#faeee7] text-[#33272a]" required>
      </div>

      <div>
        <label class="block font-bold mb-1">Message</label>
        <textarea name="message" rows="4" placeholder="Type your message..."
                  class="textarea textarea-bordered w-full bg-[#faeee7] text-[#33272a]" required></textarea>
      </div>

      <button type="submit"
              class="btn mt-2 w-full bg-[#ff8ba7] hover:bg-[#ec6c8c] text-white font-bold">
        SEND MESSAGE
      </button>
    </form>
  </div>
</div>
@endsection