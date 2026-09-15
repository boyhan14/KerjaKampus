@extends('layouts.dashboard')

@section('title', 'Edit Profil - KerjaKampus')

@section('dashboard-content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Edit Profil Saya</h1>
            <p class="text-xs sm:text-sm text-slate-500">Perbarui data diri, latar belakang, dan kontak Anda.</p>
        </div>
        <a href="{{ route('profile.show') }}" class="text-xs font-bold text-indigo-600 hover:underline">&larr; Kembali ke Profil</a>
    </div>

    <!-- Avatar Upload Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Foto Profil</h3>
        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-center gap-6">
            @csrf
            <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-indigo-500 to-violet-600 text-white font-black flex items-center justify-center text-2xl uppercase overflow-hidden shrink-0 shadow-md shadow-indigo-500/15">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    {{ substr($user->name, 0, 1) }}
                @endif
            </div>

            <div class="space-y-1.5 flex-1">
                <input type="file" name="avatar" accept="image/*" required class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                <p class="text-[11px] text-slate-400">Format yang didukung: PNG, JPG, WEBP. Ukuran maksimal: 2MB.</p>
            </div>

            <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-xs self-start sm:self-center transition-colors">
                Unggah Foto
            </button>
        </form>
    </div>

    <!-- Details Form -->
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 space-y-6 shadow-xs">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kota / Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="Contoh: Jakarta / Bandung" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
            </div>
        </div>

        @if($user->isTalent())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pendidikan / Universitas</label>
                    <input type="text" name="education" value="{{ old('education', $user->education) }}" placeholder="Contoh: Universitas Indonesia" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pengalaman Kerja (Tahun)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $user->experience_years) }}" min="0" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>
            </div>
        @endif

        @if($user->isClient())
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Informasi Perusahaan / Bisnis</h3>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Perusahaan</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" placeholder="Contoh: PT Digital Kreasi Nusantara" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Perusahaan</label>
                    <textarea name="company_description" rows="3" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">{{ old('company_description', $user->company_description) }}</textarea>
                </div>
            </div>
        @endif

        <!-- Bio -->
        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Biodata / Ringkasan Diri</label>
            <textarea name="bio" rows="4" placeholder="Ceritakan latar belakang, spesialisasi keahlian, dan apa yang membuat Anda unggul..." class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Social Links -->
        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Tautan & Media Sosial</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Website Pribadi / Portofolio URL</label>
                    <input type="url" name="website" value="{{ old('website', $user->website) }}" placeholder="https://..." class="w-full px-3.5 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">LinkedIn Profile URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="https://linkedin.com/in/..." class="w-full px-3.5 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">GitHub Profile URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $user->github_url) }}" placeholder="https://github.com/..." class="w-full px-3.5 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="https://instagram.com/..." class="w-full px-3.5 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('profile.show') }}" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-7 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-2xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                Simpan Perubahan Profil
            </button>
        </div>
    </form>
</div>
@endsection
