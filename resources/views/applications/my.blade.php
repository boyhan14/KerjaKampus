@extends('layouts.dashboard')

@section('title', 'Lamaran Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Riwayat Lamaran Proyek</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau status seleksi proposal dan penawaran yang telah Anda kirimkan ke berbagai lowongan.</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <span>Eksplor Lowongan Baru</span>
        </a>
    </div>

    <!-- Status Tabs -->
    <div class="flex flex-wrap items-center gap-2 p-1.5 bg-slate-100/80 rounded-2xl border border-slate-200/60 text-xs font-bold">
        <a href="{{ route('applications.my') }}" 
           class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ !request('status') ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
            <span>Semua</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ !request('status') ? 'bg-indigo-50 text-indigo-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['all'] ?? 0 }}</span>
        </a>
        <a href="{{ route('applications.my', ['status' => 'pending']) }}" 
           class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-white text-amber-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
            <span>Menunggu Review</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['pending'] ?? 0 }}</span>
        </a>
        <a href="{{ route('applications.my', ['status' => 'shortlisted']) }}" 
           class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'shortlisted' ? 'bg-white text-blue-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
            <span>Shortlisted</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'shortlisted' ? 'bg-blue-50 text-blue-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['shortlisted'] ?? 0 }}</span>
        </a>
        <a href="{{ route('applications.my', ['status' => 'accepted']) }}" 
           class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'accepted' ? 'bg-white text-emerald-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            <span>Diterima (Proyek)</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'accepted' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['accepted'] ?? 0 }}</span>
        </a>
        <a href="{{ route('applications.my', ['status' => 'rejected']) }}" 
           class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'rejected' ? 'bg-white text-rose-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
            <span>Tidak Terpilih</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'rejected' ? 'bg-rose-50 text-rose-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['rejected'] ?? 0 }}</span>
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Tidak Ada Lamaran Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                @if(request('status'))
                    Tidak ada lamaran pada status ini.
                @else
                    Kamu belum melamar pekerjaan apa pun. Jelajahi lowongan yang sesuai dengan keahlianmu sekarang.
                @endif
            </p>
            <div class="pt-2">
                @if(request('status'))
                    <a href="{{ route('applications.my') }}" class="inline-block px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors">
                        Reset Filter
                    </a>
                @else
                    <a href="{{ route('jobs.index') }}" class="inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                        Cari Lowongan Proyek
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col md:flex-row md:items-center justify-between gap-5 transition-all">
                    <div class="space-y-2.5 min-w-0 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            @php
                                $statusBadge = match($app->status->value ?? $app->status) {
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'shortlisted' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'accepted' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    'withdrawn' => 'bg-slate-100 text-slate-600 border-slate-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-xs font-bold rounded-full border {{ $statusBadge }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ in_array(($app->status->value ?? $app->status), ['pending', 'shortlisted']) ? 'bg-amber-500' : ( ($app->status->value ?? $app->status) === 'accepted' ? 'bg-emerald-500 animate-pulse' : 'bg-current' ) }}"></span>
                                {{ ucfirst($app->status->value ?? $app->status) }}
                            </span>
                            <span class="text-xs text-slate-400">Diajukan {{ $app->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 truncate transition-colors">
                            <a href="{{ route('jobs.show', $app->jobListing?->slug) }}">{{ $app->jobListing?->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 flex flex-wrap items-center gap-2">
                            <span>Klien: <strong class="text-slate-800">{{ $app->jobListing?->client?->name }}</strong></span>
                            @if($app->proposed_price)
                                <span>&bull;</span>
                                <span>Tawaran: <strong class="text-indigo-600 font-extrabold">Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</strong></span>
                            @endif
                            @if($app->estimated_duration)
                                <span>&bull;</span>
                                <span>Estimasi: <strong class="text-slate-700">{{ $app->estimated_duration }}</strong></span>
                            @endif
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2.5 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                        @if(($app->status->value ?? $app->status) === 'accepted' && $app->project)
                            <a href="{{ route('projects.show', $app->project->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press">
                                <span>Buka Ruang Proyek</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @endif

                        @if(in_array($app->status->value ?? $app->status, ['pending', 'shortlisted']))
                            <form action="{{ route('applications.withdraw', $app->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menarik kembali lamaran ini?');">
                                @csrf
                                <button type="submit" class="px-3.5 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl border border-rose-200 transition-colors">
                                    Tarik Lamaran
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('jobs.show', $app->jobListing?->slug) }}" class="px-3.5 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 rounded-xl border border-slate-200 transition-colors">
                            Detail Lowongan
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
