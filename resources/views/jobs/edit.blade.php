@extends('layouts.dashboard')

@section('title', 'Edit Lowongan - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Lowongan Pekerjaan</h1>
            <p class="text-sm text-gray-500">Perbarui detail atau kriteria lowongan pekerjaan Anda.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali ke Lowongan Saya</a>
    </div>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Pekerjaan / Proyek *</label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Category & Job Type -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Keahlian *</label>
                <select name="category_id" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jenis Kontrak *</label>
                <select name="job_type" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['freelance' => 'Freelance', 'gig' => 'Gig', 'internship' => 'Internship', 'part_time' => 'Part Time', 'contract' => 'Contract'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('job_type', $job->job_type->value ?? $job->job_type) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Work Mode & Experience -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipe Kerja *</label>
                <select name="work_mode" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['remote' => 'Remote', 'onsite' => 'Onsite', 'hybrid' => 'Hybrid'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('work_mode', $job->work_mode->value ?? $job->work_mode) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tingkat Pengalaman *</label>
                <select name="experience_level" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'expert' => 'Expert'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('experience_level', $job->experience_level->value ?? $job->experience_level) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Budget Range & Deadline -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Budget Min (Rp) *</label>
                <input type="number" name="budget_min" value="{{ old('budget_min', (int)$job->budget_min) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Budget Max (Rp) *</label>
                <input type="number" name="budget_max" value="{{ old('budget_max', (int)$job->budget_max) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Batas Waktu Lamaran *</label>
                <input type="date" name="deadline" value="{{ old('deadline', $job->deadline?->format('Y-m-d')) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi (Opsional)</label>
            <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Lengkap *</label>
            <textarea name="description" rows="6" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $job->description) }}</textarea>
        </div>

        <!-- Skills -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih Keahlian Terkait</label>
            @php $currentSkills = $job->skills->pluck('id')->toArray(); @endphp
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 max-h-48 overflow-y-auto p-3 border border-gray-200 rounded-xl bg-gray-50">
                @foreach($skills as $skill)
                    <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $currentSkills) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="truncate">{{ $skill->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('jobs.my') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

