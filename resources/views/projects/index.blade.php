@extends('layouts.dashboard')

@section('title', 'Proyek Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Proyek Kolaborasi Saya</h1>
            <p class="text-sm text-gray-500">Pantau proyek aktif, deliverables, dan riwayat proyek yang telah selesai.</p>
        </div>
    </div>

    @if($projects->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Proyek Berjalan</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">
                Proyek akan otomatis terbentuk ketika tawaran/lamaran diterima oleh klien.
            </p>
            @if(Auth::user()->isClient())
                <a href="{{ route('jobs.my') }}" class="inline-block px-5 py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700">Cek Pelamar Lowonganmu</a>
            @else
                <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700">Cari Lowongan Pekerjaan</a>
            @endif
        </div>
    @else
        <div class="space-y-4">
            @foreach($projects as $project)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-2 min-w-0">
                        <div class="flex items-center gap-2">
                            @php
                                $statusBadge = match($project->status->value ?? $project->status) {
                                    'active' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'completed' => 'bg-green-50 text-green-700 border-green-200',
                                    'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                    default => 'bg-gray-100 text-gray-700 border-gray-200',
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-md border {{ $statusBadge }}">
                                {{ ucfirst($project->status->value ?? $project->status) }}
                            </span>
                            <span class="text-xs text-gray-400">Dimulai {{ $project->started_at ? $project->started_at->format('d M Y') : '-' }}</span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 hover:text-indigo-600 truncate">
                            <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                        </h3>

                        <p class="text-xs text-gray-500">
                            @if(Auth::id() === $project->client_id)
                                Talenta: <span class="font-semibold text-gray-800">{{ $project->talent?->name }}</span>
                            @else
                                Klien: <span class="font-semibold text-gray-800">{{ $project->client?->name }}</span>
                            @endif
                            &bull; Kompensasi: <span class="font-bold text-indigo-600">Rp {{ number_format($project->budget, 0, ',', '.') }}</span>
                            @if($project->deadline)
                                &bull; Batas Selesai: <span class="font-medium text-gray-700">{{ $project->deadline->format('d M Y') }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                        <a href="{{ route('projects.show', $project->id) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs">
                            Kelola Proyek &rarr;
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

