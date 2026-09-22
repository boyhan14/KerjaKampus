@extends('layouts.dashboard')

@section('title', 'Semua Pelamar Masuk - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Kandidat Pelamar Masuk</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Evaluasi proposal pelamar dari seluruh lowongan pekerjaan yang Anda buat.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors inline-flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kelola per Lowongan</span>
        </a>
    </div>

    <!-- Status Tabs -->
    @if(isset($counts))
        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-slate-100/80 rounded-2xl border border-slate-200/60 text-xs font-bold">
            <a href="{{ route('applications.client') }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ !request('status') ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Semua</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ !request('status') ? 'bg-indigo-50 text-indigo-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['all'] ?? 0 }}</span>
            </a>
            <a href="{{ route('applications.client', ['status' => 'pending']) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-white text-amber-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                <span>Perlu Direview</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['pending'] ?? 0 }}</span>
            </a>
            <a href="{{ route('applications.client', ['status' => 'shortlisted']) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'shortlisted' ? 'bg-white text-blue-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                <span>Shortlist</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'shortlisted' ? 'bg-blue-50 text-blue-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['shortlisted'] ?? 0 }}</span>
            </a>
            <a href="{{ route('applications.client', ['status' => 'accepted']) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'accepted' ? 'bg-white text-emerald-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Diterima</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'accepted' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['accepted'] ?? 0 }}</span>
            </a>
            <a href="{{ route('applications.client', ['status' => 'rejected']) }}" 
               class="px-3.5 py-2 rounded-xl transition-all flex items-center gap-1.5 {{ request('status') === 'rejected' ? 'bg-white text-rose-600 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Ditolak</span>
                <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ request('status') === 'rejected' ? 'bg-rose-50 text-rose-700' : 'bg-slate-200 text-slate-600' }}">{{ $counts['rejected'] ?? 0 }}</span>
            </a>
        </div>
    @endif

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Pelamar Masuk</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                @if(request('status'))
                    Tidak ada kandidat pelamar pada status filter ini.
                @else
                    Saat talenta mahasiswa melamar ke lowongan Anda, proposal mereka akan ditampilkan di sini.
                @endif
            </p>
            <div class="pt-2">
                @if(request('status'))
                    <a href="{{ route('applications.client') }}" class="inline-block px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors">
                        Reset Filter
                    </a>
                @else
                    <a href="{{ route('jobs.create') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                        + Pasang Lowongan Baru
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4 card-hover transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-black flex items-center justify-center shrink-0 text-lg uppercase shadow-xs">
                                {{ substr($app->talent?->name ?? 'T', 0, 1) }}
                            </div>
                            <div class="space-y-1 min-w-0">
                                <h3 class="font-bold text-slate-900 text-base">
                                    <a href="{{ route('talents.show', $app->talent?->username ?? $app->talent?->id ?? '') }}" target="_blank" class="hover:text-indigo-600 transition-colors">
                                        {{ $app->talent?->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500">
                                    Melamar untuk lowongan: 
                                    <a href="{{ route('jobs.show', $app->jobListing?->slug ?? $app->jobListing?->id) }}" class="font-bold text-indigo-600 hover:underline">
                                        {{ $app->jobListing?->title }}
                                    </a>
                                </p>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                                    @if($app->proposed_price)
                                        <span class="font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-lg">Tawaran: Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</span>
                                    @endif
                                    @if($app->estimated_duration)
                                        <span class="text-slate-700 bg-slate-100 border border-slate-200/60 px-2.5 py-0.5 rounded-lg font-medium">Estimasi Waktu: {{ $app->estimated_duration }}</span>
                                    @endif
                                    <span class="text-slate-400 text-[11px]">Diajukan {{ $app->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Badge -->
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
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full border {{ $statusBadge }} shrink-0 self-start">
                            <span class="w-1.5 h-1.5 rounded-full {{ ($app->status->value ?? $app->status) === 'accepted' ? 'bg-emerald-500 animate-pulse' : 'bg-current' }}"></span>
                            {{ ucfirst($app->status->value ?? $app->status) }}
                        </span>
                    </div>

                    <!-- Cover letter excerpt -->
                    <div class="p-4 sm:p-5 bg-slate-50/80 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Surat Pengantar & Pendekatan:</span>
                        <p class="whitespace-pre-line">{{ $app->cover_letter }}</p>
                    </div>

                    <!-- Action buttons -->
                    @if(in_array($app->status->value ?? $app->status, ['pending', 'shortlisted']))
                        <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-end gap-2">
                            @if(($app->status->value ?? $app->status) === 'pending')
                                <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="shortlist">
                                    <button type="submit" class="px-3.5 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-xl text-xs font-bold border border-blue-200 transition-colors">
                                        Shortlist Kandidat
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="reject">
                                <button type="submit" class="px-3.5 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl border border-rose-200 transition-colors" onclick="return confirm('Tolak lamaran ini?');">
                                    Tolak
                                </button>
                            </form>

                            <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-xl text-xs font-bold shadow-xs transition-all btn-press" onclick="return confirm('Terima pelamar ini? Kontrak proyek kolaborasi baru akan otomatis dibuat.');">
                                    Terima & Buat Proyek
                                </button>
                            </form>
                        </div>
                    @elseif(($app->status->value ?? $app->status) === 'accepted' && $app->project)
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                            <a href="{{ route('projects.show', $app->project->id) }}" class="inline-flex items-center gap-1.5 px-5 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white rounded-xl text-xs font-bold shadow-xs transition-all">
                                <span>Buka Ruang Proyek</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
