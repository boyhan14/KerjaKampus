@extends('layouts.dashboard')

@section('title', 'Lowongan Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Lowongan Pekerjaan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola dan pantau seluruh lowongan proyek yang Anda publikasikan.</p>
        </div>
        <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>+ Buat Lowongan Baru</span>
        </a>
    </div>

    @if($jobs->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Lowongan Terpasang</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">Mulai cari mahasiswa dan fresh graduate berbakat dengan memasang lowongan pertama Anda.</p>
            <div class="pt-2">
                <a href="{{ route('jobs.create') }}" class="inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                    Pasang Lowongan Pertama
                </a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($jobs as $job)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="space-y-2.5 min-w-0">
                        <div class="flex items-center gap-2">
                            @php
                                $statusBadge = match($job->status->value ?? $job->status) {
                                    'open' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'closed' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    'draft' => 'bg-slate-100 text-slate-700 border-slate-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-xs font-bold rounded-full border {{ $statusBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ ($job->status->value ?? $job->status) === 'open' ? 'bg-emerald-500' : 'bg-current' }}"></span>
                                {{ ucfirst($job->status->value ?? $job->status) }}
                            </span>
                            <span class="text-xs text-slate-400">Dibuat {{ $job->created_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 truncate transition-colors">
                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>

                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                            <span class="font-extrabold text-indigo-600">Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}</span>
                            <span>&bull;</span>
                            <span class="font-semibold text-slate-700">{{ ucfirst($job->work_mode->value ?? $job->work_mode) }}</span>
                            <span>&bull;</span>
                            <span class="font-bold text-emerald-600">{{ $job->applications_count }} Pelamar</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <a href="{{ route('applications.job', $job->id) }}" class="px-4 py-2.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-bold rounded-xl border border-indigo-200/80 transition-colors">
                            Lihat Pelamar ({{ $job->applications_count }})
                        </a>

                        <a href="{{ route('jobs.edit', $job->id) }}" class="px-3.5 py-2.5 bg-slate-50 text-slate-700 hover:bg-slate-100 text-xs font-bold rounded-xl border border-slate-200 transition-colors">
                            Edit
                        </a>

                        <form action="{{ route('jobs.toggle-status', $job->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3.5 py-2.5 text-xs font-bold rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 transition-colors">
                                {{ ($job->status->value ?? $job->status) === 'open' ? 'Tutup' : 'Buka' }}
                            </button>
                        </form>

                        @if(($job->status->value ?? $job->status) === 'draft' || $job->applications_count == 0)
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus lowongan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 text-xs font-bold rounded-xl text-rose-600 hover:bg-rose-50 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
