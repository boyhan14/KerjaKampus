@extends('layouts.app')

@section('title', 'Cari Pekerjaan & Proyek - KerjaKampus')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8 text-center max-w-3xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Temukan Proyek & Gig Impianmu</h1>
            <p class="mt-2 text-base text-gray-600">Jelajahi lowongan freelance, gig, magang, dan part-time dari berbagai perusahaan & UMKM di seluruh Indonesia.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter Form -->
            <div class="lg:col-span-1">
                <form action="{{ route('jobs.index') }}" method="GET" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-6 sticky top-24">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-900 text-base">Filter Pencarian</h2>
                        <a href="{{ route('jobs.index') }}" class="text-xs text-indigo-600 font-semibold hover:underline">Reset</a>
                    </div>

                    <!-- Keyword Search -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kata Kunci</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: Laravel, Desain..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori</label>
                        <select name="category_id" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Work Mode -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipe Kerja</label>
                        <select name="work_mode" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Semua Mode</option>
                            <option value="remote" {{ request('work_mode') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="onsite" {{ request('work_mode') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="hybrid" {{ request('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jenis Kontrak</label>
                        <select name="job_type" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Semua Jenis</option>
                            <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="gig" {{ request('job_type') == 'gig' ? 'selected' : '' }}>Gig</option>
                            <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                            <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tingkat Pengalaman</label>
                        <select name="experience_level" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Semua Tingkat</option>
                            <option value="beginner" {{ request('experience_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ request('experience_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="expert" {{ request('experience_level') == 'expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm transition-colors">
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Jobs Listing -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Sort & Count Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-gray-200">
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-bold text-gray-900">{{ $jobs->total() }}</span> lowongan pekerjaan
                    </p>

                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 font-medium">Urutkan:</span>
                        <select onchange="location = this.value;" class="text-xs border border-gray-300 rounded-lg px-2.5 py-1.5 focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'latest']) }}" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'budget_high']) }}" {{ request('sort_by') == 'budget_high' ? 'selected' : '' }}>Budget Tertinggi</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'budget_low']) }}" {{ request('sort_by') == 'budget_low' ? 'selected' : '' }}>Budget Terendah</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'deadline']) }}" {{ request('sort_by') == 'deadline' ? 'selected' : '' }}>Deadline Terdekat</option>
                        </select>
                    </div>
                </div>

                @if($jobs->isEmpty())
                    <!-- Empty State -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center space-y-4">
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Belum ada project yang cocok.</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto">
                            Coba ubah kata kunci pencarian atau sesuaikan filter untuk menemukan peluang lainnya.
                        </p>
                        <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-indigo-50 text-indigo-700 text-sm font-semibold rounded-xl border border-indigo-200 hover:bg-indigo-100">
                            Reset Semua Filter
                        </a>
                    </div>
                @else
                    <!-- Jobs Grid -->
                    <div class="space-y-4">
                        @foreach($jobs as $job)
                            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xs hover:shadow-md hover:border-indigo-200 transition-all flex flex-col justify-between">
                                <div class="space-y-3">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                        <div>
                                            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100">
                                                {{ $job->category?->name ?? 'Umum' }}
                                            </span>
                                            <h3 class="text-lg font-bold text-gray-900 hover:text-indigo-600 mt-1">
                                                <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                            </h3>
                                        </div>
                                        <div class="text-left sm:text-right">
                                            <div class="text-base font-extrabold text-indigo-600">
                                                Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                                            </div>
                                            <span class="text-[11px] text-gray-400">Estimasi Budget</span>
                                        </div>
                                    </div>

                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ Str::limit($job->description, 180) }}
                                    </p>

                                    <!-- Badges & Skills -->
                                    <div class="flex flex-wrap items-center gap-2 pt-2">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-700">
                                            {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? $job->job_type)) }}
                                        </span>
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ ucfirst($job->work_mode->value ?? $job->work_mode) }}
                                        </span>
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                            {{ ucfirst($job->experience_level->value ?? $job->experience_level) }}
                                        </span>

                                        @foreach($job->skills->take(3) as $skill)
                                            <span class="px-2 py-0.5 text-[11px] font-medium rounded-md bg-gray-50 text-gray-500 border border-gray-200">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-gray-700">{{ $job->client?->company_name ?? $job->client?->name }}</span>
                                        @if($job->location)
                                            <span>&bull;</span>
                                            <span>{{ $job->location }}</span>
                                        @endif
                                        <span>&bull;</span>
                                        <span>Deadline: {{ $job->deadline ? $job->deadline->format('d M Y') : 'Fleksibel' }}</span>
                                    </div>

                                    <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex items-center gap-1 font-bold text-indigo-600 hover:text-indigo-800">
                                        Lihat Detail &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
