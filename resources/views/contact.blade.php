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
      <div class="flex-1 card bg-white shadow-xl p-8">
        <form class="space-y-4">
          <div>
            <label for="name" class="block text-lg font-bold">Name</label>
            <input type="text" id="name" placeholder="Enter your name" class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;" />
          </div>
          <div>
            <label for="email" class="block text-lg font-bold">Email</label>
            <input type="email" id="email" placeholder="Enter your email address" class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;" />
          </div>
          <div>
            <label for="message" class="block text-lg font-bold">Message</label>
            <textarea id="message" rows="5" placeholder="Type your message..." class="w-full p-3 rounded text-sm font-mono" style="background-color: #faeee7;"></textarea>
          </div>
          <button type="submit" class="btn uppercase font-bold tracking-wider" style="background-color: #ff8ba7; color: #33272a;">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer footer-center p-4" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>
</body>
</html>