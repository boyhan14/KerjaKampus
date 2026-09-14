@extends('layouts.dashboard')

@section('title', 'Profil Saya - KerjaKampus')

@section('dashboard-content')
<div class="space-y-8">
    <!-- Header Card -->
    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <!-- Avatar -->
                <div class="relative group">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-2xl sm:text-3xl flex items-center justify-center uppercase overflow-hidden shadow-md">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-gray-900">{{ $user->name }}</h1>
                        <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase">
                            {{ $user->role?->value ?? $user->role }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500">
                        {{ '@' . ($user->username ?? 'user') }} &bull; {{ $user->location ?? 'Indonesia' }}
                    </p>
                    <p class="text-xs text-gray-400">Bergabung {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if($user->username)
                    <a href="{{ route('talents.show', $user->username) }}" target="_blank" class="px-4 py-2 text-xs font-semibold rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50">
                        Lihat Publik &rarr;
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs">
                    Edit Profil
                </a>
            </div>
        </div>

        <!-- Completion bar if talent -->
        @if($user->isTalent())
            <div class="mt-6 pt-6 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1 w-full max-w-md">
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <span class="text-gray-600">Kelengkapan Profil</span>
                        <span class="text-indigo-600 font-bold">{{ $completion }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $completion }}%"></div>
                    </div>
                </div>
                <span class="text-xs text-gray-400">Profil lengkap meningkatkan 3x peluang diterima!</span>
            </div>
        @endif
    </div>

    <!-- Bio & Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Main details -->
        <div class="md:col-span-2 space-y-6">
            <!-- Bio -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-3">
                <h3 class="font-bold text-gray-900 text-base">Tentang Saya</h3>
                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $user->bio ?? 'Belum ada biodata yang ditambahkan. Klik Edit Profil untuk menceritakan tentang diri dan pengalamanmu.' }}
                </p>
            </div>

            <!-- Skills -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base">Keahlian & Skill</h3>
                    <a href="{{ route('skills.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Kelola &rarr;</a>
                </div>

                <div class="flex flex-wrap gap-2">
                    @forelse($user->skills as $skill)
                        <span class="px-3 py-1.5 rounded-xl bg-gray-100 text-gray-800 text-xs font-semibold">
                            {{ $skill->name }}
                        </span>
                    @empty
                        <span class="text-xs text-gray-400">Belum ada keahlian yang ditambahkan.</span>
                    @endforelse
                </div>
            </div>

            <!-- Portfolio summary -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base">Portofolio Teratas</h3>
                    <a href="{{ route('portfolio.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua &rarr;</a>
                </div>

                @if($user->portfolioItems->isEmpty())
                    <p class="text-xs text-gray-400">Belum ada proyek portofolio yang ditambahkan.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($user->portfolioItems->take(4) as $item)
                            <div class="p-3 rounded-xl border border-gray-100 bg-gray-50 flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-900 truncate">{{ $item->title }}</span>
                                <a href="{{ route('portfolio.show', $item->slug) }}" class="text-xs text-indigo-600 font-semibold shrink-0">Buka &rarr;</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Informasi Kontak</h3>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-gray-400 block">Email</span>
                        <span class="font-semibold text-gray-800">{{ $user->email }}</span>
                    </div>

                    @if($user->phone)
                        <div>
                            <span class="text-gray-400 block">Nomor Telepon</span>
                            <span class="font-semibold text-gray-800">{{ $user->phone }}</span>
                        </div>
                    @endif

                    @if($user->education)
                        <div>
                            <span class="text-gray-400 block">Pendidikan / Kampus</span>
                            <span class="font-semibold text-gray-800">{{ $user->education }}</span>
                        </div>
                    @endif

                    @if($user->experience_years)
                        <div>
                            <span class="text-gray-400 block">Pengalaman Kerja</span>
                            <span class="font-semibold text-gray-800">{{ $user->experience_years }} Tahun</span>
                        </div>
                    @endif

                    @if($user->website)
                        <div>
                            <span class="text-gray-400 block">Website</span>
                            <a href="{{ $user->website }}" target="_blank" class="font-semibold text-indigo-600 hover:underline truncate block">{{ $user->website }}</a>
                        </div>
                    @endif
                </div>

                <!-- Social links -->
                <div class="pt-4 border-t border-gray-100 space-y-2">
                    <span class="text-gray-400 block text-xs">Tautan Media Sosial</span>
                    <div class="flex items-center gap-3">
                        @if($user->github_url)
                            <a href="{{ $user->github_url }}" target="_blank" class="text-gray-500 hover:text-gray-900 text-xs font-semibold">GitHub</a>
                        @endif
                        @if($user->linkedin_url)
                            <a href="{{ $user->linkedin_url }}" target="_blank" class="text-gray-500 hover:text-indigo-600 text-xs font-semibold">LinkedIn</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
