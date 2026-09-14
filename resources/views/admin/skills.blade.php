@extends('layouts.dashboard')

@section('title', 'Master Keahlian - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Master Keahlian & Skill</h1>
        <p class="text-sm text-gray-500">Kelola daftar keahlian yang dapat dipilih talenta dan dicantumkan pada lowongan.</p>
    </div>

    <!-- Create Skill Form -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-4">
        <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Tambah Keahlian Baru</h3>
        <form action="{{ route('admin.skills.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="name" required placeholder="Nama skill (Contoh: Tailwind CSS)" class="px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none flex-1">
            
            <select name="skill_category_id" required class="px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:w-64">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-xs shrink-0">
                + Tambah Skill
            </button>
        </form>
    </div>

    <!-- Skills List Table -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5">Nama Keahlian</th>
                        <th class="px-6 py-3.5">Kategori</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($skills as $skill)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $skill->name }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                <span class="px-2.5 py-0.5 rounded-md bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    {{ $skill->category?->name ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus skill {{ $skill->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada skill yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $skills->links() }}
        </div>
    </div>
</div>
@endsection

