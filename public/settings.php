<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Settings</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-6 overflow-y-auto">
      <div class="flex items-center space-x-2 mb-10">
        <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
        <h1 class="text-xl font-bold">Admin</h1>
      </div>
       <nav class="space-y-4 text-sm">
        <a href="dashboard.php" class="block text-white font-semibold">Dashboard</a>
        <a href="transtactions.php" class="block text-white">Transactions</a>
        <a href="customers.php" class="block text-white">Customers</a>
        <a href="custome_layout.php" class="block text-white">Custome Layout</a>
        <a href="settings.php" class="block text-white">Settings</a>
        <a href="login.php" class="block text-white text-red-400 mt-10 hover:text-red-600">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-6">Settings</h2>

      <!-- Profile Settings -->
      <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4">Profile Settings</h3>
        <form class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Full Name</label>
              <input type="text" class="mt-1 w-full px-4 py-2 border rounded" value="Admin User">
            </div>
            <div>
              <label class="block text-sm font-medium">Email</label>
              <input type="email" class="mt-1 w-full px-4 py-2 border rounded" value="admin@photobooth.com">
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium">Phone Number</label>
            <input type="text" class="mt-1 w-full px-4 py-2 border rounded" value="‪+62 812 3456 7890‬">
          </div>
          <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Changes
          </button>
        </form>
      </div>

      <!-- Security Settings -->
      <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Security</h3>
        <form class="space-y-4">
          <div>
            <label class="block text-sm font-medium">Current Password</label>
            <input type="password" class="mt-1 w-full px-4 py-2 border rounded">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">New Password</label>
              <input type="password" class="mt-1 w-full px-4 py-2 border rounded">
            </div>
            <div>
              <label class="block text-sm font-medium">Confirm Password</label>
              <input type="password" class="mt-1 w-full px-4 py-2 border rounded">
            </div>
          </div>
          <button class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Change Password
            
          </button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>