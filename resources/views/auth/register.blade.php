@extends('layouts.app')

@section('title', 'Daftar Akun Baru - KerjaKampus')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Ambient background glow -->
    <div class="absolute -top-32 right-1/3 w-96 h-96 bg-violet-200/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-md w-full space-y-6 bg-white/95 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-xl border border-slate-200/80 relative z-10 box-shine premium-border">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white mx-auto shadow-md shadow-indigo-500/20">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Buat Akun KerjaKampus
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Masuk di sini &rarr;
                </a>
            </p>
        </div>

        <form class="space-y-5" action="{{ route('register') }}" method="POST" x-data="{ role: '{{ old('role', 'talent') }}' }">
            @csrf

            <!-- Role Selection Cards -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Tipe Akun</label>
                <div class="grid grid-cols-2 gap-3">
                    <label 
                        class="relative flex flex-col p-4 rounded-2xl border cursor-pointer transition-all text-left"
                        :class="role === 'talent' ? 'border-indigo-600 bg-indigo-50/60 ring-2 ring-indigo-600/20' : 'border-slate-200 bg-slate-50 hover:bg-slate-100/70'"
                    >
                        <input type="radio" name="role" value="talent" x-model="role" class="sr-only">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-lg">🎓</span>
                            <span x-show="role === 'talent'" class="w-4 h-4 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-bold">✓</span>
                        </div>
                        <span class="text-xs font-bold" :class="role === 'talent' ? 'text-indigo-950' : 'text-slate-800'">
                            Talenta Mahasiswa
                        </span>
                        <span class="text-[10px] text-slate-500 mt-0.5 leading-tight">
                            Mencari proyek & pengalaman
                        </span>
                    </label>

                    <label 
                        class="relative flex flex-col p-4 rounded-2xl border cursor-pointer transition-all text-left"
                        :class="role === 'client' ? 'border-indigo-600 bg-indigo-50/60 ring-2 ring-indigo-600/20' : 'border-slate-200 bg-slate-50 hover:bg-slate-100/70'"
                    >
                        <input type="radio" name="role" value="client" x-model="role" class="sr-only">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-lg">💼</span>
                            <span x-show="role === 'client'" class="w-4 h-4 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-bold">✓</span>
                        </div>
                        <span class="text-xs font-bold" :class="role === 'client' ? 'text-indigo-950' : 'text-slate-800'">
                            Pemberi Kerja
                        </span>
                        <span class="text-[10px] text-slate-500 mt-0.5 leading-tight">
                            Merekrut & pasang lowongan
                        </span>
                    </label>
                </div>
                @error('role')
                    <p class="text-rose-600 text-xs font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3.5">
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all @error('name') border-rose-300 text-rose-900 placeholder-rose-300 focus:ring-rose-500 focus:border-rose-500 @enderror" 
                        placeholder="Andi Pratama">
                    @error('name')
                        <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Username Unik</label>
                    <input id="username" name="username" type="text" autocomplete="username" required value="{{ old('username') }}"
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all @error('username') border-rose-300 text-rose-900 placeholder-rose-300 focus:ring-rose-500 focus:border-rose-500 @enderror" 
                        placeholder="andipratama">
                    @error('username')
                        <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all @error('email') border-rose-300 text-rose-900 placeholder-rose-300 focus:ring-rose-500 focus:border-rose-500 @enderror" 
                        placeholder="andi@kampus.ac.id">
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all @error('password') border-rose-300 text-rose-900 placeholder-rose-300 focus:ring-rose-500 focus:border-rose-500 @enderror" 
                            placeholder="Min. 8 karakter">
                        @error('password')
                            <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Konfirmasi Sandi</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all" 
                            placeholder="Ulangi sandi">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 rounded-2xl text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 shadow-xl shadow-indigo-500/25 transition-all btn-press btn-shine animate-glow-pulse">
                    Daftar Akun Sekarang
                </button>
            </div>
            
            <p class="text-[11px] text-center text-slate-400 leading-relaxed">
                Dengan mendaftar, Anda menyetujui <a href="{{ url('/how-it-works') }}" class="text-indigo-600 hover:underline">Ketentuan Layanan</a> & <a href="{{ url('/how-it-works') }}" class="text-indigo-600 hover:underline">Kebijakan Privasi</a> KerjaKampus.
            </p>
        </form>
    </div>
</div>
@endsection
