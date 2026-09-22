@extends('layouts.dashboard')

@section('title', 'Edit Profil - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8" x-data="{ 
    activeTab: 'personal',
    avatarPreview: null,
    handleAvatarChange(event) {
        const file = event.target.files[0];
        if (file) {
            this.avatarPreview = URL.createObjectURL(file);
        }
    }
}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
                <a href="{{ route('profile.show') }}" class="hover:text-indigo-600 transition-colors">&larr; Profil Saya</a>
                <span>/</span>
                <span class="text-slate-700">Pengaturan Akun</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Edit Profil Saya</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola identitas publik, informasi kontak, latar belakang, dan status ketersediaan kerja.</p>
        </div>
        <div class="flex items-center gap-2.5">
            @if($user->username)
                <a href="{{ route('talents.show', $user->username) }}" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:border-slate-300 text-slate-700 text-xs font-bold transition-colors inline-flex items-center gap-1.5 bg-white shadow-2xs">
                    <span>Lihat Publik</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            @endif
            <a href="{{ route('profile.show') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors">
                Batal
            </a>
        </div>
    </div>

    <!-- Avatar Upload Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative shrink-0">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-black flex items-center justify-center text-2xl sm:text-3xl uppercase overflow-hidden shadow-md shadow-indigo-500/20 border-2 border-white">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="Preview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!avatarPreview">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span>{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </template>
                    </div>
                </div>

                <div class="space-y-1">
                    <h3 class="text-sm font-bold text-slate-900">Foto Profil Publik</h3>
                    <p class="text-xs text-slate-500">Tampilkan foto profesional agar lebih mudah dikenali oleh klien dan rekan proyek.</p>
                    <p class="text-[11px] text-slate-400">PNG, JPG, atau WEBP. Maksimal 2MB.</p>
                </div>
            </div>

            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
                @csrf
                <label class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl cursor-pointer text-center transition-colors">
                    <span>Pilih Foto Baru</span>
                    <input type="file" name="avatar" accept="image/*" required @change="handleAvatarChange($event)" class="hidden">
                </label>
                <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-xs transition-colors btn-press">
                    Simpan Foto
                </button>
            </form>
        </div>
    </div>

    <!-- Main Profile Edit Form -->
    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Section 1: Data Diri & Identitas Publik -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="pb-4 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-900">1. Data Diri & Identitas Publik</h3>
                <p class="text-xs text-slate-500">Informasi utama yang ditampilkan di platform dan komunikasi proyek.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                           class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Username Unik (@)</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">@</span>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="username" 
                               class="w-full pl-8 pr-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                           class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor WhatsApp / Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" 
                           class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kota / Lokasi Domisili</label>
                    <input type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="Contoh: Jakarta Selatan, DKI Jakarta" 
                           class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Biodata Singkat / Ringkasan Keahlian</label>
                    <textarea name="bio" rows="4" placeholder="Ceritakan latar belakang, fokus spesialisasi keahlianmu, serta apa nilai tambah yang bisa kamu berikan..." 
                              class="w-full px-4 py-3 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all leading-relaxed">{{ old('bio', $user->bio) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Status Ketersediaan Kerja (Availability) -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4" x-data="{ available: {{ old('is_available', $user->is_available ?? true) ? 'true' : 'false' }} }">
            <div class="pb-3 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">2. Status Ketersediaan Pekerjaan</h3>
                    <p class="text-xs text-slate-500">Tentukan apakah Anda sedang menerima tawaran proyek kolaborasi baru saat ini.</p>
                </div>
                <!-- Status Badge Preview -->
                <div>
                    <span x-show="available" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Tersedia untuk Proyek
                    </span>
                    <span x-show="!available" x-cloak class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        Sedang Sibuk
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-slate-50/70 rounded-2xl border border-slate-100">
                <div class="space-y-0.5 pr-4">
                    <span class="text-xs font-bold text-slate-800 block">Terima Tawaran & Undangan Proyek Baru</span>
                    <p class="text-[11px] text-slate-500">Jika dinonaktifkan, profil Anda akan ditandai 'Sedang Sibuk' sehingga klien mengetahui Anda belum siap menerima pekerjaan tambahan.</p>
                </div>

                <!-- Modern Toggle Switch -->
                <button type="button" @click="available = !available" 
                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none" 
                        :class="available ? 'bg-indigo-600' : 'bg-slate-200'">
                    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out" 
                          :class="available ? 'translate-x-5' : 'translate-x-0'"></span>
                </button>
                <input type="hidden" name="is_available" :value="available ? 1 : 0">
            </div>
        </div>

        <!-- Section 3: Pendidikan / Karier ATAU Perusahaan -->
        @if($user->isTalent())
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="pb-4 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900">3. Pendidikan & Pengalaman Profesional</h3>
                    <p class="text-xs text-slate-500">Membantu meyakinkan calon klien atas kompetensi dan rekam jejak akademismu.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Universitas / Kampus / Jurusan</label>
                        <input type="text" name="education" value="{{ old('education', $user->education) }}" placeholder="Contoh: Universitas Indonesia - Teknik Informatika" 
                               class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pengalaman Kerja (Tahun)</label>
                        <input type="number" name="experience_years" value="{{ old('experience_years', $user->experience_years) }}" min="0" max="50" placeholder="0" 
                               class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                    </div>
                </div>
            </div>
        @endif

        @if($user->isClient())
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="pb-4 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900">3. Informasi Perusahaan & Bisnis</h3>
                    <p class="text-xs text-slate-500">Profil entitas bisnis atau startup yang Anda wakili.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Perusahaan / Usaha</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" placeholder="Contoh: PT Digital Kreasi Nusantara" 
                               class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Perusahaan</label>
                        <textarea name="company_description" rows="3" placeholder="Jelaskan bidang usaha, industri, dan visi perusahaan Anda..." 
                                  class="w-full px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">{{ old('company_description', $user->company_description) }}</textarea>
                    </div>
                </div>
            </div>
        @endif

        <!-- Section 4: Media Sosial & Tautan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
            <div class="pb-4 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-900">4. Media Sosial & Tautan Eksternal</h3>
                <p class="text-xs text-slate-500">Tautkan akun profesional Anda untuk memperluas jangkauan verifikasi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        Website Pribadi / Portofolio
                    </label>
                    <input type="url" name="website" value="{{ old('website', $user->website) }}" placeholder="https://domainanda.com" 
                           class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                        LinkedIn URL
                    </label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="https://linkedin.com/in/username" 
                           class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-900" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        GitHub URL
                    </label>
                    <input type="url" name="github_url" value="{{ old('github_url', $user->github_url) }}" placeholder="https://github.com/username" 
                           class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        Instagram URL
                    </label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="https://instagram.com/username" 
                           class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('profile.show') }}" class="px-6 py-3 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-2xl transition-colors">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs sm:text-sm rounded-2xl shadow-md shadow-indigo-500/25 transition-all btn-press">
                Simpan Perubahan Profil
            </button>
        </div>
    </form>
</div>
@endsection
