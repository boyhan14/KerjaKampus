@extends('layouts.app')

@section('title', 'Direktori Talenta Mahasiswa Terverifikasi - KerjaKampus')

@section('content')
<div class="bg-slate-50 py-10 sm:py-14 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Search -->
        <div class="mb-12 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-bold mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                Direktori Mahasiswa Berbakat
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                Temukan Talenta Mahasiswa Unggulan
            </h1>
            <p class="mt-3 text-sm sm:text-base text-slate-600">
                Pilih desainer, programmer, penulis, dan pemasar digital terbaik dari berbagai perguruan tinggi ternama untuk membantu proyek Anda.
            </p>
            
            <form action="{{ url('/talents') }}" method="GET" class="mt-8 flex items-center bg-white p-2 rounded-2xl sm:rounded-full shadow-sm border border-slate-200/80 max-w-2xl mx-auto">
                <div class="pl-4 pr-2 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" placeholder="Cari nama, keahlian (misal: Laravel, Figma), atau lokasi..." value="{{ request('search') }}"
                    class="w-full px-2 py-2.5 bg-transparent border-none text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white rounded-xl sm:rounded-full text-xs sm:text-sm font-bold shadow-md shadow-indigo-500/20 transition-all btn-press shrink-0">
                    Cari Talenta
                </button>
            </form>
        </div>

        <!-- Meta Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200/80">
            <div class="text-xs sm:text-sm text-slate-600 font-medium">
                Menampilkan <span class="font-bold text-slate-900">{{ $talents->total() ?? 0 }}</span> talenta terdaftar
            </div>
            <div class="text-xs text-slate-400 font-semibold">
                Terverifikasi mahasiswa aktif & fresh graduate
            </div>
        </div>

        <!-- Talent Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($talents as $talent)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 flex flex-col justify-between shadow-xs card-hover">
                <div>
                    <!-- Avatar & Status -->
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        @if($talent->avatar)
                            <img class="w-20 h-20 rounded-2xl object-cover ring-2 ring-indigo-50" src="{{ asset('storage/' . $talent->avatar) }}" alt="{{ $talent->name }}">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white text-2xl font-black shadow-xs">
                                {{ substr($talent->name, 0, 1) }}
                            </div>
                        @endif
                        @if($talent->is_available ?? true)
                            <span class="absolute -bottom-1 -right-1 flex h-4 w-4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 ring-2 ring-white" title="Siap bekerja"></span>
                            </span>
                        @endif
                    </div>
                    
                    <div class="text-center mb-3">
                        <h3 class="text-base font-bold text-slate-900 hover:text-indigo-600 transition-colors truncate">
                            <a href="{{ url('/talents/'.$talent->username) }}">{{ $talent->name }}</a>
                        </h3>
                        <p class="text-xs text-slate-400 font-mono">{{ '@'.$talent->username }}</p>
                        <div class="flex items-center justify-center gap-1 mt-1 text-xs text-slate-500">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $talent->location ?? 'Indonesia' }}</span>
                        </div>
                    </div>

                    <!-- Rating Stars -->
                    <div class="flex items-center justify-center gap-1 text-amber-400 mb-3">
                        @php $rating = method_exists($talent, 'averageRating') ? $talent->averageRating() : 5; @endphp
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= ($rating > 0 ? $rating : 5) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-xs font-bold text-slate-700 ml-1">{{ number_format($rating > 0 ? $rating : 5, 1) }}</span>
                    </div>

                    <!-- Bio Excerpt -->
                    <p class="text-xs text-slate-500 line-clamp-2 mb-4 text-center leading-relaxed">
                        {{ $talent->bio ?? 'Mahasiswa bertalenta tinggi yang siap membantu menyelesaikan proyek Anda.' }}
                    </p>

                    <!-- Skills Chips -->
                    <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                        @foreach(collect($talent->skills ?? [])->take(3) as $skill)
                            <span class="px-2 py-0.5 bg-slate-50 text-slate-600 text-[11px] font-semibold rounded-lg border border-slate-200/60">{{ $skill->name ?? $skill }}</span>
                        @endforeach
                        @if(count($talent->skills ?? []) > 3)
                            <span class="px-2 py-0.5 bg-slate-50 text-slate-400 text-[11px] font-semibold rounded-lg border border-slate-200/60">+{{ count($talent->skills) - 3 }}</span>
                        @endif
                    </div>
                </div>
                
                <a href="{{ url('/talents/'.$talent->username) }}" class="block w-full py-2.5 text-center rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 transition-all">
                    Lihat Profil Lengkap
                </a>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-3xl bg-slate-100 text-slate-400 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-1">Talenta tidak ditemukan</h3>
                <p class="text-xs text-slate-500">Coba ubah kata kunci pencarian Anda untuk menemukan talenta lainnya.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $talents->links() }}
        </div>
    </div>
</div>
@endsection
