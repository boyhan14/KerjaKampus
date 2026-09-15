@extends('layouts.dashboard')

@section('title', 'Semua Pelamar Masuk - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Kandidat Pelamar Masuk</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Evaluasi proposal pelamar dari seluruh lowongan pekerjaan yang Anda buat.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
            &larr; Kelola per Lowongan
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Pelamar Masuk</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">Saat talenta mahasiswa melamar ke lowongan Anda, proposal mereka akan ditampilkan di sini.</p>
            <div class="pt-2">
                <a href="{{ route('jobs.create') }}" class="inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                    + Pasang Lowongan Baru
                </a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4 card-hover">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 font-black flex items-center justify-center shrink-0 text-lg uppercase shadow-xs">
                                {{ substr($app->talent?->name ?? 'T', 0, 1) }}
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold text-slate-900 text-base">
                                    <a href="{{ route('talents.show', $app->talent?->username ?? $app->talent?->id ?? '') }}" target="_blank" class="hover:text-indigo-600 transition-colors">
                                        {{ $app->talent?->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500">
                                    Melamar untuk: 
                                    <a href="{{ route('jobs.show', $app->jobListing?->slug ?? $app->jobListing?->id) }}" class="font-bold text-indigo-600 hover:underline">
                                        {{ $app->jobListing?->title }}
                                    </a>
                                </p>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                                    @if($app->proposed_price)
                                        <span class="font-bold text-indigo-600 bg-indigo-50/60 border border-indigo-100/80 px-2.5 py-0.5 rounded-lg">Tawaran: Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</span>
                                    @endif
                                    @if($app->estimated_duration)
                                        <span class="text-slate-600 bg-slate-50 border border-slate-200/60 px-2.5 py-0.5 rounded-lg font-medium">Waktu: {{ $app->estimated_duration }}</span>
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
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full border {{ $statusBadge }} shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full {{ ($app->status->value ?? $app->status) === 'accepted' ? 'bg-emerald-500' : 'bg-current' }}"></span>
                            {{ ucfirst($app->status->value ?? $app->status) }}
                        </span>
                    </div>

                    <!-- Cover letter excerpt -->
                    <div class="p-4 sm:p-5 bg-slate-50 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Surat Pengantar & Penawaran:</span>
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
                                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-xs transition-colors btn-press" onclick="return confirm('Terima pelamar ini? Kontrak proyek baru akan otomatis dibuat.');">
                                    Terima & Buat Proyek
                                </button>
                            </form>
                        </div>
                    @elseif(($app->status->value ?? $app->status) === 'accepted' && $app->project)
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                            <a href="{{ route('projects.show', $app->project->id) }}" class="px-5 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white rounded-xl text-xs font-bold shadow-xs transition-all">
                                Buka Ruang Proyek &rarr;
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
