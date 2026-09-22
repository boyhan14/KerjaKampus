<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use App\Services\ApplicationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct(protected ApplicationService $applicationService)
    {
    }

    public function store(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'cover_letter' => 'required|string|min:10',
            'proposed_price' => 'nullable|numeric|min:0',
            'estimated_duration' => 'nullable|string|max:100',
        ]);

        try {
            $this->applicationService->apply(Auth::user(), $job, $validated);
            return redirect()->route('applications.my')->with('success', 'Lamaran Anda berhasil dikirim!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function withdraw(Application $application)
    {
        if (Auth::id() !== $application->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        try {
            $this->applicationService->withdraw($application);
            return redirect()->back()->with('success', 'Lamaran berhasil ditarik kembali.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myApplications(Request $request)
    {
        $user = Auth::user();
        $baseQuery = $user->applications()->with(['jobListing.client', 'project']);

        $counts = [
            'all' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'shortlisted' => (clone $baseQuery)->where('status', 'shortlisted')->count(),
            'accepted' => (clone $baseQuery)->where('status', 'accepted')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];

        $query = clone $baseQuery;

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(15)->withQueryString();
        return view('applications.my', compact('applications', 'counts'));
    }

    public function clientApplications(Request $request)
    {
        $user = Auth::user();
        if ($user->isTalent() && !$user->isClient() && !$user->isAdmin()) {
            return redirect()->route('applications.my');
        }

        if ($user->isAdmin()) {
            $baseQuery = Application::query();
        } else {
            $jobIds = $user->jobListings()->pluck('id');
            $baseQuery = Application::whereIn('job_listing_id', $jobIds);
        }

        $counts = [
            'all' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'shortlisted' => (clone $baseQuery)->where('status', 'shortlisted')->count(),
            'accepted' => (clone $baseQuery)->where('status', 'accepted')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];

        $query = clone $baseQuery;

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->with(['jobListing.client', 'talent.skills', 'project'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('applications.client', compact('applications', 'counts'));
    }

    public function jobApplications(JobListing $job)
    {
        if (Auth::id() !== $job->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $applications = $job->applications()->with(['talent.skills', 'talent.portfolioItems'])->latest()->paginate(15);
        return view('applications.job', compact('job', 'applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        if (Auth::id() !== $application->jobListing->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $request->validate([
            'status' => 'required|in:shortlist,accept,reject',
        ]);

        try {
            switch ($request->status) {
                case 'shortlist':
                    $this->applicationService->shortlist($application);
                    $msg = 'Pelamar berhasil dimasukkan ke daftar shortlist.';
                    break;
                case 'accept':
                    $this->applicationService->accept($application);
                    $msg = 'Pelamar berhasil diterima! Proyek kolaborasi baru telah otomatis dibuat.';
                    break;
                case 'reject':
                    $this->applicationService->reject($application);
                    $msg = 'Status lamaran diubah menjadi ditolak.';
                    break;
            }
            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
