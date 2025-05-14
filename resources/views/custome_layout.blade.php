<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Custom Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-900 text-white p-6">
      <div class="flex items-center space-x-2 mb-10">
        <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
        <h1 class="text-xl font-bold">Admin</h1>
      </div>
      <nav class="space-y-4 text-sm">
        <a href="dashboard.blade.php" class="block text-white font-semibold">Dashboard</a>
        <a href="transtactions.blade.php" class="block text-white">Transactions</a>
        <a href="customers.blade.php" class="block text-white">Customers</a>
        <a href="custome_layout.blade.php" class="block text-white">Custome Layout</a>
        <a href="settings.blade.php" class="block text-white">Settings</a>
        <a href="login.blade.php" class="block text-white text-red-400 mt-10 hover:text-red-600">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Custom Layouts</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New Layout</button>
      </div>

      <!-- Layouts Table -->
      <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
          <thead class="bg-gray-100 text-xs uppercase">
            <tr>
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Preview</th>
              <th class="px-6 py-3">Layout Name</th>
              <th class="px-6 py-3">Theme Color</th>
              <th class="px-6 py-3">Last Updated</th>
              <th class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">1</td>
              <td class="px-6 py-4">
                <img src="layout1.jpg" alt="Layout 1" class="w-16 h-16 rounded object-cover border" />
              </td>
              <td class="px-6 py-4">Wedding Theme</td>
              <td class="px-6 py-4">
                <div class="w-6 h-6 rounded-full bg-pink-500 border"></div>
              </td>
              <td class="px-6 py-4">Apr 25, 2025</td>
              <td class="px-6 py-4 space-x-2">
                <button class="text-blue-600 hover:underline">Edit</button>
                <button class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">2</td>
              <td class="px-6 py-4">
                <img src="layout2.jpg" alt="Layout 2" class="w-16 h-16 rounded object-cover border" />
              </td>
              <td class="px-6 py-4">Graduation Style</td>
              <td class="px-6 py-4">
                <div class="w-6 h-6 rounded-full bg-blue-600 border"></div>
              </td>
              <td class="px-6 py-4">Apr 15, 2025</td>
              <td class="px-6 py-4 space-x-2">
                <button class="text-blue-600 hover:underline">Edit</button>
                <button class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>