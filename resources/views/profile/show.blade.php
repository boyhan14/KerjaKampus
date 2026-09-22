@extends('layouts.dashboard')

@section('title', 'Profil Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8" x-data="{ activeTab: 'overview' }">
    <!-- Profile Hero Card with Cover Banner -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <!-- Cover Banner -->
        <div class="h-32 sm:h-44 bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 relative overflow-hidden">
            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            <div class="absolute top-4 right-4 flex items-center gap-2">
                @if($user->username)
                    <a href="{{ route('talents.show', $user->username) }}" target="_blank" class="px-3.5 py-1.5 bg-white/20 hover:bg-white/30 text-white backdrop-blur-md text-xs font-bold rounded-xl border border-white/20 transition-all inline-flex items-center gap-1.5">
                        <span>Halaman Publik</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Overlapping Profile Details -->
        <div class="px-6 sm:px-8 pb-8 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 -mt-12 sm:-mt-16 mb-6">
                <!-- Avatar -->
                <div class="flex items-end gap-5">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-black text-3xl flex items-center justify-center uppercase overflow-hidden shadow-xl border-4 border-white shrink-0">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>

                    <div class="space-y-1 mb-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h1>
                            <span class="px-2.5 py-0.5 text-[10px] font-black rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase">
                                {{ $user->role?->value ?? $user->role }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium">
                            {{ '@' . ($user->username ?? 'user') }} &bull; {{ $user->education ?? ($user->location ?? 'Indonesia') }}
                        </p>
                    </div>
                </div>

                <!-- Action CTA -->
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('profile.edit') }}" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all btn-press inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        <span>Edit Profil</span>
                    </a>
                </div>
            </div>

            <!-- Availability & Stats Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-slate-100">
                <div class="p-3.5 bg-slate-50/70 rounded-2xl border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Status Kerja</span>
                    @if($user->is_available ?? true)
                        <div class="flex items-center gap-1.5 text-xs font-bold text-emerald-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Siap Proyek</span>
                        </div>
                    @else
                        <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            <span>Sedang Sibuk</span>
                        </div>
                    @endif
                </div>

                <div class="p-3.5 bg-slate-50/70 rounded-2xl border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Portofolio</span>
                    <span class="text-sm font-black text-slate-900">{{ $user->portfolioItems->count() }} Karya</span>
                </div>

                <div class="p-3.5 bg-slate-50/70 rounded-2xl border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Ulasan Diterima</span>
                    <span class="text-sm font-black text-slate-900">{{ $user->reviewsReceived->count() }} Review</span>
                </div>

                <div class="p-3.5 bg-slate-50/70 rounded-2xl border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Rating Kepuasan</span>
                    <div class="flex items-center gap-1 text-xs font-bold text-slate-900">
                        <span class="text-amber-400">★</span>
                        <span>{{ number_format($user->averageRating(), 1) }}</span>
                    </div>
                </div>
            </div>

            <!-- Profile Completion (Talent only) -->
            @if($user->isTalent())
                <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-1.5 flex-1 max-w-md">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="text-slate-600">Kelengkapan Profil</span>
                            <span class="text-indigo-600">{{ $completion }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-violet-600 h-2 rounded-full transition-all duration-500" style="width: {{ $completion }}%"></div>
                        </div>
                    </div>
                    <span class="text-xs text-slate-400">Profil lengkap mempermudah verifikasi dan meningkatkan 3x tawaran proyek.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Segmented Navigation Tabs -->
    <div class="flex items-center gap-2 p-1.5 bg-slate-100/80 rounded-2xl border border-slate-200/60 text-xs font-bold overflow-x-auto">
        <button type="button" @click="activeTab = 'overview'" 
                class="px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shrink-0" 
                :class="activeTab === 'overview' ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Ringkasan Diri</span>
        </button>

        @if($user->isTalent())
            <button type="button" @click="activeTab = 'portfolio'" 
                    class="px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shrink-0" 
                    :class="activeTab === 'portfolio' ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Portofolio Karya ({{ $user->portfolioItems->count() }})</span>
            </button>

            <button type="button" @click="activeTab = 'skills'" 
                    class="px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shrink-0" 
                    :class="activeTab === 'skills' ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <span>Keahlian & Skill ({{ $user->skills->count() }})</span>
            </button>
        @endif

        <button type="button" @click="activeTab = 'reviews'" 
                class="px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shrink-0" 
                :class="activeTab === 'reviews' ? 'bg-white text-indigo-600 shadow-xs' : 'text-slate-600 hover:text-slate-900'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            <span>Ulasan Rekan ({{ $user->reviewsReceived->count() }})</span>
        </button>
    </div>

    <!-- Tab 1: Overview -->
    <div x-show="activeTab === 'overview'" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Main details (2 cols) -->
        <div class="md:col-span-2 space-y-6">
            <!-- Bio Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 text-sm">Tentang Saya</h3>
                    <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-indigo-600 hover:underline">Edit &rarr;</a>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                    {{ $user->bio ?? 'Belum ada biodata yang ditambahkan. Lengkapi biodata Anda agar klien lebih mengenal keterampilan dan keunggulan Anda.' }}
                </p>
            </div>

            @if($user->isClient() && $user->company_name)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-3">
                    <h3 class="font-bold text-slate-900 text-sm">Profil Bisnis / Usaha</h3>
                    <div class="space-y-1">
                        <h4 class="font-bold text-indigo-600 text-sm">{{ $user->company_name }}</h4>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $user->company_description ?? 'Belum ada deskripsi perusahaan.' }}</p>
                    </div>
                </div>
            @endif

            <!-- Mini Skills Preview -->
            @if($user->isTalent() && $user->skills->isNotEmpty())
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-slate-900 text-sm">Skill Pilihan</h3>
                        <a href="{{ route('skills.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Kelola Skill &rarr;</a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->skills->take(8) as $skill)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 text-slate-800 border border-slate-200/60 text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar Info (1 col) -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-slate-400 text-xs uppercase tracking-wider">Kredensial & Kontak</h3>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 block mb-0.5">Alamat Email</span>
                        <span class="font-bold text-slate-800">{{ $user->email }}</span>
                    </div>

                    @if($user->phone)
                        <div>
                            <span class="text-slate-400 block mb-0.5">WhatsApp / Telepon</span>
                            <span class="font-bold text-slate-800">{{ $user->phone }}</span>
                        </div>
                    @endif

                    @if($user->location)
                        <div>
                            <span class="text-slate-400 block mb-0.5">Lokasi Domisili</span>
                            <span class="font-bold text-slate-800">{{ $user->location }}</span>
                        </div>
                    @endif

                    @if($user->education)
                        <div>
                            <span class="text-slate-400 block mb-0.5">Pendidikan / Kampus</span>
                            <span class="font-bold text-slate-800">{{ $user->education }}</span>
                        </div>
                    @endif

                    @if($user->experience_years)
                        <div>
                            <span class="text-slate-400 block mb-0.5">Pengalaman Kerja</span>
                            <span class="font-bold text-slate-800">{{ $user->experience_years }} Tahun</span>
                        </div>
                    @endif

                    @if($user->website)
                        <div>
                            <span class="text-slate-400 block mb-0.5">Website Pribadi</span>
                            <a href="{{ $user->website }}" target="_blank" rel="noopener" class="font-bold text-indigo-600 hover:underline truncate block">{{ $user->website }}</a>
                        </div>
                    @endif
                </div>

                <!-- Social Links -->
                @if($user->github_url || $user->linkedin_url || $user->instagram_url || $user->twitter_url)
                    <div class="pt-4 border-t border-slate-100 space-y-2">
                        <span class="text-slate-400 block text-xs font-semibold">Tautan Media Sosial</span>
                        <div class="flex flex-wrap items-center gap-2">
                            @if($user->github_url)
                                <a href="{{ $user->github_url }}" target="_blank" rel="noopener" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-colors">GitHub</a>
                            @endif
                            @if($user->linkedin_url)
                                <a href="{{ $user->linkedin_url }}" target="_blank" rel="noopener" class="px-2.5 py-1 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-lg transition-colors">LinkedIn</a>
                            @endif
                            @if($user->instagram_url)
                                <a href="{{ $user->instagram_url }}" target="_blank" rel="noopener" class="px-2.5 py-1 bg-pink-50 hover:bg-pink-100 text-pink-700 text-xs font-bold rounded-lg transition-colors">Instagram</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tab 2: Portfolio -->
    @if($user->isTalent())
        <div x-show="activeTab === 'portfolio'" x-cloak class="space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="font-black text-slate-900 text-lg">Daftar Portofolio Karya</h3>
                <a href="{{ route('portfolio.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-xs font-bold rounded-xl shadow-xs btn-press">
                    + Tambah Portofolio
                </a>
            </div>

            @if($user->portfolioItems->isEmpty())
                <div class="p-12 text-center bg-white rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
                    <p class="text-xs sm:text-sm text-slate-400">Belum ada karya portofolio yang ditambahkan.</p>
                    <a href="{{ route('portfolio.create') }}" class="inline-block px-4 py-2 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-xl">Tambah Portofolio Sekarang</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->portfolioItems as $item)
                        <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs card-hover flex flex-col justify-between">
                            <div>
                                <div class="h-40 bg-slate-100 overflow-hidden">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">🖼️</div>
                                    @endif
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider block">{{ $item->category ?? 'Proyek' }}</span>
                                    <h4 class="font-bold text-slate-900 text-sm truncate">
                                        <a href="{{ route('portfolio.show', $item->slug) }}" class="hover:text-indigo-600">{{ $item->title }}</a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-2">{{ $item->description }}</p>
                                </div>
                            </div>
                            <div class="p-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                                <a href="{{ route('portfolio.show', $item->slug) }}" class="text-indigo-600 hover:underline">Lihat &rarr;</a>
                                <a href="{{ route('portfolio.edit', $item->id) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Tab 3: Skills -->
        <div x-show="activeTab === 'skills'" x-cloak class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <h3 class="font-black text-slate-900 text-lg">Keahlian & Kemampuan Teknis</h3>
                    <p class="text-xs text-slate-500">Keterampilan yang Anda kuasai untuk menyelesaikan proyek klien.</p>
                </div>
                <a href="{{ route('skills.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-xs font-bold rounded-xl shadow-xs btn-press">
                    Kelola Keahlian
                </a>
            </div>

            @if($user->skills->isEmpty())
                <p class="text-xs text-slate-400 text-center py-8">Belum ada skill yang ditambahkan. Tambahkan skill untuk mencocokkan lowongan yang relevan!</p>
            @else
                <div class="flex flex-wrap gap-2.5">
                    @foreach($user->skills as $skill)
                        <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-50 text-slate-800 border border-slate-200/70 text-xs font-bold shadow-2xs">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            <span>{{ $skill->name }}</span>
                            <span class="text-[10px] text-slate-400 font-normal">({{ $skill->category?->name ?? 'Skill' }})</span>
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <!-- Tab 4: Reviews -->
    <div x-show="activeTab === 'reviews'" x-cloak class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="pb-4 border-b border-slate-100">
            <h3 class="font-black text-slate-900 text-lg">Ulasan & Reputasi Proyek</h3>
            <p class="text-xs text-slate-500">Feedback nyata yang diberikan oleh rekan kolaborasi Anda.</p>
        </div>

        @if($user->reviewsReceived->isEmpty())
            <div class="p-12 text-center space-y-2">
                <p class="text-xs sm:text-sm text-slate-400">Belum ada ulasan yang diterima saat ini.</p>
                <p class="text-[11px] text-slate-400">Selesaikan proyek kolaborasi dengan rekan untuk mulai mengumpulkan review positif!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($user->reviewsReceived as $rev)
                    <div class="p-4 sm:p-5 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-900 text-xs sm:text-sm">{{ $rev->reviewer?->name }}</span>
                                <span class="text-[10px] text-slate-400">&bull; {{ $rev->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center text-amber-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $rev->rating ? '★' : '☆' }}</span>
                                @endfor
                                <span class="text-slate-800 font-bold ml-1.5">{{ $rev->rating }}.0</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $rev->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
