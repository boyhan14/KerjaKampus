@extends('layouts.dashboard')

@section('title', 'Moderasi Ulasan - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Moderasi Ulasan & Rating</h1>
        <p class="text-sm text-gray-500">Pantau seluruh ulasan dan hapus ulasan palsu atau bernada kebencian jika ditemukan.</p>
    </div>

    @if($reviews->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center text-gray-400 text-sm">
            Belum ada ulasan yang dipublikasikan di platform.
        </div>
    @else
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xs flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div class="space-y-2 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-gray-900 text-sm">{{ $review->reviewer?->name }}</span>
                            <span class="text-xs text-gray-400">&rarr; untuk &rarr;</span>
                            <span class="font-bold text-indigo-700 text-sm">{{ $review->reviewee?->name }}</span>
                            <span class="text-xs text-gray-400">({{ $review->created_at->diffForHumans() }})</span>
                        </div>

                        <div class="flex items-center text-amber-400 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                            <span class="text-gray-700 font-bold ml-1.5">{{ $review->rating }}.0</span>
                            <span class="text-gray-400 ml-2">&bull; Proyek: {{ $review->project?->title }}</span>
                        </div>

                        <p class="text-sm text-gray-700 bg-gray-50 p-3.5 rounded-xl leading-relaxed">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini secara permanen?');" class="shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold border border-red-200">
                            Hapus Ulasan
                        </button>
                    </form>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
