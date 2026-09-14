<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $talents = User::where('role', 'talent')->get();
        $jobs = JobListing::where('status', 'open')->get();

        if ($talents->isEmpty() || $jobs->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'pending', 'shortlisted', 'accepted', 'rejected', 'pending'];
        $durations = ['1 minggu', '2 minggu', '1 bulan', '2 bulan', '3 bulan'];

        $coverLetters = [
            'Halo, saya sangat tertarik dengan posisi ini. Saya memiliki pengalaman yang relevan dan yakin bisa memberikan kontribusi terbaik untuk proyek Anda.',
            'Dengan pengalaman saya di bidang ini, saya percaya bisa menyelesaikan proyek ini dengan hasil yang memuaskan. Saya siap berdiskusi lebih lanjut.',
            'Saya telah mengerjakan beberapa proyek serupa sebelumnya. Portfolio saya dapat menjadi referensi kualitas kerja yang bisa saya berikan.',
            'Proyek ini sangat menarik bagi saya. Saya memiliki skill dan passion di bidang ini, dan akan senang bisa bergabung dalam tim Anda.',
            'Saya adalah profesional berdedikasi yang selalu menyelesaikan proyek tepat waktu. Mari berdiskusi tentang bagaimana saya bisa membantu.',
        ];

        $count = 0;
        $maxAttempts = 100;
        $attempts = 0;

        while ($count < 30 && $attempts < $maxAttempts) {
            $attempts++;
            $talent = $talents->random();
            $job = $jobs->random();

            if (Application::where('user_id', $talent->id)->where('job_listing_id', $job->id)->exists()) {
                continue;
            }

            $budgetMin = (float) $job->budget_min;
            $budgetMax = (float) $job->budget_max;
            $proposedPrice = $budgetMin + rand(0, (int)(($budgetMax - $budgetMin) * 0.8));

            Application::create([
                'job_listing_id' => $job->id,
                'user_id' => $talent->id,
                'cover_letter' => $coverLetters[array_rand($coverLetters)],
                'proposed_price' => $proposedPrice,
                'estimated_duration' => $durations[array_rand($durations)],
                'status' => $statuses[array_rand($statuses)],
            ]);

            $job->increment('applicant_count');
            $count++;
        }
    }
}
