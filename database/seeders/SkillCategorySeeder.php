<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Web Development',
            'Mobile Development',
            'UI/UX Design',
            'Graphic Design',
            'Data Science',
            'Digital Marketing',
            'Content Writing',
            'Video & Animation',
            'Business & Finance',
            'Others'
        ];

        foreach ($categories as $category) {
            SkillCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => 'Kategori untuk keterampilan ' . $category,
            ]);
        }
    }
}
