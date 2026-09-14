@extends('layouts.dashboard')

@section('title', 'Manajemen Lowongan - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Manajemen & Moderasi Lowongan</h1>
        <p class="text-sm text-gray-500">Tinjau, moderasi, tutup atau buka lowongan pekerjaan di seluruh platform.</p>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('admin.jobs') }}" method="GET" class="bg-white p-4 rounded-2xl border border-gray-200 flex flex-wrap items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul pekerjaan..." class="px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none flex-1 min-w-[200px]">

        <select name="status" class="px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none">
            <option value="">Semua Status</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl">
            Filter
        </button>
        <a href="{{ route('admin.jobs') }}" class="px-3 py-2 text-sm text-gray-500 hover:underline">Reset</a>
    </form>

    <!-- Jobs Table -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5">Judul & Klien</th>
                        <th class="px-6 py-3.5">Kategori & Budget</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Pelamar</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($jobs as $job)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="font-bold text-gray-900 hover:text-indigo-600 block">
                                    {{ $job->title }}
                                </a>
                                <span class="text-xs text-gray-400">Oleh: {{ $job->client?->name }} ({{ $job->client?->company_name }})</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-semibold text-gray-800">{{ $job->category?->name ?? '-' }}</div>
                                <div class="text-xs text-indigo-600 font-bold">Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-md bg-gray-100 text-gray-700 uppercase">
                                    {{ $job->status->value ?? $job->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-700">
                                {{ $job->applicant_count }} Pelamar
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    @if(($job->status->value ?? $job->status) === 'open')
                                        <input type="hidden" name="status" value="closed">
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-600 hover:bg-red-50 rounded-lg border border-red-200">
                                            Tutup
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="open">
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-green-700 hover:bg-green-50 rounded-lg border border-green-200">
                                            Buka
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm">Tidak ada lowongan yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection

