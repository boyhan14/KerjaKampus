@extends('layouts.dashboard')

@section('title', 'Notifikasi - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6" x-data="{ 
    modalOpen: false, 
    activeNotif: null,
    openNotif(notif) {
        this.activeNotif = notif;
        this.modalOpen = true;
        if (!notif.is_read) {
            // Mark as read in background
            fetch('/notifications/' + notif.id + '/read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(() => {
                notif.is_read = true;
            }).catch(() => {});
        }
    }
}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-2 border border-indigo-100/80">
                <span>🔔 Notifikasi & Aktivitas</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pusat Notifikasi</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pemberitahuan terkini terkait lamaran, moderasi laporan, status proyek, dan aktivitas akun Anda.</p>
        </div>

        @if(($stats['unread'] ?? 0) > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-700 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100/80 px-4 py-2.5 rounded-2xl border border-indigo-200/70 transition-all shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Tandai Semua Dibaca</span>
                </button>
            </form>
        @endif
    </div>

    <!-- Quick Filter Tabs -->
    @php
        $currentFilter = request('filter', '');
    @endphp
    <div class="flex flex-wrap items-center gap-2.5">
        <a href="{{ route('notifications.index') }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentFilter === '' ? 'bg-slate-900 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-slate-700 hover:bg-slate-50' }}"
           style="{{ $currentFilter === '' ? 'background-color: #0f172a !important; color: #ffffff !important;' : '' }}">
            <span>Semua</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentFilter === '' ? 'bg-slate-800 text-slate-200' : 'bg-slate-100 text-slate-700' }}"
                  style="{{ $currentFilter === '' ? 'background-color: #1e293b !important; color: #f1f5f9 !important;' : '' }}">
                {{ $stats['total'] ?? $notifications->total() }}
            </span>
        </a>

        <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentFilter === 'unread' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-indigo-700 hover:bg-indigo-50/50' }}"
           style="{{ $currentFilter === 'unread' ? 'background-color: #4f46e5 !important; color: #ffffff !important;' : '' }}">
            <span>Belum Dibaca</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentFilter === 'unread' ? 'bg-indigo-700 text-white' : 'bg-indigo-100 text-indigo-800' }}"
                  style="{{ $currentFilter === 'unread' ? 'background-color: #4338ca !important; color: #ffffff !important;' : '' }}">
                {{ $stats['unread'] ?? 0 }}
            </span>
        </a>

        <a href="{{ route('notifications.index', ['filter' => 'read']) }}" 
           class="px-4 py-2 rounded-2xl text-xs font-bold transition-all flex items-center gap-2 {{ $currentFilter === 'read' ? 'bg-slate-800 text-white shadow-xs' : 'bg-white border border-slate-200/80 text-slate-700 hover:bg-slate-50' }}"
           style="{{ $currentFilter === 'read' ? 'background-color: #334155 !important; color: #ffffff !important;' : '' }}">
            <span>Sudah Dibaca</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentFilter === 'read' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}"
                  style="{{ $currentFilter === 'read' ? 'background-color: #1e293b !important; color: #ffffff !important;' : '' }}">
                {{ $stats['read'] ?? 0 }}
            </span>
        </a>
    </div>

    <!-- Notification List -->
    @if($notifications->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 sm:p-16 text-center space-y-3 shadow-xs">
            <div class="w-16 h-16 rounded-3xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Notifikasi</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                {{ $currentFilter === 'unread' ? 'Semua notifikasi sudah Anda baca.' : 'Pemberitahuan penting akan ditampilkan di sini secara otomatis.' }}
            </p>
            @if($currentFilter !== '')
                <a href="{{ route('notifications.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-bold rounded-xl transition-colors mt-2">
                    <span>Lihat Semua Notifikasi</span> &rarr;
                </a>
            @endif
        </div>
    @else
        <div class="space-y-3">
            @foreach($notifications as $notif)
                @php
                    $isUnread = is_null($notif->read_at);
                    $targetUrl = $notif->getTargetUrl();
                    $notifData = [
                        'id' => $notif->id,
                        'title' => $notif->title,
                        'message' => $notif->message,
                        'is_read' => !$isUnread,
                        'created_at' => $notif->created_at->format('d M Y, H:i') . ' WIB',
                        'time_ago' => $notif->created_at->diffForHumans(),
                        'target_url' => $targetUrl,
                    ];
                @endphp
                <div class="p-4 sm:p-5 rounded-2xl border transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 {{ $isUnread ? 'bg-indigo-50/40 border-indigo-200/90 shadow-xs' : 'bg-white border-slate-200/80 hover:border-slate-300' }} hover:shadow-xs group">
                    
                    <!-- Left: Icon & Content (Clickable) -->
                    <div class="flex items-start gap-3.5 flex-1 min-w-0 cursor-pointer" @click="openNotif({{ json_encode($notifData) }})">
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 {{ $isUnread ? 'bg-gradient-to-tr from-indigo-600 to-violet-600 text-white shadow-xs' : 'bg-slate-100 text-slate-400 group-hover:bg-slate-200 transition-colors' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <div class="space-y-1 min-w-0 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-indigo-600 transition-colors {{ $isUnread ? 'text-indigo-950 font-black' : '' }}">
                                    {{ $notif->title }}
                                </h4>
                                @if($isUnread)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black bg-indigo-600 text-white shadow-2xs">Baru</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                {{ $notif->message }}
                            </p>
                            <div class="flex items-center gap-3 pt-0.5 text-[11px] text-slate-400">
                                <span>{{ $notif->created_at->diffForHumans() }}</span>
                                <span>&bull;</span>
                                <span class="text-indigo-600 font-semibold group-hover:underline">Klik untuk buka detail &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Action Buttons -->
                    <div class="flex items-center gap-2 self-end sm:self-center shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100 w-full sm:w-auto justify-end">
                        @if($targetUrl)
                            <a href="{{ $targetUrl }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold transition-colors">
                                <span>Buka Halaman Terkait</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @else
                            <button type="button" @click="openNotif({{ json_encode($notifData) }})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 text-xs font-bold border border-slate-200 transition-colors">
                                <span>Buka Detail</span>
                            </button>
                        @endif

                        <!-- Toggle Read / Unread -->
                        <form action="{{ route('notifications.toggle', $notif->id) }}" method="POST">
                            @csrf
                            <button type="submit" title="{{ $isUnread ? 'Tandai sudah dibaca' : 'Tandai belum dibaca' }}" class="p-2 rounded-xl border border-slate-200 text-slate-500 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                                @if($isUnread)
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/></svg>
                                @endif
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('notifications.destroy', $notif->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus notifikasi" class="p-2 rounded-xl border border-slate-200 text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        </div>
    @endif

    <!-- Interactive Detail Modal -->
    <div x-show="modalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
             @click="modalOpen = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 p-6 sm:p-7 space-y-5"
                 @click.away="modalOpen = false">
                
                <!-- Modal Header -->
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white flex items-center justify-center shadow-md shadow-indigo-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 block">Pemberitahuan Sistem</span>
                            <h3 class="text-base sm:text-lg font-black text-slate-900 leading-tight" x-text="activeNotif?.title"></h3>
                        </div>
                    </div>
                    <button type="button" @click="modalOpen = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Modal Body Message -->
                <div class="space-y-3">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100/80">
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed" x-text="activeNotif?.message"></p>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-400 px-1">
                        <span>Diterima pada: <strong class="text-slate-600" x-text="activeNotif?.created_at"></strong></span>
                        <span class="text-emerald-600 font-bold" x-text="activeNotif?.time_ago"></span>
                    </div>
                </div>

                <!-- Modal Footer Actions -->
                <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <template x-if="activeNotif?.target_url">
                        <a :href="activeNotif?.target_url" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-2xl shadow-xs transition-colors">
                            <span>Buka Objek / Lowongan Terkait</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </template>
                    <template x-if="!activeNotif?.target_url">
                        <span class="text-xs text-slate-400">Pemberitahuan informasi akun</span>
                    </template>

                    <button type="button" @click="modalOpen = false" class="w-full sm:w-auto px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-2xl transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
