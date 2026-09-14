@extends('layouts.dashboard')

@section('title', 'Admin Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Admin & Moderasi Platform</h1>
        <p class="text-sm text-gray-500">Ringkasan aktivitas platform, pengguna, pekerjaan, dan moderasi konten.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Total Pengguna</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_users'] }}</p>
            <p class="text-[11px] text-gray-400 mt-1">{{ $stats['total_talents'] }} Talenta &bull; {{ $stats['total_clients'] }} Klien</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Total Lowongan</p>
            <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $stats['total_jobs'] }}</p>
            <p class="text-[11px] text-gray-400 mt-1">{{ $stats['total_applications'] }} Lamaran Masuk</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Proyek Berjalan</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['active_projects'] }}</p>
            <p class="text-[11px] text-green-600 mt-1">{{ $stats['completed_projects'] }} Selesai</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Laporan Pending</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['pending_reports'] }}</p>
            <a href="{{ route('admin.reports') }}" class="text-[11px] text-indigo-600 hover:underline mt-1 block">Tinjau Laporan &rarr;</a>
        </div>
    </div>

    <!-- Moderation & Management Shortcuts -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ route('admin.users') }}" class="p-4 bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 shadow-xs hover:shadow-sm transition-all text-center">
            <span class="text-sm font-bold text-gray-900 block">Kelola Pengguna</span>
            <span class="text-xs text-gray-400">Suspend & Aktivasi</span>
        </a>
        <a href="{{ route('admin.jobs') }}" class="p-4 bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 shadow-xs hover:shadow-sm transition-all text-center">
            <span class="text-sm font-bold text-gray-900 block">Kelola Lowongan</span>
            <span class="text-xs text-gray-400">Tutup & Moderasi</span>
        </a>
        <a href="{{ route('admin.skills') }}" class="p-4 bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 shadow-xs hover:shadow-sm transition-all text-center">
            <span class="text-sm font-bold text-gray-900 block">Master Keahlian</span>
            <span class="text-xs text-gray-400">CRUD Skills</span>
        </a>
        <a href="{{ route('admin.reports') }}" class="p-4 bg-white rounded-2xl border border-gray-200 hover:border-indigo-300 shadow-xs hover:shadow-sm transition-all text-center">
            <span class="text-sm font-bold text-gray-900 block">Laporan Pelanggaran</span>
            <span class="text-xs text-gray-400">Investigasi & Selesaikan</span>
        </a>
    </div>

    <!-- Recent Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua</a>
            </div>

            <div class="space-y-3">
                @foreach($recentUsers as $u)
                    <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between text-xs">
                        <div>
                            <span class="font-bold text-gray-900 block">{{ $u->name }} ({{ '@' . $u->username }})</span>
                            <span class="text-gray-400">{{ $u->email }} &bull; Role: {{ ucfirst($u->role?->value ?? $u->role) }}</span>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $u->status->value === 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                            {{ ucfirst($u->status->value) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Laporan Menunggu Tindakan</h3>
                <a href="{{ route('admin.reports') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($recentReports->isEmpty())
                <p class="text-xs text-gray-400 py-6 text-center">Tidak ada laporan yang sedang menunggu moderasi. Platform aman!</p>
            @else
                <div class="space-y-3">
                    @foreach($recentReports as $rep)
                        <div class="p-3 rounded-xl bg-red-50/50 border border-red-100 flex items-center justify-between text-xs">
                            <div>
                                <span class="font-bold text-red-900 block">{{ $rep->reason }}</span>
                                <span class="text-gray-500">Tipe: {{ ucfirst($rep->target_type) }} #{{ $rep->target_id }} &bull; Pelapor: {{ $rep->reporter?->name }}</span>
                            </div>
                            <a href="{{ route('admin.reports') }}" class="px-3 py-1 bg-red-600 text-white font-bold rounded-lg text-[10px]">Tindak</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

