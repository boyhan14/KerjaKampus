<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Enums\UserRole;
use App\Models\JobListing;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicController extends Controller
{
    public function home()
    {
        $featuredJobs = JobListing::where('status', JobStatus::OPEN)
            ->with(['category', 'skills', 'client'])
            ->latest()
            ->take(6)
            ->get();

        $topTalents = User::where('role', UserRole::TALENT)
            ->with(['skills', 'portfolioItems'])
            ->withAvg('reviewsReceived', 'rating')
            ->latest()
            ->take(8)
            ->get();

        $stats = Cache::remember('home_platform_stats', 300, function () {
            return [
                'talentCount' => User::where('role', UserRole::TALENT)->count(),
                'jobCount' => JobListing::where('status', JobStatus::OPEN)->count(),
                'skillCount' => Skill::count(),
            ];
        });

        $talentCount = $stats['talentCount'];
        $jobCount = $stats['jobCount'];
        $skillCount = $stats['skillCount'];

        return view('public.home', compact('featuredJobs', 'topTalents', 'talentCount', 'jobCount', 'skillCount'));
    }

    public function talents(Request $request)
    {
        $query = User::where('role', UserRole::TALENT)
            ->with(['skills.category', 'portfolioItems'])
            ->withAvg('reviewsReceived', 'rating');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhereHas('skills', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('skill_id')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('skills.id', $request->skill_id);
            });
        }

        $talents = $query->latest()->paginate(12)->withQueryString();
        $skills = Skill::orderBy('name')->get();

        return view('public.talents', compact('talents', 'skills'));
    }

    public function howItWorks()
    {
        return view('public.how-it-works');
    }

    public function pricing()
    {
        return view('public.pricing');
    }
}
