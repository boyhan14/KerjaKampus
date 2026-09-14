@extends('layouts.dashboard')

@section('title', 'Pelamar untuk ' . $job->title . ' - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('jobs.my') }}" class="hover:underline">&larr; Lowongan Saya</a>
                <span>/</span>
                <span class="truncate max-w-xs">{{ $job->title }}</span>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Daftar Pelamar ({{ $applications->total() }})</h1>
        </div>
        <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:underline">
            Lihat Halaman Publik &rarr;
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Pelamar</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Lowongan ini belum menerima lamaran dari talenta. Anda dapat membagikan link lowongan untuk menarik pelamar.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xs space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center shrink-0 text-lg uppercase">
                                {{ substr($app->talent?->name ?? 'T', 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-base">
                                    <a href="{{ route('talents.show', $app->talent?->username ?? '') }}" target="_blank" class="hover:text-indigo-600">
                                        {{ $app->talent?->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500">{{ $app->talent?->education ?? $app->talent?->location }}</p>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                                    @if($app->proposed_price)
                                        <span class="font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md">Tawaran: Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</span>
                                    @endif
                                    @if($app->estimated_duration)
                                        <span class="text-gray-600 bg-gray-100 px-2 py-0.5 rounded-md">Waktu: {{ $app->estimated_duration }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @php
                            $statusBadge = match($app->status->value ?? $app->status) {
                                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'shortlisted' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'accepted' => 'bg-green-50 text-green-700 border-green-200',
                                'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                'withdrawn' => 'bg-gray-100 text-gray-600 border-gray-200',
                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-bold rounded-lg border {{ $statusBadge }} self-start">
                            {{ ucfirst($app->status->value ?? $app->status) }}
                        </span>
                    </div>

                    <!-- Cover Letter -->
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-xs sm:text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                        <span class="font-bold text-gray-900 block mb-1">Surat Pengantar:</span>
                        {{ $app->cover_letter }}
                    </div>

                    <!-- Talent Skills & Portfolio Quick View -->
                    @if($app->talent?->skills?->isNotEmpty())
                        <div class="flex flex-wrap items-center gap-1.5 pt-2">
                            <span class="text-xs text-gray-400 mr-1">Skills:</span>
                            @foreach($app->talent->skills->take(5) as $skill)
                                <span class="px-2 py-0.5 text-[11px] font-medium bg-white text-gray-600 rounded border border-gray-200">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Management Actions -->
                    <div class="pt-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
                        <a href="{{ route('talents.show', $app->talent?->username ?? '') }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:underline">
                            Lihat Profil & Portofolio Lengkap &rarr;
                        </a>

                        @if(($app->status->value ?? $app->status) === 'accepted')
                            <span class="text-xs font-bold text-green-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Telah Diterima & Proyek Aktif
                            </span>
                        @elseif(($app->status->value ?? $app->status) !== 'withdrawn')
                            <div class="flex items-center gap-2">
                                @if(($app->status->value ?? $app->status) !== 'shortlisted')
                                    <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="shortlist">
                                        <button type="submit" class="px-3 py-1.5 text-xs font-bold rounded-lg border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100">
                                            Shortlist
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Terima pelamar ini? Proyek kolaborasi baru akan otomatis dibuat.');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="accept">
                                    <button type="submit" class="px-4 py-1.5 text-xs font-bold rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-xs">
                                        Terima & Buat Proyek
                                    </button>
                                </form>

                                @if(($app->status->value ?? $app->status) !== 'rejected')
                                    <form action="{{ route('applications.update-status', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak lamaran ini?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="reject">
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-lg text-red-600 hover:bg-red-50 border border-transparent">
                                            Tolak
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
