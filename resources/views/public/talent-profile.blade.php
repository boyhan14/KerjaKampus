@extends('layouts.app')

@section('title', ($talent->name ?? 'Talent Profile') . ' - KerjaKampus')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Sidebar: Profile Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Main Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                    <div class="px-6 pb-6 relative">
                        <div class="flex justify-center -mt-16 mb-4">
                            <div class="w-32 h-32 bg-white rounded-full p-1 border-4 border-white shadow-md">
                                <div class="w-full h-full bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 text-5xl font-bold">
                                    {{ substr($talent->name ?? 'A', 0, 1) }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $talent->name ?? 'Student Name' }}</h1>
                            <p class="text-gray-500 mb-2">{{ '@'.($talent->username ?? 'username') }}</p>
                            
                            <div class="flex items-center justify-center text-gray-600 mb-4 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $talent->location ?? 'Indonesia' }}
                            </div>

                            <div class="flex justify-center items-center gap-4 mb-6">
                                <div class="text-center">
                                    <div class="flex items-center text-yellow-400">
                                        @php $avgRating = $talent->averageRating(); @endphp
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-gray-900 font-bold ml-1">{{ number_format($avgRating > 0 ? $avgRating : 5.0, 1) }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500">{{ $talent->reviewsReceived->count() }} Reviews</p>
                                </div>
                                <div class="w-px h-8 bg-gray-200"></div>
                                <div class="text-center">
                                    <span class="text-gray-900 font-bold">{{ $talent->talentProjects()->where('status', \App\Enums\ProjectStatus::COMPLETED)->count() }}</span>
                                    <p class="text-xs text-gray-500">Jobs Done</p>
                                </div>
                            </div>

                            @auth
                                @if(Auth::user()->isClient())
                                    <a href="{{ route('jobs.create') }}" class="block w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                        Tawarkan Proyek ke {{ explode(' ', $talent->name ?? 'Talenta')[0] }}
                                    </a>
                                @else
                                    <a href="{{ route('profile.show') }}" class="block w-full py-2 px-4 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                                        Profil Talenta
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="block w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                    Rekrut {{ explode(' ', $talent->name ?? 'Talenta')[0] }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Education</p>
                            <p class="text-gray-900 font-medium">{{ $talent->university ?? 'University not specified' }}</p>
                            <p class="text-sm text-gray-600">{{ $talent->major ?? 'Major not specified' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Experience</p>
                            <p class="text-gray-900 font-medium">{{ $talent->experience_years ?? 0 }} Years</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Links</p>
                            <div class="flex gap-3">
                                @if(isset($talent->github_url))
                                <a href="{{ $talent->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-900">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                </a>
                                @endif
                                @if(isset($talent->linkedin_url))
                                <a href="{{ $talent->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-blue-700">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                                </a>
                                @endif
                            </div>
                            @if(!isset($talent->github_url) && !isset($talent->linkedin_url))
                            <p class="text-sm text-gray-500">No social links provided.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Bio -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About Me</h2>
                    <div class="prose prose-indigo max-w-none text-gray-600">
                        @if(!empty($talent->bio))
                            {!! nl2br(e($talent->bio)) !!}
                        @else
                            <p class="italic text-gray-400">This user hasn't written a bio yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Skills -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Skills</h2>
                    <div class="flex flex-wrap gap-2">
                        @forelse($talent->skills ?? [] as $skill)
                        <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 font-medium text-sm rounded-lg border border-indigo-100">
                            {{ $skill->name ?? $skill }}
                        </span>
                        @empty
                        <p class="text-gray-500 italic">No skills listed yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Portfolio -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Portfolio</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($talent->portfolioItems as $portfolio)
                        <div class="group relative rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex flex-col justify-between">
                            <div>
                                <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-400 group-hover:bg-gray-300 transition-colors overflow-hidden">
                                    @if($portfolio->thumbnail)
                                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <div class="p-4 bg-white">
                                    <h4 class="font-bold text-gray-900 mb-1 truncate hover:text-indigo-600">
                                        <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-500 line-clamp-2">{{ $portfolio->description }}</p>
                                </div>
                            </div>
                            <div class="px-4 pb-3 bg-white">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="text-xs font-semibold text-indigo-600 hover:underline">
                                    Lihat Detail Portofolio &rarr;
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-8 text-center text-gray-500 italic bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            Belum ada portofolio yang dipublikasikan.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Ulasan Klien</h2>
                    <div class="space-y-6">
                        @forelse($talent->reviewsReceived as $review)
                        <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $review->reviewer?->name ?? 'Klien' }}</h4>
                                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex text-yellow-400">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= ($review->rating ?? 5) ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                    <span class="text-xs text-gray-700 font-bold ml-1">{{ $review->rating }}.0</span>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">"{{ $review->comment }}"</p>
                            @if($review->project)
                            <p class="text-xs text-indigo-600 mt-2 font-medium">Proyek: {{ $review->project->title }}</p>
                            @endif
                        </div>
                        @empty
                        <div class="py-8 text-center text-gray-500 italic bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            Belum ada ulasan dari klien.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
