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
    </div>
  </div>

  <!-- ✅ Pesan dari User -->
  <div class="card bg-base-100 shadow-md mt-6">
    <div class="card-body">
      <h2 class="card-title">Pesan dari User</h2>
      @forelse($messages as $message)
        <div class="border p-3 rounded mb-2">
          <strong>{{ $message->name }} ({{ $message->email }})</strong>
          <p class="text-sm text-gray-600">{{ $message->message }}</p>
        </div>
      @empty
        <p class="text-sm text-gray-500">Belum ada pesan.</p>
      @endforelse
    </div>
  </div>

  <!-- ✅ Chart Upload Foto -->
  <div class="card bg-base-100 shadow-md mt-6">
    <div class="card-body">
      <h2 class="card-title">Aktivitas Upload Foto</h2>
      <canvas id="activityChart" height="100"></canvas>
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