@extends('layouts.dashboard')

@section('title', 'Manajemen Pengguna - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-sm text-gray-500">Cari, filter, dan moderasi akun talenta serta klien platform.</p>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <form action="{{ route('admin.users') }}" method="GET" class="bg-white p-4 rounded-2xl border border-gray-200 flex flex-wrap items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, username..." class="px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none flex-1 min-w-[200px]">

        <select name="role" class="px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none">
            <option value="">Semua Role</option>
            <option value="talent" {{ request('role') == 'talent' ? 'selected' : '' }}>Talent</option>
            <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <select name="status" class="px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl">
            Filter
        </button>
        <a href="{{ route('admin.users') }}" class="px-3 py-2 text-sm text-gray-500 hover:underline">Reset</a>
    </form>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5">Nama & Info</th>
                        <th class="px-6 py-3.5">Role</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Bergabung</th>
                        <th class="px-6 py-3.5 text-right">Aksi Moderasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $u)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $u->name }}</div>
                                <div class="text-xs text-gray-400">{{ $u->email }} &bull; {{ '@' . $u->username }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-md uppercase bg-gray-100 text-gray-700">
                                    {{ $u->role?->value ?? $u->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-md {{ $u->status->value === 'active' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                    {{ ucfirst($u->status->value) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $u->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        @if($u->status->value === 'active')
                                            <input type="hidden" name="status" value="suspended">
                                            <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold border border-red-200" onclick="return confirm('Suspend akun {{ $u->name }}?');">
                                                Suspend
                                            </button>
                                        @else
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="px-3 py-1 bg-green-50 text-green-700 hover:bg-green-100 rounded-lg text-xs font-bold border border-green-200">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400">Akun Anda</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm">Tidak ada pengguna yang cocok dengan pencarian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

