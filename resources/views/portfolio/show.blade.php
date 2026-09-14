@extends('layouts.app')

@section('title', $portfolio->title . ' - Portofolio KerjaKampus')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-xs text-gray-500 gap-2">
            <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
            <span>/</span>
            <a href="{{ route('talents.show', $portfolio->user?->username ?? '') }}" class="hover:underline">{{ $portfolio->user?->name }}</a>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate max-w-xs">{{ $portfolio->title }}</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm">
            @if($portfolio->thumbnail)
                <div class="w-full h-80 sm:h-96 bg-gray-100 overflow-hidden">
                    <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-6 sm:p-10 space-y-8">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-gray-100">
                    <div class="space-y-2">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                            {{ $portfolio->category ?? 'Proyek Portofolio' }}
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $portfolio->title }}</h1>
                        <p class="text-xs text-gray-400">
                            Karya dari 
                            <a href="{{ route('talents.show', $portfolio->user?->username ?? '') }}" class="text-indigo-600 font-semibold hover:underline">
                                {{ $portfolio->user?->name }}
                            </a>
                        </p>
                    </div>

                    <!-- Links -->
                    <div class="flex items-center gap-2 shrink-0">
                        @if($portfolio->demo_url)
                            <a href="{{ $portfolio->demo_url }}" target="_blank" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Live Demo
                            </a>
                        @endif

                        @if($portfolio->repository_url)
                            <a href="{{ $portfolio->repository_url }}" target="_blank" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-bold rounded-xl inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                Repository
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <h3 class="text-base font-bold text-gray-900">Tentang Proyek</h3>
                    <div class="text-sm sm:text-base text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $portfolio->description }}
                    </div>
                </div>

                <!-- Skills Used -->
                @if($portfolio->skills->isNotEmpty())
                    <div class="space-y-3 pt-6 border-t border-gray-100">
                        <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Teknologi & Keahlian</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($portfolio->skills as $skill)
                                <span class="px-3 py-1.5 rounded-xl bg-gray-100 text-gray-800 text-xs font-semibold">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Author Profile Card -->
                <div class="pt-8 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-lg uppercase">
                            {{ substr($portfolio->user?->name ?? 'T', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $portfolio->user?->name }}</h4>
                            <p class="text-xs text-gray-500">{{ $portfolio->user?->location ?? 'Indonesia' }}</p>
                        </div>
                    </div>

                    <a href="{{ route('talents.show', $portfolio->user?->username ?? '') }}" class="px-4 py-2 rounded-xl border border-indigo-200 text-indigo-600 hover:bg-indigo-50 text-xs font-bold">
                        Lihat Profil Talenta &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

