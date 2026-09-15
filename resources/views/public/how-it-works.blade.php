@extends('layouts.app')

@section('title', 'Cara Kerja - KerjaKampus')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-800 text-white py-16 sm:py-24 relative overflow-hidden">
    <div class="absolute -top-20 right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 border border-white/20 text-white text-xs font-bold mb-6">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            Panduan Lengkap Platform
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight mb-4 leading-tight">
            Bagaimana KerjaKampus Bekerja?
        </h1>
        <p class="text-sm sm:text-lg text-indigo-100 max-w-2xl mx-auto leading-relaxed font-medium">
            Mulai dari mencari talenta mahasiswa berbakat hingga menyelesaikan proyek dan menerima kompensasi dengan aman.
        </p>
    </div>
</section>

<!-- For Talent Section -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-indigo-600 font-bold uppercase tracking-wider text-xs">Untuk Mahasiswa & Talenta Muda</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Hasilkan Cuan dari Skill Kuliah</h2>
            <p class="mt-2 text-sm text-slate-500">Mulai bangun portofolio profesional dan karier mandiri dalam 4 langkah.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-500/20">
                    01
                </div>
                <h3 class="text-lg font-bold text-slate-900">Lengkapi Profil</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Daftar akun gratis, cantumkan latar belakang kampus, keahlian utama, dan unggah karya portofolio terbaikmu.
                </p>
            </div>
            
            <!-- Step 2 -->
            <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-500/20">
                    02
                </div>
                <h3 class="text-lg font-bold text-slate-900">Pilih Lowongan</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Eksplorasi ratusan lowongan proyek freelance, gig singkat, atau magang yang sesuai dengan waktu kuliahmu.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-500/20">
                    03
                </div>
                <h3 class="text-lg font-bold text-slate-900">Kirim Penawaran</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Ajukan proposal penawaran, tentukan estimasi waktu pengerjaan dan harga yang Anda tawarkan ke pihak klien.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-500/20">
                    04
                </div>
                <h3 class="text-lg font-bold text-slate-900">Beres & Review</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Selesaikan tugas, dapatkan pembayaran transparan, dan kumpulkan rating ulasan bintang 5 untuk reputasi Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- For Client Section -->
<section class="py-20 lg:py-28 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-indigo-600 font-bold uppercase tracking-wider text-xs">Untuk UMKM, Startup & Klien</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Rekrut Mahasiswa Berprestasi</h2>
            <p class="mt-2 text-sm text-slate-500">Selesaikan proyek Anda dengan talenta kampus yang siap kerja.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-black text-lg shadow-md">
                    01
                </div>
                <h3 class="text-lg font-bold text-slate-900">Pasang Lowongan</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Jelaskan lingkup proyek yang Anda butuhkan, tentukan budget realistis, dan tetapkan batas waktu pengumpulan.
                </p>
            </div>
            
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-black text-lg shadow-md">
                    02
                </div>
                <h3 class="text-lg font-bold text-slate-900">Review Pelamar</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Terima proposal dari mahasiswa berbakat. Bandingkan portofolio, rating, dan riwayat proyek mereka.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-black text-lg shadow-md">
                    03
                </div>
                <h3 class="text-lg font-bold text-slate-900">Setujui Proyek</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Terima proposal yang paling cocok. Sistem akan otomatis membuat ruang proyek khusus untuk kolaborasi.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-xs card-hover space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-black text-lg shadow-md">
                    04
                </div>
                <h3 class="text-lg font-bold text-slate-900">Selesai & Evaluasi</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Terima hasil pekerjaan, tandai selesai, dan berikan penilaian feedback untuk mendukung masa depan talenta.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white text-center border-t border-slate-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Siap Memulai Langkah Pertamamu?</h2>
        <p class="text-sm sm:text-base text-slate-500 max-w-xl mx-auto">
            Bergabunglah bersama ribuan mahasiswa dan pelaku usaha di seluruh Indonesia sekarang juga.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-2">
            <a href="{{ url('/register') }}" class="px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm rounded-2xl shadow-md shadow-indigo-500/20 transition-all btn-press">
                Daftar Akun Sekarang
            </a>
            <a href="{{ url('/jobs') }}" class="px-8 py-3.5 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-2xl hover:bg-slate-50 transition-colors">
                Eksplorasi Proyek
            </a>
        </div>
    </div>
</section>
@endsection
