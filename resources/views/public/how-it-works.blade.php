@extends('layouts.app')

@section('title', 'How It Works - KerjaKampus')

@section('content')
<!-- Hero Section -->
<section class="bg-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">How KerjaKampus Works</h1>
        <p class="text-xl text-indigo-100 max-w-3xl mx-auto">
            Whether you're looking to hire talented students or you're a student looking for opportunities, 
            we make the process seamless and secure.
        </p>
    </div>
</section>

<!-- For Talent Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">For Students & Freelancers</span>
            <h2 class="mt-2 text-3xl font-bold text-gray-900">Start Earning with Your Skills</h2>
        </div>

        <div class="relative">
            <!-- Line connecting steps (desktop) -->
            <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-200" aria-hidden="true"></div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-indigo-100 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-indigo-600">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Create a Profile</h3>
                    <p class="text-gray-600">Sign up, list your skills, education, and build your portfolio. Let our AI help you optimize your presentation.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-indigo-100 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-indigo-600">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Find Projects</h3>
                    <p class="text-gray-600">Browse trending opportunities or let our AI match you with projects that perfectly fit your skill set.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-indigo-100 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-indigo-600">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Submit Proposals</h3>
                    <p class="text-gray-600">Pitch your ideas to clients, discuss terms, and get hired. Our platform keeps all communication secure.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-indigo-100 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-indigo-600">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Work & Get Paid</h3>
                    <p class="text-gray-600">Deliver great work, receive secure payments through our escrow system, and build your reputation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- For Client Section -->
<section class="py-20 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">For Clients & Businesses</span>
            <h2 class="mt-2 text-3xl font-bold text-gray-900">Hire Top Student Talent</h2>
        </div>

        <div class="relative">
            <!-- Line connecting steps (desktop) -->
            <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-200" aria-hidden="true"></div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-gray-200 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-gray-700">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Post a Project</h3>
                    <p class="text-gray-600">Describe what you need done, set your budget, and choose project requirements. It's free to post.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-gray-200 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-gray-700">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Review Proposals</h3>
                    <p class="text-gray-600">Receive pitches from qualified students. Compare profiles, portfolios, and reviews to find the best fit.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-gray-200 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-gray-700">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hire & Collaborate</h3>
                    <p class="text-gray-600">Award the project, deposit funds into escrow, and communicate directly through our workspace.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-white border-4 border-gray-200 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="text-2xl font-bold text-gray-700">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Approve & Pay</h3>
                    <p class="text-gray-600">Review the final delivery. Once approved, funds are released to the talent. Leave a review to help them grow.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-white text-center border-t border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Ready to get started?</h2>
        <p class="text-lg text-gray-600 mb-10">Join thousands of students and clients already using KerjaKampus to connect and collaborate.</p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ url('/register') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-700 transition-colors">
                Sign Up Now
            </a>
            <a href="{{ url('/jobs') }}" class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition-colors">
                Browse Projects
            </a>
        </div>
    </div>
</section>
@endsection
