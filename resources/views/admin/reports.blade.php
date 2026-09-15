@extends('layouts.dashboard')

@section('title', 'Laporan & Moderasi - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold uppercase tracking-wider mb-2">
                Pusat Moderasi & Keamanan
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Laporan Aduan Pelanggaran</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Tinjau laporan dari pengguna terkait indikasi spam, penipuan, atau konten tidak patut.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center text-xs font-bold text-slate-700">
            Total Laporan: {{ $reports->total() }}
        </div>
    </div>

    @if($reports->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-16 text-center space-y-4 shadow-xs">
            <div class="w-20 h-20 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900">Semua Laporan Telah Bersih</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                Tidak ada aduan pelanggaran baru yang membutuhkan tindakan saat ini. Platform berjalan tertib dan aman.
            </p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reports as $report)
                @php 
                    $reportStatus = $report->status->value ?? $report->status;
                @endphp
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:shadow-md transition-all space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="px-3 py-1 text-xs font-black rounded-xl uppercase bg-rose-50 text-rose-700 border border-rose-200/60">
                                Target: {{ ucfirst($report->target_type) }} #{{ $report->target_id }}
                            </span>
                            <span class="px-3 py-1 text-xs font-black rounded-xl uppercase tracking-wider {{ $reportStatus === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200/60' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($reportStatus) }}
                            </span>
                        </div>
                        <span class="text-xs text-slate-400 font-medium">Dilaporkan {{ $report->created_at->diffForHumans() }}</span>
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

                    @if($reportStatus === 'pending')
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-3">
                            <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl border border-slate-200 transition-colors">
                                    Abaikan Laporan
                                </button>
                            </form>

                            <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs transition-colors">
                                    Tandai Selesai / Ditindak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="mt-8">
                {{ $reports->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
