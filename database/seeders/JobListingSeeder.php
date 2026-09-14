<?php

namespace Database\Seeders;

use App\Models\JobListing;
use App\Models\SkillCategory;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        $clients = User::where('role', 'client')->get();
        $skills = Skill::all();
        $categories = SkillCategory::all();

        if ($clients->isEmpty()) {
            return;
        }

        $jobs = [
            ['title' => 'Fullstack Developer untuk Platform E-Learning', 'cat' => 'Web Development', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'intermediate', 'min' => 5000000, 'max' => 10000000],
            ['title' => 'Desainer UI/UX Aplikasi Mobile Banking', 'cat' => 'UI/UX Design', 'type' => 'contract', 'mode' => 'hybrid', 'exp' => 'intermediate', 'min' => 3000000, 'max' => 7000000],
            ['title' => 'Social Media Manager Startup F&B', 'cat' => 'Digital Marketing', 'type' => 'part_time', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 1500000, 'max' => 3000000],
            ['title' => 'Content Writer Blog Teknologi', 'cat' => 'Content Writing', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 500000, 'max' => 2000000],
            ['title' => 'Video Editor untuk YouTube Channel Edukasi', 'cat' => 'Video & Animation', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 1000000, 'max' => 3000000],
            ['title' => 'Mobile Developer Flutter E-Commerce', 'cat' => 'Mobile Development', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'intermediate', 'min' => 8000000, 'max' => 15000000],
            ['title' => 'Data Analyst Intern', 'cat' => 'Data Science', 'type' => 'internship', 'mode' => 'onsite', 'exp' => 'beginner', 'min' => 1000000, 'max' => 2500000],
            ['title' => 'SEO Specialist untuk E-Commerce Fashion', 'cat' => 'Digital Marketing', 'type' => 'contract', 'mode' => 'remote', 'exp' => 'intermediate', 'min' => 3000000, 'max' => 5000000],
            ['title' => 'Graphic Designer Brand Identity Kopi', 'cat' => 'Graphic Design', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 2000000, 'max' => 5000000],
            ['title' => 'Laravel Developer untuk Startup SaaS', 'cat' => 'Web Development', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'expert', 'min' => 10000000, 'max' => 20000000],
            ['title' => 'Frontend React Developer Dashboard Analytics', 'cat' => 'Web Development', 'type' => 'contract', 'mode' => 'hybrid', 'exp' => 'intermediate', 'min' => 7000000, 'max' => 12000000],
            ['title' => 'Backend API Developer Node.js', 'cat' => 'Web Development', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'intermediate', 'min' => 6000000, 'max' => 10000000],
            ['title' => 'Digital Marketing Strategist UMKM', 'cat' => 'Digital Marketing', 'type' => 'part_time', 'mode' => 'hybrid', 'exp' => 'beginner', 'min' => 2000000, 'max' => 4000000],
            ['title' => 'Translator Bahasa Inggris - Indonesia', 'cat' => 'Content Writing', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 500000, 'max' => 1500000],
            ['title' => 'Virtual Assistant untuk CEO Startup', 'cat' => 'Others', 'type' => 'part_time', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 1500000, 'max' => 3000000],
            ['title' => 'Motion Graphics Designer Iklan', 'cat' => 'Video & Animation', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'intermediate', 'min' => 3000000, 'max' => 6000000],
            ['title' => 'WordPress Developer Website Company Profile', 'cat' => 'Web Development', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 2000000, 'max' => 5000000],
            ['title' => 'Bookkeeper Part-Time UMKM', 'cat' => 'Business & Finance', 'type' => 'part_time', 'mode' => 'onsite', 'exp' => 'beginner', 'min' => 1500000, 'max' => 3000000],
            ['title' => 'Python Developer Automasi Data', 'cat' => 'Data Science', 'type' => 'freelance', 'mode' => 'remote', 'exp' => 'expert', 'min' => 8000000, 'max' => 15000000],
            ['title' => 'Canva Designer Social Media Content', 'cat' => 'Graphic Design', 'type' => 'gig', 'mode' => 'remote', 'exp' => 'beginner', 'min' => 500000, 'max' => 1500000],
        ];

        foreach ($jobs as $index => $j) {
            $client = $clients->random();
            $category = $categories->where('name', $j['cat'])->first();
            $status = $index < 16 ? 'open' : 'closed';

            $job = JobListing::create([
                'user_id' => $client->id,
                'title' => $j['title'],
                'slug' => Str::slug($j['title']) . '-' . Str::random(4),
                'description' => "Kami sedang mencari kandidat terbaik untuk posisi {$j['title']}.\n\nAnda akan bekerja dalam tim yang dinamis dan inovatif. Posisi ini cocok untuk Anda yang memiliki passion di bidang ini dan ingin mendapatkan pengalaman nyata.\n\nTanggung jawab:\n- Mengerjakan project sesuai brief yang diberikan\n- Berkomunikasi secara profesional dengan tim\n- Menyelesaikan deliverables tepat waktu\n- Memberikan update progress secara berkala\n\nKualifikasi:\n- Memiliki pengalaman yang relevan\n- Mampu bekerja secara mandiri maupun tim\n- Memiliki portfolio yang bisa ditunjukkan\n- Deadline-oriented dan bertanggung jawab",
                'category_id' => $category?->id,
                'job_type' => $j['type'],
                'work_mode' => $j['mode'],
                'experience_level' => $j['exp'],
                'budget_min' => $j['min'],
                'budget_max' => $j['max'],
                'location' => $client->location,
                'status' => $status,
                'deadline' => now()->addDays(rand(14, 60)),
            ]);

            if ($skills->count() > 0) {
                $categorySkills = $skills->where('skill_category_id', $category?->id);
                if ($categorySkills->count() >= 2) {
                    $job->skills()->attach($categorySkills->random(min(rand(2, 4), $categorySkills->count()))->pluck('id'));
                } else {
                    $job->skills()->attach($skills->random(rand(2, 4))->pluck('id'));
                }
            }
        }
    }
}
