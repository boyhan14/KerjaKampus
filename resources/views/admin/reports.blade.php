@extends('layouts.dashboard')

@section('title', 'Laporan & Moderasi - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Laporan Pelanggaran Pengguna</h1>
        <p class="text-sm text-gray-500">Tinjau aduan dan laporan dugaan spam, penipuan, atau konten tidak pantas.</p>
    </div>

    @if($reports->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-green-50 text-green-600 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Semua Laporan Telah Bersih</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada laporan pelanggaran baru yang perlu ditinjau saat ini.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reports as $report)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xs space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            @php $reportStatus = $report->status->value ?? $report->status; @endphp
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-md uppercase bg-red-50 text-red-700 border border-red-200">
                                Target: {{ ucfirst($report->target_type) }} #{{ $report->target_id }}
                            </span>
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-md {{ $reportStatus === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($reportStatus) }}
                            </span>
                        </div>
                        <span class="text-xs text-gray-400">Dilaporkan {{ $report->created_at->diffForHumans() }}</span>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Alasan: {{ $report->reason }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Pelapor: <span class="font-semibold text-gray-800">{{ $report->reporter?->name }} ({{ $report->reporter?->email }})</span></p>
                    </div>

                    @if($report->description)
                        <div class="p-3 bg-gray-50 rounded-xl text-xs text-gray-700 leading-relaxed">
                            <span class="font-bold block text-gray-900 mb-0.5">Keterangan Tambahan:</span>
                            {{ $report->description }}
                        </div>
                    @endif

                    @if($reportStatus === 'pending')
                        <div class="pt-3 border-t border-gray-100 flex items-center justify-end gap-3">
                            <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-1.5 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg border border-gray-200">
                                    Abaikan Laporan
                                </button>
                            </form>

                            <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-1.5 text-xs font-bold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-xs">
                                    Tandai Selesai / Ditindak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="mt-6">
                {{ $reports->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

