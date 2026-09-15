@extends('layouts.app')

@section('title', 'Biaya & Skema Harga - KerjaKampus')

@section('content')
<div class="relative bg-slate-50 min-h-screen py-20 overflow-hidden">
    <!-- Ambient Background Lighting -->
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[450px] bg-gradient-to-tr from-indigo-500/10 via-purple-500/10 to-pink-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-bold tracking-wide uppercase mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Transparan & Terjangkau
            </div>
            <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-4">
                Investasi Terbaik untuk <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700">Masa Depan Karir & Bisnismu</span>
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Platform KerjaKampus dirancang inklusif untuk mahasiswa dan UMKM/Startup. Tanpa biaya pendaftaran tersembunyi selama masa Early Access Beta.
            </p>
        </div>

        <!-- Pricing Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-20">
            <!-- Card 1: Talent / Mahasiswa -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-slate-300 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center px-3 py-1 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold mb-4">
                        Untuk Mahasiswa & Fresh Grad
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Talenta Kampus</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6">Mulai bangun rekam jejak portofolio dan hasilkan uang saku tambahan.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-4xl font-black text-slate-900">Rp 0</span>
                        <span class="text-xs text-slate-400 font-medium">/ selamanya gratis daftar</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Profil profesional & portofolio publik gratis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Kirim lamaran tanpa batas ke semua proyek</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Akses fitur AI Job Matching otomatis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Ulasan & bintang reputasi terverifikasi</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('register') }}" class="w-full py-3.5 px-4 text-center rounded-2xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition-all shadow-sm">
                    Daftar Sebagai Talenta
                </a>
            </div>

            <!-- Card 2: Client Early Access (Featured / Popular) -->
            <div class="relative bg-white rounded-3xl p-8 border-2 border-indigo-600 shadow-2xl shadow-indigo-600/10 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between transform md:-translate-y-2">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-[11px] font-black uppercase tracking-wider py-1 px-4 rounded-full shadow-md">
                    Paling Populer &bull; Beta Promo
                </div>

                <div>
                    <div class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-bold mb-4">
                        Klien, UMKM & Startup
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Bisnis & Klien</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6">Rekrut talenta terampil dengan efisiensi biaya maksimal.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-4xl font-black text-indigo-600">Rp 0</span>
                        <span class="text-xs text-slate-400 font-medium">/ 0% Komisi Beta</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Pasang lowongan proyek tanpa kuota limit</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Manajemen pelamar, shortlist & penerimaan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Kolaborasi proyek & pelaporan milestone</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Tanpa potongan fee platform (0% platform fee)</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('register') }}" class="w-full py-3.5 px-4 text-center rounded-2xl bg-indigo-600 text-white font-bold text-xs hover:bg-indigo-700 transition-all shadow-md shadow-indigo-600/30">
                    Pasang Lowongan Pertama
                </a>
            </div>

            <!-- Card 3: Enterprise / Kampus Partner -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-slate-300 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center px-3 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-bold mb-4">
                        Institusi & Kampus
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Campus Partnership</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6">Untuk universitas, CDC, atau inkubator bisnis kampus.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-slate-100">
                        <span class="text-3xl font-black text-slate-900">Custom</span>
                        <span class="text-xs text-slate-400 font-medium">/ MoA Kampus</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-slate-700 mb-8">
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Dedicated dashboard Career Development Center</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Laporan serapan talenta & tracer study</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Integrasi program magang ber-SKS</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>Dedicated Account Manager & Support</span>
                        </li>
                    </ul>
                </div>

                <a href="mailto:partnership@kerjakampus.id" class="w-full py-3.5 px-4 text-center rounded-2xl bg-slate-100 text-slate-800 font-bold text-xs hover:bg-slate-200 transition-all">
                    Hubungi Tim Kemitraan
                </a>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-3xl mx-auto bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-sm">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight text-center mb-8">Pertanyaan yang Sering Diajukan</h2>

            <div class="space-y-6 divide-y divide-slate-100">
                <div class="pt-4 first:pt-0">
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Apakah pendaftaran mahasiswa benar-benar gratis?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Ya, 100% gratis. Mahasiswa dapat membuat profil, memajang portofolio, dan melamar pekerjaan tanpa dipungut biaya langganan apa pun.
                    </p>
                </div>

                <div class="pt-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Bagaimana skema pembayaran proyek antara klien dan talenta?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Klien dan talenta menyepakati nilai kompensasi di platform. Selama periode early access, KerjaKampus tidak memungut biaya potongan komisi sehingga pembayaran diterima penuh oleh talenta.
                    </p>
                </div>

                <div class="pt-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Apakah saya bisa berganti peran menjadi Klien dan Talenta sekaligus?</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Tentu saja. Anda dapat memilih peran saat mendaftar dan dapat menggunakan fitur posting proyek maupun melamar pekerjaan sesuai kebutuhan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
