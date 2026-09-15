@extends('layouts.dashboard')

@section('title', 'Ulasan & Reputasi - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider mb-2">
                Reputasi Terverifikasi
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Ulasan & Feedback Klien</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Semua testimoni dan rating yang Anda peroleh dari proyek kolaborasi yang telah selesai.</p>
        </div>
        <div class="px-4 py-2.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center">
            <span class="text-amber-400 text-base">★</span>
            <span class="text-xs font-bold text-slate-800">Total {{ $reviews->total() }} Ulasan Masuk</span>
        </div>
    </div>

    @if($reviews->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-16 text-center space-y-4 shadow-xs">
            <div class="w-20 h-20 rounded-3xl bg-amber-50 text-amber-500 flex items-center justify-center mx-auto shadow-inner">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900">Belum Ada Ulasan Diterima</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                Ulasan otomatis diberikan oleh klien setelah proyek kolaborasi selesai diserahkan dan ditandai komplit.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($reviews as $review)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-300 flex flex-col justify-between space-y-4">
                    <div>
                        <!-- Review Header -->
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                @if($review->reviewer?->avatar)
                                    <img src="{{ asset('storage/' . $review->reviewer->avatar) }}" alt="{{ $review->reviewer->name }}" class="w-11 h-11 rounded-2xl object-cover border border-slate-200">
                                @else
                                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-black flex items-center justify-center text-sm uppercase shadow-xs">
                                        {{ substr($review->reviewer?->name ?? 'U', 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $review->reviewer?->name }}</h4>
                                    <p class="text-[11px] text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Star Rating -->
                            <div class="flex items-center gap-1 bg-amber-50 border border-amber-200/60 px-2.5 py-1 rounded-xl">
                                <span class="text-amber-400 text-xs">★</span>
                                <span class="text-slate-900 font-black text-xs">{{ $review->rating }}.0</span>
                            </div>
                        </div>

                        <!-- Quote Comment -->
                        <div class="relative p-4 bg-slate-50/80 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed italic">
                            <span class="text-indigo-300 text-2xl font-serif font-black absolute top-1 left-2 select-none leading-none">“</span>
                            <p class="relative z-10 pl-3">
                                {{ $review->comment }}
                            </p>
                        </div>
                    </div>

                    <!-- Project Tag -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Proyek:</span>
                        <span class="font-bold text-indigo-600 truncate max-w-[240px]">
                            {{ $review->project?->title }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
@endsection
