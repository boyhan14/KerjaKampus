@extends('layouts.app')

@section('title', 'Lupa Kata Sandi - KerjaKampus')

@section('content')
<div class="relative min-h-[calc(100vh-5rem)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-50">
    <!-- Ambient Background Light -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-gradient-to-tr from-indigo-500/10 via-purple-500/10 to-pink-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-md w-full">
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-xl shadow-indigo-600/5 space-y-6">
            <!-- Header -->
            <div class="text-center">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Atur Ulang Kata Sandi</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Masukkan alamat email terdaftar akun KerjaKampus Anda. Kami akan mengirimkan tautan pemulihan.
                </p>
            </div>

            @if (session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form class="space-y-5" action="{{ route('password.email') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email Akun
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('email') border-rose-500 @enderror" 
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider shadow-md shadow-indigo-600/20 hover:shadow-lg transition-all">
                    Kirim Link Pemulihan
                </button>
            </form>

            <div class="pt-4 border-t border-slate-100 text-center">
                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-600 hover:text-indigo-600 transition-colors">
                    &larr; Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
