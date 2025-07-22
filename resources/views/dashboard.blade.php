@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

  <!-- ✅ Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="card bg-base-100 shadow-md">
      <div class="card-body">
        <h2 class="card-title">Total Transaksi</h2>
        <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
      </div>
    </div>
    <div class="card bg-base-100 shadow-md">
      <div class="card-body">
        <h2 class="card-title">Total Revenue</h2>
        <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
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
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
          <h3 class="text-sm text-gray-500">Total Transactions</h3>
          <p class="text-2xl font-bold">1,245</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
          <h3 class="text-sm text-gray-500">Total Revenue</h3>
          <p class="text-2xl font-bold">Rp123.456.789</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
          <h3 class="text-sm text-gray-500">Active Customers</h3>
          <p class="text-2xl font-bold">560</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
          <h3 class="text-sm text-gray-500">Failed Payments</h3>
          <p class="text-2xl font-bold text-red-500">32</p>
        </div>
      </div>

  <!-- ✅ Chart Donasi -->
  <div class="card bg-base-100 shadow-md mt-6">
    <div class="card-body">
      <h2 class="card-title">Donasi 7 Hari Terakhir</h2>
      <canvas id="donationChart" height="100"></canvas>
    </div>
  </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('activityChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($chartData->pluck('date')) !!},
      datasets: [{
        label: 'Jumlah Foto',
        data: {!! json_encode($chartData->pluck('total')) !!},
        backgroundColor: '#f472b6',
        borderColor: '#ec4899',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  const donationCtx = document.getElementById('donationChart').getContext('2d');
  new Chart(donationCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode($weeklyDonations->pluck('date')) !!},
      datasets: [{
        label: 'Total Donasi (Rp)',
        data: {!! json_encode($weeklyDonations->pluck('total')) !!},
        fill: false,
        borderColor: '#10b981',
        backgroundColor: '#6ee7b7',
        tension: 0.2
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>
@endpush