@extends('layouts.app')

@section('title', 'Cara Kerja - Platform Ekosistem KerjaKampus')

@section('content')
<div class="relative bg-slate-50 overflow-hidden" x-data="{ activeTab: 'talent' }">
    <!-- Ambient Background Lighting / Morphing Blobs -->
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-gradient-to-tr from-indigo-400/20 via-purple-400/20 to-pink-300/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 -right-36 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-10 -left-36 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- ✦ HERO SECTION ✦ -->
    <section class="pt-16 pb-20 sm:pt-24 sm:pb-28 text-center relative z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Floating Pill Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50/90 border border-indigo-200/80 text-indigo-700 text-xs font-bold mb-8 shadow-xs hover:scale-105 transition-transform cursor-default">
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-600"></span>
                </span>
                <span>Panduan Lengkap Ekosistem KerjaKampus</span>
            </div>

            <!-- Main Title with Gradient Animation -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
                Dari Bangku Kuliah Menuju <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 animate-gradient">
                    Peluang Karier & Bisnis Nyata.
                </span>
            </h1>

            <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                Pelajari alur kerja transparan KerjaKampus. Dirancang aman, fleksibel dengan jadwal kuliah, dan saling menguntungkan antara mahasiswa dan pemilik proyek.
            </p>

            <!-- Role Selector Interactive Toggle Tabs -->
            <div class="inline-flex p-1.5 rounded-2xl bg-white border border-slate-200/90 shadow-sm gap-1.5 mb-8">
                <button type="button" 
                        @click="activeTab = 'talent'"
                        :class="activeTab === 'talent' ? 'bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-md shadow-indigo-500/20 font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                        class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center gap-2">
                    <span>🎓</span>
                    <span>Untuk Mahasiswa & Talenta</span>
                </button>
                <button type="button" 
                        @click="activeTab = 'client'"
                        :class="activeTab === 'client' ? 'bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-md shadow-indigo-500/20 font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                        class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center gap-2">
                    <span>🏢</span>
                    <span>Untuk Klien, UMKM & Startup</span>
                </button>
            </div>

            <!-- Key Trust Badges Strip -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto pt-6 border-t border-slate-200/60 text-left">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/80 border border-slate-200/60 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-base shrink-0">🛡️</div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">Escrow Aman</p>
                        <p class="text-[11px] text-slate-500">Dana terlindungi</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/80 border border-slate-200/60 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-base shrink-0">⚡</div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">AI Job Match</p>
                        <p class="text-[11px] text-slate-500">Pencocokan akurat</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/80 border border-slate-200/60 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-base shrink-0">⭐</div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">Review Riil</p>
                        <p class="text-[11px] text-slate-500">Kredibilitas CV</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/80 border border-slate-200/60 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center font-bold text-base shrink-0">💸</div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">0% Potongan</p>
                        <p class="text-[11px] text-slate-500">Early access promo</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ✦ TAB 1: WORKFLOW UNTUK MAHASISWA & TALENTA ✦ -->
    <section x-show="activeTab === 'talent'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                Alur Kerja Talenta
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">
                4 Langkah Mengubah Skill Menjadi Penghasilan
            </h2>
            <p class="text-slate-500 text-sm mt-2">
                Tidak perlu menunggu wisuda untuk memulai karier profesionalmu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            👤
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-black text-xs shadow-sm">
                            Langkah 01
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Bangun Profil & Portofolio</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Daftar akun gratis, hubungkan kampusmu, tambahkan keahlian utama, dan pamerkan portofolio tugas kuliah atau project mandiri.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-indigo-700 flex items-center gap-1.5">
                        <span>✨</span>
                        <span>Dilengkapi AI Portfolio Optimizer</span>
                    </span>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            🔍
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-black text-xs shadow-sm">
                            Langkah 02
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Eksplorasi Proyek Cocok</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Cari lowongan freelance, gig cepat, atau magang remote. Gunakan filter estimasi budget, keahlian, dan durasi pengerjaan.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-purple-700 flex items-center gap-1.5">
                        <span>🎯</span>
                        <span>Smart Job Matching Score</span>
                    </span>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            📑
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-black text-xs shadow-sm">
                            Langkah 03
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Ajukan Penawaran Cerdas</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Kirim proposal dengan cover letter menarik, ajukan harga sesuai kemampuan, dan tentukan estimasi deadline pengerjaan.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-amber-700 flex items-center gap-1.5">
                        <span>💡</span>
                        <span>Bisa tawar-menawar transparan</span>
                    </span>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            💰
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-black text-xs shadow-sm">
                            Langkah 04
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Kirim Tugas & Terima Dana</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Selesaikan deliverable proyek. Klien menyetujui hasil kerja, dana langsung cair ke dompetmu, dan dapatkan ulasan bintang 5.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                        <span>🛡️</span>
                        <span>100% Bebas Potongan Komisi</span>
                    </span>
                </div>
            </div>

        </div>

        <!-- Callout Banner For Talent -->
        <div class="mt-12 p-8 rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white border border-indigo-800/50 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 text-xs font-bold">
                    <span>🚀</span> Siap mulai mengasah skill?
                </div>
                <h3 class="text-xl sm:text-2xl font-black tracking-tight">Daftarkan Dirimu Sebagai Talenta Sekarang</h3>
                <p class="text-xs sm:text-sm text-slate-300">Bergabung gratis dan dapatkan akses ke puluhan proyek pertama dari UMKM & Startup.</p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-500 to-violet-600 text-white font-black text-xs sm:text-sm shadow-lg shadow-indigo-500/30 btn-press btn-shine animate-glow-pulse">
                    Daftar Akun Mahasiswa
                </a>
                <a href="{{ url('/jobs') }}" class="px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold text-xs sm:text-sm transition-colors">
                    Lihat Lowongan
                </a>
            </div>
        </div>

    </section>

    <!-- ✦ TAB 2: WORKFLOW UNTUK KLIEN, STARTUP & UMKM ✦ -->
    <section x-show="activeTab === 'client'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-wider text-violet-600 bg-violet-50 px-3 py-1 rounded-full border border-violet-100">
                Alur Kerja Pemberi Proyek
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">
                Selesaikan Proyek Lebih Cepat & Hemat Budget
            </h2>
            <p class="text-slate-500 text-sm mt-2">
                Akses ribuan mahasiswa berbakat dari universitas terkemuka di seluruh nusantara.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-800 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            ✍️
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-slate-900 text-white font-black text-xs shadow-sm">
                            Langkah 01
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Pasang Deskripsi Proyek</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Tuliskan kebutuhan tugas, skill yang dicari, tentukan rentang kompensasi anggaran, dan tanggal tenggat waktu pengumpulan.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5">
                        <span>⚡</span>
                        <span>Posting lowongan dalam 2 menit</span>
                    </span>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            👥
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-slate-900 text-white font-black text-xs shadow-sm">
                            Langkah 02
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Seleksi Proposal Terbaik</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Terima penawaran dari berbagai mahasiswa aktif. Cek portofolio asli, ulasan bintang dari klien sebelumnya, dan estimasi waktu kerja.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-indigo-700 flex items-center gap-1.5">
                        <span>🔍</span>
                        <span>Lihat portofolio & rating live</span>
                    </span>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            🔒
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-slate-900 text-white font-black text-xs shadow-sm">
                            Langkah 03
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Mulai Proyek & Proteksi</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Pilih kandidat pemenang. Sistem otomatis membuatkan kontrak kerja digital dan mengamankan anggaran di rekening bersama (Escrow).
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                        <span>🛡️</span>
                        <span>Garansi uang kembali jika batal</span>
                    </span>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs card-hover box-shine flex flex-col justify-between group">
                <div>
                    <!-- Card Top: Icon & Step Badge -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform">
                            🏆
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full bg-slate-900 text-white font-black text-xs shadow-sm">
                            Langkah 04
                        </span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2.5">Terima Hasil & Beri Nilai</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                        Tinjau deliverable yang diserahkan. Jika sesuai, setujui penyelesaian proyek dan berikan ulasan feedback untuk mendukung talenta muda.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 bg-slate-50/50 -mx-7 -mb-7 p-5 rounded-b-3xl">
                    <span class="text-[11px] font-bold text-amber-700 flex items-center gap-1.5">
                        <span>⭐</span>
                        <span>Bantu mahasiswa membangun CV</span>
                    </span>
                </div>
            </div>

        </div>

        <!-- Callout Banner For Client -->
        <div class="mt-12 p-8 rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white border border-slate-800 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 text-xs font-bold">
                    <span>🏢</span> Butuh bantuan menyelesaikan pekerjaan?
                </div>
                <h3 class="text-xl sm:text-2xl font-black tracking-tight">Pasang Lowongan Proyek Pertama Anda</h3>
                <p class="text-xs sm:text-sm text-slate-300">Dapatkan pelamar berkualitas dalam hitungan jam. 0% biaya platform selama periode beta.</p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-500 to-violet-600 text-white font-black text-xs sm:text-sm shadow-lg shadow-indigo-500/30 btn-press btn-shine animate-glow-pulse">
                    Mulai Rekrut Talenta
                </a>
                <a href="{{ url('/talents') }}" class="px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold text-xs sm:text-sm transition-colors">
                    Jelajahi Profil Talenta
                </a>
            </div>
        </div>

    </section>

    <!-- ✦ WHY KERJAKAMPUS SECTION ✦ -->
    <section class="py-20 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Nilai Lebih Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">
                    Mengapa KerjaKampus Menjadi Pilihan Terbaik?
                </h2>
                <p class="text-slate-500 text-sm mt-2">
                    Kombinasi teknologi modern, proteksi pembayaran, dan semangat generasi muda Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 card-hover box-shine space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-600/20">
                        🛡️
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Sistem Rekening Bersama (Escrow)</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Klien tidak perlu khawatir pekerjaan tidak selesai, dan mahasiswa tidak perlu cemas tidak dibayar. Dana dijamin aman hingga deliverable disetujui bersama.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 card-hover box-shine space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center text-xl shadow-md shadow-purple-600/20">
                        🤖
                    </div>
                    <h3 class="text-lg font-black text-slate-900">AI Career Copilot Terintegrasi</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Algoritma cerdas kami membantu mahasiswa membedah kecocokan lowongan, merapikan deskripsi portofolio, dan merekomendasikan talenta tepat untuk setiap brief proyek.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 card-hover box-shine space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-xl shadow-md shadow-emerald-600/20">
                        📈
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Verifikasi Riwayat Nyata</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Setiap ulasan dan rating berasal dari transaksi proyek nyata. Menjadikan profil KerjaKampus sebagai bukti kredibilitas portofolio yang dapat dilampirkan saat melamar kerja resmi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ✦ FAQ ACCORDION SECTION ✦ -->
    <section class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ openFaq: 1 }">
        <div class="text-center mb-12">
            <span class="text-xs font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                FAQ
            </span>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-3">Pertanyaan Seputar Cara Kerja</h2>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
                <button type="button" @click="openFaq = openFaq === 1 ? 0 : 1" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-indigo-600 transition-colors">
                    <span>Apakah mahasiswa baru (semester 1-2) boleh mendaftar dan mencari proyek?</span>
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180 text-indigo-600': openFaq === 1 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Tentu saja! KerjaKampus terbuka untuk semua jenjang semester aktif maupun fresh graduate. Proyek yang tersedia bervariasi mulai dari gig sederhana (seperti input data, desain canva, penulisan artikel) hingga proyek advance (seperti web development atau mobile apps).
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
                <button type="button" @click="openFaq = openFaq === 2 ? 0 : 2" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-indigo-600 transition-colors">
                    <span>Bagaimana jika klien tidak puas dengan hasil pekerjaan talenta?</span>
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180 text-indigo-600': openFaq === 2 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Klien memiliki hak untuk meminta revisi sesuai kesepakatan awal pada proposal. Jika terjadi sengketa, tim mediasi KerjaKampus akan memeriksa deliverable dan brief asli untuk memastikan keputusan yang adil bagi kedua belah pihak.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
                <button type="button" @click="openFaq = openFaq === 3 ? 0 : 3" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-indigo-600 transition-colors">
                    <span>Apakah ada batasan jumlah lamaran yang bisa dikirimkan talenta?</span>
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180 text-indigo-600': openFaq === 3 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Selama periode Early Access Beta ini, tidak ada batasan kuota proposal! Anda dapat melamar ke seluruh proyek yang relevan dengan keahlian Anda tanpa biaya tambahan apa pun.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
                <button type="button" @click="openFaq = openFaq === 4 ? 0 : 4" class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 hover:text-indigo-600 transition-colors">
                    <span>Bagaimana cara mencairkan dana penghasilan dari proyek?</span>
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180 text-indigo-600': openFaq === 4 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Setelah proyek disetujui selesai oleh klien, saldo Anda dapat ditarik langsung ke seluruh rekening bank lokal Indonesia (BCA, Mandiri, BNI, BRI) serta e-wallet terkemuka (GoPay, OVO, Dana) secara instan.
                </div>
            </div>
        </div>
    </section>

    <!-- ✦ FINAL CTA SECTION ✦ -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-800 text-white text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
            <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                Mulai Perjalanan Profesionalmu Sekarang.
            </h2>
            <p class="text-sm sm:text-base text-indigo-100 max-w-xl mx-auto">
                Daftar gratis hanya dalam 1 menit. Akses peluang proyek menarik dan bangun reputasi karier sejak di bangku kuliah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-2">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white text-indigo-700 font-black text-sm shadow-xl hover:bg-slate-50 transition-all btn-press btn-shine btn-shine-dark animate-glow-gold">
                    Daftar Akun Sekarang
                </a>
                <a href="{{ url('/jobs') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-indigo-500/30 border border-white/30 text-white font-bold text-sm hover:bg-indigo-500/40 transition-all btn-shine">
                    Cari Proyek Tersedia
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
