@extends('layouts.app')

@section('title', 'KerjaKampus - Turn Your Skills Into Opportunities')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-indigo-600 to-purple-700 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6">
            Turn Your Skills Into Opportunities.
        </h1>
        <p class="text-lg md:text-xl text-indigo-100 max-w-3xl mx-auto mb-10">
            Cari project, bangun pengalaman, dan mulai menghasilkan dari skill yang kamu punya. 
            Platform marketplace talenta terbaik untuk mahasiswa dan fresh graduate.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ url('/jobs') }}" class="px-8 py-3 bg-white text-indigo-700 font-semibold rounded-lg shadow hover:bg-gray-50 transition-colors">
                Find Projects
            </a>
            <a href="{{ url('/register') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-indigo-700 transition-colors">
                Hire Talent
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-4">
                <p class="text-4xl font-bold text-indigo-600 mb-2">{{ number_format($talentCount ?? 0) }}+</p>
                <p class="text-gray-500 font-medium">Total Talent</p>
            </div>
            <div class="p-4">
                <p class="text-4xl font-bold text-indigo-600 mb-2">{{ number_format($jobCount ?? 0) }}+</p>
                <p class="text-gray-500 font-medium">Total Projects</p>
            </div>
            <div class="p-4">
                <p class="text-4xl font-bold text-indigo-600 mb-2">{{ number_format($skillCount ?? 0) }}+</p>
                <p class="text-gray-500 font-medium">Verified Skills</p>
            </div>
        </div>
    </div>
</section>

<!-- Trending Jobs Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Trending Opportunities</h2>
                <p class="text-gray-600 mt-2">Discover the latest projects waiting for your expertise.</p>
            </div>
            <a href="{{ url('/jobs') }}" class="hidden sm:inline-block text-indigo-600 font-medium hover:text-indigo-800">
                View All Jobs &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredJobs ?? [] as $job)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow flex flex-col">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2"><a href="{{ route('jobs.show', $job->slug ?? $job->id) }}" class="hover:text-indigo-600">{{ $job->title }}</a></h3>
                </div>
                <div class="text-sm text-gray-500 mb-4">{{ $job->client?->company_name ?? ($job->client?->name ?? 'Klien Terverifikasi') }}</div>
                
                <div class="flex items-center gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ ucfirst(str_replace('_', ' ', $job->job_type->value ?? ($job->job_type ?? 'Project'))) }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        {{ ucfirst($job->work_mode->value ?? ($job->work_mode ?? 'Remote')) }}
                    </span>
                </div>

                <div class="text-indigo-700 font-bold mb-4">
                    Rp {{ number_format($job->budget_min ?? 0, 0, ',', '.') }} - {{ number_format($job->budget_max ?? 0, 0, ',', '.') }}
                </div>

                <div class="flex flex-wrap gap-2 mt-auto mb-4">
                    @foreach(collect($job->skills ?? [])->take(3) as $skill)
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">{{ $skill->name ?? $skill }}</span>
                    @endforeach
                    @if(count($job->skills ?? []) > 3)
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">+{{ count($job->skills) - 3 }}</span>
                    @endif
                </div>

                <div class="text-xs text-gray-400 border-t pt-4 mt-auto">
                    Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No featured jobs available right now. Check back later!
            </div>
            @endforelse
        </div>
        
        <div class="mt-8 text-center sm:hidden">
            <a href="{{ url('/jobs') }}" class="text-indigo-600 font-medium hover:text-indigo-800">
                View All Jobs &rarr;
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
            <p class="text-gray-600 mt-2">Start your journey in four simple steps.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
            <!-- Step 1 -->
            <div>
                <div class="w-16 h-16 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">1. Create Profile</h3>
                <p class="text-gray-600">Daftar dan lengkapi profilmu. Tambahkan portofolio dan skill yang kamu kuasai.</p>
            </div>
            <!-- Step 2 -->
            <div>
                <div class="w-16 h-16 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">2. Find Opportunity</h3>
                <p class="text-gray-600">Cari project yang sesuai dengan keahlianmu. Gunakan filter untuk mempermudah pencarian.</p>
            </div>
            <!-- Step 3 -->
            <div>
                <div class="w-16 h-16 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">3. Get Hired</h3>
                <p class="text-gray-600">Kirim proposal, diskusikan scope project, dan mulai kerjakan tugasmu dengan klien.</p>
            </div>
            <!-- Step 4 -->
            <div>
                <div class="w-16 h-16 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">4. Build Experience</h3>
                <p class="text-gray-600">Selesaikan project, dapatkan bayaran, dan kumpulkan review positif untuk membangun reputasimu.</p>
            </div>
        </div>
    </div>
</section>

<!-- AI Career Section -->
<section class="py-20 bg-indigo-50 border-y border-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Your AI Career Copilot</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Analyze your skills, improve your CV, and discover opportunities that fit you perfectly with our integrated AI assistant.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-indigo-100">
                        <h4 class="font-bold text-indigo-700 mb-1">Career Analysis</h4>
                        <p class="text-sm text-gray-500">Get insights on your career trajectory.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-indigo-100">
                        <h4 class="font-bold text-indigo-700 mb-1">Job Matching</h4>
                        <p class="text-sm text-gray-500">AI finds the best projects for your skills.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-indigo-100">
                        <h4 class="font-bold text-indigo-700 mb-1">CV Analyzer</h4>
                        <p class="text-sm text-gray-500">Improve your resume automatically.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-indigo-100">
                        <h4 class="font-bold text-indigo-700 mb-1">Portfolio Writer</h4>
                        <p class="text-sm text-gray-500">Generate compelling project descriptions.</p>
                    </div>
                </div>
                <a href="{{ url('/register') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                    Try AI Career Assistant
                </a>
            </div>
            <div class="lg:w-1/2 flex justify-center">
                <!-- Abstract AI graphic -->
                <div class="relative w-full max-w-md aspect-square rounded-full bg-gradient-to-tr from-indigo-200 to-purple-200 flex items-center justify-center p-8">
                    <div class="w-full h-full rounded-full bg-white bg-opacity-60 shadow-xl border-4 border-white flex items-center justify-center flex-col text-center p-6 backdrop-blur-sm">
                        <svg class="w-16 h-16 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        <h3 class="text-2xl font-bold text-gray-800">KerjaKampus AI</h3>
                        <p class="text-indigo-600 font-medium">Always learning, always helping.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Talents Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Top Talent</h2>
                <p class="text-gray-600 mt-2">Hire the brightest minds from top universities.</p>
            </div>
            <a href="{{ url('/talents') }}" class="hidden sm:inline-block text-indigo-600 font-medium hover:text-indigo-800">
                Browse All Talent &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($topTalents ?? [] as $talent)
            <div class="bg-white rounded-xl border border-gray-100 p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                <div class="w-20 h-20 mx-auto bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 text-2xl font-bold mb-4">
                    {{ substr($talent->name ?? 'A', 0, 1) }}
                </div>
                <h3 class="text-lg font-bold text-gray-900"><a href="{{ route('talents.show', $talent->username ?? $talent->id) }}" class="hover:text-indigo-600">{{ $talent->name ?? 'Student Name' }}</a></h3>
                <p class="text-sm text-gray-500 mb-3">{{ $talent->location ?? 'Indonesia' }}</p>
                
                <div class="flex items-center justify-center gap-1 text-yellow-400 mb-4">
                    @php $avgRating = method_exists($talent, 'averageRating') ? $talent->averageRating() : 5; @endphp
                    @for($i=1; $i<=5; $i++)
                        <svg class="w-4 h-4 {{ $i <= ($avgRating > 0 ? $avgRating : 5) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>

                <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $talent->bio ?? 'Passionate student ready for new challenges.' }}</p>

                <div class="flex flex-wrap justify-center gap-2">
                    @foreach(collect($talent->skills ?? [])->take(3) as $skill)
                    <span class="px-2 py-1 bg-gray-50 text-gray-600 text-xs rounded border border-gray-100">{{ $skill->name ?? $skill }}</span>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Talent profiles are currently being updated.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Business CTA Section -->
<section class="py-20 bg-gray-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-4">Need someone to get things done?</h2>
        <p class="text-xl text-gray-400 mb-10">Post your project and connect with skilled talent from top universities.</p>
        <a href="{{ url('/register') }}" class="inline-block px-8 py-4 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors shadow-lg">
            Hire Talent Now
        </a>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-24 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-extrabold tracking-tight mb-8">Your next opportunity starts here.</h2>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ url('/register') }}" class="px-8 py-3 bg-white text-indigo-700 font-bold rounded-lg shadow-lg hover:bg-gray-50 transition-colors">
                Get Started
            </a>
            <a href="{{ url('/how-it-works') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-indigo-700 transition-colors">
                Learn More
            </a>
        </div>
    </div>
</section>
@endsection
