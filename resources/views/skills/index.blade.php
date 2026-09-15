@extends('layouts.dashboard')

@section('title', 'Keahlian Saya - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-2">
                Profil & Kecocokan AI
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Keahlian & Kemampuan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Skill yang Anda tambahkan digunakan oleh algoritma rekomendasi untuk mencocokkan proyek.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 text-xs font-bold text-slate-700">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            {{ $user->skills->count() }} Keahlian Aktif
        </div>
    </div>

    <!-- Active Skills Grid Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-black text-slate-900 text-base">Daftar Keahlian Profil</h3>
                <p class="text-xs text-slate-400">Tingkat kemahiran yang Anda kuasai saat ini.</p>
            </div>
        </div>

        @if($user->skills->isEmpty())
            <div class="p-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200 space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h4 class="text-base font-bold text-slate-800">Belum Ada Keahlian Ditambahkan</h4>
                <p class="text-xs text-slate-500 max-w-sm mx-auto leading-relaxed">
                    Tambahkan skill utama Anda melalui formulir di bawah ini agar algoritma AI dapat mencocokkan proyek yang relevan.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3.5">
                @foreach($user->skills as $skill)
                    @php
                        $level = strtolower($skill->pivot->level?->value ?? $skill->pivot->level ?? 'intermediate');
                        $levelBadge = match($level) {
                            'beginner' => 'bg-sky-50 text-sky-700 border-sky-100',
                            'expert' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            default => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                        };
                    @endphp
                    <div class="p-4 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:border-slate-300 hover:shadow-sm transition-all flex items-center justify-between gap-3 group">
                        <div class="min-w-0">
                            <h4 class="font-bold text-slate-900 text-sm truncate group-hover:text-indigo-600 transition-colors">{{ $skill->name }}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-md border uppercase tracking-wider {{ $levelBadge }}">
                                    {{ $level }}
                                </span>
                                <span class="text-[11px] text-slate-400 truncate">{{ $skill->category?->name }}</span>
                            </div>
                        </div>
                        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Hapus keahlian {{ $skill->name }} dari profil Anda?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus skill" class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Add Skill Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
            <span class="w-7 h-7 rounded-xl bg-indigo-50 text-indigo-600 font-black text-xs flex items-center justify-center">+</span>
            <div>
                <h3 class="font-black text-slate-900 text-base">Tambah Keahlian Baru</h3>
                <p class="text-xs text-slate-400">Pilih dari katalog teknologi dan spesialisasi KerjaKampus.</p>
            </div>
        </div>

        <form action="{{ route('skills.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Pilih Keahlian <span class="text-rose-500">*</span>
                    </label>
                    <select name="skill_id" required class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        <option value="">-- Pilih Skill dari Katalog --</option>
                        @foreach($availableSkills as $skill)
                            <option value="{{ $skill->id }}">
                                {{ $skill->name }} ({{ $skill->category?->name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Tingkat Kemahiran <span class="text-rose-500">*</span>
                    </label>
                    <select name="level" class="w-full px-4 py-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none transition-all">
                        <option value="beginner">Beginner (Pemula)</option>
                        <option value="intermediate" selected>Intermediate (Menengah)</option>
                        <option value="expert">Expert (Mahir)</option>
                    </select>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="px-7 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-600/20 hover:shadow-lg transition-all">
                    + Tambahkan ke Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
