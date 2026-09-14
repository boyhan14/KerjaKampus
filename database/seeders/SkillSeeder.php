<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skillsData = [
            'Web Development' => ['Laravel', 'PHP', 'JavaScript', 'TypeScript', 'React', 'Next.js', 'Vue.js', 'Node.js', 'HTML/CSS', 'WordPress'],
            'Mobile Development' => ['Flutter', 'React Native', 'Kotlin', 'Swift', 'Java'],
            'UI/UX Design' => ['Figma', 'Adobe XD', 'Sketch', 'Wireframing', 'Prototyping'],
            'Graphic Design' => ['Photoshop', 'Illustrator', 'Canva', 'Logo Design', 'Brand Identity'],
            'Data Science' => ['Python', 'R', 'Machine Learning', 'SQL', 'Data Visualization', 'Excel'],
            'Digital Marketing' => ['SEO', 'Social Media', 'Google Ads', 'Email Marketing', 'Copywriting'],
            'Content Writing' => ['Blog Writing', 'Technical Writing', 'Content Strategy', 'Translation'],
            'Video & Animation' => ['Video Editing', 'Motion Graphics', 'After Effects', 'Premiere Pro'],
            'Business & Finance' => ['Financial Analysis', 'Bookkeeping', 'Business Plan', 'Presentation'],
            'Others' => ['Data Entry', 'Virtual Assistant', 'Customer Service', 'Research'],
        ];

        foreach ($skillsData as $categoryName => $skills) {
            $category = SkillCategory::where('name', $categoryName)->first();
            
            if ($category) {
                foreach ($skills as $skill) {
                    Skill::create([
                        'skill_category_id' => $category->id,
                        'name' => $skill,
                        'slug' => Str::slug($skill),
                    ]);
                }
            }
        }
    }
}
