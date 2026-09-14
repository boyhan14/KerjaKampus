@extends('layouts.dashboard')

@section('title', 'Notifikasi - KerjaKampus')

@section('dashboard-content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pusat Notifikasi</h1>
            <p class="text-sm text-gray-500">Kabar terbaru mengenai lamaran, proyek, dan aktivitas akun Anda.</p>
        </div>

        @if($notifications->isNotEmpty())
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100">
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if($notifications->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Notifikasi</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">Semua notifikasi baru akan muncul di sini secara real-time.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($notifications as $notif)
                <div class="p-4 sm:p-5 rounded-2xl border transition-all flex items-start justify-between gap-4 {{ is_null($notif->read_at) ? 'bg-indigo-50/40 border-indigo-200' : 'bg-white border-gray-200' }}">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ is_null($notif->read_at) ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-500' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-sm text-gray-900 {{ is_null($notif->read_at) ? 'text-indigo-900' : '' }}">{{ $notif->title }}</h4>
                                @if(is_null($notif->read_at))
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $notif->message }}</p>
                            <span class="text-[11px] text-gray-400 block">{{ $notif->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @if(is_null($notif->read_at))
                        <form action="{{ route('notifications.read', $notif->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-gray-400 hover:text-indigo-600 font-medium shrink-0">
                                Tandai dibaca
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
