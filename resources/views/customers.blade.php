<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customers</title>
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
        <h2 class="text-2xl font-bold">Customers</h2>
      </div>

      <!-- Customers Table -->
      <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
          <thead class="bg-gray-100 text-xs uppercase">
            <tr>
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Name</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Phone</th>
              <th class="px-6 py-3">Total Orders</th>
              <th class="px-6 py-3">Last Activity</th>
              <th class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">1</td>
              <td class="px-6 py-4">Anggun</td>
              <td class="px-6 py-4">anggun@mail.com</td>
              <td class="px-6 py-4">‪+62 812 1234 5678‬</td>
              <td class="px-6 py-4">12</td>
              <td class="px-6 py-4">Apr 12, 2025</td>
              <td class="px-6 py-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">2</td>
              <td class="px-6 py-4">Rifa</td>
              <td class="px-6 py-4">rifa@mail.com</td>
              <td class="px-6 py-4">‪+62 811 9988 3322‬</td>
              <td class="px-6 py-4">5</td>
              <td class="px-6 py-4">Apr 10, 2025</td>
              <td class="px-6 py-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">3</td>
              <td class="px-6 py-4">Raihan</td>
              <td class="px-6 py-4">raihan@mail.com</td>
              <td class="px-6 py-4">‪+62 822 8888 9999‬</td>
              <td class="px-6 py-4">8</td>
              <td class="px-6 py-4">Apr 5, 2025</td>
              <td class="px-6 py-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>