@extends('layouts.app')

@section('title', 'Cari Lowongan & Proyek Freelance Mahasiswa - KerjaKampus')

@section('content')
<div class="bg-slate-50 min-h-screen py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="mb-8 sm:mb-10 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-bold mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                Eksplorasi Proyek Fleksibel
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                Temukan Proyek & Gig Impianmu
            </h1>
            <p class="mt-3 text-sm sm:text-base text-slate-600">
                Pilih dari puluhan pekerjaan sampingan, proyek lepas, dan magang yang bisa dikerjakan di sela jadwal kuliah.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter Form -->
            <div class="lg:col-span-1">
                <form action="{{ route('jobs.index') }}" method="GET" class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-6 sticky top-24">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            <h2 class="font-bold text-slate-900 text-sm">Filter Pencarian</h2>
                        </div>
                        <a href="{{ route('jobs.index') }}" class="text-xs text-indigo-600 font-bold hover:underline">Reset</a>
                    </div>

                    <!-- Keyword Search -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Kata Kunci</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: Laravel, Figma, Copywriter..." class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Kategori</label>
                        <select name="category_id" class="w-full px-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                @php
                                    $catId = is_object($category) ? $category->id : (is_array($category) ? ($category['id'] ?? '') : '');
                                    $catName = is_object($category) ? $category->name : (is_array($category) ? ($category['name'] ?? '') : $category);
                                @endphp
                                @if($catId)
                                    <option value="{{ $catId }}" {{ request('category_id') == $catId ? 'selected' : '' }}>
                                        {{ $catName }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Work Mode -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Mode Kerja</label>
                        <select name="work_mode" class="w-full px-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            <option value="">Semua Mode</option>
                            <option value="remote" {{ request('work_mode') == 'remote' ? 'selected' : '' }}>Remote (Dari Rumah)</option>
                            <option value="onsite" {{ request('work_mode') == 'onsite' ? 'selected' : '' }}>Onsite (Di Lokasi)</option>
                            <option value="hybrid" {{ request('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Kontrak</label>
                        <select name="job_type" class="w-full px-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            <option value="">Semua Jenis</option>
                            <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance (Per Proyek)</option>
                            <option value="gig" {{ request('job_type') == 'gig' ? 'selected' : '' }}>Gig (Tugas Cepat)</option>
                            <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Magang (Internship)</option>
                            <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time (Paruh Waktu)</option>
                            <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                        </select>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Level Pengalaman</label>
                        <select name="experience_level" class="w-full px-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                            <option value="">Semua Level</option>
                            <option value="beginner" {{ request('experience_level') == 'beginner' ? 'selected' : '' }}>Pemula (Beginner)</option>
                            <option value="intermediate" {{ request('experience_level') == 'intermediate' ? 'selected' : '' }}>Menengah (Intermediate)</option>
                            <option value="expert" {{ request('experience_level') == 'expert' ? 'selected' : '' }}>Ahli (Expert)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-2xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Jobs Listing -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Sort & Count Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs">
                    <p class="text-xs sm:text-sm text-slate-600">
                        Menampilkan <span class="font-bold text-slate-900">{{ $jobs->total() }}</span> lowongan aktif
                    </p>

                    <div class="flex items-center gap-2">
                        <span class="text-xs text-slate-500 font-semibold">Urutkan:</span>
                        <select onchange="location = this.value;" class="text-xs font-semibold border border-slate-200 bg-slate-50 rounded-xl px-3 py-2 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'latest']) }}" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'budget_high']) }}" {{ request('sort_by') == 'budget_high' ? 'selected' : '' }}>Budget Tertinggi</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'budget_low']) }}" {{ request('sort_by') == 'budget_low' ? 'selected' : '' }}>Budget Terendah</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'deadline']) }}" {{ request('sort_by') == 'deadline' ? 'selected' : '' }}>Deadline Terdekat</option>
                        </select>
                    </div>
                </div>

                @if($jobs->isEmpty())
                    <!-- Modern Empty State -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
                        <div class="w-16 h-16 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Belum ada proyek yang cocok</h3>
                        <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                            Coba ubah kata kunci pencarian Anda atau reset filter untuk melihat semua lowongan yang tersedia.
                        </p>
                        <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-xl border border-indigo-200 hover:bg-indigo-100 transition-colors">
                            Reset Semua Filter
                        </a>
                    </div>
                @else
                    <!-- Jobs Grid Cards -->
                    <div class="space-y-4">
                        @foreach($jobs as $job)
                            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col justify-between">
                                <div class="space-y-3.5">
                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <span class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100/60">
                                                    {{ $job->category?->name ?? 'Umum' }}
                                                </span>
                                                <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100/60">
                                                    {{ ucfirst($job->work_mode->value ?? $job->work_mode) }}
                                                </span>
                                            </div>
                                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                                                <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                            </h3>
                                        </div>
                                        <div class="text-left sm:text-right shrink-0">
                                            <div class="text-lg font-black text-indigo-600">
                                                Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                                            </div>
                                            <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400">Estimasi Kompensasi</span>
                                        </div>
                                    </div>

                                    <p class="text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                        {{ Str::limit($job->description, 200) }}
                                    </p>

                                    <!-- Badges & Skills -->
                                    <div class="flex flex-wrap items-center gap-2 pt-1">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 text-slate-700">
                                            {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? $job->job_type)) }}
                                        </span>
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-violet-50 text-violet-700 border border-violet-100">
                                            {{ ucfirst($job->experience_level->value ?? $job->experience_level) }}
                                        </span>

                                        @foreach($job->skills->take(4) as $skill)
                                            <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-50 text-slate-600 border border-slate-200/80">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-5 pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-800">{{ $job->client?->company_name ?? $job->client?->name }}</span>
                                        @if($job->location)
                                            <span>&bull;</span>
                                            <span>{{ $job->location }}</span>
                                        @endif
                                        <span>&bull;</span>
                                        <span class="text-slate-400">Deadline: {{ $job->deadline ? $job->deadline->format('d M Y') : 'Fleksibel' }}</span>
                                    </div>

                                    <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex items-center gap-1.5 font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                                        <span>Lihat Detail Proyek</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Container -->
                    <div class="mt-8">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
