<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Photobooth</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-sm bg-white shadow-md rounded-lg p-8">
    <div class="mb-6 text-center">
      <h1 class="text-2xl font-bold text-gray-800">Admin Login</h1>
      <p class="text-sm text-gray-500">Sign in to manage your photobooth</p>
    </div>

    <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input name="email" type="email" required
               class="mt-1 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-purple-500"/>
      </div>

      <button type="submit"
              class="w-full bg-pink-600 text-white py-2 rounded hover:bg-purple-700 transition">
        Login
      </button>
    </form>

    <p class="text-center text-xs text-gray-400 mt-6">
      &copy; 2025 Photobooth Admin Panel
    </p>
  </div>
</body>
</html>