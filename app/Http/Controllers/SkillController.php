<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('skills.category');
        $userSkillIds = $user->skills->pluck('id')->toArray();
        $availableSkills = Skill::with('category')->whereNotIn('id', $userSkillIds)->get();

        return view('skills.index', compact('user', 'availableSkills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'level' => 'nullable|in:beginner,intermediate,expert',
        ]);

        $user = Auth::user();

        if (!$user->skills()->where('skills.id', $request->skill_id)->exists()) {
            $user->skills()->attach($request->skill_id, [
                'level' => $request->level ?? 'intermediate',
            ]);
        }

        return redirect()->route('skills.index')->with('success', 'Keahlian berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        // Check if $id is UserSkill id or Skill id
        $userSkill = UserSkill::where('id', $id)->where('user_id', $user->id)->first();
        if ($userSkill) {
            $userSkill->delete();
        } else {
            $user->skills()->detach($id);
        }

        return redirect()->route('skills.index')->with('success', 'Keahlian berhasil dihapus.');
    }
}
