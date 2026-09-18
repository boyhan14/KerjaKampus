<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JobStatus;
use App\Enums\ReportStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\Report;
use App\Models\Review;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_talents' => User::where('role', 'talent')->count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_jobs' => JobListing::count(),
            'total_applications' => Application::count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'pending_reports' => Report::where('status', ReportStatus::PENDING)->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = JobListing::with('client')->latest()->take(5)->get();
        $recentReports = Report::with('reporter')->where('status', ReportStatus::PENDING)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs', 'recentReports'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('username', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:active,suspended,pending,rejected,flagged']);

        $user->update(['status' => UserStatus::from($request->status)]);

        return redirect()->back()->with('success', "Status pengguna {$user->name} berhasil diubah menjadi {$request->status}.");
    }

    public function jobs(Request $request)
    {
        $query = JobListing::with('client', 'category');

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->latest()->paginate(15)->withQueryString();

        return view('admin.jobs', compact('jobs'));
    }

    public function updateJobStatus(Request $request, JobListing $job)
    {
        $request->validate(['status' => 'required|in:draft,open,closed,suspended']);

        $job->update(['status' => JobStatus::from($request->status)]);

        return redirect()->back()->with('success', "Status lowongan berhasil diubah menjadi {$request->status}.");
    }

    public function skills()
    {
        $skills = Skill::with('category')->latest()->paginate(20);
        $categories = SkillCategory::all();

        return view('admin.skills', compact('skills', 'categories'));
    }

    public function storeSkill(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill_category_id' => 'required|exists:skill_categories,id',
        ]);

        $slug = Str::slug($validated['name']);
        if (Skill::where('slug', $slug)->exists()) {
            $slug .= '-'.Str::random(4);
        }

        Skill::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'skill_category_id' => $validated['skill_category_id'],
        ]);

        Cache::forget('job_skills_all');
        Cache::forget('public_talents_skills_list');
        Cache::forget('home_platform_stats');

        return redirect()->back()->with('success', 'Keahlian baru berhasil ditambahkan.');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill_category_id' => 'required|exists:skill_categories,id',
        ]);

        $skill->update($validated);

        Cache::forget('job_skills_all');
        Cache::forget('public_talents_skills_list');

        return redirect()->back()->with('success', 'Keahlian berhasil diperbarui.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();

        Cache::forget('job_skills_all');
        Cache::forget('public_talents_skills_list');
        Cache::forget('home_platform_stats');

        return redirect()->back()->with('success', 'Keahlian berhasil dihapus.');
    }

    public function categories()
    {
        $categories = SkillCategory::withCount('skills')->latest()->paginate(15);

        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skill_categories,name',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SkillCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'icon' => $validated['icon'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        Cache::forget('job_categories_all');

        return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, SkillCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        Cache::forget('job_categories_all');

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(SkillCategory $category)
    {
        $category->delete();

        Cache::forget('job_categories_all');

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function reports(Request $request)
    {
        $reports = Report::with('reporter')->latest()->paginate(15);

        return view('admin.reports', compact('reports'));
    }

    public function resolveReport(Report $report)
    {
        $report->update([
            'status' => ReportStatus::RESOLVED,
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil ditandai selesai.');
    }

    public function dismissReport(Report $report)
    {
        $report->update([
            'status' => ReportStatus::DISMISSED,
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Laporan diabaikan.');
    }

    public function reviews()
    {
        $reviews = Review::with('reviewer', 'reviewee', 'project')->latest()->paginate(15);

        return view('admin.reviews', compact('reviews'));
    }

    public function destroyReview(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
