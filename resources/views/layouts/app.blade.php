<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Farkhan Nabiel Makarim">
    <meta name="developer" content="Farkhan Nabiel Makarim">
    <meta name="copyright" content="KerjaKampus - Farkhan Nabiel Makarim">
    <meta name="application-name" content="KerjaKampus">
    <meta property="og:site_name" content="KerjaKampus">
    <meta property="og:title" content="KerjaKampus - Platform Karier & Marketplace Mahasiswa">
    <meta property="og:description" content="Platform marketplace freelance dan proyek karier mahasiswa Indonesia. Dirancang dan dibangun oleh Farkhan Nabiel Makarim.">

    <title>@yield('title', 'KerjaKampus - Platform Karier & Marketplace Mahasiswa')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js (fallback if not in app.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Instrument Sans', sans-serif;
        }
    </style>
</head>
<body class="h-full flex flex-col font-sans antialiased text-slate-800 bg-slate-50 selection:bg-indigo-500 selection:text-white">
    
    <!-- Toast Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 px-4 py-3 text-sm font-medium text-emerald-900 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-200/80 max-w-md w-full mx-auto" role="alert">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="flex-1 text-xs sm:text-sm font-semibold">
                {{ session('success') }}
            </div>
            <button @click="show = false" type="button" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Close">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 7000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 px-4 py-3 text-sm font-medium text-rose-900 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-rose-200/80 max-w-md w-full mx-auto" role="alert">
            <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1 text-xs sm:text-sm font-semibold">
                {{ session('error') }}
            </div>
            <button @click="show = false" type="button" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Close">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Modern Glass Navbar -->
    <nav x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="sticky top-0 z-40 bg-white/85 backdrop-blur-md border-b border-slate-200/80 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20">
                <!-- Brand Logo & Main Nav -->
                <div class="flex items-center gap-8 lg:gap-10">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-600 to-violet-600 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <span class="text-xl sm:text-2xl font-black tracking-tight text-slate-900">
                            Kerja<span class="text-gradient">Kampus</span><span class="inline-block w-1.5 h-1.5 rounded-full bg-indigo-600 ml-0.5"></span>
                        </span>
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ url('/jobs') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->is('jobs*') ? 'text-indigo-600 bg-indigo-50/80 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                            Cari Proyek
                        </a>
                        <a href="{{ url('/talents') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->is('talents*') ? 'text-indigo-600 bg-indigo-50/80 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                            Talenta
                        </a>
                        <a href="{{ url('/how-it-works') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->is('how-it-works*') ? 'text-indigo-600 bg-indigo-50/80 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                            Cara Kerja
                        </a>
                        <a href="{{ url('/pricing') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->is('pricing*') ? 'text-indigo-600 bg-indigo-50/80 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                            Harga
                        </a>
                    </div>
                </div>

                <!-- Right Side (Auth / Guest) -->
                <div class="hidden md:flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/70 rounded-xl transition-all duration-150">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 rounded-xl shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/25 transition-all duration-150 btn-press btn-shine">
                            <span>Daftar Gratis</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @else
                        <!-- Notification Bell with Interactive Dropdown -->
                        <div class="relative" x-data="{ 
                            notifOpen: false, 
                            unreadCount: 0, 
                            notifications: [],
                            loading: false,
                            fetchNotifications() {
                                this.loading = true;
                                fetch('{{ route('notifications.recent') }}')
                                    .then(r => r.json())
                                    .then(data => {
                                        this.unreadCount = data.unread_count;
                                        this.notifications = data.notifications;
                                        this.loading = false;
                                    })
                                    .catch(() => { this.loading = false; });
                            }
                        }" x-init="fetchNotifications()">
                            <button @click="notifOpen = !notifOpen; if(notifOpen) fetchNotifications()" 
                                    type="button" 
                                    class="p-2.5 rounded-xl text-slate-500 hover:text-indigo-600 hover:bg-slate-100/80 transition-all duration-150 relative focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                                <span class="sr-only">Notifikasi</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <!-- Ping badge -->
                                <span x-show="unreadCount > 0" x-cloak class="absolute top-1.5 right-1.5 flex h-4 min-w-[16px] px-1 items-center justify-center">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex items-center justify-center rounded-full h-4 min-w-[16px] px-1 bg-rose-600 text-white text-[9px] font-extrabold shadow-sm" x-text="unreadCount"></span>
                                </span>
                            </button>

                            <!-- Notification Dropdown Panel -->
                            <div x-show="notifOpen" 
                                 @click.away="notifOpen = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 mt-3 w-80 sm:w-96 rounded-2xl shadow-2xl bg-white border border-slate-200/80 z-50 overflow-hidden" 
                                 style="display: none;">
                                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-slate-900">Notifikasi</span>
                                        <span x-show="unreadCount > 0" x-text="unreadCount + ' baru'" class="text-[10px] font-bold bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded-full border border-indigo-100"></span>
                                    </div>
                                    <form action="{{ route('notifications.read-all') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                            Tandai semua dibaca
                                        </button>
                                    </form>
                                </div>

                                <div class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                                    <template x-if="loading && notifications.length === 0">
                                        <div class="py-8 text-center text-xs text-slate-400">Memuat pemberitahuan...</div>
                                    </template>

                                    <template x-if="!loading && notifications.length === 0">
                                        <div class="py-10 text-center px-4">
                                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-2 text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                            </div>
                                            <p class="text-xs text-slate-500 font-medium">Belum ada notifikasi baru</p>
                                        </div>
                                    </template>

                                    <template x-for="item in notifications" :key="item.id">
                                        <a :href="'/notifications/' + item.id" class="p-4 hover:bg-indigo-50/40 transition-colors flex items-start justify-between gap-3 group" :class="{ 'bg-indigo-50/30': !item.is_read }">
                                            <div class="space-y-1 min-w-0 flex-1">
                                                <div class="flex items-center gap-1.5">
                                                    <span x-show="!item.is_read" class="w-2 h-2 rounded-full bg-indigo-600 shrink-0"></span>
                                                    <h5 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition-colors truncate" :class="{ 'text-indigo-950 font-black': !item.is_read }" x-text="item.title"></h5>
                                                </div>
                                                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed" x-text="item.message"></p>
                                                <div class="flex items-center gap-2 pt-0.5">
                                                    <span class="text-[10px] text-slate-400 font-medium" x-text="item.time"></span>
                                                    <span class="text-[10px] font-bold text-indigo-600 group-hover:underline">&bull; Buka & Baca &rarr;</span>
                                                </div>
                                            </div>
                                            <span class="text-slate-300 group-hover:text-indigo-600 transition-colors shrink-0 text-xs mt-1">&rarr;</span>
                                        </a>
                                    </template>
                                </div>

                                <div class="p-2.5 border-t border-slate-100 bg-slate-50/50 text-center">
                                    <a href="{{ route('notifications.index') }}" class="inline-block w-full py-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-xl transition-colors">
                                        Lihat Semua Notifikasi &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="relative">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    @click.away="userMenuOpen = false" 
                                    type="button" 
                                    class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-slate-100/80 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                                @if(Auth::user()->avatar)
                                    <img class="h-8 w-8 rounded-xl object-cover ring-1 ring-slate-200" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="text-left hidden lg:block">
                                    <p class="text-xs font-bold text-slate-900 leading-tight">{{ Str::limit(Auth::user()->name, 14) }}</p>
                                    <p class="text-[10px] font-semibold text-indigo-600 capitalize">
                                        {{ Auth::user()->role?->value ?? (is_string(Auth::user()->role) ? Auth::user()->role : 'User') }}
                                    </p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- User Dropdown Menu -->
                            <div x-show="userMenuOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 mt-3 w-56 rounded-2xl shadow-2xl bg-white border border-slate-200/80 py-2 z-50" 
                                 style="display: none;">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 capitalize">
                                            {{ Auth::user()->role?->value ?? (is_string(Auth::user()->role) ? Auth::user()->role : 'User') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="py-1">
                                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Dashboard
                                    </a>
                                    <a href="{{ url('/profile') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Profil Saya
                                    </a>
                                    
                                    @if(Auth::user()->isTalent())
                                        <a href="{{ url('/my-applications') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Lamaran Saya
                                        </a>
                                        <a href="{{ route('projects.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            Proyek Saya
                                        </a>
                                    @elseif(Auth::user()->isClient())
                                        <a href="{{ url('/my-jobs') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            Lowongan Saya
                                        </a>
                                        <a href="{{ route('applications.client') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                            Kandidat Pelamar
                                        </a>
                                        <a href="{{ route('projects.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                            Proyek Aktif
                                        </a>
                                    @elseif(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-indigo-700 bg-indigo-50/50 hover:bg-indigo-50 transition-colors">
                                            <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                            Admin Console
                                        </a>
                                    @endif
                                </div>

                                <div class="pt-1 border-t border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2.5 w-full text-left px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Keluar (Logout)
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center gap-2 md:hidden">
                    @auth
                        <a href="{{ route('notifications.index') }}" class="p-2 rounded-xl text-slate-500 hover:text-indigo-600 hover:bg-slate-100 relative">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </a>
                    @endauth
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka Menu</span>
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden border-b border-slate-200 bg-white/95 backdrop-blur-lg px-4 pt-2 pb-6 space-y-3" 
             id="mobile-menu" 
             style="display: none;">
            <div class="space-y-1">
                <a href="{{ url('/jobs') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->is('jobs*') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Cari Proyek</a>
                <a href="{{ url('/talents') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->is('talents*') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Talenta Mahasiswa</a>
                <a href="{{ url('/how-it-works') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->is('how-it-works*') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Cara Kerja</a>
                <a href="{{ url('/pricing') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->is('pricing*') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Biaya & Harga</a>
            </div>
            
            @guest
                <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-700 hover:bg-slate-50">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-500/20 btn-shine">
                        Daftar Gratis
                    </a>
                </div>
            @else
                <div class="pt-3 border-t border-slate-100 space-y-1">
                    <div class="px-3 py-2 flex items-center gap-3">
                        <div class="h-9 w-9 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50">Dashboard</a>
                    <a href="{{ url('/profile') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-sm font-semibold text-rose-600 hover:bg-rose-50">
                            Keluar (Logout)
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </nav>

    <!-- ✦ PREMIUM RUNNING TEXT / LIVE TICKER ✦ -->
    <div style="position:relative;overflow:hidden;z-index:30;">
        <!-- Animated gradient border line on top -->
        <div style="height:2px;background:linear-gradient(90deg,#4f46e5,#a855f7,#ec4899,#f59e0b,#a855f7,#4f46e5);background-size:300% 100%;animation:ticker-border 4s linear infinite;"></div>
        <style>@keyframes ticker-border{0%{background-position:0% 50%}100%{background-position:300% 50%}}</style>

        <div style="background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#0f172a 100%);padding:10px 0;border-bottom:1px solid rgba(99,102,241,0.15);">
            <div style="max-width:80rem;margin:0 auto;padding:0 1rem;display:flex;align-items:center;gap:12px;">

                <!-- Premium Live Badge -->
                <div style="flex-shrink:0;display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:9999px;background:linear-gradient(135deg,rgba(99,102,241,0.25),rgba(168,85,247,0.2));border:1px solid rgba(129,140,248,0.3);backdrop-filter:blur(8px);font-size:10px;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;color:#c7d2fe;">
                    <span style="position:relative;display:inline-flex;width:7px;height:7px;">
                        <span style="position:absolute;inset:0;border-radius:9999px;background:#34d399;opacity:0.75;animation:ping 1.5s cubic-bezier(0,0,0.2,1) infinite;"></span>
                        <span style="position:relative;display:inline-block;width:7px;height:7px;border-radius:9999px;background:#34d399;box-shadow:0 0 6px #34d399;"></span>
                    </span>
                    <style>@keyframes ping{75%,100%{transform:scale(2);opacity:0}}</style>
                    <span>Live</span>
                </div>

                <!-- Ticker Track Container -->
                <div style="overflow:hidden;flex:1;-webkit-mask-image:linear-gradient(90deg,transparent 0%,#000 4%,#000 96%,transparent 100%);mask-image:linear-gradient(90deg,transparent 0%,#000 4%,#000 96%,transparent 100%);">
                    <div id="ticker-track" style="display:flex;width:max-content;animation:ticker-move 45s linear infinite;will-change:transform;">
                        <style>@keyframes ticker-move{from{transform:translate3d(0,0,0)}to{transform:translate3d(-50%,0,0)}}</style>

                        <!-- Items Group 1 -->
                        <div style="display:flex;align-items:center;gap:28px;white-space:nowrap;padding-right:28px;font-size:12px;color:#cbd5e1;">
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#4f46e5,#7c3aed);font-size:11px;">🚀</span>
                                <strong style="color:#e0e7ff;">Proyek Baru</strong>
                                <span style="color:#94a3b8;">Fullstack Developer E-Learning — <span style="color:#a5b4fc;font-weight:700;">Rp 8.500.000</span></span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#059669,#10b981);font-size:11px;">⚡</span>
                                <strong style="color:#e0e7ff;">1.250+ Talenta</strong>
                                <span style="color:#94a3b8;">Mahasiswa aktif siap kerja & magang</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#d97706,#f59e0b);font-size:11px;">✨</span>
                                <strong style="color:#fde68a;">Promo</strong>
                                <span style="color:#94a3b8;">Komisi 0% untuk proyek pertama!</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#7c3aed,#a855f7);font-size:11px;">🤖</span>
                                <strong style="color:#e0e7ff;">AI Copilot</strong>
                                <span style="color:#94a3b8;">Analisis CV & Portfolio otomatis</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#0284c7,#38bdf8);font-size:11px;">🎓</span>
                                <strong style="color:#e0e7ff;">50+ Kampus</strong>
                                <span style="color:#94a3b8;">ITB, UI, UGM, ITS, BINUS, Telkom</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#e11d48,#f43f5e);font-size:11px;">⭐</span>
                                <strong style="color:#e0e7ff;">Rating 4.9/5.0</strong>
                                <span style="color:#94a3b8;">Dipercaya ribuan mahasiswa se-Indonesia</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                        </div>

                        <!-- Items Group 2 (Duplicate for seamless loop) -->
                        <div style="display:flex;align-items:center;gap:28px;white-space:nowrap;padding-right:28px;font-size:12px;color:#cbd5e1;">
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#4f46e5,#7c3aed);font-size:11px;">🚀</span>
                                <strong style="color:#e0e7ff;">Proyek Baru</strong>
                                <span style="color:#94a3b8;">Fullstack Developer E-Learning — <span style="color:#a5b4fc;font-weight:700;">Rp 8.500.000</span></span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#059669,#10b981);font-size:11px;">⚡</span>
                                <strong style="color:#e0e7ff;">1.250+ Talenta</strong>
                                <span style="color:#94a3b8;">Mahasiswa aktif siap kerja & magang</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#d97706,#f59e0b);font-size:11px;">✨</span>
                                <strong style="color:#fde68a;">Promo</strong>
                                <span style="color:#94a3b8;">Komisi 0% untuk proyek pertama!</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#7c3aed,#a855f7);font-size:11px;">🤖</span>
                                <strong style="color:#e0e7ff;">AI Copilot</strong>
                                <span style="color:#94a3b8;">Analisis CV & Portfolio otomatis</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#0284c7,#38bdf8);font-size:11px;">🎓</span>
                                <strong style="color:#e0e7ff;">50+ Kampus</strong>
                                <span style="color:#94a3b8;">ITB, UI, UGM, ITS, BINUS, Telkom</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                            <span style="display:inline-flex;align-items:center;gap:8px;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:8px;background:linear-gradient(135deg,#e11d48,#f43f5e);font-size:11px;">⭐</span>
                                <strong style="color:#e0e7ff;">Rating 4.9/5.0</strong>
                                <span style="color:#94a3b8;">Dipercaya ribuan mahasiswa se-Indonesia</span>
                            </span>
                            <span style="color:#334155;font-size:8px;">◆</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Modern Clean Footer -->
    <footer class="bg-white border-t border-slate-200/80 mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-4 xl:gap-12">
                <div class="space-y-4 xl:col-span-1">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white shadow-xs">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-black text-slate-900 tracking-tight">
                            Kerja<span class="text-gradient">Kampus</span>
                        </span>
                    </div>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Platform marketplace karier dan gig terdepan yang menghubungkan mahasiswa berbakat Indonesia dengan UMKM, startup, dan klien profesional.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-slate-400">
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Sistem 100% Aktif
                        </span>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-8 xl:mt-0 xl:col-span-3">
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Eksplorasi</h4>
                        <ul role="list" class="mt-4 space-y-2.5 text-xs sm:text-sm">
                            <li><a href="{{ url('/jobs') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Lowongan & Proyek</a></li>
                            <li><a href="{{ url('/talents') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Direktori Talenta</a></li>
                            <li><a href="{{ url('/how-it-works') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Cara Mendaftar</a></li>
                            <li><a href="{{ url('/pricing') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Skema Biaya</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Kategori Populer</h4>
                        <ul role="list" class="mt-4 space-y-2.5 text-xs sm:text-sm">
                            <li><a href="{{ url('/jobs?search=Web') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Web Development</a></li>
                            <li><a href="{{ url('/jobs?search=UI%2FUX') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">UI/UX Design</a></li>
                            <li><a href="{{ url('/jobs?search=Content') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Content Writing</a></li>
                            <li><a href="{{ url('/jobs?search=Data') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Data Science</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Bantuan & Legal</h4>
                        <ul role="list" class="mt-4 space-y-2.5 text-xs sm:text-sm">
                            <li><a href="{{ url('/how-it-works') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Pusat Bantuan (FAQ)</a></li>
                            <li><a href="{{ url('/how-it-works') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="{{ url('/how-it-works') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">Kebijakan Privasi</a></li>
                            <li><a href="mailto:support@kerjakampus.com" class="text-slate-500 hover:text-indigo-600 transition-colors">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <div>
                    <p>&copy; {{ date('Y') }} KerjaKampus Platform. Hak Cipta Dilindungi.</p>
                    <p class="text-[11px] text-slate-400 mt-1">
                        Dirancang & Dikembangkan oleh <a href="https://github.com/boyhan14" target="_blank" rel="noopener noreferrer" class="font-bold text-slate-800 hover:text-indigo-600 transition-colors underline decoration-indigo-300 underline-offset-2">Farkhan Nabiel Makarim</a>
                    </p>
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <a href="https://github.com/boyhan14" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-700 hover:text-indigo-600 bg-slate-100 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-200/80 px-3 py-1 rounded-xl transition-all shadow-2xs">
                        <span>🚀 Created by Farkhan Nabiel Makarim</span>
                        <span class="text-[9px] text-slate-400">&nearr;</span>
                    </a>
                    <span>🇮🇩 Indonesia</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
