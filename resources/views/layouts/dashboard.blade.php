@extends('layouts.app')

@section('title', 'Dashboard - KerjaKampus')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 h-full flex flex-col md:flex-row gap-8 pb-24 md:pb-8">
    
    <!-- Desktop Sidebar Navigation -->
    <aside class="hidden md:block w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
            <nav class="flex flex-col p-4 space-y-1">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-3">Menu</div>
                
                @php
                    if (!function_exists('current_path_active')) {
                        function current_path_active($path) {
                            $isActive = request()->is($path . '*');
                            return $isActive 
                                ? 'bg-indigo-50 text-indigo-700' 
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
                        }
                    }
                    $user = Auth::user();
                    $role = $user->role?->value ?? ($user->role ?? 'talent');
                    $currentRoute = request()->path();
                @endphp

                <!-- Admin Links -->
                @if($role === 'admin')
                    <a href="{{ url('/dashboard') }}" class="{{ current_path_active('dashboard') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ url('/admin/users') }}" class="{{ current_path_active('admin/users') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        Users
                    </a>
                    <a href="{{ url('/admin/jobs') }}" class="{{ current_path_active('admin/jobs') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        Jobs
                    </a>
                    <a href="{{ url('/admin/skills') }}" class="{{ current_path_active('admin/skills') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        Skills
                    </a>
                    <a href="{{ url('/admin/categories') }}" class="{{ current_path_active('admin/categories') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        Categories
                    </a>
                    <a href="{{ url('/admin/reports') }}" class="{{ current_path_active('admin/reports') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Reports
                    </a>
                @endif

                <!-- Talent Links -->
                @if($role === 'talent')
                    <a href="{{ url('/dashboard') }}" class="{{ current_path_active('dashboard') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Dashboard
                    </a>
                    <a href="{{ url('/jobs') }}" class="{{ current_path_active('jobs') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        Find Jobs
                    </a>
                    <a href="{{ url('/my-applications') }}" class="{{ current_path_active('my-applications') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        My Applications
                    </a>
                    <a href="{{ url('/my-projects') }}" class="{{ current_path_active('my-projects') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        My Projects
                    </a>
                    <a href="{{ url('/my-portfolio') }}" class="{{ current_path_active('my-portfolio') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        My Portfolio
                    </a>
                @endif

                <!-- Client Links -->
                @if($role === 'client')
                    <a href="{{ url('/dashboard') }}" class="{{ current_path_active('dashboard') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Dashboard
                    </a>
                    <a href="{{ url('/my-jobs') }}" class="{{ current_path_active('my-jobs') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        My Jobs
                    </a>
                    <a href="{{ url('/applications') }}" class="{{ current_path_active('applications') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        Applications
                    </a>
                    <a href="{{ url('/my-projects') }}" class="{{ current_path_active('my-projects') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                        <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        Projects
                    </a>
                @endif
                
                <div class="mt-4 pt-4 border-t border-gray-100"></div>
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-3">Account</div>
                
                <a href="{{ url('/profile') }}" class="{{ current_path_active('profile') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                    <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Profile Settings
                </a>
                <a href="{{ url('/notifications') }}" class="{{ current_path_active('notifications') }} flex items-center px-3 py-2.5 rounded-lg font-medium transition-colors">
                    <svg class="mr-3 h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    Notifications
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 min-w-0">
        @yield('dashboard-content')
    </main>

</div>

<!-- Mobile Bottom Navigation -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 px-2 pb-safe">
    <div class="flex justify-between items-center h-16">
        @php
            $role = Auth::user()->role ?? 'talent';
        @endphp

        <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('dashboard') ? 'text-indigo-600' : '' }}">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            <span class="text-[10px] font-medium mt-1">Home</span>
        </a>

        @if($role === 'talent')
            <a href="{{ url('/jobs') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('jobs*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <span class="text-[10px] font-medium mt-1">Jobs</span>
            </a>
            <a href="{{ url('/my-applications') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('my-applications*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                <span class="text-[10px] font-medium mt-1">Apps</span>
            </a>
        @elseif($role === 'client')
            <a href="{{ url('/my-jobs') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('my-jobs*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                <span class="text-[10px] font-medium mt-1">My Jobs</span>
            </a>
            <a href="{{ url('/applications') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('applications*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <span class="text-[10px] font-medium mt-1">Applicants</span>
            </a>
        @elseif($role === 'admin')
            <a href="{{ url('/admin/users') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('admin/users*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <span class="text-[10px] font-medium mt-1">Users</span>
            </a>
            <a href="{{ url('/admin/jobs') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('admin/jobs*') ? 'text-indigo-600' : '' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                <span class="text-[10px] font-medium mt-1">Jobs</span>
            </a>
        @endif

        <a href="{{ url('/notifications') }}" class="relative flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('notifications') ? 'text-indigo-600' : '' }}" x-data="{ unreadCount: 0 }" x-init="fetch('/notifications/unread-count').then(r => r.json()).then(data => unreadCount = data.count).catch(() => {})">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            <span x-show="unreadCount > 0" x-cloak class="absolute top-1 right-3 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
            <span class="text-[10px] font-medium mt-1">Alerts</span>
        </a>

        <a href="{{ url('/profile') }}" class="flex flex-col items-center justify-center w-full text-gray-500 hover:text-indigo-600 {{ request()->is('profile') ? 'text-indigo-600' : '' }}">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            <span class="text-[10px] font-medium mt-1">Profile</span>
        </a>
    </div>
</nav>
@endsection
