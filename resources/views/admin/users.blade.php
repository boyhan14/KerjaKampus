@extends('layouts.dashboard')

@section('title', 'Manajemen Pengguna - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2">
                Direktori Akun
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Cari, filter, serta atur status aktivasi akun talenta dan klien.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center text-xs font-bold text-slate-700">
            Total: {{ $users->total() }} Pengguna
        </div>
    </div>

    <!-- Filter Toolbar -->
    <form action="{{ route('admin.users') }}" method="GET" class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[220px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, username..." 
                class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <select name="role" class="px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <option value="">Semua Role</option>
            <option value="talent" {{ request('role') == 'talent' ? 'selected' : '' }}>Talent (Mahasiswa)</option>
            <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client (Pemberi Kerja)</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <select name="status" class="px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-xs transition-colors">
            Terapkan Filter
        </button>
        <a href="{{ route('admin.users') }}" class="px-4 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-700">Reset</a>
    </form>

    <!-- Users Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/70 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Nama & Kredensial</th>
                        <th class="px-6 py-4">Role Utama</th>
                        <th class="px-6 py-4">Status Akun</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-right">Aksi Moderasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $u)
                        @php 
                            $uRole = $u->role?->value ?? $u->role;
                            $uStatus = $u->status->value ?? $u->status;
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $u->name }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $u->email }} &bull; {{ '@' . $u->username }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[11px] font-black rounded-lg uppercase tracking-wider {{ $uRole === 'admin' ? 'bg-purple-50 text-purple-700' : ($uRole === 'client' ? 'bg-amber-50 text-amber-700' : 'bg-indigo-50 text-indigo-700') }}">
                                    {{ $uRole }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[11px] font-black rounded-lg uppercase tracking-wider {{ $uStatus === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-rose-50 text-rose-700 border border-rose-200/60' }}">
                                    {{ ucfirst($uStatus) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $u->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        @if($uStatus === 'active')
                                            <input type="hidden" name="status" value="suspended">
                                            <button type="submit" class="px-3.5 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-xl text-xs font-bold border border-rose-200/60 transition-colors" onclick="return confirm('Suspend akun {{ $u->name }}? Pengguna ini tidak akan bisa login.');">
                                                Suspend
                                            </button>
                                        @else
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="px-3.5 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-xl text-xs font-bold border border-emerald-200/60 transition-colors">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-xl">Akun Anda</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-xs sm:text-sm">
                                Tidak ada pengguna yang cocok dengan kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 sm:p-6 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
