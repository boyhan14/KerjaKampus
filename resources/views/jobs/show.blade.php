@extends('layouts.app')

@section('title', $job->title . ' - KerjaKampus')

@section('content')
<div class="bg-gray-50 min-h-screen py-10" x-data="{ applyModal: false, reportModal: false }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-xs text-gray-500 gap-2">
            <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
            <span>/</span>
            <a href="{{ route('jobs.index') }}" class="hover:underline">Lowongan</a>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate max-w-xs">{{ $job->title }}</span>
        </nav>

        <!-- Main Card -->
        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-10 shadow-sm space-y-8">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 pb-6 border-b border-gray-100">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                            {{ $job->category?->name ?? 'Kategori Umum' }}
                        </span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                            {{ ucfirst($job->work_mode->value ?? $job->work_mode) }}
                        </span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-50 text-purple-700 border border-purple-100">
                            {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? $job->job_type)) }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $job->title }}</h1>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">{{ $job->client?->company_name ?? $job->client?->name }}</span>
                        @if($job->location)
                            <span>&bull;</span>
                            <span>{{ $job->location }}</span>
                        @endif
                        <span>&bull;</span>
                        <span>Diposting {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Budget & CTA -->
                <div class="md:text-right space-y-3 shrink-0">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-indigo-600">
                            Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                        </div>
                        <p class="text-xs text-gray-400">Estimasi Kompensasi</p>
                    </div>

                    @guest
                        <a href="{{ route('login') }}" class="block w-full text-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm">
                            Masuk untuk Melamar
                        </a>
                    @else
                        @if(Auth::id() === $job->user_id)
                            <a href="{{ route('applications.job', $job->id) }}" class="block w-full text-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm">
                                Kelola Pelamar ({{ $job->applications()->count() }})
                            </a>
                        @elseif($hasApplied)
                            <div class="p-3 bg-green-50 rounded-xl border border-green-200 text-center">
                                <span class="text-xs font-bold text-green-700 block">Anda telah melamar</span>
                                <span class="text-[11px] text-green-600">Status: {{ ucfirst($userApplication->status->value ?? 'Pending') }}</span>
                            </div>
                        @elseif(($job->status->value ?? $job->status) !== 'open')
                            <div class="p-3 bg-gray-100 rounded-xl border border-gray-200 text-center text-xs font-bold text-gray-500">
                                Lowongan Ini Sudah Ditutup
                            </div>
                        @elseif(Auth::user()->isClient() && !Auth::user()->isAdmin())
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-200 text-center text-xs text-gray-500">
                                Akun Klien tidak dapat melamar lowongan.
                            </div>
                        @else
                            <button @click="applyModal = true" class="w-full px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md transition-all">
                                Lamar Sekarang
                            </button>
                        @endif
                    @endguest
                </div>
            </div>

            <!-- Job Description -->
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900">Deskripsi Pekerjaan</h3>
                <div class="text-gray-700 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                    {{ $job->description }}
                </div>
            </div>

            <!-- Required Skills -->
            <div class="space-y-3 pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Keahlian yang Dibutuhkan</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse($job->skills as $skill)
                        <span class="px-3 py-1.5 rounded-xl bg-gray-100 text-gray-800 text-xs font-semibold">
                            {{ $skill->name }}
                        </span>
                    @empty
                        <span class="text-xs text-gray-400">Tidak ada spesifikasi keahlian khusus.</span>
                    @endforelse
                </div>
            </div>

            <!-- Meta info grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-5 rounded-2xl bg-gray-50 border border-gray-100 text-xs">
                <div>
                    <span class="text-gray-400 block mb-1">Tingkat Pengalaman</span>
                    <span class="font-bold text-gray-800">{{ ucfirst($job->experience_level->value ?? $job->experience_level) }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-1">Batas Waktu Lamaran</span>
                    <span class="font-bold text-gray-800">{{ $job->deadline ? $job->deadline->format('d F Y') : 'Fleksibel' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-1">Total Pelamar</span>
                    <span class="font-bold text-gray-800">{{ $job->applicant_count }} Orang</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-1">Status Lowongan</span>
                    <span class="font-bold text-green-600">{{ ucfirst($job->status->value ?? $job->status) }}</span>
                </div>
            </div>

            <!-- Footer Action & Report -->
            <div class="pt-6 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                <span>ID Lowongan: #KK-{{ $job->id }}</span>
                @auth
                    <button @click="reportModal = true" class="text-red-600 hover:underline font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Laporkan Lowongan
                    </button>
                @endauth
            </div>
        </div>
    </div>

    <!-- Apply Modal -->
    @auth
        <div x-show="applyModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
            <div @click.away="applyModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl relative">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Kirim Lamaran Proyek</h3>
                        <p class="text-xs text-gray-500">{{ $job->title }}</p>
                    </div>
                    <button @click="applyModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form action="{{ route('applications.store', $job->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cover Letter / Surat Pengantar *</label>
                        <textarea name="cover_letter" rows="5" required placeholder="Jelaskan pengalamanmu, mengapa kamu cocok untuk pekerjaan ini, dan apa yang bisa kamu tawarkan..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Penawaran Harga (Rp)</label>
                            <input type="number" name="proposed_price" value="{{ $job->budget_min }}" placeholder="Contoh: 1500000" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Estimasi Waktu</label>
                            <input type="text" name="estimated_duration" placeholder="Contoh: 2 minggu" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <button type="button" @click="applyModal = false" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-sm">Kirim Lamaran</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Modal -->
        <div x-show="reportModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs">
            <div @click.away="reportModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 space-y-4 shadow-2xl relative">
                <h3 class="text-base font-bold text-gray-900">Laporkan Lowongan Ini</h3>
                <p class="text-xs text-gray-500">Bantu kami menjaga KerjaKampus tetap aman dari spam dan penipuan.</p>

                <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="target_type" value="job">
                    <input type="hidden" name="target_id" value="{{ $job->id }}">

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Alasan Pelaporan</label>
                        <select name="reason" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="Spam atau Penipuan">Spam atau Penipuan</option>
                            <option value="Konten Tidak Pantas">Konten Tidak Pantas</option>
                            <option value="Informasi Palsu">Informasi Palsu</option>
                            <option value="Pelanggaran Kebijakan">Pelanggaran Kebijakan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Detail Keterangan</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan indikasi pelanggaran..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" @click="reportModal = false" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-xl">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</div>
@endsection

