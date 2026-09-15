<?php

namespace Database\Seeders;

use App\Enums\ReportStatus;
use App\Models\JobListing;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $talents = User::where('role', 'talent')->get();
        $clients = User::where('role', 'client')->get();
        $jobs = JobListing::all();
        $reviews = Review::all();

        if ($talents->isEmpty() || $clients->isEmpty()) {
            return;
        }

        $reporter1 = $talents->first();
        $reporter2 = $clients->first();
        $reportedUser = $talents->last();

        // 1. Laporan user mencurigakan
        Report::create([
            'reporter_id' => $reporter1->id,
            'target_type' => 'user',
            'target_id' => $reportedUser->id,
            'reason' => 'Indikasi Akun Palsu / Profil Tidak Valid',
            'description' => 'Pengguna menggunakan nama kampus dan sertifikat yang meragukan saat berkomunikasi.',
            'status' => ReportStatus::PENDING,
        ]);

        // 2. Laporan lowongan pekerjaan melanggar
        if ($jobs->isNotEmpty()) {
            Report::create([
                'reporter_id' => $reporter1->id,
                'target_type' => 'job',
                'target_id' => $jobs->first()->id,
                'reason' => 'Kompensasi Tidak Sesuai Lingkup Tugas',
                'description' => 'Deskripsi pekerjaan meminta pembangunan sistem perbankan lengkap namun budget hanya Rp 100.000.',
                'status' => ReportStatus::PENDING,
            ]);
        }

        // 3. Laporan review bernada kasar
        if ($reviews->isNotEmpty()) {
            Report::create([
                'reporter_id' => $reporter2->id,
                'target_type' => 'review',
                'target_id' => $reviews->first()->id,
                'reason' => 'Ulasan Mengandung Bahasa Tidak Pantas',
                'description' => 'Ulasan yang diberikan menggunakan kata-kata kasar yang merugikan reputasi profil.',
                'status' => ReportStatus::PENDING,
            ]);
        }
    }
}

