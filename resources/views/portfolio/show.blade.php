@extends('layouts.app')

@section('title', $portfolio->title . ' - Portofolio Karya Mahasiswa KerjaKampus')

@section('content')
<div class="bg-slate-50/70 min-h-screen py-8 sm:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center text-xs font-semibold text-slate-400 gap-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Beranda</span>
            </a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('talents.index') }}" class="hover:text-indigo-600 transition-colors">Eksplor Talenta</a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('talents.show', $portfolio->user?->username ?? $portfolio->user?->id) }}" class="hover:text-indigo-600 transition-colors">{{ $portfolio->user?->name }}</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-800 truncate max-w-xs font-bold">{{ $portfolio->title }}</span>
        </nav>

        <!-- Main Showcase Container -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left & Center: Project Showcase (8 cols) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Visual Showcase Card with Mockup Window -->
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                    <!-- Browser Style Frame Header -->
                    <div class="px-5 py-3.5 bg-slate-100/70 border-b border-slate-200/70 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <span class="text-[11px] font-mono text-slate-400 ml-2 hidden sm:inline-block">preview://{{ Str::slug($portfolio->title) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 text-[10px] font-black rounded-md bg-indigo-50 text-indigo-700 uppercase tracking-wider border border-indigo-100">
                                {{ $portfolio->category ?? 'Showcase Karya' }}
                            </span>
                        </div>
                    </div>

                    <!-- Project Image / Preview -->
                    @if($portfolio->thumbnail)
                        <div class="w-full bg-slate-900 overflow-hidden group relative">
                            <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-auto max-h-[480px] object-cover sm:object-contain mx-auto transition-transform duration-500 group-hover:scale-[1.01]">
                        </div>
                    @else
                        <div class="w-full h-64 sm:h-80 bg-gradient-to-br from-indigo-500/10 via-violet-500/5 to-purple-500/10 flex flex-col items-center justify-center text-slate-400 p-8 text-center">
                            <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h4 class="font-bold text-slate-700 text-sm">Dokumentasi Proyek Digital</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm">Karya ini dirancang dan dikembangkan secara independen oleh talenta mahasiswa.</p>
                        </div>
                    @endif

                    <!-- Title & Details Content -->
                    <div class="p-6 sm:p-9 space-y-8">
                        <div class="space-y-3 pb-6 border-b border-slate-100">
                            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                                {{ $portfolio->title }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                                <span>Kategori: <strong class="text-slate-800">{{ $portfolio->category ?? 'Umum' }}</strong></span>
                                <span>&bull;</span>
                                <span>Dipublikasikan: <strong class="text-slate-700">{{ $portfolio->published_at ? $portfolio->published_at->format('d F Y') : $portfolio->created_at->format('d F Y') }}</strong></span>
                            </div>
                        </div>

                        <!-- Action Links Buttons -->
                        @if($portfolio->demo_url || $portfolio->repository_url)
                            <div class="flex flex-wrap items-center gap-3">
                                @if($portfolio->demo_url)
                                    <a href="{{ $portfolio->demo_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        <span>Kunjungi Live Demo</span>
                                    </a>
                                @endif

                                @if($portfolio->repository_url)
                                    <a href="{{ $portfolio->repository_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm rounded-xl shadow-xs transition-all btn-press">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                        <span>Source Code Repository</span>
                                    </a>
                                @endif
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ruang Lingkup & Deskripsi Proyek</h3>
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50/50 p-5 rounded-2xl border border-slate-100">
                                {{ $portfolio->description }}
                            </div>
                        </div>

                        <!-- Skills / Tech Stack Used -->
                        @if($portfolio->skills->isNotEmpty())
                            <div class="space-y-3 pt-4 border-t border-slate-100">
                                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Teknologi & Keterampilan yang Digunakan</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($portfolio->skills as $skill)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white text-slate-800 border border-slate-200/80 text-xs font-bold shadow-2xs hover:border-indigo-300 transition-colors">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Sticky Talent & CTA Sidebar (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Talent Info Card -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-6">
                    <div class="flex items-start gap-4">
                        <!-- Avatar -->
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-black flex items-center justify-center text-xl uppercase overflow-hidden shadow-md shadow-indigo-500/20 shrink-0">
                            @if($portfolio->user?->avatar)
                                <img src="{{ asset('storage/' . $portfolio->user->avatar) }}" alt="{{ $portfolio->user->name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($portfolio->user?->name ?? 'T', 0, 1) }}
                            @endif
                        </div>

                        <div class="min-w-0 flex-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 block mb-0.5">Pembuat Karya</span>
                            <h3 class="font-black text-slate-900 text-base sm:text-lg truncate">
                                <a href="{{ route('talents.show', $portfolio->user?->username ?? $portfolio->user?->id) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ $portfolio->user?->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-500 truncate mt-0.5">{{ $portfolio->user?->education ?? ($portfolio->user?->location ?? 'Indonesia') }}</p>
                            
                            <!-- Availability status -->
                            <div class="mt-2.5 flex items-center gap-1.5">
                                @if($portfolio->user?->is_available ?? true)
                                    <span class="flex h-2 w-2 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                    <span class="text-[11px] font-bold text-emerald-700">Tersedia untuk Proyek</span>
                                @else
                                    <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                    <span class="text-[11px] font-medium text-slate-400">Sedang Sibuk</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($portfolio->user?->bio)
                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            "{{ $portfolio->user->bio }}"
                        </p>
                    @endif

                    <!-- CTA Action Button -->
                    <div class="space-y-2.5 pt-2">
                        <a href="{{ route('talents.show', $portfolio->user?->username ?? $portfolio->user?->id) }}" class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-2xl shadow-md shadow-indigo-500/20 text-center block transition-all btn-press">
                            Lihat Profil & Rekrut Talenta &rarr;
                        </a>
                        
                        @if(Auth::check() && Auth::id() === $portfolio->user_id)
                            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-2xl text-center block transition-colors">
                                Edit Portofolio Ini
                            </a>
                        @endif
                    </div>
                </div>

                <!-- More Works by Talent -->
                @if(isset($portfolio->user?->portfolioItems) && $portfolio->user->portfolioItems->where('id', '!=', $portfolio->id)->isNotEmpty())
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                        <div class="flex items-center justify-between">
                            <h4 class="font-black text-slate-900 text-xs uppercase tracking-wider">Karya Lainnya</h4>
                            <a href="{{ route('talents.show', $portfolio->user?->username ?? $portfolio->user?->id) }}" class="text-[11px] font-bold text-indigo-600 hover:underline">Semua &rarr;</a>
                        </div>

                        <div class="space-y-3">
                            @foreach($portfolio->user->portfolioItems->where('id', '!=', $portfolio->id)->take(3) as $otherItem)
                                <a href="{{ route('portfolio.show', $otherItem->slug) }}" class="p-3 rounded-2xl border border-slate-100 hover:border-indigo-200 bg-slate-50/50 hover:bg-indigo-50/20 transition-all flex items-center gap-3 group">
                                    <div class="w-12 h-12 rounded-xl bg-slate-200 overflow-hidden shrink-0">
                                        @if($otherItem->thumbnail)
                                            <img src="{{ asset('storage/' . $otherItem->thumbnail) }}" alt="{{ $otherItem->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">🚀</div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h5 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 truncate transition-colors">{{ $otherItem->title }}</h5>
                                        <span class="text-[10px] text-slate-400 block">{{ $otherItem->category ?? 'Proyek' }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
