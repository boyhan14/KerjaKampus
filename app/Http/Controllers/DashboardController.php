<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Enums\ApplicationStatus;
use App\Enums\ProjectStatus;
use App\Models\Application;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\User;
use App\Services\JobMatchingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isClient()) {
            return redirect()->route('dashboard.client');
        }

        return redirect()->route('dashboard.talent');
    }

    public function talentDashboard(JobMatchingService $jobMatchingService)
    {
        $user = Auth::user();

        $applications = Application::where('user_id', $user->id)
            ->with('jobListing.client')
            ->latest()
            ->take(5)
            ->get();

        $activeProjects = Project::where('talent_id', $user->id)
            ->where('status', ProjectStatus::ACTIVE)
            ->with('client', 'jobListing')
            ->latest()
            ->get();

        $completedProjects = Project::where('talent_id', $user->id)
            ->where('status', ProjectStatus::COMPLETED)
            ->count();

        $recommendedJobs = $jobMatchingService->getRecommendedJobs($user, 6);

        $profileCompletion = $user->profileCompletionPercentage();
        $averageRating = $user->averageRating();

        return view('dashboard.talent', compact(
            'user', 'applications', 'activeProjects', 'completedProjects',
            'recommendedJobs', 'profileCompletion', 'averageRating'
        ));
    }

    public function clientDashboard()
    {
        $user = Auth::user();

        $jobs = JobListing::where('user_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $activeProjects = Project::where('client_id', $user->id)
            ->where('status', ProjectStatus::ACTIVE)
            ->with('talent')
            ->latest()
            ->get();

        $completedProjects = Project::where('client_id', $user->id)
            ->where('status', ProjectStatus::COMPLETED)
            ->count();

        $jobIds = JobListing::where('user_id', $user->id)->pluck('id');
        $recentApplications = Application::whereIn('job_listing_id', $jobIds)
            ->with('talent', 'jobListing')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.client', compact(
            'user', 'jobs', 'activeProjects', 'completedProjects', 'recentApplications'
        ));
    }
}
