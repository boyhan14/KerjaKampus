@extends('layouts.dashboard')

@section('title', 'Edit Portofolio - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Portofolio Proyek</h1>
            <p class="text-sm text-gray-500">Perbarui informasi karya atau hasil proyekmu.</p>
        </div>
        <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali</a>
    </div>

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Judul Proyek *</label>
            <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Proyek</label>
            <input type="text" name="category" value="{{ old('category', $portfolio->category) }}" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <!-- Demo URL & Repository URL -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Live Demo URL</label>
                <input type="url" name="demo_url" value="{{ old('demo_url', $portfolio->demo_url) }}" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Repository URL / Github</label>
                <input type="url" name="repository_url" value="{{ old('repository_url', $portfolio->repository_url) }}" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <!-- Thumbnail -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Thumbnail Baru (Kosongkan jika tidak diubah)</label>
            @if($portfolio->thumbnail)
                <div class="mb-3 w-32 h-20 rounded-xl overflow-hidden border border-gray-200">
                    <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Proyek *</label>
            <textarea name="description" rows="5" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $portfolio->description) }}</textarea>
        </div>

        <!-- Skills -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Keahlian & Teknologi</label>
            @php $currentSkills = $portfolio->skills->pluck('id')->toArray(); @endphp
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 max-h-48 overflow-y-auto p-3 border border-gray-200 rounded-xl bg-gray-50">
                @foreach($skills as $skill)
                    <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $currentSkills) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="truncate">{{ $skill->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Published Option -->
        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100">
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ $portfolio->is_published ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500 w-4 h-4">
            <label for="is_published" class="text-xs text-gray-700 font-medium cursor-pointer">
                Publikasikan di profil publik saya
            </label>
        </div>

        <!-- Actions -->
        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('portfolio.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

