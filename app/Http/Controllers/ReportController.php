<?php

namespace App\Http\Controllers;

use App\Enums\ReportStatus;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'target_type' => 'required|in:user,job,review',
            'target_id' => 'required|integer',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Report::create([
            'reporter_id' => Auth::id(),
            'target_type' => $validated['target_type'],
            'target_id' => $validated['target_id'],
            'reason' => $validated['reason'],
            'description' => $validated['description'] ?? null,
            'status' => ReportStatus::PENDING,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim dan akan ditinjau oleh admin.');
    }
}
