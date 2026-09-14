@extends('layouts.dashboard')

@section('title', 'Semua Pelamar Masuk - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Semua Pelamar Masuk</h1>
            <p class="text-sm text-gray-500">Tinjau seluruh pelamar dari semua lowongan pekerjaan yang Anda buat.</p>
        </div>
        <a href="{{ route('jobs.my') }}" class="text-xs font-bold text-indigo-600 hover:underline">
            &larr; Kelola per Lowongan
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Pelamar</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Anda belum menerima lamaran dari talenta untuk lowongan Anda saat ini.</p>
            <a href="{{ route('jobs.create') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-xs hover:bg-indigo-700">
                + Pasang Lowongan Baru
            </a>
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
                                    <a href="{{ route('talents.show', $app->talent?->username ?? $app->talent?->id ?? '') }}" target="_blank" class="hover:text-indigo-600">
                                        {{ $app->talent?->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500">
                                    Melamar untuk: 
                                    <a href="{{ route('jobs.show', $app->jobListing?->slug ?? $app->jobListing?->id) }}" class="font-semibold text-indigo-600 hover:underline">
                                        {{ $app->jobListing?->title }}
                                    </a>
                                </p>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                                    @if($app->proposed_price)
                                        <span class="font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md">Tawaran: Rp {{ number_format($app->proposed_price, 0, ',', '.') }}</span>
                                    @endif
                                    @if($app->estimated_duration)
                                        <span class="text-gray-600 bg-gray-100 px-2 py-0.5 rounded-md">Waktu: {{ $app->estimated_duration }}</span>
                                    @endif
                                    <span class="text-gray-400">Diajukan {{ $app->created_at->diffForHumans() }}</span>
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
                        <span class="px-3 py-1 text-xs font-bold rounded-lg border {{ $statusBadge }} shrink-0">
                            {{ ucfirst($app->status->value ?? $app->status) }}
                        </span>
                    </div>

                    <!-- Cover letter excerpt -->
                    <div class="p-4 bg-gray-50 rounded-xl text-xs text-gray-700 leading-relaxed">
                        <span class="font-bold block text-gray-900 mb-1">Cover Letter:</span>
                        {{ $app->cover_letter }}
                    </div>

                    <!-- Action buttons -->
                    @if(in_array($app->status->value ?? $app->status, ['pending', 'shortlisted']))
                        <div class="pt-3 border-t border-gray-100 flex flex-wrap items-center justify-end gap-2">
                            @if(($app->status->value ?? $app->status) === 'pending')
                                <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="shortlist">
                                    <button type="submit" class="px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-semibold border border-blue-200">
                                        Shortlist
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="reject">
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-lg border border-red-200" onclick="return confirm('Tolak lamaran ini?');">
                                    Tolak
                                </button>
                            </form>

                            <form action="{{ route('applications.update-status', $app->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-bold shadow-xs" onclick="return confirm('Terima pelamar ini? Proyek baru akan otomatis dibuat.');">
                                    Terima & Buat Proyek
                                </button>
                            </form>
                        </div>
                    @elseif(($app->status->value ?? $app->status) === 'accepted' && $app->project)
                        <div class="pt-3 border-t border-gray-100 flex items-center justify-end">
                            <a href="{{ route('projects.show', $app->project->id) }}" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-bold shadow-xs">
                                Buka Proyek &rarr;
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

