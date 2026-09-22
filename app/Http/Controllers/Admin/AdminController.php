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
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

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
            $search = trim($request->search);
            $numericId = ltrim($search, '#');
            $query->where(function ($q) use ($search, $numericId) {
                if (is_numeric($numericId)) {
                    $q->orWhere('id', (int) $numericId);
                }
                $q->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
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

        $newStatus = UserStatus::from($request->status);
        $user->update(['status' => $newStatus]);

        if ($newStatus === UserStatus::SUSPENDED) {
            $this->notificationService->send(
                $user,
                'account_suspended',
                'Pemberitahuan Penangguhan Akun',
                'Akun Anda telah disuspend oleh Administrator karena indikasi pelanggaran aturan komunitas. Silakan hubungi admin jika butuh klarifikasi.',
                ['status' => 'suspended']
            );
        } elseif ($newStatus === UserStatus::ACTIVE) {
            $this->notificationService->send(
                $user,
                'account_activated',
                'Akun Anda Telah Diaktifkan Kembali',
                'Akun Anda telah diaktifkan kembali oleh Administrator. Anda dapat menggunakan seluruh layanan platform seperti biasa.',
                ['status' => 'active']
            );
        } elseif ($newStatus === UserStatus::FLAGGED) {
            $this->notificationService->send(
                $user,
                'account_flagged',
                'Peringatan Akun',
                'Akun Anda ditandai oleh Administrator untuk peninjauan. Mohon patuhi pedoman dan kebijakan komunitas KerjaKampus.',
                ['status' => 'flagged']
            );
        }

        return redirect()->back()->with('success', "Status pengguna {$user->name} berhasil diubah menjadi {$request->status} dan notifikasi telah dikirimkan.");
    }

    public function jobs(Request $request)
    {
        $query = JobListing::with('client', 'category');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $numericId = ltrim($search, '#');
            $query->where(function ($q) use ($search, $numericId) {
                if (is_numeric($numericId)) {
                    $q->orWhere('id', (int) $numericId);
                }
                $q->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
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

        $newStatus = JobStatus::from($request->status);
        $job->update(['status' => $newStatus]);

        if ($job->client) {
            if ($newStatus === JobStatus::CLOSED) {
                $this->notificationService->send(
                    $job->client,
                    'job_closed',
                    'Lowongan Pekerjaan Ditutup',
                    "Lowongan pekerjaan '{$job->title}' telah ditutup oleh Administrator.",
                    ['job_id' => $job->id, 'status' => 'closed']
                );
            } elseif ($newStatus === JobStatus::SUSPENDED) {
                $this->notificationService->send(
                    $job->client,
                    'job_suspended',
                    'Lowongan Pekerjaan Ditangguhkan',
                    "Lowongan pekerjaan '{$job->title}' ditangguhkan oleh Administrator untuk peninjauan kepatuhan.",
                    ['job_id' => $job->id, 'status' => 'suspended']
                );
            } elseif ($newStatus === JobStatus::OPEN) {
                $this->notificationService->send(
                    $job->client,
                    'job_opened',
                    'Lowongan Pekerjaan Disetujui',
                    "Lowongan pekerjaan '{$job->title}' telah disetujui dan dibuka oleh Administrator.",
                    ['job_id' => $job->id, 'status' => 'open']
                );
            }
        }

        return redirect()->back()->with('success', "Status lowongan berhasil diubah menjadi {$request->status} dan notifikasi telah dikirim ke pemilik lowongan.");
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
        $query = Report::with('reporter');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $numericId = ltrim($search, '#');

            $query->where(function ($q) use ($search, $numericId) {
                if (is_numeric($numericId)) {
                    $q->orWhere('id', (int) $numericId)
                      ->orWhere('target_id', (int) $numericId);
                }
                $q->orWhere('reason', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('reporter', function ($sub) use ($search) {
                      $sub->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('target_type')) {
            $query->where('target_type', $request->target_type);
        }

        if ($request->filled('status')) {
            $statusVal = strtolower(trim($request->status));
            $query->where('status', $statusVal);
        }

        $reports = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'dismissed' => Report::where('status', 'dismissed')->count(),
        ];

        return view('admin.reports', compact('reports', 'stats'));
    }

    public function resolveReport(Report $report)
    {
        $report->update([
            'status' => ReportStatus::RESOLVED,
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        if ($report->reporter) {
            $this->notificationService->send(
                $report->reporter,
                'report_resolved',
                'Laporan Anda Telah Diselesaikan',
                "Laporan Anda terkait {$report->target_type} #{$report->target_id} telah ditinjau dan ditindaklanjuti oleh Administrator. Terima kasih atas kontribusi Anda dalam menjaga keamanan platform.",
                ['report_id' => $report->id, 'status' => 'resolved']
            );
        }

        return redirect()->back()->with('success', 'Laporan berhasil ditandai selesai dan notifikasi telah dikirim ke pelapor.');
    }

    public function dismissReport(Report $report)
    {
        $report->update([
            'status' => ReportStatus::DISMISSED,
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        if ($report->reporter) {
            $this->notificationService->send(
                $report->reporter,
                'report_dismissed',
                'Pembaruan Status Laporan',
                "Laporan Anda terkait {$report->target_type} #{$report->target_id} telah ditinjau oleh Administrator dan ditutup karena bukti belum mencukupi.",
                ['report_id' => $report->id, 'status' => 'dismissed']
            );
        }

        return redirect()->back()->with('success', 'Laporan diabaikan dan notifikasi telah dikirim ke pelapor.');
    }

    public function reopenReport(Report $report)
    {
        $report->update([
            'status' => ReportStatus::PENDING,
            'resolved_by' => null,
            'resolved_at' => null,
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil dikembalikan ke Menunggu Tindakan (Pending).');
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
