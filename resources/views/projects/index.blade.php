@extends('layouts.dashboard')

@section('title', 'Proyek Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Proyek Kolaborasi Saya</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau proyek aktif, deliverable tugas, dan riwayat pekerjaan yang telah selesai.</p>
        </div>
    </div>

    @if($projects->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Proyek Berjalan</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                Proyek otomatis terbentuk saat lamaran talenta disetujui dan diterima oleh pihak klien.
            </p>
            <div class="pt-2">
                @if(Auth::user()->isClient())
                    <a href="{{ route('jobs.my') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">Cek Pelamar Lowonganmu</a>
                @else
                    <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">Cari Lowongan Pekerjaan</a>
                @endif
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($projects as $project)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="space-y-2.5 min-w-0">
                        <div class="flex items-center gap-2">
                            @php
                                $statusBadge = match($project->status->value ?? $project->status) {
                                    'active' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'completed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                    'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-xs font-bold rounded-full border {{ $statusBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ ($project->status->value ?? $project->status) === 'active' ? 'bg-emerald-500' : 'bg-current' }}"></span>
                                {{ ucfirst($project->status->value ?? $project->status) }}
                            </span>
                            <span class="text-xs text-slate-400">Dimulai {{ $project->started_at ? $project->started_at->format('d M Y') : '-' }}</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 truncate transition-colors">
                            <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 flex flex-wrap items-center gap-2">
                            @if(Auth::id() === $project->client_id)
                                <span>Talenta: <strong class="text-slate-800">{{ $project->talent?->name }}</strong></span>
                            @else
                                <span>Klien: <strong class="text-slate-800">{{ $project->client?->name }}</strong></span>
                            @endif
                            <span>&bull;</span>
                            <span>Kompensasi: <strong class="text-indigo-600 font-extrabold">Rp {{ number_format($project->budget, 0, ',', '.') }}</strong></span>
                            @if($project->deadline)
                                <span>&bull;</span>
                                <span>Tenggat: <strong class="text-slate-700">{{ $project->deadline->format('d M Y') }}</strong></span>
                            @endif
                        </p>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press">
                            <span>Kelola Proyek</span>
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
