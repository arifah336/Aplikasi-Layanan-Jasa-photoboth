@extends('layouts.admin')

@section('title', 'Transaksi Donasi')

@section('content')
  <h1 class="text-3xl font-bold mb-6">Data Transaksi Donasi</h1>

  <div class="overflow-x-auto rounded shadow bg-white">
    <table class="table table-zebra w-full text-sm">
      <thead class="bg-[#ffb0c2] text-[#33272a]">
        <tr>
          <th>No</th>
          <th>Nama User</th>
          <th>Email</th>
          <th>Jumlah (Rp)</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($payments as $i => $pay)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ optional($pay->user)->username ?? '-' }}</td>
          <td>{{ $pay->user->email ?? '-' }}</td>
          <td>Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($pay->payment_date)->format('d M Y') }}</td>
          <td>
            <form action="{{ route('admin.transactions.delete', $pay->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-error text-white">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection