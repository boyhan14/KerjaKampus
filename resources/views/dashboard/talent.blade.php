@extends('layouts.dashboard')

@section('title', 'Talent Dashboard - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Welcome & Profile Completion Banner -->
    <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-800 rounded-3xl p-6 sm:p-9 text-white shadow-xl shadow-indigo-500/15 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-white/15 text-white backdrop-blur-md border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Talenta Terverifikasi
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">Halo, {{ $user->name }}! 👋</h1>
                <p class="text-indigo-100 text-xs sm:text-sm max-w-xl leading-relaxed">
                    Siap menghasilkan cuan dan membangun portofolio riil hari ini? Cek proyek rekomendasi AI yang cocok dengan keahlianmu.
                </p>
            </div>
            
            <!-- Completion Card -->
            <div class="bg-white/15 backdrop-blur-xl rounded-2xl p-5 border border-white/20 min-w-[280px] space-y-3">
                <div class="flex items-center justify-between text-xs font-bold">
                    <span class="text-white/90">Kelengkapan Profil</span>
                    <span class="text-amber-300 font-extrabold text-sm">{{ $profileCompletion }}%</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-400 to-emerald-400 h-2.5 rounded-full transition-all duration-500" style="width: {{ $profileCompletion }}%"></div>
                </div>
                <div class="flex items-center justify-between text-[11px] text-indigo-100 pt-1">
                    <span>{{ $profileCompletion >= 80 ? '⭐ Profil siap dilirik klien!' : 'Lengkapi info & portofolio' }}</span>
                    <a href="{{ route('profile.edit') }}" class="font-bold underline hover:text-white transition-colors">Edit &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Lamaran Aktif</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $applications->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Proyek Berjalan</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $activeProjects->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Proyek Selesai</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $completedProjects }}</p>
            </div>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex items-center gap-4 card-hover">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Rating Talenta</p>
                <p class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ number_format($averageRating, 1) }} <span class="text-xs font-normal text-slate-400">/ 5.0</span></p>
            </div>
        </div>
    </div>

    <!-- Recommended Jobs Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 flex items-center gap-2">
                    <span>Rekomendasi Proyek AI</span>
                    <span class="text-[11px] font-bold bg-indigo-50 text-indigo-700 px-2.5 py-0.5 rounded-full border border-indigo-100">Smart Match</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Lowongan yang disesuaikan secara otomatis dengan skill dan kualifikasimu</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                Lihat Semua &rarr;
            </a>
        </div>

        @if($recommendedJobs->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-200/80 p-8 text-center shadow-xs">
                <p class="text-slate-500 text-xs sm:text-sm">Belum ada rekomendasi pekerjaan saat ini. Tambahkan skill pada profilmu untuk memicu rekomendasi cerdas!</p>
                <a href="{{ route('skills.index') }}" class="mt-4 inline-block px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20">
                    Tambah Keahlian Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($recommendedJobs as $job)
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs card-hover flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div>
                                    <span class="text-xs font-semibold text-slate-400">{{ $job->client?->company_name ?? $job->client?->name }}</span>
                                    <h3 class="font-bold text-slate-900 text-base hover:text-indigo-600 line-clamp-1 transition-colors">
                                        <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                    </h3>
                                </div>
                                <span class="px-2.5 py-1 text-xs font-extrabold rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 shrink-0">
                                    {{ $job->match_score }}% Match
                                </span>
                            </div>

                            <p class="text-slate-500 text-xs line-clamp-2 mb-4 leading-relaxed">{{ Str::limit($job->description, 120) }}</p>

                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach($job->skills->take(3) as $skill)
                                    <span class="text-[11px] font-medium bg-slate-50 text-slate-600 px-2 py-0.5 rounded-lg border border-slate-200/60">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="font-bold text-indigo-600">
                                Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-indigo-600 font-bold hover:underline">Detail &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Active Projects & Applications Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Active Projects -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">Proyek Berjalan</h3>
                <a href="{{ route('projects.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($activeProjects->isEmpty())
                <div class="py-10 text-center text-slate-400 text-xs">
                    <svg class="w-10 h-10 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    Belum ada proyek yang sedang berjalan.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($activeProjects as $project)
                        <div class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $project->title }}</h4>
                                <p class="text-[11px] text-slate-500">Klien: {{ $project->client?->name }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->id) }}" class="shrink-0 px-3.5 py-1.5 text-xs font-bold rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">Buka</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-900 text-sm">Lamaran Terakhir</h3>
                <a href="{{ route('applications.my') }}" class="text-xs font-bold text-indigo-600 hover:underline">Semua</a>
            </div>

            @if($applications->isEmpty())
                <div class="py-10 text-center text-slate-400 text-xs">
                    <svg class="w-10 h-10 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Anda belum mengajukan lamaran ke lowongan apa pun.
                </div>
            @else
                <div class="space-y-3">
                    @foreach($applications as $app)
                        <div class="p-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="min-w-0 pr-3">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $app->jobListing?->title }}</h4>
                                <p class="text-[11px] text-slate-500">{{ $app->created_at->diffForHumans() }}</p>
                            </div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'shortlisted' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'accepted' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    'withdrawn' => 'bg-slate-100 text-slate-600 border-slate-200',
                                ];
                            @endphp
                            <span class="shrink-0 px-2.5 py-1 text-[11px] font-bold rounded-lg border {{ $statusColors[$app->status->value] ?? 'bg-slate-100' }}">
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
