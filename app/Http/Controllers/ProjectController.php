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

    public function index()
    {
        $user = Auth::user();
        
        $query = Project::with('jobListing');
        if ($user->role === \App\Enums\UserRole::TALENT) {
            $query->where('talent_id', $user->id)->with('client');
        } elseif ($user->role === \App\Enums\UserRole::CLIENT) {
            $query->where('client_id', $user->id)->with('talent');
        } else {
            abort(403);
        }

        $projects = $query->latest()->paginate(15);
        
        return view('projects.index', compact('projects'));
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
        if (Auth::id() !== $project->client_id && Auth::id() !== $project->talent_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
