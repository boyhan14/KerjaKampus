@extends('layouts.dashboard')

@section('title', 'Ulasan & Reputasi - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Ulasan & Rating Saya</h1>
        <p class="text-sm text-gray-500">Semua testimoni dan feedback yang Anda terima dari proyek yang telah selesai.</p>
    </div>

    @if($reviews->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Ulasan</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Selesaikan proyek kolaborasi Anda untuk mendapatkan ulasan dan bintang reputasi pertama.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xs space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-sm uppercase">
                                {{ substr($review->reviewer?->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">{{ $review->reviewer?->name }}</h4>
                                <p class="text-[11px] text-gray-400">{{ $review->created_at->diffForHumans() }} &bull; Proyek: {{ $review->project?->title }}</p>
                            </div>
                        </div>

                        <div class="flex items-center text-amber-400 text-sm">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                            <span class="text-gray-800 font-bold text-xs ml-1.5">{{ $review->rating }}.0</span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl">
                        "{{ $review->comment }}"
                    </p>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
