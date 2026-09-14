@extends('layouts.dashboard')

@section('title', 'Talent Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Welcome & Profile Completion Banner -->
    <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                    Talenta KerjaKampus
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Halo, {{ $user->name }}! 👋</h1>
                <p class="text-indigo-100 text-sm sm:text-base max-w-xl">
                    Siap mencari proyek impian dan meningkatkan portofoliomu hari ini? Cek rekomendasi pekerjaan yang sesuai dengan skillmu di bawah.
                </p>
            </div>
            
            <!-- Completion Card -->
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/15 min-w-[260px]">
                <div class="flex items-center justify-between text-sm font-semibold mb-2">
                    <span>Kelengkapan Profil</span>
                    <span class="text-amber-300 font-bold">{{ $profileCompletion }}%</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-400 to-green-400 h-2.5 rounded-full transition-all duration-500" style="width: {{ $profileCompletion }}%"></div>
                </div>
                <div class="mt-3 flex items-center justify-between text-xs text-indigo-100">
                    <span>{{ $profileCompletion >= 80 ? 'Profil sangat baik!' : 'Lengkapi profilmu' }}</span>
                    <a href="{{ route('profile.edit') }}" class="underline hover:text-white font-medium">Edit Profil &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Lamaran Aktif</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $applications->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Proyek Aktif</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $activeProjects->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Proyek Selesai</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $completedProjects }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Rating Talenta</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ number_format($averageRating, 1) }} <span class="text-xs font-normal text-gray-400">/ 5.0</span></p>
            </div>
        </div>
    </div>

    <!-- Recommended Jobs Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center gap-2">
                    <span>Rekomendasi Pekerjaan</span>
                    <span class="text-xs font-medium bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded-full border border-indigo-100">Smart Match</span>
                </h2>
                <p class="text-xs text-gray-500">Peluang yang dicocokkan dengan keahlian & minat Anda</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat Semua &rarr;</a>
        </div>

        @if($recommendedJobs->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
                <p class="text-gray-500 text-sm">Belum ada rekomendasi pekerjaan saat ini. Tambahkan skill pada profilmu untuk mendapatkan kecocokan terbaik!</p>
                <a href="{{ route('skills.index') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700">Tambah Keahlian</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recommendedJobs as $job)
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div>
                                    <span class="text-xs font-medium text-gray-400">{{ $job->client?->company_name ?? $job->client?->name }}</span>
                                    <h3 class="font-bold text-gray-900 text-base hover:text-indigo-600 line-clamp-1">
                                        <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                    </h3>
                                </div>
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg bg-green-50 text-green-700 border border-green-200 shrink-0">
                                    {{ $job->match_score }}% Match
                                </span>
                            </div>

                            <p class="text-gray-500 text-xs line-clamp-2 mb-4">{{ Str::limit($job->description, 120) }}</p>

                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach($job->skills->take(3) as $skill)
                                    <span class="text-[11px] font-medium bg-gray-50 text-gray-600 px-2 py-0.5 rounded-md border border-gray-200">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                            <span class="font-semibold text-gray-900">
                                Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-indigo-600 font-semibold hover:underline">Detail &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Active Projects & Applications Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Active Projects -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Proyek Berjalan</h3>
                <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($activeProjects->isEmpty())
                <div class="py-8 text-center text-gray-400 text-sm">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    Belum ada proyek yang sedang berjalan.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($activeProjects as $project)
                        <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $project->title }}</h4>
                                <p class="text-xs text-gray-500">Klien: {{ $project->client?->name }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->id) }}" class="shrink-0 px-3 py-1.5 text-xs font-semibold rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Buka Proyek</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="font-bold text-gray-900">Lamaran Terakhir</h3>
                <a href="{{ route('applications.my') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($applications->isEmpty())
                <div class="py-8 text-center text-gray-400 text-sm">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Anda belum melamar pekerjaan apa pun.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($applications as $app)
                        <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $app->jobListing?->title }}</h4>
                                <p class="text-xs text-gray-500">{{ $app->created_at->diffForHumans() }}</p>
                            </div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'shortlisted' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'accepted' => 'bg-green-50 text-green-700 border-green-200',
                                    'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                    'withdrawn' => 'bg-gray-100 text-gray-600 border-gray-200',
                                ];
                            @endphp
                            <span class="shrink-0 px-2.5 py-1 text-xs font-semibold rounded-lg border {{ $statusColors[$app->status->value] ?? 'bg-gray-100' }}">
                                {{ ucfirst($app->status->value) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
