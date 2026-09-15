@extends('layouts.dashboard')

@section('title', 'Admin Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                Pusat Kontrol Sistem
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Admin & Moderasi Platform</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Ringkasan aktivitas platform, metrik pengguna, pekerjaan, dan moderasi konten.</p>
        </div>
        <div class="text-xs font-bold text-slate-500 bg-white px-4 py-2.5 rounded-2xl border border-slate-200/80 shadow-xs self-start sm:self-center">
            Status: <span class="text-emerald-600 font-black">Online & Stabil</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Stat 1: Pengguna -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total Pengguna</span>
                <span class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </span>
            </div>
            <p class="text-3xl font-black text-slate-900 mt-2">{{ $stats['total_users'] }}</p>
            <div class="mt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                <span class="text-indigo-600 font-bold">{{ $stats['total_talents'] }}</span> Talenta &bull; 
                <span class="text-purple-600 font-bold">{{ $stats['total_clients'] }}</span> Klien
            </div>
        </div>

        <!-- Stat 2: Lowongan -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">Lowongan Kerja</span>
                <span class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
            </div>
            <p class="text-3xl font-black text-indigo-600 mt-2">{{ $stats['total_jobs'] }}</p>
            <div class="mt-2 text-[11px] font-semibold text-slate-500">
                <span class="text-indigo-600 font-bold">{{ $stats['total_applications'] }}</span> Total Lamaran Masuk
            </div>
        </div>

        <!-- Stat 3: Proyek -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">Proyek Berjalan</span>
                <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="text-3xl font-black text-emerald-600 mt-2">{{ $stats['active_projects'] }}</p>
            <div class="mt-2 text-[11px] font-semibold text-slate-500">
                <span class="text-emerald-600 font-bold">{{ $stats['completed_projects'] }}</span> Berhasil Selesai
            </div>
        </div>

        <!-- Stat 4: Laporan -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">Laporan Aduan</span>
                <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </span>
            </div>
            <p class="text-3xl font-black text-rose-600 mt-2">{{ $stats['pending_reports'] }}</p>
            <a href="{{ route('admin.reports') }}" class="mt-2 inline-flex items-center gap-1 text-[11px] font-bold text-indigo-600 hover:text-indigo-700">
                Tinjau & Moderasi &rarr;
            </a>
        </div>
    </div>

    <!-- Quick Navigation Shortcuts -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ route('admin.users') }}" class="p-5 bg-white rounded-3xl border border-slate-200/80 hover:border-indigo-400 shadow-xs hover:shadow-md transition-all group">
            <span class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </span>
            <span class="text-sm font-black text-slate-900 block group-hover:text-indigo-600 transition-colors">Kelola Pengguna</span>
            <span class="text-xs text-slate-400 mt-0.5 block">Suspend, aktifkan, dan edit role</span>
        </a>

        <a href="{{ route('admin.jobs') }}" class="p-5 bg-white rounded-3xl border border-slate-200/80 hover:border-indigo-400 shadow-xs hover:shadow-md transition-all group">
            <span class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </span>
            <span class="text-sm font-black text-slate-900 block group-hover:text-indigo-600 transition-colors">Kelola Lowongan</span>
            <span class="text-xs text-slate-400 mt-0.5 block">Moderasi konten lowongan publik</span>
        </a>

        <a href="{{ route('admin.skills') }}" class="p-5 bg-white rounded-3xl border border-slate-200/80 hover:border-indigo-400 shadow-xs hover:shadow-md transition-all group">
            <span class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </span>
            <span class="text-sm font-black text-slate-900 block group-hover:text-indigo-600 transition-colors">Master Keahlian</span>
            <span class="text-xs text-slate-400 mt-0.5 block">Manajemen tag skill dan kategori</span>
        </a>

        <a href="{{ route('admin.reports') }}" class="p-5 bg-white rounded-3xl border border-slate-200/80 hover:border-indigo-400 shadow-xs hover:shadow-md transition-all group">
            <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </span>
            <span class="text-sm font-black text-slate-900 block group-hover:text-indigo-600 transition-colors">Pusat Laporan</span>
            <span class="text-xs text-slate-400 mt-0.5 block">Investigasi dan tindak kecurangan</span>
        </a>
    </div>

    <!-- Recent Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                    <h3 class="font-black text-slate-900 text-base">Pengguna Terbaru</h3>
                </div>
                <a href="{{ route('admin.users') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="space-y-3">
                @foreach($recentUsers as $u)
                    <div class="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-100 flex items-center justify-between text-xs hover:bg-slate-50 transition-colors">
                        <div class="min-w-0">
                            <span class="font-bold text-slate-900 block truncate">{{ $u->name }} <span class="text-slate-400 font-normal">({{ '@' . $u->username }})</span></span>
                            <span class="text-slate-400 text-[11px]">{{ $u->email }} &bull; Role: {{ ucfirst($u->role?->value ?? $u->role) }}</span>
                        </div>
                        <span class="px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider shrink-0 {{ ($u->status->value ?? $u->status) === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-rose-50 text-rose-700 border border-rose-200/60' }}">
                            {{ ucfirst($u->status->value ?? $u->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-600"></span>
                    <h3 class="font-black text-slate-900 text-base">Laporan Menunggu Tindakan</h3>
                </div>
                <a href="{{ route('admin.reports') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua &rarr;</a>
            </div>

            @if($recentReports->isEmpty())
                <div class="py-12 text-center text-slate-400 text-xs">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    Tidak ada aduan yang menunggu moderasi. Platform aman!
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentReports as $rep)
                        <div class="p-3.5 rounded-2xl bg-rose-50/40 border border-rose-100 flex items-center justify-between text-xs gap-3">
                            <div class="min-w-0">
                                <span class="font-bold text-rose-900 block truncate">{{ $rep->reason }}</span>
                                <span class="text-slate-500 text-[11px]">Tipe: {{ ucfirst($rep->target_type) }} #{{ $rep->target_id }} &bull; Pelapor: {{ $rep->reporter?->name }}</span>
                            </div>
                            <a href="{{ route('admin.reports') }}" class="px-3.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-[11px] shadow-xs shrink-0 transition-colors">
                                Tindak
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
