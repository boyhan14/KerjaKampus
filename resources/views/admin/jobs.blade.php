@extends('layouts.dashboard')

@section('title', 'Manajemen Lowongan - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2">
                Katalog Proyek
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Lowongan Kerja</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau dan moderasi status lowongan pekerjaan yang dipasang klien di platform.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center text-xs font-bold text-slate-700">
            Total: {{ $jobs->total() }} Lowongan
        </div>
    </div>

    <!-- Filter Toolbar -->
    <form action="{{ route('admin.jobs') }}" method="GET" class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[220px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul pekerjaan..." 
                class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <select name="status" class="px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <option value="">Semua Status</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-xs transition-colors">
            Filter
        </button>
        <a href="{{ route('admin.jobs') }}" class="px-4 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-700">Reset</a>
    </form>

    <!-- Jobs Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/70 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-4 w-16">ID</th>
                        <th class="px-6 py-4">Judul & Klien Pembuat</th>
                        <th class="px-6 py-4">Kategori & Rentang Anggaran</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Total Pelamar</th>
                        <th class="px-6 py-4 text-right">Aksi Moderasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jobs as $job)
                        @php 
                            $jStatus = $job->status->value ?? $job->status;
                            $statusBadge = match($jStatus) {
                                'open' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                'closed' => 'bg-slate-100 text-slate-600 border-slate-200',
                                'draft' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                'suspended' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-xs text-indigo-600">
                                #{{ $job->id }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-indigo-600 transition-colors block">
                                    {{ $job->title }}
                                </a>
                                <span class="text-xs text-slate-400 mt-0.5 block">
                                    Oleh: {{ $job->client?->name }} ({{ $job->client?->company_name ?? 'Personal' }})
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-bold text-slate-800">{{ $job->category?->name ?? 'Umum' }}</div>
                                <div class="text-xs font-black text-indigo-600 mt-0.5">
                                    Rp {{ number_format($job->budget_min, 0, ',', '.') }} - {{ number_format($job->budget_max, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[11px] font-black rounded-lg uppercase tracking-wider border {{ $statusBadge }}">
                                    {{ $jStatus }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-slate-700">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-black">
                                    {{ $job->applicant_count }} Pelamar
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    @if($jStatus === 'open')
                                        <input type="hidden" name="status" value="closed">
                                        <button type="submit" class="px-3.5 py-1.5 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl border border-rose-200/60 transition-colors" onclick="return confirm('Tutup lowongan ini? Lowongan tidak akan tampil di pencarian publik.');">
                                            Tutup Lowongan
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="open">
                                        <button type="submit" class="px-3.5 py-1.5 text-xs font-bold text-emerald-700 hover:bg-emerald-50 rounded-xl border border-emerald-200/60 transition-colors">
                                            Buka Lowongan
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-xs sm:text-sm">
                                Tidak ada lowongan pekerjaan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 sm:p-6 border-t border-slate-100">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection
