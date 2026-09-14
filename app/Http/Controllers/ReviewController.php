<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use App\Services\ReviewService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(protected ReviewService $reviewService)
    {
    }

    public function index()
    {
        $reviews = Review::where('reviewee_id', Auth::id())
            ->with('reviewer', 'project')
            ->latest()
            ->paginate(15);
            
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        try {
            $this->reviewService->create(Auth::user(), $project, $validated);
            return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
