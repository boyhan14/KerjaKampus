@extends('layouts.app')

@section('title', 'Kata Sandi Baru - KerjaKampus')

@section('content')
<div class="relative min-h-[calc(100vh-5rem)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-50">
    <!-- Ambient Background Light -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-gradient-to-tr from-indigo-500/10 via-purple-500/10 to-pink-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-md w-full">
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-xl shadow-indigo-600/5 space-y-6">
            <!-- Header -->
            <div class="text-center">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Buat Kata Sandi Baru</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Silakan masukkan kata sandi baru yang aman untuk akun KerjaKampus Anda.
                </p>
            </div>

            <form class="space-y-5" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email', request()->email) }}" readonly
                        class="w-full px-4 py-3.5 text-sm bg-slate-100 border border-slate-200 rounded-2xl text-slate-500 cursor-not-allowed">
                    @error('email')
                        <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kata Sandi Baru
                    </label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all @error('password') border-rose-500 @enderror" 
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                        class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all" 
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider shadow-md shadow-indigo-600/20 hover:shadow-lg transition-all">
                    Perbarui Kata Sandi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
