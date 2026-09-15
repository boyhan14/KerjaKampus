@extends('layouts.dashboard')

@section('title', 'Pelamar: ' . $job->title . ' - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-2">
                <a href="{{ route('jobs.my') }}" class="hover:text-indigo-600 transition-colors">&larr; Lowongan Saya</a>
                <span>/</span>
                <span class="text-slate-800 truncate max-w-md font-bold">{{ $job->title }}</span>
            </div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Kandidat Pelamar</h1>
                <span class="px-3 py-1 text-xs font-black rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                    {{ $applications->total() }} Talenta Terdaftar
                </span>
            </div>
        </div>

        <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white border border-slate-200 hover:border-indigo-300 text-xs font-bold text-slate-700 hover:text-indigo-600 shadow-xs transition-all self-start sm:self-center">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Halaman Publik Lowongan
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-16 text-center space-y-4 shadow-xs">
            <div class="w-20 h-20 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900">Belum Ada Pelamar Masuk</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                Lowongan ini belum menerima proposal dari mahasiswa. Bagikan link lowongan ke grup kampus atau media sosial untuk menarik talenta terbaik.
            </p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-300 space-y-5">
                    <!-- Applicant Header Info -->
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex items-start gap-4">
                            @if($app->talent?->avatar)
                                <img src="{{ asset('storage/' . $app->talent->avatar) }}" alt="{{ $app->talent->name }}" class="w-14 h-14 rounded-2xl object-cover border border-slate-200 shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-black flex items-center justify-center shrink-0 text-xl shadow-md shadow-indigo-600/20">
                                    {{ substr($app->talent?->name ?? 'T', 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-black text-slate-900 text-base sm:text-lg">
                                        <a href="{{ route('talents.show', $app->talent?->username ?? '') }}" target="_blank" class="hover:text-indigo-600 transition-colors">
                                            {{ $app->talent?->name }}
                                        </a>
                                    </h3>
                                    <span class="text-xs text-slate-400 font-medium">({{ '@' . ($app->talent?->username ?? 'talent') }})</span>
                                </div>

                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $app->talent?->education ?? 'Mahasiswa' }} &bull; {{ $app->talent?->location ?? 'Indonesia' }}
                                </p>

                                <div class="mt-2.5 flex flex-wrap items-center gap-2 text-xs">
                                    @if($app->proposed_price)
                                        <span class="font-black text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-2.5 py-1 rounded-xl">
                                            Penawaran: Rp {{ number_format($app->proposed_price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    @if($app->estimated_duration)
                                        <span class="font-semibold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-xl">
                                            Estimasi: {{ $app->estimated_duration }}
                                        </span>
                                    @endif
                                    <span class="text-slate-400 text-[11px]">
                                        Melamar {{ $app->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @php
                            $statusVal = $app->status->value ?? $app->status;
                            $statusConfig = match($statusVal) {
                                'pending' => ['bg' => 'bg-amber-50 text-amber-700 border-amber-200', 'label' => 'Menunggu Review'],
                                'shortlisted' => ['bg' => 'bg-sky-50 text-sky-700 border-sky-200', 'label' => 'Disimpan / Shortlist'],
                                'accepted' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'label' => 'Diterima & Kontrak Aktif'],
                                'rejected' => ['bg' => 'bg-rose-50 text-rose-700 border-rose-200', 'label' => 'Tidak Terpilih'],
                                'withdrawn' => ['bg' => 'bg-slate-100 text-slate-600 border-slate-200', 'label' => 'Ditarik oleh Pelamar'],
                                default => ['bg' => 'bg-slate-100 text-slate-700 border-slate-200', 'label' => ucfirst($statusVal)],
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-bold rounded-xl border {{ $statusConfig['bg'] }} self-start">
                            {{ $statusConfig['label'] }}
                        </span>
                    </div>

                    <!-- Cover Letter Box -->
                    <div class="p-4 sm:p-5 bg-slate-50/80 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed">
                        <span class="font-bold text-slate-900 block mb-1.5 text-xs uppercase tracking-wider text-indigo-600">
                            Surat Pengantar & Pendekatan Kerja:
                        </span>
                        <div class="whitespace-pre-line">{{ $app->cover_letter }}</div>
                    </div>

                    <!-- Talent Skills Pills -->
                    @if($app->talent?->skills?->isNotEmpty())
                        <div class="flex flex-wrap items-center gap-1.5 pt-1">
                            <span class="text-xs text-slate-400 mr-1 font-medium">Skill Pelamar:</span>
                            @foreach($app->talent->skills->take(6) as $skill)
                                <span class="px-2.5 py-0.5 text-[11px] font-semibold bg-white text-slate-600 rounded-lg border border-slate-200/80">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Action Bar -->
                    <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <a href="{{ route('talents.show', $app->talent?->username ?? '') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 hover:underline">
                            Lihat Profil & Portofolio Lengkap
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        @if($statusVal === 'accepted')
                            <span class="text-xs font-bold text-emerald-600 flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Kandidat telah diterima & proyek kolaborasi telah dibuat
                            </span>
                        @elseif($statusVal !== 'withdrawn')
                            <div class="flex items-center gap-2">
                                @if($statusVal !== 'shortlisted')
                                    <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="shortlist">
                                        <button type="submit" class="px-3.5 py-2 text-xs font-bold rounded-xl border border-sky-200 text-sky-700 bg-sky-50 hover:bg-sky-100 transition-colors">
                                            Shortlist
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Terima pelamar {{ $app->talent?->name }}? Proyek kolaborasi baru akan otomatis dibuat.');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="accept">
                                    <button type="submit" class="px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white shadow-sm transition-all">
                                        Terima & Mulai Proyek
                                    </button>
                                </form>

                                @if($statusVal !== 'rejected')
                                    <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak lamaran dari {{ $app->talent?->name }}?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="reject">
                                        <button type="submit" class="px-3.5 py-2 text-xs font-bold rounded-xl text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                            Tolak
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="mt-8">
                {{ $applications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
