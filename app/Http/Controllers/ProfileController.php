<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('skills', 'portfolioItems', 'reviewsReceived.reviewer');
        $completion = $user->profileCompletionPercentage();
        return view('profile.show', compact('user', 'completion'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'education' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'website' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        $user->update(['avatar' => $path]);

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function publicProfile(string $username)
    {
        $talent = User::where('username', $username)
            ->when(is_numeric($username), fn($q) => $q->orWhere('id', $username))
            ->with(['skills', 'portfolioItems' => function ($q) {
                $q->where('is_published', true);
            }, 'reviewsReceived.reviewer'])
            ->firstOrFail();

        return view('public.talent-profile', compact('talent'));
    }
}
