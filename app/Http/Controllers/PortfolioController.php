<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Auth::user()->portfolioItems()->with('skills')->latest()->paginate(12);
        return view('portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $skills = Skill::all();
        return view('portfolio.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'demo_url' => 'nullable|url',
            'repository_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'is_published' => 'nullable|boolean',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('portfolios', 'public');
        }

        $slug = Str::slug($validated['title']);
        if (PortfolioItem::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(5);
        }

        $portfolio = Auth::user()->portfolioItems()->create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'category' => $validated['category'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'repository_url' => $validated['repository_url'] ?? null,
            'thumbnail' => $thumbnailPath,
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $request->boolean('is_published', true) ? now() : null,
        ]);

        if (!empty($validated['skills'])) {
            $portfolio->skills()->attach($validated['skills']);
        }

        return redirect()->route('portfolio.index')->with('success', 'Portofolio proyek berhasil ditambahkan.');
    }

    public function show(string $slug)
    {
        $portfolio = PortfolioItem::where('slug', $slug)
            ->when(is_numeric($slug), fn($q) => $q->orWhere('id', $slug))
            ->with(['user.skills', 'user.portfolioItems' => fn($q) => $q->where('is_published', true)->take(4), 'skills'])
            ->firstOrFail();

        if (!$portfolio->is_published && (!Auth::check() || Auth::id() !== $portfolio->user_id)) {
            abort(404);
        }

        return view('portfolio.show', compact('portfolio'));
    }

    public function edit(PortfolioItem $portfolio)
    {
        $this->authorizeOwnership($portfolio);
        $skills = Skill::all();
        return view('portfolio.edit', compact('portfolio', 'skills'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $this->authorizeOwnership($portfolio);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'demo_url' => 'nullable|url',
            'repository_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail) {
                Storage::disk('public')->delete($portfolio->thumbnail);
            }
            $portfolio->thumbnail = $request->file('thumbnail')->store('portfolios', 'public');
        }

        $portfolio->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'repository_url' => $validated['repository_url'] ?? null,
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $request->boolean('is_published', true) ? ($portfolio->published_at ?? now()) : null,
        ]);

        if (isset($validated['skills'])) {
            $portfolio->skills()->sync($validated['skills']);
        } else {
            $portfolio->skills()->detach();
        }

        return redirect()->route('portfolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        $this->authorizeOwnership($portfolio);

        if ($portfolio->thumbnail) {
            Storage::disk('public')->delete($portfolio->thumbnail);
        }

        $portfolio->skills()->detach();
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portofolio berhasil dihapus.');
    }

    public function togglePublish(PortfolioItem $portfolio)
    {
        $this->authorizeOwnership($portfolio);

        $newStatus = !$portfolio->is_published;
        $portfolio->update([
            'is_published' => $newStatus,
            'published_at' => $newStatus ? now() : null,
        ]);

        $statusText = $newStatus ? 'dipublikasikan' : 'diarsipkan (draft)';
        return redirect()->back()->with('success', "Portofolio berhasil {$statusText}.");
    }

    private function authorizeOwnership(PortfolioItem $portfolio)
    {
        if (Auth::id() !== $portfolio->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Akses tidak diizinkan.');
        }
    }
}
