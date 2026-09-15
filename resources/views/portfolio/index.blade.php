@extends('layouts.dashboard')

@section('title', 'Portofolio Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Portofolio Proyek Saya</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pamerkan karya terbaikmu untuk memikat calon klien dan meningkatkan peluang kerja.</p>
        </div>
        <a href="{{ route('portfolio.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>+ Tambah Portofolio</span>
        </a>
    </div>

    @if($portfolios->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Portofolio Kamu Masih Kosong</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">Tambahkan karya proyek pertamamu untuk meningkatkan reputasi profil dan memikat klien baru.</p>
            <div class="pt-2">
                <a href="{{ route('portfolio.create') }}" class="inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20">
                    Tambah Proyek Pertama
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolios as $item)
                <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs card-hover flex flex-col justify-between group">
                    <div>
                        <!-- Thumbnail -->
                        <div class="h-44 bg-slate-100 flex items-center justify-center overflow-hidden relative">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="text-center p-4 text-indigo-300">
                                    <svg class="w-10 h-10 mx-auto mb-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span class="text-[11px] font-semibold text-slate-400">Preview Portofolio</span>
                                </div>
                            @endif

                            <!-- Status Tag -->
                            <div class="absolute top-3 right-3">
                                @if($item->is_published)
                                    <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full bg-emerald-500 text-white shadow-xs">Publik</span>
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full bg-slate-800/90 text-white shadow-xs">Draft</span>
                                @endif
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-5 space-y-2.5">
                            <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider block">{{ $item->category ?? 'Proyek' }}</span>
                            <h3 class="font-bold text-slate-900 text-base line-clamp-1 hover:text-indigo-600 transition-colors">
                                <a href="{{ route('portfolio.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $item->description }}
                            </p>

                            <!-- Skills -->
                            @if($item->skills->isNotEmpty())
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    @foreach($item->skills->take(3) as $skill)
                                        <span class="px-2 py-0.5 text-[10px] font-medium bg-slate-50 text-slate-600 rounded-md border border-slate-200/60">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions Footer -->
                    <div class="p-4 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2.5 font-bold">
                            <a href="{{ route('portfolio.edit', $item->id) }}" class="text-slate-600 hover:text-indigo-600 transition-colors">Edit</a>
                            <span class="text-slate-300">&bull;</span>
                            <form action="{{ route('portfolio.toggle-publish', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-slate-600 hover:text-slate-900 transition-colors">
                                    {{ $item->is_published ? 'Jadikan Draft' : 'Publikasikan' }}
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('portfolio.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus portofolio ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold text-rose-600 hover:text-rose-800 transition-colors">Hapus</button>
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
