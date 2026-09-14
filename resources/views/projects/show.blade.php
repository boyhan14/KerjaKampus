@extends('layouts.dashboard')

@section('title', $project->title . ' - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ reviewModal: false }">
    <div class="flex items-center justify-between">
        <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline flex items-center gap-1">
            &larr; Kembali ke Proyek Saya
        </a>
        
        @php
            $statusBadge = match($project->status->value ?? $project->status) {
                'active' => 'bg-blue-50 text-blue-700 border-blue-200',
                'completed' => 'bg-green-50 text-green-700 border-green-200',
                'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                default => 'bg-gray-100 text-gray-700 border-gray-200',
            };
        @endphp
        <span class="px-3 py-1 text-xs font-bold rounded-lg border {{ $statusBadge }}">
            Status: {{ ucfirst($project->status->value ?? $project->status) }}
        </span>
    </div>

    <!-- Main Project Card -->
    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        <div class="space-y-2 pb-6 border-b border-gray-100">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $project->title }}</h1>
            <p class="text-xs text-gray-500">
                Dimulai sejak {{ $project->started_at ? $project->started_at->format('d F Y') : '-' }}
                @if($project->completed_at)
                    &bull; Selesai pada {{ $project->completed_at->format('d F Y') }}
                @endif
            </p>
        </div>

        <!-- Participants info -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-lg uppercase shrink-0">
                    {{ substr($project->client?->name ?? 'C', 0, 1) }}
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">Klien</span>
                    <h4 class="font-bold text-gray-900 text-sm">{{ $project->client?->name }}</h4>
                    <p class="text-xs text-gray-500">{{ $project->client?->company_name ?? $project->client?->location }}</p>
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-700 font-bold flex items-center justify-center text-lg uppercase shrink-0">
                    {{ substr($project->talent?->name ?? 'T', 0, 1) }}
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">Talenta</span>
                    <h4 class="font-bold text-gray-900 text-sm">
                        <a href="{{ route('talents.show', $project->talent?->username ?? '') }}" class="hover:text-indigo-600 underline">
                            {{ $project->talent?->name }}
                        </a>
                    </h4>
                    <p class="text-xs text-gray-500">{{ $project->talent?->education ?? $project->talent?->location }}</p>
                </div>
            </div>
        </div>

        <!-- Budget & Deadline -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-5 rounded-2xl bg-indigo-50/50 border border-indigo-100 text-xs">
            <div>
                <span class="text-gray-500 block mb-1">Nilai Kontrak / Kompensasi</span>
                <span class="text-base font-extrabold text-indigo-700">Rp {{ number_format($project->budget, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="text-gray-500 block mb-1">Target Batas Waktu</span>
                <span class="text-sm font-bold text-gray-800">{{ $project->deadline ? $project->deadline->format('d M Y') : 'Fleksibel' }}</span>
            </div>
            <div>
                <span class="text-gray-500 block mb-1">Lowongan Asal</span>
                @if($project->jobListing)
                    <a href="{{ route('jobs.show', $project->jobListing->slug) }}" class="text-xs font-bold text-indigo-600 hover:underline truncate block">
                        {{ $project->jobListing->title }} &rarr;
                    </a>
                @else
                    <span class="text-gray-400">Pekerjaan Mandiri</span>
                @endif
            </div>
        </div>

        <!-- Description / Brief -->
        @if($project->description)
            <div class="space-y-2">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Brief / Deskripsi Proyek</h3>
                <div class="p-4 rounded-2xl bg-gray-50 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $project->description }}
                </div>
            </div>
        @endif

        <!-- Actions -->
        @if(($project->status->value ?? $project->status) === 'active')
            <div class="pt-6 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                <form action="{{ route('projects.complete', $project->id) }}" method="POST" onsubmit="return confirm('Tandai proyek ini sebagai selesai? Setelah selesai, Anda dan rekan proyek dapat saling memberikan ulasan.');">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Tandai Proyek Selesai
                    </button>
                </form>

                <form action="{{ route('projects.cancel', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan proyek ini?');">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl border border-red-200">
                        Batalkan Proyek
                    </button>
                </form>
            </div>
        @endif

        <!-- Reviews Section when Completed -->
        @if(($project->status->value ?? $project->status) === 'completed')
            <div class="pt-6 border-t border-gray-100 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base">Ulasan & Rating Proyek</h3>
                    
                    @php
                        $hasReviewed = $project->reviews->where('reviewer_id', Auth::id())->isNotEmpty();
                    @endphp

                    @if(!$hasReviewed)
                        <button @click="reviewModal = true" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs">
                            + Tulis Ulasan
                        </button>
                    @endif
                </div>

                @if($project->reviews->isEmpty())
                    <p class="text-xs text-gray-400 py-4 text-center">Belum ada ulasan untuk proyek ini. Klik tombol di atas untuk memberikan feedback!</p>
                @else
                    <div class="space-y-3">
                        @foreach($project->reviews as $review)
                            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-900 text-xs">{{ $review->reviewer?->name }}</span>
                                        <span class="text-[10px] text-gray-400">&bull; {{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center text-amber-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                        @endfor
                                        <span class="text-gray-700 font-bold ml-1">{{ $review->rating }}.0</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Review Modal -->
    <div x-show="reviewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
        <div @click.away="reviewModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 space-y-5 shadow-2xl relative">
            <h3 class="text-base font-bold text-gray-900">Beri Ulasan & Rating</h3>

            <form action="{{ route('reviews.store', $project->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Rating Bintang (1 - 5)</label>
                    <select name="rating" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="5">★★★★★ - 5 (Sempurna)</option>
                        <option value="4">★★★★☆ - 4 (Sangat Bagus)</option>
                        <option value="3">★★★☆☆ - 3 (Cukup)</option>
                        <option value="2">★★☆☆☆ - 2 (Kurang)</option>
                        <option value="1">★☆☆☆☆ - 1 (Sangat Buruk)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Ulasan / Komentar</label>
                    <textarea name="comment" rows="4" required placeholder="Bagikan pengalamanmu berkolaborasi dalam proyek ini..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" @click="reviewModal = false" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

