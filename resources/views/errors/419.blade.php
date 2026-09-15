@extends('layouts.app')

@section('title', '419 - Sesi Kedaluwarsa - KerjaKampus')

@section('content')
<div class="relative min-h-[calc(100vh-16rem)] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
    <!-- Ambient Lighting -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-gradient-to-tr from-sky-500/10 via-indigo-500/10 to-purple-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-sky-50 text-sky-600 font-black text-4xl shadow-inner border border-sky-100">
            419
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Sesi Halaman Kedaluwarsa</h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                Token keamanan sesi Anda telah berakhir karena tidak ada aktivitas dalam waktu lama. Silakan muat ulang halaman.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button onclick="window.location.reload()" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-600/20 transition-all">
                Muat Ulang Halaman
            </button>
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-2xl border border-slate-200 transition-colors">
                Masuk Ulang
            </a>
        </div>
    </div>
</div>
@endsection

