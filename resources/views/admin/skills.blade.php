@extends('layouts.dashboard')

@section('title', 'Master Keahlian - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2">
                Taksonomi Skill
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Master Keahlian & Keterampilan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola perbendaharaan skill yang dapat dipilih mahasiswa dan dicantumkan pada lowongan.</p>
        </div>
        <div class="px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2 self-start sm:self-center text-xs font-bold text-slate-700">
            Total: {{ $skills->total() }} Skills
        </div>
    </div>

    <!-- Create Skill Form -->
    <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-indigo-600 font-bold text-xs flex items-center justify-center">+</span>
            <h3 class="font-black text-slate-900 text-sm uppercase tracking-wider">Tambah Keahlian Baru</h3>
        </div>
        
        <form action="{{ route('admin.skills.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="name" required placeholder="Nama skill (Contoh: Tailwind CSS, Docker, Figma)" 
                class="px-4 py-3 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none flex-1 transition-all">
            
            <select name="skill_category_id" required class="px-4 py-3 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 focus:outline-none sm:w-64 transition-all">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-7 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-xs transition-colors shrink-0">
                + Tambah Skill
            </button>
        </form>
    </div>

    <!-- Skills List Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/70 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Nama Keahlian</th>
                        <th class="px-6 py-4">Kategori Induk</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($skills as $skill)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $skill->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100/60">
                                    {{ $skill->category?->name ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus skill {{ $skill->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-400 text-xs sm:text-sm">Belum ada skill yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 sm:p-6 border-t border-slate-100">
            {{ $skills->links() }}
        </div>
    </div>
</div>
@endsection
