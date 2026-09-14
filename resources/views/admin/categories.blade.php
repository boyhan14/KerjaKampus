@extends('layouts.dashboard')

@section('title', 'Master Kategori - Admin KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Master Kategori Pekerjaan</h1>
        <p class="text-sm text-gray-500">Kelola kategori industri dan spesialisasi pekerjaan platform.</p>
    </div>

    <!-- Create Category Form -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-4">
        <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Tambah Kategori Baru</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="name" required placeholder="Nama Kategori (Contoh: Artificial Intelligence)" class="px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none flex-1">
            
            <input type="text" name="description" placeholder="Deskripsi singkat..." class="px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-1 focus:ring-indigo-500 focus:outline-none flex-1">

            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-xs shrink-0">
                + Tambah Kategori
            </button>
        </form>
    </div>

    <!-- Categories List Table -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5">Nama Kategori</th>
                        <th class="px-6 py-3.5">Deskripsi</th>
                        <th class="px-6 py-3.5">Jumlah Skill</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-indigo-600">
                                {{ $category->skills_count }} Skill
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori {{ $category->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada kategori yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
