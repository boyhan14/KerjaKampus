@extends('layouts.dashboard')

@section('title', $project->title . ' - Detail Proyek KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ reviewModal: false }">
    <!-- Top Nav / Back -->
    <div class="flex items-center justify-between">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Proyek</span>
        </a>
        
        @php
            $statusBadge = match($project->status->value ?? $project->status) {
                'active' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'completed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                default => 'bg-slate-100 text-slate-700 border-slate-200',
            };
        @endphp
        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full border {{ $statusBadge }}">
            <span class="w-1.5 h-1.5 rounded-full {{ ($project->status->value ?? $project->status) === 'active' ? 'bg-emerald-500 animate-pulse' : 'bg-current' }}"></span>
            Status: {{ ucfirst($project->status->value ?? $project->status) }}
        </span>
    </div>

    <!-- Main Project Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-9 space-y-8 shadow-xs">
        <div class="space-y-2 pb-6 border-b border-slate-100">
            <div class="flex items-center gap-2 text-xs text-indigo-600 font-bold uppercase tracking-wider">
                <span>Kontrak Kerja Kolaborasi</span>
                @if(Auth::user()->isAdmin())
                    <span class="px-2 py-0.5 rounded bg-purple-50 text-purple-700 border border-purple-200 text-[10px]">Tampilan Admin</span>
                @endif
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">{{ $project->title }}</h1>
            <p class="text-xs text-slate-400">
                Dimulai sejak {{ $project->started_at ? $project->started_at->format('d F Y') : '-' }}
                @if($project->completed_at)
                    &bull; Selesai pada {{ $project->completed_at->format('d F Y') }}
                @endif
            </p>
        </div>

        <!-- Participants info cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Client Card -->
            <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 font-black flex items-center justify-center text-lg uppercase shrink-0 shadow-xs">
                    {{ substr($project->client?->name ?? 'C', 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pemberi Kerja (Klien)</span>
                    <h4 class="font-bold text-slate-900 text-sm truncate">{{ $project->client?->name }}</h4>
                    <p class="text-xs text-slate-500 truncate">{{ $project->client?->company_name ?? ($project->client?->location ?? 'Indonesia') }}</p>
                    @if($project->client?->email)
                        <a href="mailto:{{ $project->client->email }}" class="text-[11px] text-indigo-600 hover:underline block truncate mt-0.5">{{ $project->client->email }}</a>
                    @endif
                </div>
            </div>

            <!-- Talent Card -->
            <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-violet-100 text-violet-700 font-black flex items-center justify-center text-lg uppercase shrink-0 shadow-xs">
                    {{ substr($project->talent?->name ?? 'T', 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pelaksana (Talenta)</span>
                    <h4 class="font-bold text-slate-900 text-sm truncate">
                        <a href="{{ route('talents.show', $project->talent?->username ?? $project->talent?->id) }}" class="hover:text-indigo-600 hover:underline">
                            {{ $project->talent?->name }}
                        </a>
                    </h4>
                    <p class="text-xs text-slate-500 truncate">{{ $project->talent?->education ?? ($project->talent?->location ?? 'Indonesia') }}</p>
                    @if($project->talent?->email)
                        <a href="mailto:{{ $project->talent->email }}" class="text-[11px] text-indigo-600 hover:underline block truncate mt-0.5">{{ $project->talent->email }}</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Budget & Deadline Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-5 rounded-2xl bg-indigo-50/40 border border-indigo-100/60 text-xs">
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block mb-1">Nilai Kontrak</span>
                <span class="text-base font-black text-indigo-700">Rp {{ number_format($project->budget, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block mb-1">Target Batas Waktu</span>
                <span class="text-sm font-bold text-slate-800">{{ $project->deadline ? $project->deadline->format('d M Y') : 'Fleksibel' }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block mb-1">Lowongan Rujukan</span>
                @if($project->jobListing)
                    <a href="{{ route('jobs.show', $project->jobListing->slug) }}" class="text-xs font-bold text-indigo-600 hover:underline truncate block">
                        {{ $project->jobListing->title }} &rarr;
                    </a>
                @else
                    <span class="text-slate-400">Pekerjaan Mandiri</span>
                @endif
            </div>
        </div>

        <!-- Description / Brief -->
        @if($project->description)
            <div class="space-y-2">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Brief / Ruang Lingkup Kontrak</h3>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $project->description }}
                </div>
            </div>
        @endif

        <!-- Action Controls -->
        @if(($project->status->value ?? $project->status) === 'active')
            <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <form action="{{ route('projects.complete', $project->id) }}" method="POST" onsubmit="return confirm('Tandai proyek ini sebagai selesai? Setelah selesai, Anda dapat saling memberikan ulasan dan rating.');">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold rounded-2xl shadow-sm flex items-center gap-2 transition-all btn-press">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Tandai Proyek Selesai</span>
                    </button>
                </form>

                <form action="{{ route('projects.cancel', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan kontrak proyek ini? Tindakan ini tidak dapat diurungkan.');">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl border border-rose-200 transition-colors">
                        Batalkan Proyek
                    </button>
                </form>
            </div>
        @endif

        <!-- Reviews Section when Completed -->
        @if(($project->status->value ?? $project->status) === 'completed')
            <div class="pt-6 border-t border-slate-100 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-base">Ulasan & Rating Proyek</h3>
                        <p class="text-xs text-slate-400">Feedback performa hasil kolaborasi kedua belah pihak.</p>
                    </div>
                    
                    @php
                        $hasReviewed = $project->reviews->where('reviewer_id', Auth::id())->isNotEmpty();
                    @endphp

                    @if(!$hasReviewed && !Auth::user()->isAdmin())
                        <button @click="reviewModal = true" class="px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press">
                            + Tulis Ulasan & Rating
                        </button>
                    @endif
                </div>

                @if($project->reviews->isEmpty())
                    <div class="p-6 text-center bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-xs text-slate-400">Belum ada ulasan untuk proyek ini. Berikan ulasan objektif mengenai kepuasan kerja sama!</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($project->reviews as $review)
                            <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-900 text-xs sm:text-sm">{{ $review->reviewer?->name }}</span>
                                        <span class="text-[10px] text-slate-400">&bull; {{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center text-amber-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                        @endfor
                                        <span class="text-slate-800 font-bold ml-1">{{ $review->rating }}.0</span>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Review Modal -->
    <div x-show="reviewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="reviewModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 space-y-5 shadow-2xl relative border border-slate-200">
            <div>
                <h3 class="text-base font-bold text-slate-900">Beri Ulasan & Rating</h3>
                <p class="text-xs text-slate-500">Berikan penilaian jujur atas performa kerja rekan proyek.</p>
            </div>

            <form action="{{ route('reviews.store', $project->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Rating Bintang (1 - 5)</label>
                    <select name="rating" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                        <option value="5">★★★★★ - 5 (Sempurna & Sangat Profesional)</option>
                        <option value="4">★★★★☆ - 4 (Sangat Bagus & Tepat Waktu)</option>
                        <option value="3">★★★☆☆ - 3 (Cukup Memuaskan)</option>
                        <option value="2">★★☆☆☆ - 2 (Perlu Peningkatan)</option>
                        <option value="1">★☆☆☆☆ - 1 (Kurang Memuaskan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ulasan / Komentar</label>
                    <textarea name="comment" rows="4" required placeholder="Ceritakan bagaimana komunikasi, ketepatan waktu, dan kualitas hasil kerja..." class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="reviewModal = false" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
