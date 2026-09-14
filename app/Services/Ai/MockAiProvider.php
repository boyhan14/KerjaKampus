<?php

namespace App\Services\Ai;

use App\Contracts\AiProviderInterface;

class MockAiProvider implements AiProviderInterface
{
    public function generateText(string $prompt, array $options = []): string
    {
        return "Proyek ini berhasil dirancang dan diimplementasikan dengan standar arsitektur modern. Memadukan antarmuka yang intuitif dan responsif dengan performa tinggi, aplikasi ini memberikan solusi nyata dalam meningkatkan efisiensi operasional dan kepuasan pengguna akhir.";
    }

    public function analyze(string $input, string $task): array
    {
        return match ($task) {
            'cv_analysis' => [
                'score' => 86,
                'strengths' => [
                    'Struktur penulisan jelas dan berorientasi pada pencapaian',
                    'Keahlian teknis relevan dengan kebutuhan industri digital',
                    'Portofolio proyek nyata mendukung klaim keahlian',
                ],
                'weaknesses' => [
                    'Dapat ditambahkan metrik kuantitatif keberhasilan proyek (misal: meningkatkan efisiensi 25%)',
                    'Sertifikasi industri pendukung masih dapat ditingkatkan',
                ],
                'suggestions' => [
                    'Sertakan tautan langsung ke live demo atau GitHub pada setiap portofolio',
                    'Gunakan kata kerja aksi di awal setiap poin pengalaman',
                ],
            ],
            'career_guidance' => [
                'recommended_roles' => [
                    'Fullstack Web Developer',
                    'Backend Engineer (Laravel/Node.js)',
                    'Frontend Engineer (React/Tailwind)',
                ],
                'skill_gaps' => [
                    'Automated Testing (PHPUnit/Pest)',
                    'CI/CD Pipeline & Docker Deployment',
                ],
                'suggested_projects' => [
                    'Bangun SaaS sederhana dengan sistem autentikasi dan payment gateway',
                    'Buat RESTful API berkinerja tinggi dengan sistem caching Redis',
                ],
            ],
            default => [
                'status' => 'success',
                'message' => 'Analisis berhasil diproses secara otomatis.',
            ]
        };
    }
}
