@extends('layouts.dashboard')

@section('title', 'Client Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl p-6 sm:p-9 text-white shadow-xl shadow-slate-900/10 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-400/25">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    Portal Pemberi Kerja
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">Selamat Datang, {{ $user->company_name ?? $user->name }}!</h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                    Kelola lowongan pekerjaan, evaluasi kandidat mahasiswa bertalenta tinggi, dan pantau proyek kolaborasimu secara transparan.
                </p>
            </div>
            
            <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-indigo-600/30 transition-all btn-press shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                + Pasang Lowongan Baru
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Lowongan</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $jobs->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pelamar Masuk</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $recentApplications->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Proyek Berjalan</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $activeProjects->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Proyek Selesai</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $completedProjects }}</p>
            </div>
        </div>
    </div>

    <!-- Active Jobs & Applications Table Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Client's Jobs -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">Lowongan Pekerjaan Anda</h3>
                <a href="{{ route('jobs.my') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($jobs->isEmpty())
                <div class="py-10 text-center text-slate-400 text-xs">
                    <p class="mb-3">Anda belum membuat lowongan pekerjaan.</p>
                    <a href="{{ route('jobs.create') }}" class="text-xs font-bold text-indigo-600 hover:underline">+ Pasang Lowongan Pertama</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($jobs as $job)
                        <div class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $job->title }}</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ $job->applications_count }} Pelamar &bull; <span class="capitalize text-emerald-600 font-semibold">{{ $job->status->value }}</span></p>
                            </div>
                            <a href="{{ route('applications.job', $job->id) }}" class="shrink-0 px-3.5 py-1.5 text-xs font-bold rounded-xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 border border-indigo-200/80 transition-colors">
                                Kelola Pelamar
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Incoming Applications -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">Pelamar Masuk Terbaru</h3>
                <a href="{{ route('applications.client') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($recentApplications->isEmpty())
                <div class="py-10 text-center text-slate-400 text-xs">
                    Belum ada pelamar baru yang mendaftar.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentApplications as $app)
                        <div class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $app->talent?->name }}</h4>
                                <p class="text-[11px] text-slate-500 truncate mt-0.5">Melamar: {{ $app->jobListing?->title }}</p>
                            </div>
                            <a href="{{ route('applications.job', $app->job_listing_id) }}" class="shrink-0 px-3.5 py-1.5 text-xs font-bold rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white shadow-xs transition-all">
                                Tinjau
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Active Ongoing Projects -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="font-bold text-slate-900 text-sm">Proyek Kolaborasi yang Sedang Berjalan</h3>
            <a href="{{ route('projects.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua Proyek</a>
        </div>

        @if($activeProjects->isEmpty())
            <div class="py-10 text-center text-slate-400 text-xs">
                Belum ada proyek aktif. Ketika Anda menyetujui proposal talenta, kontrak proyek akan otomatis muncul di sini.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($activeProjects as $project)
                    <div class="p-4 rounded-2xl border border-slate-200/80 bg-slate-50/50 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $project->title }}</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-blue-50 text-blue-700 border border-blue-200">Aktif</span>
                            </div>
                            <p class="text-xs text-slate-500 mb-2">Talenta: <span class="font-bold text-slate-800">{{ $project->talent?->name }}</span></p>
                            <p class="text-xs font-bold text-indigo-600">Budget: Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
                        </div>
                        <div class="pt-3 mt-3 border-t border-slate-200/60 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400">Dimulai {{ $project->started_at?->diffForHumans() }}</span>
                            <a href="{{ route('projects.show', $project->id) }}" class="text-xs font-bold text-indigo-600 hover:underline">Kelola &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
