@extends('layouts.dashboard')

@section('title', 'Buat Lowongan Pekerjaan - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pasang Lowongan Baru</h1>
            <p class="text-sm text-gray-500">Isi formulir di bawah ini untuk mencari talenta mahasiswa terbaik.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali ke Lowongan Saya</a>
    </div>

    <form action="{{ route('jobs.store') }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Pekerjaan / Proyek *</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Frontend React Developer untuk E-Commerce" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('title') border-red-500 @enderror">
            @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Category & Job Type -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Keahlian *</label>
                <select name="category_id" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jenis Kontrak *</label>
                <select name="job_type" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance (Proyekan)</option>
                    <option value="gig" {{ old('job_type') == 'gig' ? 'selected' : '' }}>Gig (Tugas Singkat)</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Magang (Internship)</option>
                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part Time (Paruh Waktu)</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract (Kontrak)</option>
                </select>
                @error('job_type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Work Mode & Experience -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipe Kerja *</label>
                <select name="work_mode" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="remote" {{ old('work_mode') == 'remote' ? 'selected' : '' }}>Remote (Dari Mana Saja)</option>
                    <option value="onsite" {{ old('work_mode') == 'onsite' ? 'selected' : '' }}>Onsite (Di Kantor)</option>
                    <option value="hybrid" {{ old('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid (Fleksibel)</option>
                </select>
                @error('work_mode') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tingkat Pengalaman *</label>
                <select name="experience_level" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="beginner" {{ old('experience_level') == 'beginner' ? 'selected' : '' }}>Beginner (Pemula / Mahasiswa)</option>
                    <option value="intermediate" {{ old('experience_level') == 'intermediate' ? 'selected' : '' }}>Intermediate (Menengah)</option>
                    <option value="expert" {{ old('experience_level') == 'expert' ? 'selected' : '' }}>Expert (Mahir)</option>
                </select>
                @error('experience_level') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Budget Range & Deadline -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Budget Min (Rp) *</label>
                <input type="number" name="budget_min" value="{{ old('budget_min', 500000) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('budget_min') border-red-500 @enderror">
                @error('budget_min') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Budget Max (Rp) *</label>
                <input type="number" name="budget_max" value="{{ old('budget_max', 2000000) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('budget_max') border-red-500 @enderror">
                @error('budget_max') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Batas Waktu Lamaran *</label>
                <input type="date" name="deadline" value="{{ old('deadline', now()->addDays(14)->format('Y-m-d')) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('deadline') border-red-500 @enderror">
                @error('deadline') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi (Opsional)</label>
            <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Jakarta Selatan / Yogyakarta" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Lengkap & Kualifikasi *</label>
            <textarea name="description" rows="6" required placeholder="Tuliskan detail pekerjaan, deliverables, ekspektasi, dan kriteria talenta yang Anda cari..." class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Required Skills -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih Keahlian Terkait (Multiple)</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 max-h-48 overflow-y-auto p-3 border border-gray-200 rounded-xl bg-gray-50">
                @foreach($skills as $skill)
                    <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer hover:text-indigo-600">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="truncate">{{ $skill->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('jobs.my') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                Publikasikan Lowongan
            </button>
        </div>
    </form>
</div>
@endsection
