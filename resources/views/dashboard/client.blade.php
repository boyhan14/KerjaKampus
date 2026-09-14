@extends('layouts.dashboard')

@section('title', 'Client Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/30 text-indigo-200 border border-indigo-400/30">
                    Klien & Perusahaan
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang, {{ $user->company_name ?? $user->name }}!</h1>
                <p class="text-gray-300 text-sm sm:text-base max-w-xl">
                    Kelola lowongan pekerjaan, tinjau lamaran talenta mahasiswa terbaik, dan pantau proyek kolaborasimu di sini.
                </p>
            </div>
            
            <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition-all shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Lowongan Baru
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Lowongan Aktif</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $jobs->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Pelamar Masuk</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $recentApplications->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Proyek Berjalan</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $activeProjects->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Proyek Selesai</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $completedProjects }}</p>
            </div>
        </div>
    </div>

    <!-- Active Jobs & Applications Table Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Client's Jobs -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Lowongan Pekerjaan Anda</h3>
                <a href="{{ route('jobs.my') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($jobs->isEmpty())
                <div class="py-8 text-center text-gray-400 text-sm">
                    <p class="mb-3">Anda belum membuat lowongan pekerjaan.</p>
                    <a href="{{ route('jobs.create') }}" class="text-xs font-semibold text-indigo-600 hover:underline">+ Buat Lowongan Pertama</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($jobs as $job)
                        <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $job->title }}</h4>
                                <p class="text-xs text-gray-500">{{ $job->applications_count }} Pelamar &bull; {{ ucfirst($job->status->value) }}</p>
                            </div>
                            <a href="{{ route('applications.job', $job->id) }}" class="shrink-0 px-3 py-1.5 text-xs font-semibold rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 border border-indigo-200">
                                Kelola Pelamar
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Incoming Applications -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Pelamar Masuk Terbaru</h3>
            </div>

            @if($recentApplications->isEmpty())
                <div class="py-8 text-center text-gray-400 text-sm">
                    Belum ada pelamar baru yang mendaftar.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentApplications as $app)
                        <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $app->talent?->name }}</h4>
                                <p class="text-xs text-gray-500 truncate">Melamar: {{ $app->jobListing?->title }}</p>
                            </div>
                            <a href="{{ route('applications.job', $app->job_listing_id) }}" class="shrink-0 px-3 py-1.5 text-xs font-semibold rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                Tinjau
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Active Ongoing Projects -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <h3 class="font-bold text-gray-900">Proyek Kolaborasi yang Sedang Berjalan</h3>
            <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua Proyek</a>
        </div>

        @if($activeProjects->isEmpty())
            <div class="py-8 text-center text-gray-400 text-sm">
                Belum ada proyek aktif. Ketika Anda menerima lamaran talenta, proyek akan otomatis dibuat di sini.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($activeProjects as $project)
                    <div class="p-4 rounded-xl border border-gray-200 bg-white shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $project->title }}</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-blue-50 text-blue-700 border border-blue-200">Aktif</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">Talenta: <span class="font-semibold text-gray-700">{{ $project->talent?->name }}</span></p>
                            <p class="text-xs font-semibold text-gray-900">Budget: Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
                        </div>
                        <div class="pt-3 mt-3 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400">Dimulai {{ $project->started_at?->diffForHumans() }}</span>
                            <a href="{{ route('projects.show', $project->id) }}" class="text-xs font-bold text-indigo-600 hover:underline">Kelola &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
