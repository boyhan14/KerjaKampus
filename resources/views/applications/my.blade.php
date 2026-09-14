@extends('layouts.dashboard')

@section('title', 'Lamaran Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Riwayat Lamaran Pekerjaan</h1>
        <p class="text-sm text-gray-500">Pantau status lamaran yang telah Anda kirimkan ke berbagai lowongan.</p>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Kamu Belum Melamar Project Apa Pun</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Jelajahi ratusan peluang gig, freelance, dan magang yang sesuai dengan keahlianmu sekarang.</p>
            <a href="{{ route('jobs.index') }}" class="inline-block px-5 py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700">Cari Lowongan</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-2 min-w-0">
                        <div class="flex items-center gap-2">
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
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-md border {{ $statusBadge }}">
                                {{ ucfirst($app->status->value ?? $app->status) }}
                            </span>
                            <span class="text-xs text-gray-400">Diajukan {{ $app->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 hover:text-indigo-600 truncate">
                            <a href="{{ route('jobs.show', $app->jobListing?->slug) }}">{{ $app->jobListing?->title }}</a>
                        </h3>

                        <p class="text-xs text-gray-500 line-clamp-1">
                            Klien: <span class="font-medium text-gray-700">{{ $app->jobListing?->client?->name }}</span>
                            @if($app->proposed_price)
                                &bull; Tawaranmu: <span class="font-semibold text-gray-800">Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</span>
                            @endif
                            @if($app->estimated_duration)
                                &bull; Estimasi: <span class="font-semibold text-gray-800">{{ $app->estimated_duration }}</span>
                            @endif
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                        @if(($app->status->value ?? $app->status) === 'accepted' && $app->project)
                            <a href="{{ route('projects.show', $app->project->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-xl shadow-xs">
                                Buka Proyek Kolaborasi &rarr;
                            </a>
                        @endif

                        @if(in_array($app->status->value ?? $app->status, ['pending', 'shortlisted']))
                            <form action="{{ route('applications.withdraw', $app->id) }}" method="POST" onsubmit="return confirm('Tarik kembali lamaran ini?');">
                                @csrf
                                <button type="submit" class="px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl border border-red-200">
                                    Tarik Lamaran
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('jobs.show', $app->jobListing?->slug) }}" class="px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50 rounded-xl border border-gray-200">
                            Detail Lowongan
                        </a>
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
