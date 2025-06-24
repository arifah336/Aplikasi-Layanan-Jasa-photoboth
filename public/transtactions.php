<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transactions</title>
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
      <h2 class="text-2xl font-bold mb-6">Recent Transactions</h2>

      <!-- Filters -->
      <div class="flex flex-wrap gap-4 mb-4">
        <select class="border rounded px-3 py-2 text-sm">
          <option>Status</option>
          <option>Success</option>
          <option>Failed</option>
        </select>

        <select class="border rounded px-3 py-2 text-sm">
          <option>Payment Method</option>
          <option>Credit Card</option>
          <option>Bank Transfer</option>
          <option>PayPal</option>
          <option>E-Wallet</option>
        </select>

        <select class="border rounded px-3 py-2 text-sm">
          <option>Date</option>
          <option>Newest</option>
          <option>Oldest</option>
        </select>

        <input type="text" placeholder="Search" class="border rounded px-3 py-2 text-sm w-64">
      </div>

      <!-- Table -->
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left">
          <thead class="border-b bg-gray-100">
            <tr>
              <th class="py-3 px-4 font-semibold">Transaction ID</th>
              <th class="py-3 px-4 font-semibold">Customer</th>
              <th class="py-3 px-4 font-semibold">Date</th>
              <th class="py-3 px-4 font-semibold">Amount</th>
              <th class="py-3 px-4 font-semibold">Status</th>
              <th class="py-3 px-4 font-semibold">Payment Method</th>
              <th class="py-3 px-4 font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <tr>
              <td class="py-3 px-4">0XGBB1ABDK2V</td>
              <td class="py-3 px-4">Anggun</td>
              <td class="py-3 px-4">Apr 12, 1:21 AM</td>
              <td class="py-3 px-4">$45.00</td>
              <td class="py-3 px-4 text-green-600">Success</td>
              <td class="py-3 px-4">Qris</td>
              <td class="py-3 px-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr>
              <td class="py-3 px-4">8GNWbAFKBCE</td>
              <td class="py-3 px-4">Rifa</td>
              <td class="py-3 px-4">Apr 13, 1:36 AM</td>
              <td class="py-3 px-4">$95.00</td>
              <td class="py-3 px-4 text-red-500">Failed</td>
              <td class="py-3 px-4">Qris</td>
              <td class="py-3 px-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr>
              <td class="py-3 px-4">ECNZKADSGBEF</td>
              <td class="py-3 px-4">Raihan</td>
              <td class="py-3 px-4">Jun 23, 3:25 AM</td>
              <td class="py-3 px-4">$85.00</td>
              <td class="py-3 px-4 text-green-600">Success</td>
              <td class="py-3 px-4">Qris</td>
              <td class="py-3 px-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr>
              <td class="py-3 px-4">2D4T1CGAXDKRX</td>
              <td class="py-3 px-4">Mulya</td>
              <td class="py-3 px-4">Apr 23, 3:24 AM</td>
              <td class="py-3 px-4">$159.00</td>
              <td class="py-3 px-4 text-red-500">Failed</td>
              <td class="py-3 px-4">Qris</td>
              <td class="py-3 px-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
            <tr>
              <td class="py-3 px-4">6BDWG3GWA23V</td>
              <td class="py-3 px-4">Salsa</td>
              <td class="py-3 px-4">Apr 23, 1:25 AM</td>
              <td class="py-3 px-4">$185.00</td>
              <td class="py-3 px-4 text-green-600">Success</td>
              <td class="py-3 px-4">Qris</td>
              <td class="py-3 px-4 text-blue-600 hover:underline cursor-pointer">View</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>