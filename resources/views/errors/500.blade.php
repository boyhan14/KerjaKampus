@extends('layouts.app')

@section('title', '500 - Terjadi Kesalahan Server - KerjaKampus')

@section('content')
<div class="relative min-h-[calc(100vh-16rem)] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
    <!-- Ambient Lighting -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-gradient-to-tr from-amber-500/10 via-rose-500/10 to-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-amber-50 text-amber-600 font-black text-4xl shadow-inner border border-amber-100">
            500
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Terjadi Gangguan Server</h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                Sistem kami sedang mengalami kendala teknis internal. Tim teknis sedang menangani masalah ini.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-600/20 transition-all">
                Kembali ke Beranda
            </a>
            <button onclick="window.location.reload()" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-2xl border border-slate-200 transition-colors">
                Muat Ulang Halaman
            </button>
        </div>
    </div>
</div>
@endsection

