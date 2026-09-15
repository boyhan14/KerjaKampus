@extends('layouts.app')

@section('title', $job->title . ' - KerjaKampus')

@section('content')
<div class="bg-slate-50 min-h-screen py-8 sm:py-12" x-data="{ applyModal: false, reportModal: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-xs font-semibold text-slate-400 gap-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span>/</span>
            <a href="{{ route('jobs.index') }}" class="hover:text-indigo-600 transition-colors">Lowongan</a>
            <span>/</span>
            <span class="text-slate-700 truncate max-w-xs">{{ $job->title }}</span>
        </nav>

        <!-- Two-column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Job Details & Client Profile -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Main Job Card -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs space-y-8">
                    
                    <!-- Header Badges & Title -->
                    <div class="space-y-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100/60">
                                {{ $job->category?->name ?? 'Kategori Umum' }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100/60">
                                {{ ucfirst($job->work_mode->value ?? $job->work_mode) }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-violet-50 text-violet-700 border border-violet-100/60">
                                {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? $job->job_type)) }}
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                            {{ $job->title }}
                        </h1>
                        
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 font-medium pt-1">
                            <span class="font-bold text-slate-800 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                {{ $job->client?->company_name ?? $job->client?->name }}
                            </span>
                            @if($job->location)
                                <span>&bull;</span>
                                <span>{{ $job->location }}</span>
                            @endif
                            <span>&bull;</span>
                            <span>Diposting {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Job Description Content -->
                    <div class="space-y-3 pt-6 border-t border-slate-100">
                        <h3 class="text-base font-bold text-slate-900">Deskripsi & Ruang Lingkup Proyek</h3>
                        <div class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line space-y-2">
                            {{ $job->description }}
                        </div>
                    </div>

                    <!-- Required Skills -->
                    <div class="space-y-3 pt-6 border-t border-slate-100">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Keahlian yang Dibutuhkan</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($job->skills as $skill)
                                <span class="px-3 py-1.5 rounded-xl bg-slate-50 text-slate-700 text-xs font-semibold border border-slate-200/80">
                                    {{ $skill->name }}
                                </span>
                            @empty
                                <span class="text-xs text-slate-400">Tidak ada spesifikasi keahlian khusus.</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Footer Action & Report -->
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                        <span class="font-mono">Ref: #KK-JOB-{{ $job->id }}</span>
                        @auth
                            <button @click="reportModal = true" class="text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1.5 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Laporkan Lowongan
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Client Info Card -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                    <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Tentang Pemberi Kerja (Klien)
                    </h3>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-black text-lg shrink-0">
                            {{ substr($job->client?->company_name ?? ($job->client?->name ?? 'K'), 0, 1) }}
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-slate-900">
                                {{ $job->client?->company_name ?? $job->client?->name }}
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ $job->client?->company_description ?? 'Pemberi kerja terdaftar di platform KerjaKampus.' }}
                            </p>
                            @if($job->client?->website)
                                <a href="{{ $job->client->website }}" target="_blank" rel="noopener" class="text-xs font-bold text-indigo-600 hover:underline inline-block pt-1">
                                    Kunjungi Website &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sticky Apply & Meta Box -->
            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-6 sticky top-24">
                    
                    <!-- Budget Section -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block mb-1">Kompensasi Proyek</span>
                        <div class="text-2xl font-black text-indigo-600">
                            Rp {{ number_format($job->budget_min, 0, ',', '.') }}
                        </div>
                        <div class="text-xs font-semibold text-slate-500 mt-0.5">
                            hingga Rp {{ number_format($job->budget_max, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Action Button Area -->
                    <div>
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm shadow-md shadow-indigo-500/20 transition-all btn-press">
                                Masuk untuk Melamar
                            </a>
                        @else
                            @if(Auth::id() === $job->user_id)
                                <a href="{{ route('applications.job', $job->id) }}" class="block w-full text-center px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm shadow-md shadow-indigo-500/20 transition-all">
                                    Kelola Pelamar ({{ $job->applications()->count() }})
                                </a>
                            @elseif($hasApplied)
                                <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-200/80 text-center space-y-1">
                                    <span class="text-xs font-bold text-emerald-800 flex items-center justify-center gap-1.5">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Lamaran Telah Terkirim
                                    </span>
                                    <span class="text-[11px] font-semibold text-emerald-700 block">Status: {{ ucfirst($userApplication->status->value ?? 'Pending') }}</span>
                                </div>
                            @elseif(($job->status->value ?? $job->status) !== 'open')
                                <div class="p-4 bg-slate-100 rounded-2xl border border-slate-200 text-center text-xs font-bold text-slate-500">
                                    Lowongan Ini Telah Ditutup
                                </div>
                            @elseif(Auth::user()->isClient() && !Auth::user()->isAdmin())
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-center text-xs font-semibold text-slate-500">
                                    Akun Klien tidak dapat melamar lowongan.
                                </div>
                            @else
                                <button @click="applyModal = true" class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm shadow-md shadow-indigo-500/25 transition-all btn-press">
                                    Ajukan Lamaran Sekarang
                                </button>
                            @endif
                        @endguest
                    </div>

                    <!-- Key Metadata List -->
                    <div class="space-y-3.5 pt-4 border-t border-slate-100 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-medium">Batas Waktu:</span>
                            <span class="font-bold text-slate-800">{{ $job->deadline ? $job->deadline->format('d F Y') : 'Fleksibel' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-medium">Tingkat Keahlian:</span>
                            <span class="font-bold text-slate-800">{{ ucfirst($job->experience_level->value ?? $job->experience_level) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-medium">Total Pelamar:</span>
                            <span class="font-bold text-slate-800">{{ $job->applicant_count }} Orang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 font-medium">Status Lowongan:</span>
                            <span class="font-bold text-emerald-600">{{ ucfirst($job->status->value ?? $job->status) }}</span>
                        </div>
                    </div>

                    <!-- Safety Guarantee -->
                    <div class="p-3.5 rounded-2xl bg-indigo-50/50 border border-indigo-100/60 text-[11px] text-slate-600 space-y-1">
                        <div class="flex items-center gap-1.5 font-bold text-indigo-900">
                            <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Jaminan KerjaKampus
                        </div>
                        <p class="text-slate-500">Klien dan talenta dilindungi perjanjian proyek yang jelas dan sistem penilaian transparan.</p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Apply Modal -->
    @auth
        <div x-show="applyModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="applyModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl relative border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Kirim Lamaran Proyek</h3>
                        <p class="text-xs text-slate-500 truncate max-w-xs">{{ $job->title }}</p>
                    </div>
                    <button @click="applyModal = false" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form action="{{ route('applications.store', $job->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Surat Pengantar / Proposal *</label>
                        <textarea name="cover_letter" rows="5" required placeholder="Jelaskan pengalamanmu, portofolio yang relevan, dan mengapa kamu adalah orang yang tepat untuk proyek ini..." class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tawaran Biaya (Rp)</label>
                            <input type="number" name="proposed_price" value="{{ $job->budget_min }}" placeholder="Contoh: 1500000" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Estimasi Waktu</label>
                            <input type="text" name="estimated_duration" placeholder="Contoh: 2 minggu" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <button type="button" @click="applyModal = false" class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20 transition-all btn-press">Kirim Lamaran</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Modal -->
        <div x-show="reportModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="reportModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 space-y-4 shadow-2xl relative border border-slate-200">
                <h3 class="text-base font-bold text-slate-900">Laporkan Lowongan Ini</h3>
                <p class="text-xs text-slate-500">Bantu kami menjaga ekosistem KerjaKampus tetap aman dan bebas penipuan.</p>

                <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="target_type" value="job">
                    <input type="hidden" name="target_id" value="{{ $job->id }}">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Alasan Pelaporan</label>
                        <select name="reason" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                            <option value="Spam atau Penipuan">Spam atau Penipuan</option>
                            <option value="Konten Tidak Pantas">Konten Tidak Pantas</option>
                            <option value="Informasi Palsu">Informasi Palsu</option>
                            <option value="Pelanggaran Kebijakan">Pelanggaran Kebijakan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Detail Keterangan</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan detail indikasi kecurangan..." class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                        <button type="button" @click="reportModal = false" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow-xs">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</div>
@endsection
