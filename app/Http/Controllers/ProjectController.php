<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        $baseQuery = Project::with('jobListing');
        if ($user->role === \App\Enums\UserRole::TALENT) {
            $baseQuery->where('talent_id', $user->id)->with('client');
        } elseif ($user->role === \App\Enums\UserRole::CLIENT) {
            $baseQuery->where('client_id', $user->id)->with('talent');
        } elseif ($user->isAdmin()) {
            $baseQuery->with(['client', 'talent']);
        } else {
            abort(403);
        }

        // Counts for status tabs
        $counts = [
            'all' => (clone $baseQuery)->count(),
            'active' => (clone $baseQuery)->where('status', \App\Enums\ProjectStatus::ACTIVE)->count(),
            'completed' => (clone $baseQuery)->where('status', \App\Enums\ProjectStatus::COMPLETED)->count(),
            'cancelled' => (clone $baseQuery)->where('status', \App\Enums\ProjectStatus::CANCELLED)->count(),
        ];

        $query = clone $baseQuery;

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->latest()->paginate(15)->withQueryString();
        
        return view('projects.index', compact('projects', 'counts'));
    }

    public function show(Project $project)
    {
        $this->authorizeParticipant($project);
        
        $project->load('jobListing', 'client', 'talent', 'reviews');
        
        return view('projects.show', compact('project'));
    }

    public function complete(Project $project)
    {
        $this->authorizeParticipant($project);

        try {
            $this->projectService->complete($project);
            return redirect()->back()->with('success', 'Proyek berhasil diselesaikan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cancel(Project $project)
    {
        $this->authorizeParticipant($project);

        try {
            $this->projectService->cancel($project);
            return redirect()->back()->with('success', 'Proyek berhasil dibatalkan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function authorizeParticipant(Project $project)
    {
        $user = Auth::user();
        if (!$user->isAdmin() && $user->id !== $project->client_id && $user->id !== $project->talent_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
