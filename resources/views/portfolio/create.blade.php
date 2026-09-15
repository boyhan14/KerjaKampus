@extends('layouts.dashboard')

@section('title', 'Tambah Portofolio Karya - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-2">
                Showcase Karya Mahasiswa
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Tambah Portofolio Baru</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Tampilkan hasil karya terbaik Anda untuk menarik minat klien merekrut Anda.</p>
        </div>
        <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-indigo-600 self-start sm:self-center transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Portofolio
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Section 1: Detail Karya -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-indigo-50 text-indigo-600 font-black text-xs flex items-center justify-center">1</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Informasi Pokok Karya</h3>
                    <p class="text-xs text-slate-400">Beri judul yang merefleksikan hasil dan solusi yang kamu bangun.</p>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Judul Proyek / Karya <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Redesign Aplikasi Mobile Banking BRI (UI/UX Case Study)" 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('title') border-rose-500 @enderror">
                @error('title') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Proyek</label>
                <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Web Development / UI/UX Design / Mobile App / Machine Learning" 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            </div>

            <!-- Live URL & GitHub -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Live Demo URL (Opsional)</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://myproject.vercel.app" 
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('demo_url') border-rose-500 @enderror">
                    @error('demo_url') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Repository / Source Code (Opsional)</label>
                    <input type="url" name="repository_url" value="{{ old('repository_url') }}" placeholder="https://github.com/username/project" 
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('repository_url') border-rose-500 @enderror">
                    @error('repository_url') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Visual & Deskripsi -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-purple-50 text-purple-600 font-black text-xs flex items-center justify-center">2</span>
                <div>
                    <h3 class="font-black text-slate-900 text-base">Cover Visual & Deskripsi Karya</h3>
                    <p class="text-xs text-slate-400">Gambar menarik dan cerita tantangan proyek akan meningkatkan impresi.</p>
                </div>
            </div>

            <!-- Thumbnail Upload -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Foto Sampul / Thumbnail (PNG, JPG, WebP maks 2MB)
                </label>
                <div class="p-6 border-2 border-dashed border-slate-200 hover:border-indigo-400 rounded-2xl bg-slate-50/50 text-center transition-colors">
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                </div>
                @error('thumbnail') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Deskripsi Lengkap & Peran Anda <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" rows="6" required placeholder="Jelaskan:
- Apa masalah yang dipecahkan oleh proyek ini?
- Peran spesifik Anda dalam tim
- Teknologi/stack apa yang dipakai dan kenapa?
- Hasil atau metrik capaian yang didapatkan..." 
                    class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all leading-relaxed @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Skills Multi-Select Pills -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Keahlian & Teknologi yang Digunakan
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5 max-h-48 overflow-y-auto p-4 border border-slate-200 rounded-2xl bg-slate-50/50">
                    @foreach($skills as $skill)
                        <label class="relative flex items-center gap-2.5 p-2.5 bg-white rounded-xl border border-slate-200/80 hover:border-indigo-300 cursor-pointer transition-all has-[:checked]:bg-indigo-50/70 has-[:checked]:border-indigo-400 has-[:checked]:text-indigo-900">
                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" 
                                class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                            <span class="text-xs font-medium text-slate-700 truncate select-none">{{ $skill->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Published Checkbox Card -->
            <div class="flex items-center gap-3.5 p-4 bg-indigo-50/40 rounded-2xl border border-indigo-100">
                <input type="checkbox" name="is_published" id="is_published" value="1" checked 
                    class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                <label for="is_published" class="text-xs text-slate-700 font-semibold cursor-pointer">
                    Publikasikan portofolio ini langsung di profil publik KerjaKampus saya
                </label>
            </div>
        </div>

        <!-- Submit Footer -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-500">
                Portofolio akan membantu profil Anda meraih skor verifikasi lebih tinggi.
            </p>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('portfolio.index') }}" class="flex-1 sm:flex-none text-center px-6 py-3 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-2xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 sm:flex-none px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-600/20 hover:shadow-lg transition-all">
                    Simpan Portofolio
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
