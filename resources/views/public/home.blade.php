@extends('layouts.app')

@section('title', 'KerjaKampus - Platform Karier & Marketplace Proyek Mahasiswa')

@section('content')
<!-- Hero Section with Ambient Background -->
<section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-32 bg-white">
    <!-- Ambient Gradient Orbs -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-32 left-1/4 w-96 h-96 bg-indigo-200/50 rounded-full blur-3xl"></div>
        <div class="absolute top-10 right-1/4 w-80 h-80 bg-violet-200/50 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50/80 border border-indigo-100/80 text-indigo-700 text-xs font-bold mb-8 shadow-xs">
                <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                Marketplace Talenta Mahasiswa & Fresh Graduate #1
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
                Ubah Skill Kuliah Jadi <br class="hidden sm:inline">
                <span class="text-gradient">Peluang Karier & Cuan Nyata.</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto font-medium">
                Temukan proyek freelance, gig fleksibel, dan magang dari ratusan klien & UMKM. Bangun portofolio profesional nyata sebelum wisuda.
            </p>

            <!-- Dual Action CTAs -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-12">
                <a href="{{ url('/jobs') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/30 transition-all btn-press">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Cari Proyek Tersedia</span>
                </a>
                <a href="{{ url('/register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-white border border-slate-200 hover:border-slate-300 text-slate-800 hover:bg-slate-50 font-bold text-sm sm:text-base shadow-xs transition-all">
                    <span>Pasang Lowongan / Rekrut</span>
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Social Proof Bar -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-4 border-t border-slate-100">
                <div class="flex -space-x-2 overflow-hidden">
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-black">A</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-black">S</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-amber-100 text-amber-700 flex items-center justify-center text-xs font-black">R</span>
                    <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-rose-100 text-rose-700 flex items-center justify-center text-xs font-black">D</span>
                </div>
                <div class="text-xs text-slate-500 font-semibold text-left">
                    <div class="flex items-center gap-1 text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-slate-800 font-bold ml-1 text-xs">4.9 / 5.0</span>
                    </div>
                    <span class="text-[11px] text-slate-500">Dipercaya mahasiswa dari 50+ universitas se-Indonesia</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Floating Platform Stats -->
<section class="relative z-20 -mt-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/80 grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">{{ number_format($talentCount ?? 0) }}+</p>
                <p class="text-xs font-semibold text-slate-500">Talenta Mahasiswa</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">{{ number_format($jobCount ?? 0) }}+</p>
                <p class="text-xs font-semibold text-slate-500">Lowongan Proyek</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">{{ number_format($skillCount ?? 0) }}+</p>
                <p class="text-xs font-semibold text-slate-500">Skill Terverifikasi</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">100%</p>
                <p class="text-xs font-semibold text-slate-500">Proyek Terverifikasi</p>
            </div>
        </div>
    </div>
</section>

<!-- Trending Jobs Section -->
<section class="py-20 lg:py-28 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span> Peluang Terkini
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Proyek Trending Minggu Ini</h2>
                <p class="text-sm sm:text-base text-slate-500 mt-2">Dapatkan tawaran kerja remote, freelance, dan part-time dengan kompensasi transparan.</p>
            </div>
            <a href="{{ url('/jobs') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                <span>Lihat Semua Lowongan</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredJobs ?? [] as $job)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs card-hover flex flex-col justify-between">
                <div>
                    <!-- Header Info & Category -->
                    <div class="flex items-start justify-between gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/60">
                            {{ $job->category?->name ?? 'Umum' }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">
                                {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? ($job->job_type ?? 'Freelance'))) }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ ucfirst($job->work_mode->value ?? ($job->work_mode ?? 'Remote')) }}
                            </span>
                        </div>
                    </div>

                    <!-- Job Title -->
                    <h3 class="text-lg font-bold text-slate-900 mb-2 leading-snug line-clamp-2">
                        <a href="{{ route('jobs.show', $job->slug ?? $job->id) }}" class="hover:text-indigo-600 transition-colors">
                            {{ $job->title }}
                        </a>
                    </h3>

                    <!-- Client Name -->
                    <p class="text-xs text-slate-500 mb-4 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $job->client?->company_name ?? ($job->client?->name ?? 'Klien Terverifikasi') }}
                    </p>

                    <!-- Budget Range -->
                    <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-100 mb-5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Estimasi Budget</span>
                        <span class="text-base font-extrabold text-indigo-600">
                            Rp {{ number_format($job->budget_min ?? 0, 0, ',', '.') }} - {{ number_format($job->budget_max ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Skills Chips -->
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        @foreach(collect($job->skills ?? [])->take(3) as $skill)
                            <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-medium">
                                {{ $skill->name ?? $skill }}
                            </span>
                        @endforeach
                        @if(count($job->skills ?? []) > 3)
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-400 text-xs font-medium">
                                +{{ count($job->skills) - 3 }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Deadline: {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Fleksibel' }}</span>
                    <a href="{{ route('jobs.show', $job->slug ?? $job->id) }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors inline-flex items-center gap-1">
                        Detail &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-slate-200">
                <p class="text-slate-500 font-medium text-sm">Belum ada proyek terbaru saat ini. Silakan cek kembali nanti!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span> Panduan Mudah
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Bagaimana Cara Kerjanya?</h2>
            <p class="text-sm sm:text-base text-slate-500 mt-2">Mulai langkah karier freelance Anda hanya dalam 4 langkah sederhana.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="p-6 rounded-3xl bg-slate-50/70 border border-slate-100 relative group hover:bg-indigo-50/30 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-indigo-500/20">
                    01
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Lengkapi Profil</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Daftar gratis, isi riwayat pendidikan kampus, portofolio karya, dan keahlian yang kamu kuasai.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-6 rounded-3xl bg-slate-50/70 border border-slate-100 relative group hover:bg-indigo-50/30 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-indigo-500/20">
                    02
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Pilih Proyek Cocok</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gunakan filter pencarian cerdas atau AI Job Matcher untuk menemukan lowongan yang pas dengan skillmu.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-6 rounded-3xl bg-slate-50/70 border border-slate-100 relative group hover:bg-indigo-50/30 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-indigo-500/20">
                    03
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Ajukan Proposal</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Kirim penawaran menarik, tentukan estimasi waktu & harga. Klien akan meninjau dan menerima proposalmu.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-6 rounded-3xl bg-slate-50/70 border border-slate-100 relative group hover:bg-indigo-50/30 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-indigo-500/20">
                    04
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Selesaikan & Nilai</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Selesaikan deliverable, dapatkan pembayaran dan ulasan bintang 5 untuk meningkatkan reputasi profesionalmu.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- AI Career Copilot Section -->
<section class="py-20 lg:py-28 bg-slate-950 text-white relative overflow-hidden">
    <!-- Ambient glowing light -->
    <div class="absolute -top-24 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <div class="lg:w-1/2 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/20 text-indigo-400 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                    KerjaKampus AI Copilot
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                    Akselerasi Kariermu Dengan <span class="text-gradient">Kecerdasan Buatan.</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                    Kami melengkapi setiap mahasiswa dengan AI Career Assistant yang menganalisis gap keahlian, membedah CV agar lolos seleksi, dan merekomendasikan lowongan yang paling relevan.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-xs mb-3">🎯</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">Smart Job Matching</h4>
                        <p class="text-xs text-slate-400">Pencocokan algoritma otomatis lowongan dengan skill profil Anda.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-violet-500/20 text-violet-400 flex items-center justify-center font-bold text-xs mb-3">📄</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">CV & Resume Analyzer</h4>
                        <p class="text-xs text-slate-400">Dapatkan saran perbaikan kalimat dan kata kunci agar menarik bagi klien.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs mb-3">✍️</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">AI Portfolio Writer</h4>
                        <p class="text-xs text-slate-400">Buat deskripsi portofolio yang profesional dan menjual dalam hitungan detik.</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                        <div class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-xs mb-3">📈</div>
                        <h4 class="font-bold text-sm text-slate-200 mb-1">Career Trajectory</h4>
                        <p class="text-xs text-slate-400">Insight roadmap keahlian yang paling banyak dicari di industri saat ini.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ url('/register') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition-all btn-press">
                        <span>Coba AI Assistant Sekarang</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- AI Interactive Preview Card -->
            <div class="lg:w-1/2 w-full">
                <div class="p-6 sm:p-8 rounded-3xl bg-slate-900 border border-slate-800 shadow-2xl space-y-4">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        </div>
                        <span class="text-xs font-mono text-slate-500">ai_career_copilot.py</span>
                    </div>

                    <div class="space-y-3 font-mono text-xs">
                        <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80 text-indigo-300">
                            &gt; Menganalisis profil mahasiswa: <span class="text-white">Andi Pratama</span><br>
                            &gt; Jurusan: Teknik Informatika • Pengalaman: 1 Tahun
                        </div>

                        <div class="p-3.5 rounded-xl bg-indigo-950/40 border border-indigo-800/40 text-slate-300 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-indigo-400 font-bold">Skor Kecocokan Proyek</span>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 font-bold text-[11px]">94% Sangat Cocok</span>
                            </div>
                            <p class="text-[11px] text-slate-400 font-sans">
                                "Profil Anda memiliki skill kuat di Laravel & Tailwind CSS yang dibutuhkan pada lowongan 'Fullstack Web App UMKM'."
                            </p>
                        </div>

                        <div class="p-3.5 rounded-xl bg-slate-950/60 border border-slate-800/80 text-slate-400 space-y-1">
                            <span class="text-amber-400 font-bold">Rekomendasi AI:</span>
                            <p class="text-[11px] font-sans">
                                Tambahkan 1 karya portofolio terkait API Integration untuk memperbesar peluang diterima hingga 2.5x lipat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Talents Section -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span> Talenta Unggulan
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Talenta Mahasiswa Berprestasi</h2>
                <p class="text-sm sm:text-base text-slate-500 mt-2">Pilih mahasiswa dengan keahlian terverifikasi dan siap bekerja secara profesional.</p>
            </div>
            <a href="{{ url('/talents') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                <span>Eksplorasi Semua Talenta</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($topTalents ?? [] as $talent)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 text-center shadow-xs card-hover flex flex-col justify-between">
                <div>
                    <!-- Avatar -->
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        @if($talent->avatar)
                            <img class="w-20 h-20 rounded-2xl object-cover ring-2 ring-indigo-50" src="{{ asset('storage/' . $talent->avatar) }}" alt="{{ $talent->name }}">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white font-black text-2xl shadow-xs">
                                {{ substr($talent->name ?? 'A', 0, 1) }}
                            </div>
                        @endif
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 ring-2 ring-white flex items-center justify-center text-white text-[10px]">
                            ✓
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                        <a href="{{ route('talents.show', $talent->username ?? $talent->id) }}">{{ $talent->name }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 mb-3">{{ $talent->location ?? 'Indonesia' }}</p>

                    <!-- Rating Stars -->
                    <div class="flex items-center justify-center gap-1 text-amber-400 mb-3">
                        @php $avgRating = method_exists($talent, 'averageRating') ? $talent->averageRating() : 5; @endphp
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= ($avgRating > 0 ? $avgRating : 5) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-xs font-bold text-slate-700 ml-1">{{ number_format($avgRating > 0 ? $avgRating : 5, 1) }}</span>
                    </div>

                    <p class="text-xs text-slate-500 line-clamp-2 mb-4 leading-relaxed">
                        {{ $talent->bio ?? 'Mahasiswa antusias yang siap mengerjakan proyek dengan penuh dedikasi.' }}
                    </p>

                    <!-- Skills -->
                    <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                        @foreach(collect($talent->skills ?? [])->take(3) as $skill)
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-medium">
                                {{ $skill->name ?? $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('talents.show', $talent->username ?? $talent->id) }}" class="w-full py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition-all">
                    Lihat Profil & Portofolio
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-400 text-sm">
                Profil talenta sedang diperbarui.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Final Call To Action Banner -->
<section class="py-20 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-800 text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
        <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
            Peluang Terbaik Menanti.<br>Mulai Kariermu Sekarang.
        </h2>
        <p class="text-sm sm:text-base text-indigo-100 max-w-xl mx-auto">
            Bergabunglah dengan ekosistem KerjaKampus hari ini. Gratis pendaftaran untuk talenta maupun klien.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-2">
            <a href="{{ url('/register') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-white text-indigo-700 font-black text-sm shadow-xl hover:bg-slate-50 transition-all btn-press">
                Daftar Akun Sekarang
            </a>
            <a href="{{ url('/jobs') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-indigo-500/30 border border-white/30 text-white font-bold text-sm hover:bg-indigo-500/40 transition-all">
                Cari Proyek
            </a>
        </div>
    </div>
</section>
@endsection
