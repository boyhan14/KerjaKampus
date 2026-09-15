@extends('layouts.dashboard')

@section('title', 'Lamaran Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Riwayat Lamaran Proyek</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau status proposal dan lamaran yang telah Anda kirimkan ke berbagai lowongan.</p>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Kamu Belum Melamar Proyek Apa Pun</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">Jelajahi puluhan peluang gig, proyek freelance, dan magang yang sesuai dengan skillmu sekarang.</p>
            <div class="pt-2">
                <a href="{{ route('jobs.index') }}" class="inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                    Cari Lowongan Proyek
                </a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="space-y-2.5 min-w-0">
                        <div class="flex items-center gap-2">
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
                                <span class="w-1.5 h-1.5 rounded-full {{ in_array(($app->status->value ?? $app->status), ['pending', 'shortlisted']) ? 'bg-amber-500' : ( ($app->status->value ?? $app->status) === 'accepted' ? 'bg-emerald-500' : 'bg-current' ) }}"></span>
                                {{ ucfirst($app->status->value ?? $app->status) }}
                            </span>
                            <span class="text-xs text-slate-400">Diajukan {{ $app->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 truncate transition-colors">
                            <a href="{{ route('jobs.show', $app->jobListing?->slug) }}">{{ $app->jobListing?->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 flex flex-wrap items-center gap-2">
                            <span>Klien: <strong class="text-slate-700">{{ $app->jobListing?->client?->name }}</strong></span>
                            @if($app->proposed_price)
                                <span>&bull;</span>
                                <span>Tawaran: <strong class="text-indigo-600">Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</strong></span>
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
                            <a href="{{ route('projects.show', $app->project->id) }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-xs transition-colors">
                                Buka Proyek &rarr;
                            </a>
                        @endif

                        @if(in_array($app->status->value ?? $app->status, ['pending', 'shortlisted']))
                            <form action="{{ route('applications.withdraw', $app->id) }}" method="POST" onsubmit="return confirm('Tarik kembali lamaran ini?');">
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
