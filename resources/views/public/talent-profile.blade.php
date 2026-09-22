@extends('layouts.app')

@section('title', ($talent->name ?? 'Profil Talenta') . ' - KerjaKampus')

@section('content')
<div class="relative bg-slate-50 min-h-screen py-8 sm:py-12 overflow-hidden">
    <!-- Ambient Lighting -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-tr from-indigo-500/15 via-purple-500/15 to-pink-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-xs font-semibold text-slate-400 gap-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ url('/talents') }}" class="hover:text-indigo-600 transition-colors">Talenta</a>
            <span>/</span>
            <span class="text-slate-700 truncate max-w-xs font-bold">{{ $talent->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Sidebar: Profile Summary & Stats -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Main Profile Card -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 overflow-hidden box-shine">
                    <div class="h-32 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 [mask-image:radial-gradient(ellipse_at_center,transparent_20%,black)]"></div>
                    </div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-16 mb-4">
                            <div class="w-28 h-28 bg-white rounded-3xl p-1.5 shadow-xl ring-4 ring-indigo-50 relative">
                                @if($talent->avatar)
                                    <img class="w-full h-full object-cover rounded-2xl" src="{{ asset('storage/' . $talent->avatar) }}" alt="{{ $talent->name }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-tr from-indigo-500 via-indigo-600 to-violet-600 rounded-2xl flex items-center justify-center text-white text-4xl font-black shadow-inner">
                                        {{ substr($talent->name ?? 'A', 0, 1) }}
                                    </div>
                                @endif
                                @if($talent->is_available ?? true)
                                    <span class="absolute -bottom-1 -right-1 flex h-6 w-6">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-6 w-6 bg-emerald-500 ring-2 ring-white items-center justify-center text-[10px] text-white font-bold" title="Tersedia untuk proyek">✓</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="text-center space-y-1">
                            <h1 class="text-xl font-black text-slate-900 tracking-tight">{{ $talent->name }}</h1>
                            <p class="text-xs text-indigo-600 font-mono font-bold">{{ '@'.($talent->username ?? 'username') }}</p>
                            
                            <div class="flex items-center justify-center text-xs text-slate-500 gap-1 pt-1 pb-2 font-medium">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $talent->location ?? 'Indonesia' }}</span>
                            </div>

                            <!-- Rating & Projects stats -->
                            <div class="flex justify-center items-center gap-6 py-4 my-3 border-y border-slate-100">
                                <div class="text-center">
                                    <div class="flex items-center justify-center text-amber-400 text-xs">
                                        @php $avgRating = $talent->averageRating(); @endphp
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-slate-900 font-black ml-1 text-sm">{{ number_format($avgRating > 0 ? $avgRating : 5.0, 1) }}</span>
                                    </div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">{{ $talent->reviewsReceived->count() }} Ulasan</p>
                                </div>
                                <div class="w-px h-8 bg-slate-200"></div>
                                <div class="text-center">
                                    <span class="text-base font-black text-slate-900">{{ $talent->talentProjects()->where('status', \App\Enums\ProjectStatus::COMPLETED)->count() }}</span>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Proyek Selesai</p>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="pt-2">
                                @auth
                                    @if(Auth::user()->isClient())
                                        <a href="{{ route('jobs.create') }}" class="block w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-500/20 transition-all btn-press btn-shine">
                                            Tawarkan Proyek ke {{ explode(' ', $talent->name ?? 'Talenta')[0] }}
                                        </a>
                                    @else
                                        <a href="{{ route('profile.show') }}" class="block w-full py-3 px-4 bg-slate-100 text-slate-700 font-bold text-xs rounded-2xl hover:bg-slate-200 transition-colors">
                                            Profil Talenta Publik
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('register') }}" class="block w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-500/20 transition-all btn-press btn-shine">
                                        Rekrut {{ explode(' ', $talent->name ?? 'Talenta')[0] }}
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Card -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 space-y-4 box-shine">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider">Kualifikasi Akademik & Pengalaman</h3>
                    
                    <div class="space-y-4 text-xs">
                        <div>
                            <span class="text-slate-400 block mb-0.5 font-medium">Perguruan Tinggi / Kampus</span>
                            <p class="text-slate-900 font-black text-sm">{{ $talent->education ?? 'Tidak dicantumkan' }}</p>
                        </div>
                        
                        <div>
                            <span class="text-slate-400 block mb-0.5 font-medium">Pengalaman Kerja / Gig</span>
                            <p class="text-slate-900 font-black text-sm">{{ $talent->experience_years ?? 0 }} Tahun</p>
                        </div>

                        <div>
                            <span class="text-slate-400 block mb-2 font-medium">Tautan Profil & Portofolio Luar</span>
                            <div class="flex gap-2">
                                @if(isset($talent->github_url))
                                    <a href="{{ $talent->github_url }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl bg-slate-50 text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/80 transition-colors" title="GitHub">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                                    </a>
                                @endif
                                @if(isset($talent->linkedin_url))
                                    <a href="{{ $talent->linkedin_url }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl bg-slate-50 text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/80 transition-colors" title="LinkedIn">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"/></svg>
                                    </a>
                                @endif
                            </div>
                            @if(!isset($talent->github_url) && !isset($talent->linkedin_url))
                                <p class="text-xs text-slate-400 italic">Belum ada tautan eksternal.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Bio -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 sm:p-8 space-y-3 box-shine">
                    <h2 class="text-base font-black text-slate-900 tracking-tight">Tentang Saya</h2>
                    <div class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
                        @if(!empty($talent->bio))
                            {!! nl2br(e($talent->bio)) !!}
                        @else
                            <p class="text-slate-400 italic">Talenta ini belum melengkapi ringkasan profil bio.</p>
                        @endif
                    </div>
                </div>

                <!-- Skills -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 sm:p-8 space-y-4 box-shine">
                    <h2 class="text-base font-black text-slate-900 tracking-tight">Keahlian & Kemampuan (Skills)</h2>
                    <div class="flex flex-wrap gap-2">
                        @forelse($talent->skills ?? [] as $skill)
                            <span class="px-3.5 py-1.5 bg-indigo-50 text-indigo-700 font-bold text-xs rounded-xl border border-indigo-100">
                                {{ $skill->name ?? $skill }}
                            </span>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada keahlian yang dicantumkan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Portfolio -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 sm:p-8 space-y-6 box-shine">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-black text-slate-900 tracking-tight">Karya Portofolio</h2>
                        <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">{{ $talent->portfolioItems->count() }} Karya</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @forelse($talent->portfolioItems as $portfolio)
                        <div class="group rounded-3xl overflow-hidden border border-slate-200/80 bg-slate-50 flex flex-col justify-between card-hover box-shine">
                            <div>
                                <div class="aspect-video bg-slate-200 flex items-center justify-center text-slate-400 overflow-hidden relative">
                                    @if($portfolio->thumbnail)
                                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    @endif
                                </div>
                                <div class="p-5 bg-white space-y-1.5">
                                    <h4 class="font-black text-slate-900 text-sm truncate group-hover:text-indigo-600 transition-colors">
                                        <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $portfolio->description }}</p>
                                </div>
                            </div>
                            <div class="px-5 pb-4 bg-white">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                    <span>Lihat Karya Detail</span> &rarr;
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-12 text-center text-slate-400 text-xs bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            Belum ada karya portofolio yang dipublikasikan.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 sm:p-8 space-y-6 box-shine">
                    <h2 class="text-base font-black text-slate-900 tracking-tight">Ulasan & Reputasi Klien</h2>
                    <div class="space-y-4">
                        @forelse($talent->reviewsReceived as $review)
                        <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-100 space-y-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-xs sm:text-sm">{{ $review->reviewer?->name ?? 'Klien' }}</h4>
                                    <p class="text-[10px] text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex text-amber-400 text-xs">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= ($review->rating ?? 5) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                    <span class="text-slate-700 font-bold ml-1 text-xs">{{ $review->rating }}.0</span>
                                </div>
                            </div>
                            <p class="text-slate-600 text-xs leading-relaxed font-medium">"{{ $review->comment }}"</p>
                            @if($review->project)
                                <p class="text-[11px] text-indigo-600 font-semibold">Proyek: {{ $review->project->title }}</p>
                            @endif
                        </div>
                        @empty
                        <div class="py-12 text-center text-slate-400 text-xs bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            Belum ada ulasan dari klien saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
