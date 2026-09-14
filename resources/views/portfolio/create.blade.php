@extends('layouts.dashboard')

@section('title', 'Tambah Portofolio - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Tambah Portofolio Proyek</h1>
            <p class="text-sm text-gray-500">Unggah detail proyek yang pernah kamu buat untuk ditampilkan di profil publikmu.</p>
        </div>
        <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali</a>
    </div>

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Proyek *</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Website E-Commerce Toko Baju" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Proyek</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Web Development / UI Design / Mobile App" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <!-- Demo URL & Repository URL -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Live Demo URL (Opsional)</label>
                <input type="url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://example.com" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @error('demo_url') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Repository URL / Github (Opsional)</label>
                <input type="url" name="repository_url" value="{{ old('repository_url') }}" placeholder="https://github.com/username/project" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @error('repository_url') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Thumbnail -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Thumbnail / Gambar Proyek (Maks 2MB)</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('thumbnail') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Proyek *</label>
            <textarea name="description" rows="5" required placeholder="Jelaskan latar belakang proyek, peranmu, teknologi yang digunakan, serta fitur utama yang kamu bangun..." class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description') }}</textarea>
            @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Skills -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Keahlian & Teknologi yang Digunakan</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 max-h-48 overflow-y-auto p-3 border border-gray-200 rounded-xl bg-gray-50">
                @foreach($skills as $skill)
                    <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="truncate">{{ $skill->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Published Option -->
        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100">
            <input type="checkbox" name="is_published" id="is_published" value="1" checked class="rounded text-indigo-600 focus:ring-indigo-500 w-4 h-4">
            <label for="is_published" class="text-xs text-gray-700 font-medium cursor-pointer">
                Publikasikan langsung ke profil publik saya
            </label>
        </div>

        <!-- Actions -->
        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('portfolio.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                Simpan Portofolio
            </button>
        </div>
    </form>
</div>
@endsection

