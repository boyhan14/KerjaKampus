@extends('layouts.app')

@section('title', 'Pricing - KerjaKampus')

@section('content')
<div class="bg-gray-50 min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-6">Simple, transparent pricing</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-16">
            We believe in giving everyone a fair chance to succeed.
        </p>

        <!-- Current Beta Pricing -->
        <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-indigo-100 mb-20 relative transform scale-105">
            <div class="absolute top-0 right-0 -mr-2 -mt-2 w-24 h-24 overflow-hidden">
                <div class="absolute bg-indigo-500 text-white text-xs font-bold py-1 px-8 shadow-lg transform rotate-45 top-6 -right-6">BETA</div>
            </div>
            
            <div class="px-6 py-10 sm:px-10">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Early Access</h3>
                <div class="mt-4 flex justify-center text-5xl font-extrabold text-indigo-600">
                    Rp 0
                </div>
                <p class="text-center text-gray-500 mt-2 font-medium">Free for all users during beta</p>
                
                <ul class="mt-10 space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="ml-3 text-gray-700">Unlimited profile creations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="ml-3 text-gray-700">Apply to unlimited projects</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="ml-3 text-gray-700">Post unlimited projects</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="ml-3 text-gray-700">0% platform fee on transactions</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="ml-3 text-gray-700">Early access to AI Career tools</span>
                    </li>
                </ul>
                
                <div class="mt-10">
                    <a href="{{ url('/register') }}" class="block w-full text-center px-6 py-4 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors shadow">
                        Join for Free
                    </a>
                </div>
            </div>
        </div>

        <!-- Future Plans Teaser -->
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">What happens after beta?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div class="bg-white p-8 rounded-xl border border-gray-200 shadow-sm opacity-80">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">For Talents</h3>
                    <p class="text-gray-600 mb-4">Joining and applying to projects will always be free. We'll only charge a small platform fee (5-10%) when you successfully complete a project and get paid.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl border border-gray-200 shadow-sm opacity-80">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">For Clients</h3>
                    <p class="text-gray-600 mb-4">Posting projects will remain free. A standard processing fee (3%) will apply on payments to cover payment gateway costs and platform maintenance.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
