@extends('layouts.dashboard')

@section('title', 'Laporan & Moderasi - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold uppercase tracking-wider mb-2 border border-rose-200/60">
                Pusat Moderasi & Keamanan
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Laporan Aduan Pelanggaran</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Tinjau laporan dari pengguna terkait indikasi spam, penipuan, atau konten tidak patut.</p>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-center">
            <span class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-xs font-bold text-slate-700">
                Menampilkan: <strong class="text-indigo-600">{{ $reports->total() }}</strong> Laporan
            </span>
        </div>
    </div>

    <!-- Quick Status Pills -->
    <div class="flex flex-wrap items-center gap-2.5">
        @php
            $currentStatus = request('status', '');
        @endphp
        <a href="{{ route('admin.reports', request()->except('page', 'status')) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentStatus === '' ? 'bg-slate-900 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-slate-700 hover:bg-slate-50' }}"
           style="{{ $currentStatus === '' ? 'background-color: #0f172a !important; color: #ffffff !important;' : '' }}">
            <span>Semua Laporan</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === '' ? 'bg-slate-800 text-slate-200' : 'bg-slate-100 text-slate-700' }}"
                  style="{{ $currentStatus === '' ? 'background-color: #1e293b !important; color: #f1f5f9 !important;' : '' }}">
                {{ $stats['total'] ?? 0 }}
            </span>
        </a>

        <a href="{{ route('admin.reports', array_merge(request()->except('page'), ['status' => 'pending'])) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentStatus === 'pending' ? 'bg-amber-500 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-amber-700 hover:bg-amber-50/50' }}"
           style="{{ $currentStatus === 'pending' ? 'background-color: #f59e0b !important; color: #ffffff !important;' : '' }}">
            <span>Menunggu Tindakan</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'pending' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800' }}"
                  style="{{ $currentStatus === 'pending' ? 'background-color: #d97706 !important; color: #ffffff !important;' : '' }}">
                {{ $stats['pending'] ?? 0 }}
            </span>
        </a>

        <a href="{{ route('admin.reports', array_merge(request()->except('page'), ['status' => 'resolved'])) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentStatus === 'resolved' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-emerald-700 hover:bg-emerald-50/50' }}"
           style="{{ $currentStatus === 'resolved' ? 'background-color: #059669 !important; color: #ffffff !important;' : '' }}">
            <span>Selesai (Resolved)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'resolved' ? 'bg-emerald-700 text-white' : 'bg-emerald-100 text-emerald-800' }}"
                  style="{{ $currentStatus === 'resolved' ? 'background-color: #047857 !important; color: #ffffff !important;' : '' }}">
                {{ $stats['resolved'] ?? 0 }}
            </span>
        </a>

        <a href="{{ route('admin.reports', array_merge(request()->except('page'), ['status' => 'dismissed'])) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentStatus === 'dismissed' ? 'bg-slate-800 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-slate-700 hover:bg-slate-50' }}"
           style="{{ $currentStatus === 'dismissed' ? 'background-color: #334155 !important; color: #ffffff !important;' : '' }}">
            <span>Diabaikan (Dismissed)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'dismissed' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}"
                  style="{{ $currentStatus === 'dismissed' ? 'background-color: #1e293b !important; color: #ffffff !important;' : '' }}">
                {{ $stats['dismissed'] ?? 0 }}
            </span>
        </a>
    </div>

    <!-- Filter Toolbar Form -->
    <form action="{{ route('admin.reports') }}" method="GET" class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-wrap items-center gap-3">

        <!-- Search Bar -->
        <div class="relative flex-1 min-w-[220px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID (#12), alasan, keterangan, pelapor..." 
                class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <!-- Target Type Dropdown -->
        <select name="target_type" class="px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <option value="">Semua Target Objek</option>
            <option value="user" {{ request('target_type') === 'user' ? 'selected' : '' }}>👤 Pengguna (User)</option>
            <option value="job" {{ request('target_type') === 'job' ? 'selected' : '' }}>💼 Lowongan (Job)</option>
            <option value="review" {{ request('target_type') === 'review' ? 'selected' : '' }}>⭐ Ulasan (Review)</option>
        </select>

        <!-- Status Dropdown -->
        <select name="status" class="px-4 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Menunggu (Pending)</option>
            <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>✅ Selesai (Resolved)</option>
            <option value="dismissed" {{ request('status') === 'dismissed' ? 'selected' : '' }}>🚫 Diabaikan (Dismissed)</option>
        </select>

        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-xs transition-colors">
            Terapkan Filter
        </button>

        @if(request('search') || request('target_type') || request('status'))
            <a href="{{ route('admin.reports') }}" class="px-4 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-700 transition-colors">
                Reset Filter
            </a>
        @endif
    </form>

    <!-- Content List -->
    @if($reports->isEmpty())
        @if(request('search') || request('target_type') || request('status'))
            <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-4 shadow-xs">
                <div class="w-16 h-16 rounded-3xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Tidak Ditemukan Laporan</h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto leading-relaxed">
                    Tidak ada aduan yang cocok dengan filter atau kata kunci pencarian saat ini.
                </p>
                <a href="{{ route('admin.reports') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 text-xs font-bold rounded-xl transition-colors">
                    <span>Kembalikan Semua Laporan</span> &rarr;
                </a>
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200/80 p-16 text-center space-y-4 shadow-xs">
                <div class="w-20 h-20 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900">Semua Laporan Telah Bersih</h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                    Tidak ada aduan pelanggaran baru yang membutuhkan tindakan saat ini. Platform berjalan tertib dan aman.
                </p>
            </div>
        @endif
    @else
        <div class="space-y-4">
            @foreach($reports as $report)
                @php 
                    $reportStatus = $report->status->value ?? $report->status;
                    $targetModel = $report->getTargetModel();
                @endphp
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:shadow-md transition-all space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="px-3 py-1 text-xs font-black rounded-xl uppercase bg-rose-50 text-rose-700 border border-rose-200/60">
                                Target: {{ ucfirst($report->target_type) }} #{{ $report->target_id }}
                            </span>
                            <span class="px-3 py-1 text-xs font-black rounded-xl uppercase tracking-wider {{ $reportStatus === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200/60' : ($reportStatus === 'resolved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-slate-100 text-slate-600') }}">
                                {{ ucfirst($reportStatus) }}
                            </span>
                        </div>
                        <span class="text-xs text-slate-400 font-medium">Dilaporkan {{ $report->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Target Preview Box -->
                    <div class="p-4 rounded-2xl bg-indigo-50/50 border border-indigo-100/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs">
                            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-500 block mb-0.5">Objek yang Dilaporkan:</span>
                            @if($report->target_type === 'user' && $targetModel)
                                <div class="font-black text-slate-900 text-sm flex items-center gap-1.5">
                                    <span>👤 {{ $targetModel->name }}</span>
                                    <span class="text-slate-400 font-normal">({{ '@' . $targetModel->username }})</span>
                                </div>
                                <div class="text-slate-500 text-[11px] mt-0.5">{{ $targetModel->email }} &bull; Role: <span class="font-bold text-slate-700 uppercase">{{ $targetModel->role?->value ?? $targetModel->role }}</span></div>
                            @elseif($report->target_type === 'job' && $targetModel)
                                <div class="font-black text-slate-900 text-sm">💼 {{ $targetModel->title }}</div>
                                <div class="text-slate-500 text-[11px] mt-0.5">Dibuat oleh: {{ $targetModel->client?->name }} &bull; Status: <span class="font-bold uppercase text-slate-700">{{ $targetModel->status->value ?? $targetModel->status }}</span></div>
                            @elseif($report->target_type === 'review' && $targetModel)
                                <div class="font-black text-slate-900 text-sm">⭐ Ulasan dari {{ $targetModel->reviewer?->name }} (Rating: {{ $targetModel->rating }}/5)</div>
                                <div class="text-slate-500 text-[11px] mt-0.5">"{{ Str::limit($targetModel->comment, 80) }}"</div>
                            @else
                                <div class="font-bold text-slate-700 text-xs">Target #{{ $report->target_id }} (Data telah dihapus atau tidak ditemukan)</div>
                            @endif
                        </div>

                        <div class="shrink-0">
                            @if($report->target_type === 'user')
                                <a href="{{ route('admin.users', ['search' => $report->target_id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-indigo-200 text-indigo-700 hover:bg-indigo-50 text-xs font-bold transition-colors shadow-2xs">
                                    <span>Buka Pengguna #{{ $report->target_id }}</span>
                                    <span>&rarr;</span>
                                </a>
                            @elseif($report->target_type === 'job')
                                <a href="{{ route('admin.jobs', ['search' => $report->target_id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-indigo-200 text-indigo-700 hover:bg-indigo-50 text-xs font-bold transition-colors shadow-2xs">
                                    <span>Buka Lowongan #{{ $report->target_id }}</span>
                                    <span>&rarr;</span>
                                </a>
                            @elseif($report->target_type === 'review')
                                <a href="{{ route('admin.reviews') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-indigo-200 text-indigo-700 hover:bg-indigo-50 text-xs font-bold transition-colors shadow-2xs">
                                    <span>Buka Moderasi Review</span>
                                    <span>&rarr;</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-1">
                        <h4 class="font-black text-slate-900 text-base">Alasan: {{ $report->reason }}</h4>
                        <p class="text-xs text-slate-500">
                            Pelapor: <span class="font-bold text-slate-800">{{ $report->reporter?->name }}</span> ({{ $report->reporter?->email }})
                        </p>
                    </div>

                    @if($report->description)
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed">
                            <span class="font-bold block text-slate-900 mb-1 text-xs uppercase tracking-wider">Keterangan Tambahan:</span>
                            {{ $report->description }}
                        </div>
                    @endif

                    <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-xs text-slate-500 flex items-center gap-2">
                            <span>Status:</span>
                            <span class="font-black px-2.5 py-0.5 rounded-xl text-[10px] uppercase tracking-wider {{ $reportStatus === 'pending' ? 'bg-amber-100 text-amber-800' : ($reportStatus === 'resolved' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700') }}">
                                {{ ucfirst($reportStatus) }}
                            </span>
                            @if($report->resolved_at)
                                <span class="text-slate-400 text-[11px]">&bull; Ditindak {{ $report->resolved_at->diffForHumans() }}</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 flex-wrap">
                            @if($reportStatus === 'pending')
                                <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl border border-slate-200 transition-colors">
                                        ✕ Abaikan Laporan
                                    </button>
                                </form>

                                <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs transition-colors">
                                        ✓ Tandai Selesai / Ditindak
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.reports.reopen', $report->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="Kembalikan status laporan ini ke Menunggu Tindakan" class="px-3.5 py-1.5 text-xs font-bold text-slate-700 hover:text-indigo-600 bg-slate-100 hover:bg-indigo-50 rounded-xl border border-slate-200 transition-colors">
                                        ↺ Buka Kembali (Pending)
                                    </button>
                                </form>

                                @if($reportStatus === 'dismissed')
                                    <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-2xs transition-colors">
                                            ✓ Ubah ke Selesai
                                        </button>
                                    </form>
                                @elseif($reportStatus === 'resolved')
                                    <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl border border-slate-200 transition-colors">
                                            ✕ Ubah ke Diabaikan
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-8">
                {{ $reports->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
