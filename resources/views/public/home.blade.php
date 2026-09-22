@extends('layouts.app')

@section('title', 'KerjaKampus - Platform Karier & Marketplace Proyek Mahasiswa')

@section('content')
<!-- Top Announcement Running Text (Marquee Ticker) -->
<div class="bg-gradient-to-r from-slate-950 via-indigo-950 to-slate-950 text-white py-2.5 overflow-hidden border-b border-indigo-900/40 relative z-20 shadow-inner">
    <div class="ticker-fade relative w-full overflow-hidden">
        <div class="ticker-track flex items-center gap-8 whitespace-nowrap text-xs font-semibold">
            @for($repeat = 0; $repeat < 2; $repeat++)
                <div class="flex items-center gap-8 shrink-0">
                    <span class="inline-flex items-center gap-2 text-indigo-300 font-bold bg-indigo-900/60 px-2.5 py-0.5 rounded-full border border-indigo-700/50">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span>INFO TERKINI</span>
                    </span>
                    <span class="text-slate-200">🔥 <strong class="text-white font-extrabold">100% Bebas Biaya Komisi</strong> untuk Klien & Mahasiswa Periode Launching!</span>
                    <span class="text-indigo-400/50">•</span>
                    <span class="text-slate-200">🎓 Terhubung dengan Mahasiswa dari <strong class="text-white font-extrabold">50+ Perguruan Tinggi</strong> Seluruh Indonesia</span>
                    <span class="text-indigo-400/50">•</span>
                    <span class="text-slate-200">⚡ Ratusan Peluang Proyek Freelance, Gig & Magang Dibuka Setiap Hari</span>
                    <span class="text-indigo-400/50">•</span>
                    <span class="text-slate-200">🛡️ Kontrak Kerja Kolaborasi Aman & Transparan</span>
                    <span class="text-indigo-400/50">•</span>
                    <span class="text-slate-200">🚀 Bangun Portofolio Nyata Sebelum Wisuda & Dapatkan Cuan Mandiri</span>
                    <span class="text-indigo-400/50">•</span>
                </div>
            @endfor
        </div>
    </div>
</div>

<!-- Hero Section with Ambient Background & Floating Badges -->
<section class="relative overflow-hidden pt-14 pb-24 lg:pt-24 lg:pb-36 bg-gradient-to-b from-indigo-50/40 via-white to-slate-50">
    <!-- Ambient Morphing Blobs -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-32 left-1/4 w-[450px] h-[450px] bg-gradient-to-tr from-indigo-400/20 via-purple-400/20 to-pink-300/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-20 right-1/4 w-[400px] h-[400px] bg-gradient-to-br from-violet-400/20 via-sky-300/20 to-emerald-300/20 rounded-full blur-3xl animate-blob-delayed"></div>
    </div>

    <!-- Floating Interactive Element: Left Top -->
    <div class="hidden lg:flex items-center gap-3 absolute top-28 left-8 xl:left-24 p-3 pr-4 rounded-2xl bg-white/90 backdrop-blur-md border border-slate-200/80 shadow-xl shadow-indigo-500/10 animate-float pointer-events-none z-10">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
            🎯
        </div>
        <div class="text-left">
            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 block">Proyek Baru Rilis</span>
            <span class="text-xs font-bold text-slate-800">UI/UX Mobile App</span>
            <span class="text-[10px] font-bold text-emerald-600 block">Rp 3.500.000</span>
        </div>
    </div>

    <!-- Floating Interactive Element: Right Top -->
    <div class="hidden lg:flex items-center gap-3 absolute top-36 right-8 xl:right-24 p-3 pr-4 rounded-2xl bg-white/90 backdrop-blur-md border border-slate-200/80 shadow-xl shadow-purple-500/10 animate-float-delayed pointer-events-none z-10">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 to-orange-500 text-white flex items-center justify-center font-bold text-base shadow-sm">
            ⭐
        </div>
        <div class="text-left">
            <span class="text-[10px] font-black uppercase tracking-wider text-amber-600 block">Review Klien Terbaru</span>
            <div class="flex items-center text-amber-400 text-xs">★★★★★</div>
            <span class="text-[10px] font-bold text-slate-700 block">"Kualitas pengerjaan luar biasa!"</span>
        </div>
    </div>

    <!-- Floating Interactive Element: Bottom Left -->
    <div class="hidden xl:flex items-center gap-3 absolute bottom-24 left-16 p-3 pr-4 rounded-2xl bg-white/90 backdrop-blur-md border border-slate-200/80 shadow-xl shadow-emerald-500/10 animate-float-reverse pointer-events-none z-10">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
            💸
        </div>
        <div class="text-left">
            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600 block">Kompensasi Cair</span>
            <span class="text-xs font-bold text-slate-800">100% Bebas Potongan</span>
            <span class="text-[10px] font-semibold text-slate-400 block">Early Access Promo</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            
            <!-- Animated Pill Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50/90 border border-indigo-100 text-indigo-700 text-xs font-bold mb-8 shadow-xs hover:scale-105 transition-transform cursor-default">
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span>Marketplace Talenta Mahasiswa & Fresh Graduate #1</span>
            </div>

            <!-- Main Heading with Animated Gradient Text -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
                Ubah Skill Kuliah Jadi <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 animate-gradient">
                    Peluang Karier & Cuan Nyata.
                </span>
            </h1>

            <p class="text-base sm:text-lg text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto font-medium">
                Temukan proyek freelance, gig fleksibel, dan magang dari ratusan klien & UMKM. Bangun portofolio profesional nyata sebelum wisuda.
            </p>

            <!-- Dual Action CTAs with Shimmer Hover -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-12">
                <a href="{{ url('/jobs') }}" class="relative group overflow-hidden w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 text-white font-black text-sm sm:text-base shadow-xl shadow-indigo-600/25 hover:shadow-2xl hover:shadow-indigo-600/35 transition-all btn-press btn-shine animate-glow-pulse">
                    <!-- Shimmer light reflection effect -->
                    <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></span>
                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Cari Proyek Tersedia</span>
                </a>

                <a href="{{ url('/register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-white border-2 border-slate-200/90 hover:border-indigo-400 text-slate-800 hover:text-indigo-600 hover:bg-slate-50 font-bold text-sm sm:text-base shadow-xs hover:shadow-md transition-all btn-press box-shine">
                    <span>Pasang Lowongan / Rekrut</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Social Proof Bar -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-4 border-t border-slate-200/60">
                <div class="flex -space-x-2.5 overflow-hidden">
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-indigo-600 text-white flex items-center justify-center text-xs font-black shadow-xs">A</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-emerald-600 text-white flex items-center justify-center text-xs font-black shadow-xs">S</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-amber-500 text-white flex items-center justify-center text-xs font-black shadow-xs">R</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-rose-500 text-white flex items-center justify-center text-xs font-black shadow-xs">D</span>
                </div>
                <div class="text-xs text-slate-500 font-semibold text-left">
                    <div class="flex items-center gap-1 text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-slate-800 font-black ml-1 text-xs">4.9 / 5.0</span>
                    </div>
                    <span class="text-[11px] text-slate-500">Dipercaya mahasiswa dari 50+ universitas se-Indonesia</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Floating Platform Stats -->
<section class="relative z-20 -mt-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-2xl shadow-indigo-600/10 border border-slate-200/80 grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 box-shine premium-border">
        <div class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50/80 transition-colors">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ number_format($talentCount ?? 0) }}+</p>
                <p class="text-xs font-bold text-slate-500">Talenta Mahasiswa</p>
            </div>
        </div>

        <div class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50/80 transition-colors">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ number_format($jobCount ?? 0) }}+</p>
                <p class="text-xs font-bold text-slate-500">Lowongan Proyek</p>
            </div>
        </div>

        <div class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50/80 transition-colors">
            <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ number_format($skillCount ?? 0) }}+</p>
                <p class="text-xs font-bold text-slate-500">Skill Terverifikasi</p>
            </div>
        </div>

        <div class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50/80 transition-colors">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">100%</p>
                <p class="text-xs font-bold text-slate-500">Proyek Terverifikasi</p>
            </div>
        </div>
    </div>
</section>

<!-- Full-Width Interactive Running Text (Skill & Campus Marquee) -->
<section class="py-14 bg-white border-y border-slate-200/80 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-2 border border-indigo-100/60">
            <span>✨ Bidang Spesialisasi & Jaringan Kampus</span>
        </div>
        <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Keahlian Populer & Kolaborasi Universitas Indonesia</h3>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Dapatkan talenta mahasiswa terverifikasi dari puluhan perguruan tinggi unggulan.</p>
    </div>

    <!-- Ticker Row 1: Trending Skills & Roles (Scrolls Left) -->
    <div class="ticker-fade relative w-full overflow-hidden mb-3.5">
        <div class="ticker-track flex items-center gap-3 whitespace-nowrap">
            @for($repeat = 0; $repeat < 2; $repeat++)
                <div class="flex items-center gap-3 shrink-0">
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>🚀</span> Fullstack Web Developer (Laravel, Vue & React)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>🎨</span> UI/UX Designer & Figma Interactive Prototype
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>📱</span> Mobile Apps Developer (Flutter & Kotlin)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>🎬</span> Video Editor Reels, TikTok & Motion Graphics
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>🤖</span> AI Prompt Engineer & Business Automation
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>📊</span> Data Analyst & Python Scraper
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>✍️</span> SEO Content Writer & Copywriter
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>📢</span> Social Media Specialist & Ads Campaign
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-300 text-xs font-bold text-slate-800 transition-colors shadow-2xs">
                        <span>🖌️</span> 3D Illustration & Visual Branding Identity
                    </span>
                </div>
            @endfor
        </div>
    </div>

    <!-- Ticker Row 2: Campus Network (Scrolls Right - Reverse) -->
    <div class="ticker-fade relative w-full overflow-hidden">
        <div class="ticker-track-reverse flex items-center gap-3 whitespace-nowrap">
            @for($repeat = 0; $repeat < 2; $repeat++)
                <div class="flex items-center gap-3 shrink-0">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Indonesia (UI)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Institut Teknologi Bandung (ITB)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Gadjah Mada (UGM)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Institut Teknologi Sepuluh Nopember (ITS)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Diponegoro (Undip)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Brawijaya (UB)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Binus University
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Telkom University
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Airlangga (Unair)
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 text-xs font-bold text-indigo-900 shadow-2xs transition-colors">
                        <span>🏛️</span> Universitas Padjadjaran (Unpad)
                    </span>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Trending Jobs Section -->
<section class="py-20 lg:py-28 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span> Peluang Terkini
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Proyek Trending Minggu Ini</h2>
                <p class="text-sm sm:text-base text-slate-500 mt-2">Dapatkan tawaran kerja remote, freelance, dan part-time dengan kompensasi transparan.</p>
            </div>
            <a href="{{ url('/jobs') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors group">
                <span>Lihat Semua Lowongan</span>
                <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredJobs ?? [] as $job)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover box-shine flex flex-col justify-between hover:border-indigo-300 transition-all group">
                <div>
                    <!-- Header Info & Category -->
                    <div class="flex items-start justify-between gap-3 mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/60">
                            {{ $job->category?->name ?? 'Umum' }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">
                                {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? ($job->job_type ?? 'Freelance'))) }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ ucfirst($job->work_mode->value ?? ($job->work_mode ?? 'Remote')) }}
                            </span>
                        </div>
                    </div>

                    <!-- Job Title -->
                    <h3 class="text-lg font-black text-slate-900 mb-2 leading-snug line-clamp-2 group-hover:text-indigo-600 transition-colors">
                        <a href="{{ route('jobs.show', is_object($job) ? ($job->slug ?? $job->id) : $job) }}">
                            {{ is_object($job) ? $job->title : $job }}
                        </a>
                    </h3>

                    <!-- Client Name -->
                    <p class="text-xs text-slate-500 mb-4 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $job->client?->company_name ?? ($job->client?->name ?? 'Klien Terverifikasi') }}
                    </p>

                    <!-- Budget Range -->
                    <div class="p-3.5 rounded-2xl bg-gradient-to-r from-slate-50 to-indigo-50/30 border border-slate-100 mb-5">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block">Estimasi Kompensasi</span>
                        <span class="text-base font-black text-indigo-600">
                            Rp {{ number_format($job->budget_min ?? 0, 0, ',', '.') }} - {{ number_format($job->budget_max ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Skills Chips -->
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        @foreach(collect($job->skills ?? [])->take(3) as $skill)
                            <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">
                                {{ $skill->name ?? $skill }}
                            </span>
                        @endforeach
                        @if(count($job->skills ?? []) > 3)
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-400 text-xs font-medium">
                                +{{ count($job->skills) - 3 }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Deadline: {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Fleksibel' }}</span>
                    <a href="{{ route('jobs.show', is_object($job) ? ($job->slug ?? $job->id) : $job) }}" class="font-black text-indigo-600 hover:text-indigo-800 transition-colors inline-flex items-center gap-1 group-hover:translate-x-1">
                        Detail &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-slate-200">
                <p class="text-slate-500 font-medium text-sm">Belum ada proyek terbaru saat ini. Silakan cek kembali nanti!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- How It Works Section with Interactive Number Badges -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span> Panduan Mudah
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Bagaimana Cara Kerjanya?</h2>
            <p class="text-sm sm:text-base text-slate-500 mt-2">Mulai langkah karier freelance Anda hanya dalam 4 langkah sederhana.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="p-7 rounded-3xl bg-slate-50/80 border border-slate-100 relative group hover:bg-white hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                <div class="relative w-14 h-14 mb-6">
                    <div class="absolute inset-0 rounded-2xl bg-indigo-600/20 animate-ping group-hover:animate-none"></div>
                    <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                        01
                    </div>
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-2">Lengkapi Profil</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Daftar gratis, isi riwayat pendidikan kampus, portofolio karya, dan keahlian yang kamu kuasai.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-7 rounded-3xl bg-slate-50/80 border border-slate-100 relative group hover:bg-white hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                <div class="relative w-14 h-14 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                        02
                    </div>
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-2">Pilih Proyek Cocok</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gunakan filter pencarian cerdas atau AI Job Matcher untuk menemukan lowongan yang pas dengan skillmu.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-7 rounded-3xl bg-slate-50/80 border border-slate-100 relative group hover:bg-white hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                <div class="relative w-14 h-14 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                        03
                    </div>
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-2">Ajukan Proposal</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Kirim penawaran menarik, tentukan estimasi waktu & harga. Klien akan meninjau dan menerima proposalmu.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-7 rounded-3xl bg-slate-50/80 border border-slate-100 relative group hover:bg-white hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                <div class="relative w-14 h-14 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                        04
                    </div>
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-2">Selesaikan & Nilai</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Selesaikan deliverable, dapatkan pembayaran dan ulasan bintang 5 untuk meningkatkan reputasi profesionalmu.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- AI Career Copilot Section with Radar & Laser Beam Effect -->
<section class="py-20 lg:py-28 bg-slate-950 text-white relative overflow-hidden">
    <!-- Ambient glowing light -->
    <div class="absolute -top-24 right-1/4 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <div class="lg:w-1/2 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/30 text-indigo-400 text-xs font-black">
                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
                    KerjaKampus AI Copilot
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                    Akselerasi Kariermu Dengan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-300 to-pink-400 animate-gradient">
                        Kecerdasan Buatan.
                    </span>
                </h2>
                <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                    Kami melengkapi setiap mahasiswa dengan AI Career Assistant yang menganalisis gap keahlian, membedah CV agar lolos seleksi, dan merekomendasikan lowongan yang paling relevan.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-indigo-500/50 transition-colors">
                        <div class="w-8 h-8 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-xs mb-3">🎯</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">Smart Job Matching</h4>
                        <p class="text-xs text-slate-400">Pencocokan algoritma otomatis lowongan dengan skill profil Anda.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-purple-500/50 transition-colors">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/20 text-violet-400 flex items-center justify-center font-bold text-xs mb-3">📄</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">CV & Resume Analyzer</h4>
                        <p class="text-xs text-slate-400">Dapatkan saran perbaikan kalimat dan kata kunci agar menarik bagi klien.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-emerald-500/50 transition-colors">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs mb-3">✍️</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">AI Portfolio Writer</h4>
                        <p class="text-xs text-slate-400">Buat deskripsi portofolio yang profesional dan menjual dalam hitungan detik.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-amber-500/50 transition-colors">
                        <div class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-xs mb-3">📈</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">Career Trajectory</h4>
                        <p class="text-xs text-slate-400">Insight roadmap keahlian yang paling banyak dicari di industri saat ini.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ url('/register') }}" class="inline-flex items-center gap-2 px-7 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-500 hover:to-purple-500 text-white font-black text-sm shadow-xl shadow-indigo-600/30 transition-all btn-press btn-shine animate-glow-pulse">
                        <span>Coba AI Assistant Sekarang</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- AI Interactive Preview Card with Scanning Beam -->
            <div class="lg:w-1/2 w-full">
                <div class="relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-slate-900/95 border border-slate-800 shadow-2xl space-y-4 box-shine box-shine-dark animate-glow-pulse">
                    <!-- Laser scanline animation -->
                    <div class="absolute inset-x-0 h-1 bg-gradient-to-r from-transparent via-indigo-400 to-transparent opacity-50 animate-scanline pointer-events-none"></div>

                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        </div>
                        <span class="text-xs font-mono text-indigo-400 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            ai_career_copilot.py
                        </span>
                    </div>

                    <div class="space-y-3 font-mono text-xs">
                        <div class="p-3.5 rounded-2xl bg-slate-950/80 border border-slate-800 text-indigo-300">
                            &gt; Menganalisis profil mahasiswa: <span class="text-white font-bold">Andi Pratama</span><br>
                            &gt; Jurusan: Teknik Informatika • Pengalaman: 1 Tahun
                        </div>

                        <div class="p-4 rounded-2xl bg-indigo-950/40 border border-indigo-800/50 text-slate-300 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-indigo-400 font-bold">Skor Kecocokan Proyek</span>
                                <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-bold text-xs">
                                    94% Sangat Cocok
                                </span>
                            </div>
                            <p class="text-xs text-slate-300 font-sans leading-relaxed">
                                "Profil Anda memiliki skill kuat di Laravel & Tailwind CSS yang dibutuhkan pada lowongan 'Fullstack Web App UMKM'."
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800 text-slate-400 space-y-1">
                            <span class="text-amber-400 font-bold flex items-center gap-1">
                                💡 Rekomendasi AI:
                            </span>
                            <p class="text-xs font-sans text-slate-300 leading-relaxed">
                                Tambahkan 1 karya portofolio terkait API Integration untuk memperbesar peluang diterima hingga 2.5x lipat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Talents Section -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span> Talenta Unggulan
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Talenta Mahasiswa Berprestasi</h2>
                <p class="text-sm sm:text-base text-slate-500 mt-2">Pilih mahasiswa dengan keahlian terverifikasi dan siap bekerja secara profesional.</p>
            </div>
            <a href="{{ url('/talents') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors group">
                <span>Eksplorasi Semua Talenta</span>
                <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($topTalents ?? [] as $talent)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 text-center shadow-xs card-hover flex flex-col justify-between hover:border-indigo-300 transition-all group">
                <div>
                    <!-- Avatar with Hover Zoom -->
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        @if($talent->avatar)
                            <img class="w-20 h-20 rounded-2xl object-cover ring-2 ring-indigo-50 group-hover:scale-105 transition-transform" src="{{ asset('storage/' . $talent->avatar) }}" alt="{{ $talent->name }}" width="80" height="80" loading="lazy" decoding="async">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white font-black text-2xl shadow-xs group-hover:scale-105 transition-transform">
                                {{ substr($talent->name ?? 'A', 0, 1) }}
                            </div>
                        @endif
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 ring-2 ring-white flex items-center justify-center text-white text-[10px] font-bold">
                            ✓
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        <a href="{{ route('talents.show', is_object($talent) ? ($talent->username ?? $talent->id) : $talent) }}">{{ is_object($talent) ? $talent->name : $talent }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 mb-3">{{ is_object($talent) ? ($talent->location ?? 'Indonesia') : 'Indonesia' }}</p>

                    <!-- Rating Stars -->
                    <div class="flex items-center justify-center gap-1 text-amber-400 mb-3">
                        @php $avgRating = (is_object($talent) && method_exists($talent, 'averageRating')) ? $talent->averageRating() : 5; @endphp
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= ($avgRating > 0 ? $avgRating : 5) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-xs font-bold text-slate-700 ml-1">{{ number_format($avgRating > 0 ? $avgRating : 5, 1) }}</span>
                    </div>

                    <p class="text-xs text-slate-500 line-clamp-2 mb-4 leading-relaxed">
                        {{ is_object($talent) ? ($talent->bio ?? 'Mahasiswa antusias yang siap mengerjakan proyek dengan penuh dedikasi.') : '' }}
                    </p>

                    <!-- Skills -->
                    <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                        @foreach(collect(is_object($talent) ? ($talent->skills ?? []) : [])->take(3) as $skill)
                            <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-semibold">
                                {{ is_object($skill) ? ($skill->name ?? $skill) : $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('talents.show', is_object($talent) ? ($talent->username ?? $talent->id) : $talent) }}" class="w-full py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition-all">
                    Lihat Profil & Portofolio
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-400 text-sm">
                Profil talenta sedang diperbarui.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Final Call To Action Banner -->
<section class="py-20 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-800 text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
        <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
            Peluang Terbaik Menanti.<br>Mulai Kariermu Sekarang.
        </h2>
        <p class="text-sm sm:text-base text-indigo-100 max-w-xl mx-auto">
            Bergabunglah dengan ekosistem KerjaKampus hari ini. Gratis pendaftaran untuk talenta maupun klien.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-2">
            <a href="{{ url('/register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white text-indigo-700 font-black text-sm shadow-xl hover:bg-slate-50 transition-all btn-press btn-shine btn-shine-dark animate-glow-gold">
                Daftar Akun Sekarang
            </a>
            <a href="{{ url('/jobs') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-indigo-500/30 border border-white/30 text-white font-bold text-sm hover:bg-indigo-500/40 transition-all btn-shine">
                Cari Proyek
            </a>
        </div>
    </div>
</section>
@endsection
