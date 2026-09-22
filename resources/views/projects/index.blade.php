@extends('layouts.dashboard')

@section('title', 'Proyek Kolaborasi - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Proyek Kolaborasi Saya</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau proyek berjalan, deliverable pekerjaan, dan riwayat penyelesaian kontrak.</p>
        </div>
        <div class="flex items-center gap-2">
            @if(Auth::user()->isClient())
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Pasang Lowongan Baru</span>
                </a>
            @else
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Cari Lowongan Proyek</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Status Tabs -->
        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-slate-100/80 rounded-2xl border border-slate-200/60 text-xs font-bold">
            <a href="{{ route('projects.index', array_filter(['search' => request('search')])) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ !request('status') ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Semua</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ !request('status') ? 'bg-indigo-50 text-indigo-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['all'] ?? 0 }}</span>
            </a>
            <a href="{{ route('projects.index', array_filter(['status' => 'active', 'search' => request('search')])) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'active' ? 'bg-white text-emerald-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Aktif</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['active'] ?? 0 }}</span>
            </a>
            <a href="{{ route('projects.index', array_filter(['status' => 'completed', 'search' => request('search')])) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'completed' ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Selesai</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'completed' ? 'bg-indigo-50 text-indigo-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['completed'] ?? 0 }}</span>
            </a>
            <a href="{{ route('projects.index', array_filter(['status' => 'cancelled', 'search' => request('search')])) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'cancelled' ? 'bg-white text-rose-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Dibatalkan</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'cancelled' ? 'bg-rose-50 text-rose-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['cancelled'] ?? 0 }}</span>
            </a>
        </div>

        <!-- Search Input -->
        <form action="{{ route('projects.index') }}" method="GET" class="relative flex-1 md:max-w-xs">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul proyek..." 
                   class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all shadow-xs">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
    </div>

    @if($projects->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Tidak Ada Proyek Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                @if(request('status') || request('search'))
                    Tidak ada proyek yang sesuai dengan kriteria filter saat ini.
                @else
                    Proyek otomatis terbentuk saat lamaran talenta diterima oleh klien.
                @endif
            </p>
            <div class="pt-2">
                @if(request('status') || request('search'))
                    <a href="{{ route('projects.index') }}" class="inline-block px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors">
                        Reset Filter
                    </a>
                @elseif(Auth::user()->isClient())
                    <a href="{{ route('jobs.my') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">Cek Pelamar Lowongan</a>
                @else
                    <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">Cari Lowongan</a>
                @endif
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($projects as $project)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col md:flex-row md:items-center justify-between gap-5 transition-all">
                    <div class="space-y-2.5 min-w-0 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            @php
                                $statusBadge = match($project->status->value ?? $project->status) {
                                    'active' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'completed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                    'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-xs font-bold rounded-full border {{ $statusBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ ($project->status->value ?? $project->status) === 'active' ? 'bg-emerald-500 animate-pulse' : 'bg-current' }}"></span>
                                {{ ucfirst($project->status->value ?? $project->status) }}
                            </span>
                            <span class="text-xs text-slate-400">Dimulai {{ $project->started_at ? $project->started_at->format('d M Y') : '-' }}</span>
                            @if($project->completed_at)
                                <span class="text-xs text-slate-400">&bull; Selesai {{ $project->completed_at->format('d M Y') }}</span>
                            @endif
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 truncate transition-colors">
                            <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                        </h3>

                        <div class="text-xs text-slate-500 flex flex-wrap items-center gap-2">
                            @if(Auth::user()->isAdmin())
                                <span>Klien: <strong class="text-slate-800">{{ $project->client?->name }}</strong></span>
                                <span>&bull;</span>
                                <span>Talenta: <strong class="text-slate-800">{{ $project->talent?->name }}</strong></span>
                            @elseif(Auth::id() === $project->client_id)
                                <span>Talenta: <strong class="text-slate-800">{{ $project->talent?->name }}</strong></span>
                            @else
                                <span>Klien: <strong class="text-slate-800">{{ $project->client?->name }}</strong></span>
                            @endif
                            <span>&bull;</span>
                            <span>Nilai Kontrak: <strong class="text-indigo-600 font-extrabold">Rp {{ number_format($project->budget, 0, ',', '.') }}</strong></span>
                            @if($project->deadline)
                                <span>&bull;</span>
                                <span>Tenggat: <strong class="text-slate-700">{{ $project->deadline->format('d M Y') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press">
                            <span>Kelola Ruang Proyek</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
