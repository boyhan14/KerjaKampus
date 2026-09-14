@extends('layouts.app')

@section('title', 'Talent Directory - KerjaKampus')

@section('content')
<div class="bg-gray-50 py-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Search -->
        <div class="mb-10 text-center max-w-3xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Find Top Talent</h1>
            <p class="text-lg text-gray-600 mb-8">Discover skilled students and professionals ready to help with your next project.</p>
            
            <form action="{{ url('/talents') }}" method="GET" class="flex items-center bg-white p-2 rounded-full shadow-sm border border-gray-200">
                <input type="text" name="search" placeholder="Search by name, skills, or role..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 bg-transparent border-none focus:ring-0 text-gray-700 outline-none">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 transition-colors">
                    Search
                </button>
            </form>
        </div>

        <!-- Filters / Sorting -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <div class="text-gray-600">
                Showing {{ $talents->firstItem() ?? 0 }} to {{ $talents->lastItem() ?? 0 }} of {{ $talents->total() ?? 0 }} talents
            </div>
            <div>
                <select name="sort" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="recommended">Recommended</option>
                    <option value="newest">Newest Arrivals</option>
                    <option value="rating">Highest Rated</option>
                </select>
            </div>
        </div>

        <!-- Talent Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($talents as $talent)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col hover:shadow-md transition-shadow">
                <div class="relative mb-4">
                    <div class="w-24 h-24 mx-auto bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 text-3xl font-bold border-4 border-white shadow-sm">
                        {{ substr($talent->name, 0, 1) }}
                    </div>
                    @if($talent->is_available ?? true)
                    <span class="absolute bottom-0 right-1/4 block h-4 w-4 rounded-full bg-green-400 border-2 border-white" title="Available for work"></span>
                    @endif
                </div>
                
                <div class="text-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900 leading-tight">
                        <a href="{{ url('/talents/'.$talent->username) }}" class="hover:text-indigo-600">{{ $talent->name }}</a>
                    </h3>
                    <p class="text-sm text-gray-500">{{ '@'.$talent->username }}</p>
                    <div class="flex items-center justify-center mt-1 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $talent->location ?? 'Indonesia' }}
                    </div>
                </div>

                <div class="flex items-center justify-center gap-1 text-yellow-400 mb-4">
                    @php $rating = $talent->rating ?? 5; @endphp
                    @for($i=1; $i<=5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                    <span class="text-xs text-gray-500 ml-1">({{ $talent->reviews_count ?? 0 }})</span>
                </div>

                <p class="text-sm text-gray-600 line-clamp-3 mb-4 text-center flex-grow">
                    {{ $talent->bio ?? 'No bio provided yet. But this talent is eager to work on great projects!' }}
                </p>

                <div class="flex flex-wrap justify-center gap-2 mb-6">
                    @foreach(collect($talent->skills ?? [])->take(3) as $skill)
                    <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-xs font-medium rounded">{{ $skill->name ?? $skill }}</span>
                    @endforeach
                    @if(count($talent->skills ?? []) > 3)
                    <span class="px-2 py-1 bg-gray-50 text-gray-600 text-xs font-medium rounded">+{{ count($talent->skills) - 3 }}</span>
                    @endif
                </div>
                
                <a href="{{ url('/talents/'.$talent->username) }}" class="mt-auto block w-full py-2 text-center border border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors">
                    View Profile
                </a>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No talents found</h3>
                <p class="text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
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
