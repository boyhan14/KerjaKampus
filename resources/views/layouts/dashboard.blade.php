@extends('layouts.app')

@section('title', 'Dashboard - KerjaKampus')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 min-h-[calc(100vh-5rem)] flex flex-col md:flex-row gap-6 lg:gap-8 pb-24 md:pb-12">
    
    <!-- Desktop Sleek Sidebar Navigation -->
    <aside class="hidden md:block w-64 lg:w-72 flex-shrink-0">
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-5 sticky top-24 space-y-6">
            
            <!-- User Mini Profile Header -->
            @php
                $user = Auth::user();
                $role = $user->role?->value ?? (is_string($user->role) ? $user->role : 'talent');
            @endphp
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                @if($user->avatar)
                    <img class="h-11 w-11 rounded-2xl object-cover ring-2 ring-indigo-50" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    <div class="h-11 w-11 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white font-black text-sm shadow-xs">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-bold text-slate-900 truncate leading-tight">{{ $user->name }}</h4>
                    <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/60 uppercase tracking-wide">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                        {{ $role }}
                    </span>
                </div>
            </div>

            <nav class="space-y-1 text-sm font-medium">
                @php
                    if (!function_exists('dash_nav_class')) {
                        function dash_nav_class($isActive) {
                            return $isActive 
                                ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-indigo-700 bg-indigo-50/90 font-bold border border-indigo-100/80 transition-all' 
                                : 'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-all';
                        }
                    }
                @endphp

                <!-- Admin Links -->
                @if($role === 'admin')
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest px-3 pt-1 pb-1">Admin Console</div>
                    <a href="{{ route('admin.dashboard') }}" class="{{ dash_nav_class(request()->routeIs('admin.dashboard')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Ringkasan
                    </a>
                    <a href="{{ route('admin.users') }}" class="{{ dash_nav_class(request()->routeIs('admin.users*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Pengguna
                    </a>
                    <a href="{{ route('admin.jobs') }}" class="{{ dash_nav_class(request()->routeIs('admin.jobs*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Lowongan
                    </a>
                    <a href="{{ route('admin.skills') }}" class="{{ dash_nav_class(request()->routeIs('admin.skills*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Skills & Kategori
                    </a>
                    <a href="{{ route('admin.reports') }}" class="{{ dash_nav_class(request()->routeIs('admin.reports*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Laporan
                    </a>
                    <a href="{{ route('admin.reviews') }}" class="{{ dash_nav_class(request()->routeIs('admin.reviews*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Moderasi Review
                    </a>
                @endif

                <!-- Talent Links -->
                @if($role === 'talent')
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest px-3 pt-1 pb-1">Workspace</div>
                    <a href="{{ route('dashboard') }}" class="{{ dash_nav_class(request()->routeIs('dashboard')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('jobs.index') }}" class="{{ dash_nav_class(request()->routeIs('jobs.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Proyek
                    </a>
                    <a href="{{ route('applications.my') }}" class="{{ dash_nav_class(request()->routeIs('applications.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Lamaran Saya
                    </a>
                    <a href="{{ route('projects.index') }}" class="{{ dash_nav_class(request()->routeIs('projects.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Proyek Aktif
                    </a>

                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest px-3 pt-3 pb-1">Portofolio & Skill</div>
                    <a href="{{ route('portfolio.index') }}" class="{{ dash_nav_class(request()->routeIs('portfolio.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Portofolio
                    </a>
                    <a href="{{ route('skills.index') }}" class="{{ dash_nav_class(request()->routeIs('skills.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Keahlian (Skills)
                    </a>
                    <a href="{{ route('reviews.index') }}" class="{{ dash_nav_class(request()->routeIs('reviews.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Review & Reputasi
                    </a>
                @endif

                <!-- Client Links -->
                @if($role === 'client')
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest px-3 pt-1 pb-1">Manajemen Proyek</div>
                    <a href="{{ route('dashboard') }}" class="{{ dash_nav_class(request()->routeIs('dashboard')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('jobs.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-white bg-gradient-to-r from-indigo-600 to-violet-600 font-bold shadow-sm shadow-indigo-500/25 hover:from-indigo-700 hover:to-violet-700 transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        + Pasang Lowongan
                    </a>
                    <a href="{{ route('jobs.my') }}" class="{{ dash_nav_class(request()->routeIs('jobs.my')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Lowongan Saya
                    </a>
                    <a href="{{ route('applications.client') }}" class="{{ dash_nav_class(request()->routeIs('applications.client')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Kandidat Pelamar
                    </a>
                    <a href="{{ route('projects.index') }}" class="{{ dash_nav_class(request()->routeIs('projects.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Proyek Kontrak
                    </a>
                    <a href="{{ route('reviews.index') }}" class="{{ dash_nav_class(request()->routeIs('reviews.*')) }}">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Review Diterima
                    </a>
                @endif
                
                <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest px-3 pt-3 pb-1">Akun</div>
                <a href="{{ route('profile.show') }}" class="{{ dash_nav_class(request()->routeIs('profile.*')) }}">
                    <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Saya
                </a>
                <a href="{{ route('notifications.index') }}" class="{{ dash_nav_class(request()->routeIs('notifications.*')) }} justify-between" x-data="{ unreadCount: 0 }" x-init="fetch('{{ route('notifications.unread-count') }}').then(r => r.json()).then(d => unreadCount = d.count).catch(() => {})">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        Notifikasi
                    </div>
                    <span x-show="unreadCount > 0" x-text="unreadCount" x-cloak class="px-2 py-0.5 text-[10px] font-black bg-rose-500 text-white rounded-full"></span>
                </a>
            </nav>

            <!-- Creator Attribution Badge -->
            <div class="mt-8 p-3.5 rounded-2xl bg-gradient-to-br from-slate-50 via-indigo-50/40 to-slate-50 border border-slate-200/80 text-center shadow-2xs group hover:border-indigo-300 transition-all">
                <div class="text-[9px] font-black text-indigo-600 uppercase tracking-widest flex items-center justify-center gap-1">
                    <span>⚡ Engine & Platform Creator</span>
                </div>
                <a href="https://github.com/boyhan14" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-xs font-bold text-slate-800 hover:text-indigo-600 mt-1 transition-colors">
                    <span>Farkhan Nabiel Makarim</span>
                    <svg class="w-3 h-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                <div class="text-[10px] text-slate-400 mt-0.5 font-medium">KerjaKampus &bull; PKL Production</div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 min-w-0">
        @yield('dashboard-content')
    </main>

</div>

<!-- Modern Glass Mobile Bottom Navigation -->
<nav class="md:hidden fixed bottom-3 left-4 right-4 z-50 bg-white/90 backdrop-blur-xl border border-slate-200/80 rounded-2xl shadow-xl px-3 py-1.5">
    <div class="flex justify-around items-center">
        @php
            $role = Auth::user()->role?->value ?? (is_string(Auth::user()->role) ? Auth::user()->role : 'talent');
        @endphp

        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px] mt-0.5">Home</span>
        </a>

        @if($role === 'talent')
            <a href="{{ route('jobs.index') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('jobs.*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span class="text-[10px] mt-0.5">Proyek</span>
            </a>
            <a href="{{ route('applications.my') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('applications.*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span class="text-[10px] mt-0.5">Lamaran</span>
            </a>
        @elseif($role === 'client')
            <a href="{{ route('jobs.my') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('jobs.my') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="text-[10px] mt-0.5">Lowongan</span>
            </a>
            <a href="{{ route('applications.client') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('applications.client') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="text-[10px] mt-0.5">Pelamar</span>
            </a>
        @elseif($role === 'admin')
            <a href="{{ route('admin.users') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('admin.users*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="text-[10px] mt-0.5">Users</span>
            </a>
            <a href="{{ route('admin.jobs') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('admin.jobs*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="text-[10px] mt-0.5">Jobs</span>
            </a>
        @endif

        <a href="{{ route('notifications.index') }}" class="relative flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('notifications.*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}" x-data="{ unreadCount: 0 }" x-init="fetch('{{ route('notifications.unread-count') }}').then(r => r.json()).then(d => unreadCount = d.count).catch(() => {})">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span x-show="unreadCount > 0" x-cloak class="absolute top-1 right-3 block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
            <span class="text-[10px] mt-0.5">Notif</span>
        </a>

        <a href="{{ route('profile.show') }}" class="flex flex-col items-center justify-center py-1 px-3 rounded-xl transition-colors {{ request()->routeIs('profile.*') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="text-[10px] mt-0.5">Akun</span>
        </a>
    </div>
</nav>
@endsection
