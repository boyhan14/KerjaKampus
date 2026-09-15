@extends('layouts.dashboard')

@section('title', 'Moderasi Ulasan - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2">
                Kontrol Kualitas Konten
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Moderasi Ulasan & Rating</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau seluruh feedback dan hapus ulasan palsu atau bermuatan ujaran kebencian.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center text-xs font-bold text-slate-700">
            Total: {{ $reviews->total() }} Ulasan
        </div>
    </div>

    @if($reviews->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900">Belum Ada Ulasan</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">Belum ada ulasan yang diterbitkan di platform saat ini.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row sm:items-start justify-between gap-5">
                    <div class="space-y-3 min-w-0 flex-1">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <span class="font-black text-slate-900 text-sm">{{ $review->reviewer?->name }}</span>
                            <span class="text-xs text-slate-400">&rarr; untuk &rarr;</span>
                            <span class="font-black text-indigo-600 text-sm">{{ $review->reviewee?->name }}</span>
                            <span class="text-xs text-slate-400">({{ $review->created_at->diffForHumans() }})</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="flex items-center text-amber-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <span class="text-slate-900 font-black text-xs">{{ $review->rating }}.0</span>
                            <span class="text-slate-400 text-xs">&bull; Proyek: <span class="font-semibold text-slate-700">{{ $review->project?->title }}</span></span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-700 bg-slate-50 p-4 rounded-2xl leading-relaxed">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini secara permanen dari basis data?');" class="shrink-0 self-end sm:self-start">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-2 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-xl text-xs font-bold border border-rose-200/60 transition-colors">
                            Hapus Ulasan
                        </button>
                    </form>
                </div>
            @endforeach

            <div class="mt-8">
                {{ $reviews->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
