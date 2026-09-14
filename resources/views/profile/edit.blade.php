@extends('layouts.dashboard')

@section('title', 'Edit Profil - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Informasi Profil</h1>
            <p class="text-sm text-gray-500">Perbarui informasi diri, portofolio, dan kontak Anda.</p>
        </div>
        <a href="{{ route('profile.show') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali</a>
    </div>

    <!-- Avatar Upload Card -->
    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Foto Profil</h3>
        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-center gap-6">
            @csrf
            <div class="w-20 h-20 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-2xl uppercase overflow-hidden shrink-0">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    {{ substr($user->name, 0, 1) }}
                @endif
            </div>

            <div class="space-y-2">
                <input type="file" name="avatar" accept="image/*" required class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-[11px] text-gray-400">Format: PNG, JPG, GIF, WEBP. Maks 2MB.</p>
            </div>

            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-gray-800 self-start sm:self-center">
                Unggah Foto
            </button>
        </form>
    </div>

    <!-- Details Form -->
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi / Kota</label>
                <input type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="Contoh: Jakarta / Bandung" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        @if($user->isTalent())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pendidikan / Universitas</label>
                    <input type="text" name="education" value="{{ old('education', $user->education) }}" placeholder="Contoh: Universitas Indonesia" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pengalaman Kerja (Tahun)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $user->experience_years) }}" min="0" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>
        @endif

        @if($user->isClient())
            <div class="space-y-4 pt-4 border-t border-gray-100">
                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Informasi Perusahaan / Organisasi</h3>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Perusahaan / Bisnis</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" placeholder="Contoh: PT Kreasi Nusantara" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Perusahaan</label>
                    <textarea name="company_description" rows="3" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('company_description', $user->company_description) }}</textarea>
                </div>
            </div>
        @endif

        <!-- Bio -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Biodata / Tentang Anda</label>
            <textarea name="bio" rows="4" placeholder="Ceritakan tentang diri Anda, latar belakang, dan apa yang membuat Anda unik..." class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Social Links -->
        <div class="space-y-4 pt-4 border-t border-gray-100">
            <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Tautan & Media Sosial</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Website</label>
                    <input type="url" name="website" value="{{ old('website', $user->website) }}" placeholder="https://..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="https://linkedin.com/in/..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $user->github_url) }}" placeholder="https://github.com/..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="https://instagram.com/..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('profile.show') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
