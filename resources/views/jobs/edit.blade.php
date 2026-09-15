@extends('layouts.dashboard')

@section('title', 'Edit Lowongan - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider mb-2">
                Pembaruan Informasi Proyek
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Edit Lowongan Pekerjaan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Sesuaikan kriteria, anggaran, atau deskripsi proyek Anda.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-indigo-600 self-start sm:self-center transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Lowongan Saya
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Section 1: Informasi Pokok -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-indigo-50 text-indigo-600 font-black text-xs flex items-center justify-center">1</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Informasi Pokok Proyek</h3>
                    <p class="text-xs text-slate-400">Judul jelas akan memudahkan talenta menemukan pekerjaan ini.</p>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Judul Pekerjaan / Proyek <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}" required 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('title') border-rose-500 @enderror">
                @error('title') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Category & Contract Type -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kategori Bidang <span class="text-rose-500">*</span>
                    </label>
                    <select name="category_id" required class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Jenis Kontrak Kerja <span class="text-rose-500">*</span>
                    </label>
                    <select name="job_type" required class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        @foreach(['freelance' => 'Freelance (Proyek Lepas)', 'gig' => 'Gig (Tugas Cepat / Satuan)', 'internship' => 'Magang (Internship)', 'part_time' => 'Part Time (Paruh Waktu)', 'contract' => 'Contract (Kontrak Tertentu)'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('job_type', $job->job_type->value ?? $job->job_type) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Section 2: Mode Kerja & Pengalaman -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-purple-50 text-purple-600 font-black text-xs flex items-center justify-center">2</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Lokasi & Kriteria Pengalaman</h3>
                    <p class="text-xs text-slate-400">Tentukan fleksibilitas kerja serta tingkat kemampuan yang diharapkan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Tipe Lokasi Kerja <span class="text-rose-500">*</span>
                    </label>
                    <select name="work_mode" required class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        @foreach(['remote' => 'Remote (Dari Mana Saja)', 'onsite' => 'Onsite (Di Lokasi / Kantor)', 'hybrid' => 'Hybrid (Fleksibel Gabungan)'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('work_mode', $job->work_mode->value ?? $job->work_mode) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Tingkat Pengalaman <span class="text-rose-500">*</span>
                    </label>
                    <select name="experience_level" required class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        @foreach(['beginner' => 'Beginner (Pemula / Mahasiswa)', 'intermediate' => 'Intermediate (Menengah)', 'expert' => 'Expert (Mahir)'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('experience_level', $job->experience_level->value ?? $job->experience_level) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kota / Lokasi Spesifik (Opsional)</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}" placeholder="Contoh: Jakarta Selatan / D.I. Yogyakarta" 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            </div>
        </div>

        <!-- Section 3: Budget & Timeline -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 font-black text-xs flex items-center justify-center">3</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Alokasi Anggaran & Batas Waktu</h3>
                    <p class="text-xs text-slate-400">Rentang pembayaran kompensasi dalam Rupiah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Budget Minimum (Rp) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" name="budget_min" value="{{ old('budget_min', (int)$job->budget_min) }}" required step="50000"
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Budget Maksimum (Rp) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" name="budget_max" value="{{ old('budget_max', (int)$job->budget_max) }}" required step="50000"
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Batas Akhir Lamaran <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" name="deadline" value="{{ old('deadline', $job->deadline?->format('Y-m-d')) }}" required
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- Section 4: Deskripsi & Skill Requirements -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-amber-50 text-amber-600 font-black text-xs flex items-center justify-center">4</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Deskripsi Lengkap & Kualifikasi</h3>
                    <p class="text-xs text-slate-400">Rincian pekerjaan, ekspektasi, dan teknologi.</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Deskripsi Lengkap <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" rows="7" required 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all leading-relaxed">{{ old('description', $job->description) }}</textarea>
            </div>

            <!-- Skills Multi-Select Pills -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Pilih Tag Keahlian Terkait
                </label>
                @php $currentSkills = $job->skills->pluck('id')->toArray(); @endphp
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5 max-h-56 overflow-y-auto p-4 border border-slate-200 rounded-2xl bg-slate-50/50">
                    @foreach($skills as $skill)
                        <label class="relative flex items-center gap-2.5 p-2.5 bg-white rounded-xl border border-slate-200/80 hover:border-indigo-300 cursor-pointer transition-all has-[:checked]:bg-indigo-50/70 has-[:checked]:border-indigo-400 has-[:checked]:text-indigo-900">
                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $currentSkills) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                            <span class="text-xs font-medium text-slate-700 truncate select-none">{{ $skill->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Submit Footer -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-500">
                Perubahan pada lowongan akan langsung diperbarui di halaman publik.
            </p>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('jobs.my') }}" class="flex-1 sm:flex-none text-center px-6 py-3 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-2xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 sm:flex-none px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-600/20 hover:shadow-lg transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
