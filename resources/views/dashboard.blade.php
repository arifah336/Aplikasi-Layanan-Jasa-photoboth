<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
        <a href="transtactions.blade.php" class="block text-white">Transtactions</a>
        <a href="customers.blade.php" class="block text-white">Customers</a>
        <a href="custome_layout.blade.php" class="block text-white">Custome Layout</a>
        <a href="settings.blade.php" class="block text-white">Settings</a>
        <a href="login.blade.php" class="block text-white text-red-400 mt-10 hover:text-red-600">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

      <!-- Summary Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-sm text-gray-500">Total Transactions</h3>
        <p class="text-2xl font-bold">{{ $totalTransactions }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-sm text-gray-500">Total Revenue</h3>
        <p class="text-2xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Recent Activity diganti dengan Chart -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Transaction Statistics</h3>
    <canvas id="transactionChart" height="100"></canvas>
</div>

<!-- Tambahkan script untuk chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('transactionChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Transactions',
                data: @json(array_values($transactionsData)),
                backgroundColor: 'rgba(79, 70, 229, 0.7)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

      <!-- Recent Activity -->
      <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
        <ul class="space-y-3 text-sm text-gray-700">
          <li>✅ Anggun completed a payment - <span class="text-gray-400">2 minutes ago</span></li>
          <li>❌ Rifa payment failed - <span class="text-gray-400">10 minutes ago</span></li>
          <li>✅ Raihan booked a photobooth - <span class="text-gray-400">1 hour ago</span></li>
          <li>🔔 System generated a monthly report - <span class="text-gray-400">Today, 9:00 AM</span></li>
        </ul>
      </div>
    </main>
  </div>
</body>
</html>