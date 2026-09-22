@extends('layouts.app')

@section('title', 'Biaya & Skema Harga - KerjaKampus')

@section('content')
<div class="relative bg-slate-50 min-h-screen overflow-hidden">
    <!-- Ambient Background Lighting -->
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[900px] h-[480px] bg-gradient-to-tr from-indigo-500/15 via-purple-500/15 to-pink-500/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-20 -left-40 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
        
        <!-- ✦ HERO HEADER ✦ -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold tracking-wide uppercase mb-6 shadow-xs">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span>Transparan • Tanpa Biaya Tersembunyi</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-5">
                Investasi Terbaik untuk <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 animate-gradient">
                    Masa Depan Karier & Bisnis Anda
                </span>
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-medium">
                Platform KerjaKampus dirancang inklusif dan adil untuk mahasiswa dan pelaku usaha. Nikmati seluruh fitur unggulan dengan <strong>0% biaya komisi</strong> selama masa Early Access Beta.
            </p>
        </div>

        <!-- ✦ PRICING CARDS GRID ✦ -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-24">
            
            <!-- Card 1: Talent / Mahasiswa -->
            <div class="bg-white rounded-3xl p-8 sm:p-9 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-indigo-200 transition-all duration-300 flex flex-col justify-between box-shine">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-indigo-50 text-indigo-700 text-xs font-bold mb-5 border border-indigo-100/60">
                        <span>🎓</span>
                        <span>Mahasiswa & Fresh Graduate</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Talenta Kampus</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6 leading-relaxed">
                        Bangun rekam jejak portofolio nyata dan hasilkan pendapatan tambahan tanpa mengganggu jam kuliah.
                    </p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-5xl font-black text-slate-900">Rp 0</span>
                        <span class="text-xs text-slate-400 font-bold ml-1">/ Selamanya Gratis</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Profil profesional & etalase portofolio publik gratis</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Kirim proposal penawaran tanpa batas kuota</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Akses AI Job Matching & CV Optimizer</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Sistem pembayaran terlindungi Escrow</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Review bintang resmi untuk reputasi CV</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('register') }}" class="w-full py-3.5 px-4 text-center rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition-all shadow-md btn-press btn-shine">
                    Mulai Sebagai Talenta
                </a>
            </div>

            <!-- Card 2: Client Early Access (Featured / Popular) -->
            <div class="bg-white rounded-3xl p-8 sm:p-9 border-2 border-indigo-600 shadow-2xl shadow-indigo-600/15 transition-all duration-300 flex flex-col justify-between transform md:-translate-y-3 box-shine premium-border">
                <div>
                    <!-- Top Highlight Banner Inside Card (Never Clipped) -->
                    <div class="mb-6 -mt-2 -mx-2 py-2 px-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 text-white text-center font-black text-xs uppercase tracking-wider shadow-md flex items-center justify-center gap-2">
                        <span>🔥</span>
                        <span>Paling Populer &bull; 0% Fee Promo Beta</span>
                    </div>

                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-indigo-50 text-indigo-700 text-xs font-bold mb-5 border border-indigo-100">
                        <span>🏢</span>
                        <span>UMKM, Startup & Pemberi Proyek</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Bisnis & Klien</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6 leading-relaxed">
                        Rekrut talenta terampil langsung dari kampus unggulan dengan efisiensi anggaran maksimal.
                    </p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-5xl font-black text-indigo-600">Rp 0</span>
                        <span class="text-xs text-slate-500 font-bold ml-1">/ 0% Potongan Komisi</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Pasang lowongan proyek tanpa kuota limit</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Dashboard manajemen pelamar & shortlist</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Kontrak kerja digital & monitoring deadline</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Garansi refund jika hasil kerja tidak sesuai kesepakatan</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span><strong>0% biaya admin</strong> selama fase early access</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('register') }}" class="w-full py-4 px-4 text-center rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 text-white font-black text-xs sm:text-sm hover:opacity-95 transition-all shadow-xl shadow-indigo-600/30 btn-press btn-shine animate-glow-pulse">
                    Pasang Proyek Pertama
                </a>
            </div>

            <!-- Card 3: Enterprise / Kampus Partner -->
            <div class="bg-white rounded-3xl p-8 sm:p-9 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-purple-200 transition-all duration-300 flex flex-col justify-between box-shine">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-purple-50 text-purple-700 text-xs font-bold mb-5 border border-purple-100">
                        <span>🏛️</span>
                        <span>Universitas & CDC Kampus</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Campus Partner</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6 leading-relaxed">
                        Kolaborasi resmi Career Development Center (CDC) dan fakultas untuk penyaluran magang & proyek terakreditasi.
                    </p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-4xl font-black text-slate-900">Kemitraan</span>
                        <span class="text-xs text-slate-400 font-bold ml-1">/ MoA Kampus</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Dedicated dashboard Career Development Center</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Laporan serapan talenta mahasiswa & tracer study</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Konversi SKS magang terstruktur</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Dedicated Relationship Manager & Bantuan Legal</span>
                        </li>
                    </ul>
                </div>

                <a href="mailto:partnership@kerjakampus.id" class="w-full py-3.5 px-4 text-center rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition-all shadow-xs btn-press">
                    Ajukan Kemitraan Kampus
                </a>
            </div>
        </div>

        <!-- ✦ FEATURE COMPARISON MATRIX TABLE ✦ -->
        <div class="mb-24 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs overflow-hidden">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Perbandingan Fitur Lengkap</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Lihat benefit yang didapatkan untuk setiap tingkatan pengguna</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="py-3.5 px-4 font-bold text-slate-500 uppercase tracking-wider text-[11px]">Fitur Platform</th>
                            <th class="py-3.5 px-4 font-bold text-indigo-700 uppercase tracking-wider text-[11px] text-center">Talenta Mahasiswa</th>
                            <th class="py-3.5 px-4 font-bold text-indigo-700 uppercase tracking-wider text-[11px] text-center">Klien / Bisnis</th>
                            <th class="py-3.5 px-4 font-bold text-indigo-700 uppercase tracking-wider text-[11px] text-center">Kampus Mitra</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Biaya Pendaftaran</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600 font-bold">Gratis Rp 0</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600 font-bold">Gratis Rp 0</td>
                            <td class="py-3.5 px-4 text-center text-slate-700 font-bold">MoA</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Potongan Komisi (Platform Fee)</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600 font-bold">0%</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600 font-bold">0%</td>
                            <td class="py-3.5 px-4 text-center text-slate-400">-</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Proteksi Rekening Bersama (Escrow)</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Akses AI Career Copilot</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Batas Pengajuan Proposal / Posting Proyek</td>
                            <td class="py-3.5 px-4 text-center font-bold text-slate-900">Unlimited</td>
                            <td class="py-3.5 px-4 text-center font-bold text-slate-900">Unlimited</td>
                            <td class="py-3.5 px-4 text-center font-bold text-slate-900">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">Laporan Tracer Study CDC</td>
                            <td class="py-3.5 px-4 text-center text-slate-300">-</td>
                            <td class="py-3.5 px-4 text-center text-slate-300">-</td>
                            <td class="py-3.5 px-4 text-center text-emerald-600">✓</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ✦ FAQ SECTION ✦ -->
        <div class="max-w-3xl mx-auto bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs mb-20" x-data="{ openFaq: 1 }">
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight text-center mb-8">
                Pertanyaan Seputar Biaya & Pembayaran
            </h2>

            <div class="space-y-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <button type="button" @click="openFaq = openFaq === 1 ? 0 : 1" class="w-full text-left flex items-center justify-between font-bold text-sm text-slate-900">
                        <span>Apakah pendaftaran mahasiswa benar-benar 100% gratis?</span>
                        <span class="text-indigo-600 font-bold" x-text="openFaq === 1 ? '−' : '+'"></span>
                    </button>
                    <p x-show="openFaq === 1" class="text-xs text-slate-600 mt-2.5 leading-relaxed">
                        Ya, 100% gratis tanpa biaya bulanan maupun pendaftaran. Mahasiswa dapat membuat profil, memajang portofolio karya, dan melamar lowongan proyek tanpa biaya apa pun.
                    </p>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <button type="button" @click="openFaq = openFaq === 2 ? 0 : 2" class="w-full text-left flex items-center justify-between font-bold text-sm text-slate-900">
                        <span>Berapa potongan fee komisi yang diambil KerjaKampus?</span>
                        <span class="text-indigo-600 font-bold" x-text="openFaq === 2 ? '−' : '+'"></span>
                    </button>
                    <p x-show="openFaq === 2" class="text-xs text-slate-600 mt-2.5 leading-relaxed">
                        Selama fase Early Access Beta, komisi platform adalah <strong>0%</strong>! Seluruh nilai pembayaran proyek akan diterima utuh oleh talenta tanpa potongan fee platform.
                    </p>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <button type="button" @click="openFaq = openFaq === 3 ? 0 : 3" class="w-full text-left flex items-center justify-between font-bold text-sm text-slate-900">
                        <span>Bagaimana mekanisme keamanan pembayaran antara klien dan talenta?</span>
                        <span class="text-indigo-600 font-bold" x-text="openFaq === 3 ? '−' : '+'"></span>
                    </button>
                    <p x-show="openFaq === 3" class="text-xs text-slate-600 mt-2.5 leading-relaxed">
                        KerjaKampus menggunakan sistem rekening bersama (Escrow). Klien mendanai proyek saat proposal disetujui, dan dana disimpan aman. Dana baru dicairkan kepada talenta setelah deliverable pekerjaan diperiksa dan disetujui klien.
                    </p>
                </div>
            </div>
        </div>

        <!-- ✦ FINAL CTA ✦ -->
        <div class="text-center bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white p-10 sm:p-14 rounded-3xl border border-indigo-800/40 shadow-2xl relative overflow-hidden">
            <h3 class="text-2xl sm:text-4xl font-black tracking-tight mb-4">Mulai Tanpa Risiko Hari Ini</h3>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto mb-8 font-medium">
                Pilih peranmu dan raih kesempatan membangun portofolio profesional atau menyelesaikan proyek bisnismu.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-violet-600 text-white font-black text-xs sm:text-sm shadow-xl shadow-indigo-500/30 btn-press btn-shine animate-glow-pulse">
                    Daftar Akun Gratis
                </a>
                <a href="{{ url('/jobs') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold text-xs sm:text-sm transition-colors">
                    Lihat Lowongan Proyek
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
