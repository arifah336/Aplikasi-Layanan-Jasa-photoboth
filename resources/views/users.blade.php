@extends('layouts.admin')

@section('title', 'Data Akun Admin/User')

@section('content')

<h1 class="text-3xl font-bold mb-6">Data Akun</h1>

<div class="overflow-x-auto bg-white rounded shadow">
  <table class="table table-zebra w-full text-sm">
    <thead class="bg-[#ffb0c2] text-[#33272a]">
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Dibuat Pada</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $i => $user)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>        
        <td>
          @if(auth()->id() !== $user->id)
          <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-xs btn-error text-white">Hapus</button>
          </form>
          @else
          <span class="text-xs text-gray-400 italic">Tidak bisa hapus diri sendiri</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection