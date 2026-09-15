@extends('layouts.app')

@section('title', '403 - Akses Ditolak - KerjaKampus')

@section('content')
<div class="relative min-h-[calc(100vh-16rem)] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
    <!-- Ambient Lighting -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-gradient-to-tr from-rose-500/10 via-amber-500/10 to-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-rose-50 text-rose-600 font-black text-4xl shadow-inner border border-rose-100">
            403
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Akses Tidak Diizinkan</h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                Anda tidak memiliki hak akses atau otorisasi role yang sesuai untuk membuka halaman atau fitur ini.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ url()->previous() ?? route('dashboard') }}" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-slate-800 to-slate-900 hover:from-slate-900 hover:to-black text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md transition-all">
                &larr; Kembali Sebelumnya
            </a>
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-2xl border border-slate-200 transition-colors">
                Buka Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
