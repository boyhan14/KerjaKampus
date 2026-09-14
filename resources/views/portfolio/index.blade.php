@extends('layouts.dashboard')

@section('title', 'Portofolio Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Portofolio Proyek Saya</h1>
            <p class="text-sm text-gray-500">Tampilkan karya terbaikmu untuk memikat calon klien dan meningkatkan peluang diterima.</p>
        </div>
        <a href="{{ route('portfolio.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Portofolio
        </a>
    </div>

    @if($portfolios->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Portfolio Kamu Masih Kosong</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Tambahkan project pertama untuk meningkatkan profilmu dan memikat klien.</p>
            <a href="{{ route('portfolio.create') }}" class="inline-block px-5 py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700">Tambah Proyek Pertama</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolios as $item)
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <!-- Thumbnail or Placeholder -->
                        <div class="h-44 bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center overflow-hidden relative">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-4 text-indigo-300">
                                    <svg class="w-12 h-12 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span class="text-xs font-semibold text-indigo-400">Preview Proyek</span>
                                </div>
                            @endif

                            <!-- Status Tag -->
                            <div class="absolute top-3 right-3">
                                @if($item->is_published)
                                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-lg bg-green-500/90 text-white backdrop-blur-xs">Publik</span>
                                @else
                                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-lg bg-gray-700/80 text-white backdrop-blur-xs">Draft</span>
                                @endif
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-5 space-y-3">
                            <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">{{ $item->category ?? 'Proyek' }}</span>
                            <h3 class="font-bold text-gray-900 text-base line-clamp-1 hover:text-indigo-600">
                                <a href="{{ route('portfolio.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                {{ $item->description }}
                            </p>

                            <!-- Skills -->
                            @if($item->skills->isNotEmpty())
                                <div class="flex flex-wrap gap-1 pt-1">
                                    @foreach($item->skills->take(3) as $skill)
                                        <span class="px-2 py-0.5 text-[10px] font-medium bg-gray-100 text-gray-600 rounded">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions Footer -->
                    <div class="p-4 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('portfolio.edit', $item->id) }}" class="font-semibold text-gray-700 hover:text-indigo-600">Edit</a>
                            <span>&bull;</span>
                            <form action="{{ route('portfolio.toggle-publish', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="font-semibold text-gray-600 hover:text-gray-900">
                                    {{ $item->is_published ? 'Jadikan Draft' : 'Publikasikan' }}
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('portfolio.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus portofolio ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-semibold text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection
