@extends('layouts.dashboard')

@section('title', 'Lowongan Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Manajemen Lowongan Pekerjaan</h1>
            <p class="text-sm text-gray-500">Kelola semua lowongan yang pernah Anda pasang di platform.</p>
        </div>
        <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Lowongan
        </a>
    </div>

    @if($jobs->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Lowongan Dipasang</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Mulai cari mahasiswa dan fresh graduate berbakat dengan memasang lowongan pertama Anda sekarang.</p>
            <a href="{{ route('jobs.create') }}" class="inline-block px-5 py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700">Pasang Lowongan Pertama</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($jobs as $job)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-2 min-w-0">
                        <div class="flex items-center gap-2">
                            @php
                                $statusBadge = match($job->status->value ?? $job->status) {
                                    'open' => 'bg-green-50 text-green-700 border-green-200',
                                    'closed' => 'bg-red-50 text-red-700 border-red-200',
                                    'draft' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    default => 'bg-gray-100 text-gray-700 border-gray-200',
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-md border {{ $statusBadge }}">
                                {{ ucfirst($job->status->value ?? $job->status) }}
                            </span>
                            <span class="text-xs text-gray-400">Dibuat {{ $job->created_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 hover:text-indigo-600 truncate">
                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>

                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                            <span class="font-semibold text-gray-700">Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}</span>
                            <span>&bull;</span>
                            <span>{{ ucfirst($job->work_mode->value ?? $job->work_mode) }}</span>
                            <span>&bull;</span>
                            <span class="font-bold text-indigo-600">{{ $job->applications_count }} Pelamar</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                        <a href="{{ route('applications.job', $job->id) }}" class="px-4 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-bold rounded-xl border border-indigo-200">
                            Lihat Pelamar ({{ $job->applications_count }})
                        </a>

                        <a href="{{ route('jobs.edit', $job->id) }}" class="px-3 py-2 bg-gray-50 text-gray-700 hover:bg-gray-100 text-xs font-semibold rounded-xl border border-gray-200">
                            Edit
                        </a>

                        <form action="{{ route('jobs.toggle-status', $job->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-2 text-xs font-semibold rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-700">
                                {{ ($job->status->value ?? $job->status) === 'open' ? 'Tutup' : 'Buka' }}
                            </button>
                        </form>

                        @if(($job->status->value ?? $job->status) === 'draft' || $job->applications_count == 0)
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus lowongan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 text-xs font-semibold rounded-xl text-red-600 hover:bg-red-50 border border-transparent">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
