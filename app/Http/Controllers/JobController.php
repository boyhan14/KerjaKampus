<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Models\JobListing;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::where('status', JobStatus::OPEN)->with('category', 'skills', 'client');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('skill_ids')) {
            $skillIds = is_array($request->skill_ids) ? $request->skill_ids : [$request->skill_ids];
            $query->whereHas('skills', function ($q) use ($skillIds) {
                $q->whereIn('skills.id', $skillIds);
            });
        }

        if ($request->filled('budget_min')) {
            $query->where('budget_max', '>=', $request->budget_min);
        }

        if ($request->filled('budget_max')) {
            $query->where('budget_min', '<=', $request->budget_max);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('work_mode')) {
            $query->where('work_mode', $request->work_mode);
        }

        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'budget_high':
                    $query->orderBy('budget_max', 'desc');
                    break;
                case 'budget_low':
                    $query->orderBy('budget_min', 'asc');
                    break;
                case 'deadline':
                    $query->orderBy('deadline', 'asc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(12)->withQueryString();
        $categories = SkillCategory::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();

        return view('jobs.index', compact('jobs', 'categories', 'skills'));
    }

    public function show(string $slug)
    {
        $job = JobListing::where('slug', $slug)
            ->when(is_numeric($slug), fn ($q) => $q->orWhere('id', $slug))
            ->with(['category', 'skills', 'client'])
            ->firstOrFail();

        $hasApplied = false;
        $userApplication = null;
        if (Auth::check()) {
            $userApplication = $job->applications()->where('user_id', Auth::id())->first();
            $hasApplied = ! is_null($userApplication);
        }

        return view('jobs.show', compact('job', 'hasApplied', 'userApplication'));
    }

    public function create()
    {
        $user = Auth::user();
        if (! $user->isClient() && ! $user->isAdmin()) {
            abort(403, 'Hanya klien yang dapat membuat lowongan pekerjaan.');
        }

        $categories = SkillCategory::all();
        $skills = Skill::all();

        return view('jobs.create', compact('categories', 'skills'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user->isClient() && ! $user->isAdmin()) {
            abort(403, 'Hanya klien yang dapat membuat lowongan pekerjaan.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:skill_categories,id',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gte:budget_min',
            'deadline' => 'required|date|after:today',
            'job_type' => 'required|in:freelance,gig,internship,part_time,contract',
            'work_mode' => 'required|in:remote,onsite,hybrid',
            'experience_level' => 'required|in:beginner,intermediate,expert',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $slug = Str::slug($validated['title']);
        if (JobListing::where('slug', $slug)->exists()) {
            $slug .= '-'.Str::random(5);
        }

        $job = JobListing::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'budget_min' => $validated['budget_min'],
            'budget_max' => $validated['budget_max'],
            'deadline' => $validated['deadline'],
            'job_type' => $validated['job_type'],
            'work_mode' => $validated['work_mode'],
            'experience_level' => $validated['experience_level'],
            'location' => $validated['location'] ?? $user->location,
            'status' => JobStatus::OPEN,
        ]);

        if (! empty($validated['skills'])) {
            $job->skills()->attach($validated['skills']);
        }

        return redirect()->route('jobs.my')->with('success', 'Pekerjaan berhasil dipublikasikan!');
    }

    public function edit(JobListing $job)
    {
        $this->authorizeOwnership($job);

        $categories = SkillCategory::all();
        $skills = Skill::all();

        return view('jobs.edit', compact('job', 'categories', 'skills'));
    }

    public function update(Request $request, JobListing $job)
    {
        $this->authorizeOwnership($job);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:skill_categories,id',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gte:budget_min',
            'deadline' => 'required|date',
            'job_type' => 'required|in:freelance,gig,internship,part_time,contract',
            'work_mode' => 'required|in:remote,onsite,hybrid',
            'experience_level' => 'required|in:beginner,intermediate,expert',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'budget_min' => $validated['budget_min'],
            'budget_max' => $validated['budget_max'],
            'deadline' => $validated['deadline'],
            'job_type' => $validated['job_type'],
            'work_mode' => $validated['work_mode'],
            'experience_level' => $validated['experience_level'],
            'location' => $validated['location'] ?? $job->location,
        ]);

        if (isset($validated['skills'])) {
            $job->skills()->sync($validated['skills']);
        } else {
            $job->skills()->detach();
        }

        return redirect()->route('jobs.my')->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(JobListing $job)
    {
        $this->authorizeOwnership($job);

        if ($job->status !== JobStatus::DRAFT && $job->applications()->count() > 0) {
            return redirect()->back()->with('error', 'Pekerjaan yang memiliki pelamar tidak dapat dihapus. Anda dapat menutup lowongan.');
        }

        $job->skills()->detach();
        $job->delete();

        return redirect()->route('jobs.my')->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }

    public function toggleStatus(JobListing $job)
    {
        $this->authorizeOwnership($job);

        if ($job->status === JobStatus::DRAFT || $job->status === JobStatus::CLOSED) {
            $job->update(['status' => JobStatus::OPEN]);
            $msg = 'Lowongan pekerjaan dibuka kembali.';
        } elseif ($job->status === JobStatus::OPEN) {
            $job->update(['status' => JobStatus::CLOSED]);
            $msg = 'Lowongan pekerjaan berhasil ditutup.';
        } else {
            return redirect()->back()->with('error', 'Status lowongan tidak dapat diubah.');
        }

        return redirect()->back()->with('success', $msg);
    }

    public function myJobs(Request $request)
    {
        $user = Auth::user();
        $baseQuery = $user->isAdmin() ? JobListing::query() : $user->jobListings();

        $counts = [
            'all' => (clone $baseQuery)->count(),
            'open' => (clone $baseQuery)->where('status', JobStatus::OPEN)->count(),
            'closed' => (clone $baseQuery)->where('status', JobStatus::CLOSED)->count(),
            'draft' => (clone $baseQuery)->where('status', JobStatus::DRAFT)->count(),
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

        $jobs = $query->withCount('applications')->latest()->paginate(12)->withQueryString();

        return view('jobs.my', compact('jobs', 'counts'));
    }

    private function authorizeOwnership(JobListing $job)
    {
        if (Auth::id() !== $job->user_id && ! Auth::user()->isAdmin()) {
            abort(403, 'Akses tidak diizinkan.');
        }
    }
}
