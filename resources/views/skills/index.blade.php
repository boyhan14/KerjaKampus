@extends('layouts.dashboard')

@section('title', 'Keahlian Saya - KerjaKampus')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Keahlian & Kemampuan</h1>
        <p class="text-sm text-gray-500">Kelola skill yang Anda kuasai untuk mendapatkan rekomendasi proyek yang akurat.</p>
    </div>

    <!-- Current Skills -->
    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="font-bold text-gray-900 text-base">Skill Aktif Anda ({{ $user->skills->count() }})</h3>

        @if($user->skills->isEmpty())
            <div class="p-8 text-center bg-gray-50 rounded-2xl border border-gray-100">
                <p class="text-sm text-gray-500 mb-2">Anda belum menambahkan keahlian apa pun ke profil Anda.</p>
                <p class="text-xs text-gray-400">Pilih dari daftar keahlian yang tersedia di bawah ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($user->skills as $skill)
                    <div class="p-3.5 rounded-2xl border border-gray-200 bg-gray-50/70 flex items-center justify-between gap-2">
                        <div class="min-w-0">
                            <h4 class="font-bold text-gray-900 text-xs sm:text-sm truncate">{{ $skill->name }}</h4>
                            <span class="text-[11px] text-gray-500 font-medium capitalize">{{ $skill->pivot->level ?? 'Intermediate' }}</span>
                        </div>
                        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Hapus keahlian {{ $skill->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Add Skill Form -->
    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="font-bold text-gray-900 text-base">Tambah Keahlian Baru</h3>

        <form action="{{ route('skills.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih Keahlian *</label>
                    <select name="skill_id" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">-- Pilih Skill --</option>
                        @foreach($availableSkills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }} ({{ $skill->category?->name }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tingkat Kemahiran</label>
                    <select name="level" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="beginner">Beginner (Pemula)</option>
                        <option value="intermediate" selected>Intermediate (Menengah)</option>
                        <option value="expert">Expert (Mahir)</option>
                    </select>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-xs">
                    + Tambahkan Skill
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
